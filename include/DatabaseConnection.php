<?php
function db_connect($server = DB_SERVER, $username = DB_SERVER_USERNAME, $password = DB_SERVER_PASSWORD, $database = DB_DATABASE, $link = 'db_link')
{
    global $$link;
    $$link = mysql_connect($server, $username, $password) or die("Couldnt connect DB");
    if ($$link)
        mysql_select_db($database);
    return $$link;
}

function db_close($link = 'db_link')
{
    global $$link;
    return mysql_close($$link);
}

function db_error($query, $errno, $error)
{
    die('<font color="#000000"><b>' . $errno . ' - ' . $error . '<br><br>' . $query . '<br><br><small><font color="#ff0000">[TEP STOP]</font></small><br><br></b></font>');
}

function db_query($query, $link = 'db_link')
{
    global $$link, $logger;
    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) {
        if (!is_object($logger))
            $logger = new logger;
        $logger->write($query, 'QUERY');
    }

    $result = mysql_query($query, $$link) or db_error($query, mysql_errno(), mysql_error());

    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) {
        if (mysql_error())
            $logger->write(mysql_error(), 'ERROR');
    }
    return $result;
}

function sql_query($query)
{
    return mysql_query($query);
}

function db_perform($table, $data, $action = 'insert', $parameters = '', $link = 'db_link')
{
    reset($data);
    if ($action == 'insert') {
        $query = 'insert into ' . $table . ' (';
        while (list($columns, ) = each($data)) {
            $query .= $columns . ', ';
        }
        $query = substr($query, 0, -2) . ') values (';
        reset($data);
        while (list(, $value) = each($data)) {
            switch ((string) $value) {
                case 'now()':
                    $query .= 'now(), ';
                    break;
                case 'null':
                    $query .= 'null, ';
                    break;
                default:
                    $query .= '\'' . db_input($value) . '\', ';
                    break;
            }
        }
        $query = substr($query, 0, -2) . ')';
    } elseif ($action == 'update') {
        $query = 'update ' . $table . ' set ';
        while (list($columns, $value) = each($data)) {
            switch ((string) $value) {
                case 'now()':
                    $query .= $columns . ' = now(), ';
                    break;
                case 'null':
                    $query .= $columns .= ' = null, ';
                    break;
                default:
                    $query .= $columns . ' = \'' . db_input($value) . '\', ';
                    break;
            }
        }
        $query = substr($query, 0, -2) . ' where ' . $parameters;
    }
    return db_query($query, $link);
}

function db_fetch_array($db_query)
{
    return mysql_fetch_array($db_query);
}

function db_result($result, $row, $field = '')
{
    return mysql_result($result, $row, $field);
}

function db_num_rows($db_query)
{
    return mysql_num_rows($db_query);
}

function db_fetch_object($db_query)
{
    return mysql_fetch_object($db_query);
}

function db_data_seek($db_query, $row_number)
{
    return mysql_data_seek($db_query, $row_number);
}

function db_insert_id()
{
    return mysql_insert_id();
}

function db_free_result($db_query)
{
    return mysql_free_result($db_query);
}

function db_fetch_fields($db_query)
{
    return mysql_fetch_field($db_query);
}

function db_output($string)
{
    return htmlspecialchars($string);
}

function db_input($string)
{
    return addslashes($string);
}

function db_prepare_input($string)
{
    if (is_string($string)) {
        return trim(stripslashes($string));
    } elseif (is_array($string)) {
        reset($string);
        while (list($key, $value) = each($string)) {
            $string[$key] = db_prepare_input($value);
        }
        return $string;
    } else {
        return $string;
    }
}


function getManagePagingLink($sqltot, $itemPerPage = 10, $startdata, $jsFun)
{
    $tot         = db_query($sqltot);
    $totalrecord = @db_num_rows($tot);
    $pagesize    = $itemPerPage;
    $noofpages   = $totalrecord / $pagesize;

    $PageContent = '';
    $PageContent .= "<ul class='pagination'>";
    $s       = $startdata / $pagesize;
    $p       = ($startdata - $pagesize) / $pagesize;
    $n       = ($startdata + $pagesize) / $pagesize;
    $curpage = $startdata / $pagesize;
    if ($curpage < 5) {
        $startlmt = 0;
        $endlmt   = 9;

        $dd = (int) $noofpages;
        if ($dd < $noofpages)
            $dd = $dd + 1;
        else
            $dd = (int) $noofpages;

        if ($dd < $endlmt)
            $endlmt = $dd;
    } else {
        $startlmt = $s - 4;
        $endlmt   = $s + 5;
        if ($endlmt > $noofpages) {
            $dd = (int) $noofpages;
            if ($dd < $noofpages)
                $endlmt = $dd + 1;
            else
                $endlmt = (int) $noofpages;
            $startlmt = $endlmt - 10;
            if ($startlmt < 0)
                $startlmt = 0;
        }
    }
    if (($noofpages > 1)) {
        if ($startdata == 0)
            $Pageing .= "<li class='page'><a onclick=\"javascript:void(0);\" style=\"text-decoration:none\">First</a></li>";
        else
            $PageContent .= "<li class='nav'><a onclick=\"return " . $jsFun . "('0');\" style=\"text-decoration:none\">First</a></li>";
    }

    if ($startdata != 0) {
        $prev = $startdata - $pagesize;
        $PageContent .= "<li class='nav'><a onclick=\"return " . $jsFun . "('$prev');\" style=\"text-decoration:none\">Prev</a></li>";
    }
    for ($i = $startlmt; $i < $endlmt; $i++) {
        $pageno = $i + 1;
        $j      = ($pagesize * $pageno) - $pagesize;
        if ($startdata == 0 && $i == 0) {
            $PageContent .= "<li class='page'><a onclick=\"javascript:void(0);\" style=\"text-decoration:none\"><span style=\"text-decoration:none\">" . $pageno . "</span></a></li>";
        } else {
            if ($startdata == ($pagesize * ($pageno)) - $pagesize) {
                $PageContent .= "<li class='page'><a onclick=\"javascript:void(0);\"><span style=\"text-decoration:none\">" . $pageno . "</span></a></li>";
                $curpage = $pageno;
            } else {
                $PageContent .= "<li class='nav'><a onclick=\"return " . $jsFun . "('$j');\"><span style=\"text-decoration:none\">" . $pageno . "</span></a></li>";
            }
        }
    }

    if ($startdata + $pagesize < $totalrecord) {
        $next = $startdata + $pagesize;
        $PageContent .= "<li class='nav'><a onclick=\"return " . $jsFun . "('$next');\"><span style=\"text-decoration:none\">Next</span></a></li>";
    }

    if ($noofpages > 1) {
        $tot = $totalrecord / $pagesize;
        $tt  = (int) $tot;
        if ($tt == $tot)
            $last = $tt * $pagesize - $pagesize;
        else {
            $last = $tt * $pagesize;
            $tt   = $tt + 1;
        }
        if ($curpage != $tt)
        //$PageContent .= "<li class='page'><a onclick=\"javascript:void(0);\"><span style=\"text-decoration:none\">Last</span></a></li>";

        //            else
            $PageContent .= "<li class='nav'><a onclick=\"return " . $jsFun . "('$last');\"><span style=\"text-decoration:none\">Last</span></a></li>";
    }

    $PageContent .= "</ul>";
    return $PageContent;
}

function ProductName($Iid)
{
    $SelectQuery = db_query("Select Kd_Keyword From " . TABLE_KEYWORDMST . " WHERE Kd_Id='" . $Iid . "' ");
    $FetchQuery  = db_fetch_array($SelectQuery);
    return ucfirst($FetchQuery[0]);
}
function ProductCategory($Iid)
{
    $SelectQuery = db_query("Select ProductCat_Name From " . TABLE_PRODUCTCATEGORY . " WHERE ProductCat_Pk='" . $Iid . "' ");
    $FetchQuery  = db_fetch_array($SelectQuery);
    return ucfirst($FetchQuery[0]);
}
function ProductSubCategory($Iid)
{
    $SelectQuery = db_query("Select ProductSubCat_Name From " . TABLE_PRODUCTSUBCATEGORY . " WHERE ProductSubCat_Pk='" . $Iid . "' ");
    $FetchQuery  = db_fetch_array($SelectQuery);
    return ucfirst($FetchQuery[0]);
}
function ProductType($Iid)
{
    $SelectQuery = db_query("Select ProductType_Name From " . TABLE_PRODUCTTYPE . " WHERE ProductType_Pk='" . $Iid . "' ");
    $FetchQuery  = db_fetch_array($SelectQuery);
    return ucfirst($FetchQuery[0]);
}

function StringLeftArrow($string, $symbol, $count)
{
    if ($string != '') {
        $strlength   = strlen($string) + $count;
        $stringright = str_pad($string, $strlength, $symbol, STR_PAD_LEFT);
    }
    if (isset($stringright) && !empty($stringright))
        return $stringright;
}


function StringAppend($string, $symbol, $count, $Type) //Type - STR_PAD_LEFT Or STR_PAD_RIGHT
{
    if ($string != '') {
        $strlength = strlen($string) + $count;
        $stringa   = str_pad($string, $strlength, $symbol, $Type);
    }
    if (isset($stringa) && !empty($stringa))
        return $stringa;
}




//Uploaded file processing function

function process_image_upload($Field, $Uploaded_image_destination, $Processed_image_destination, $Nmid)
{
    $temp_file_path = $_FILES[$Field]['tmp_name'];
    $temp_file_name = $NMid . $_FILES[$Field]['name'];
    list(, , $temp_type) = getimagesize($temp_file_path);
    if ($temp_type === NULL) {
        return false;
    }
    switch ($temp_type) {
        case IMAGETYPE_GIF:
            break;
        case IMAGETYPE_JPEG:
            break;
        case IMAGETYPE_PNG:
            break;
        default:
            return false;
    }
    $uploaded_file_path  = $Uploaded_image_destination . $temp_file_name;
    $processed_file_path = $Processed_image_destination . preg_replace('/\\.[^\\.]+$/', '.jpg', $temp_file_name);
    $result              = move_uploaded_file($temp_file_path, $uploaded_file_path);
    if ($result === false) {
        return false;
    } else {
        return array(
            $uploaded_file_path,
            $processed_file_path
        );
    }
}


function ProductSpecification($id)
{
    $SelSql = db_query("SELECT ProdSpecification FROM " . TABLE_PRODUCTSPECIFICATION . " WHERE ProdSpec_Id ='" . $id . "'");
    $Fetch  = db_fetch_array($SelSql);
    return $Fetch[0];
}

function get_Search_Id($table, $get_data, $where_field, $key_word)
{
    $eliminated_word = array(
        'a',
        'b',
        'c',
        'd',
        'e',
        'f',
        'g',
        'h',
        'i',
        'j',
        'k',
        'l',
        'm',
        'n',
        'o',
        'p',
        'q',
        'r',
        's',
        't',
        'u',
        'v',
        'w',
        'x',
        'y',
        'z',
        'am',
        'is',
        'are',
        'were',
        'the',
        'of',
        'an',
        'for',
        'then',
        'than',
        'when',
        'where',
        'which',
        'soon',
        'did',
        'how',
        'to',
        'and',
        'or',
        'not',
        'be',
        'us',
        'him',
        'her',
        'has',
        'have',
        'he',
        'she',
        'had',
        'as'
    );

    $selword  = @explode(',', $key_word);
    $whereCon = 'WHERE ';
    foreach ($selword as $word) {
        $word1 = trim($word);
        if ($whereCon != 'WHERE ') {
            $dlmt = ' OR ';
        } else {
            $dlmt = '';
        }
        if ($word1 != '') {
            if (!in_array($word1, $eliminated_word))
                $whereCon .= $dlmt . $where_field . " LIKE '%" . $word1 . "%'";
        }
    }
    if ($whereCon != 'WHERE ') {
        $sql = "SELECT " . $get_data . " FROM " . $table . " " . $whereCon;

        $res           = db_query($sql);
        $Collection_Id = '';
        $resCount      = db_num_rows($res);

        if ($resCount > 0) {
            while ($Select_ftch = db_fetch_array($res)) {
                $Select_ftch[$get_data];
                if ($Collection_Id != '') {
                    $dlmt = ',';
                } else {
                    $dlmt = '';
                }
                if ($Select_ftch[$get_data]) {
                    $Collection_Id .= $dlmt . $Select_ftch[$get_data];
                }
            }
        }
    }
    if (isset($Collection_Id) && !empty($Collection_Id))
        return $Collection_Id;
}



function CountryName($id)
{
    $name       = "";
    $sql        = "SELECT Country_Name FROM " . TABLE_GENERALCOUNTRYMASTER . " WHERE Id = '$id'";
    $result_obj = db_query($sql);
    if (db_num_rows($result_obj)) {
        $rs   = db_fetch_array($result_obj);
        $name = $rs["Country_Name"];
    }
    return $name;
}

function StateName($id)
{
    $name       = "";
    $sql        = "SELECT St_Name FROM " . TABLE_GENERALSTATEMASTER . " WHERE Id = '$id'";
    $result_obj = db_query($sql);
    if (db_num_rows($result_obj)) {
        $rs   = db_fetch_array($result_obj);
        $name = $rs["St_Name"];
    }
    return $name;
}

function CityName($id)
{
    $name       = "";
    $sql        = "SELECT Area FROM " . TABLE_GENERALAREAMASTER . " WHERE Id = '$id'";
    $result_obj = db_query($sql);
    if (db_num_rows($result_obj)) {
        $rs   = db_fetch_array($result_obj);
        $name = $rs["Area"];
    }
    return $name;
}

function AreaName($id)
{
    $name       = "";
    $sql        = "SELECT AM_Area FROM " . TABLE_AREAMASTER . " WHERE AM_Id = '$id'";
    $result_obj = db_query($sql);
    if (db_num_rows($result_obj)) {
        $rs   = db_fetch_array($result_obj);
        $name = $rs["AM_Area"];
    }
    return $name;
}

function PincodeName($id)
{
    $name       = "";
    $sql        = "SELECT PM_Pincode FROM " . TABLE_PINCODEMASTER . " WHERE PM_Id = '$id'";
    $result_obj = db_query($sql);
    if (db_num_rows($result_obj)) {
        $rs   = db_fetch_array($result_obj);
        $name = $rs["PM_Pincode"];
    }
    return $name;
}


function PHP_Mailer($Message, $Subject, $ToAddress, $ToName, $FromAddress, $FromName, $Attachmenttemp, $Attachment)
{
    $mail = new PHPMailer(true);
    try {
        $mail->AddAddress($ToAddress, $ToName);
        $mail->SetFrom($FromAddress, $FromName);
        $mail->Subject = $Subject;
        if (isset($Attachment) && $Attachment != '')
            $mail->AddAttachment($Attachmenttemp, $Attachment);
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        $mail->MsgHTML($Message);
        $mail->Send();
    }
    catch (phpmailerException $e) {
        echo $e->errorMessage();
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }

}
function CurrencyName($id)
{
    $name       = "";
    $sql        = "SELECT Symbol FROM " . TABLE_ADVCURRENCY . " WHERE Id = '$id'";
    $result_obj = db_query($sql);
    if (db_num_rows($result_obj)) {
        $rs   = db_fetch_array($result_obj);
        $name = $rs["Symbol"];
    }
    return $name;
}


function ChangeDateforDB($inputdate)
{
    if ($inputdate > 0) {
        $date  = substr($inputdate, 0, 2);
        $month = substr($inputdate, 3, 2);
        $year  = substr($inputdate, 6, 4);
        $show  = $year . "-" . $month . "-" . $date;
        return $show;
    }
}

function ChangeDateforShow($inputdate)
{
    $show = "00-00-0000";
    if ($inputdate > 0) {
        $date  = substr($inputdate, 8, 2);
        $month = substr($inputdate, 5, 2);
        $year  = substr($inputdate, 0, 4);
        $show  = $date . "-" . $month . "-" . $year;
        return $show;
    } else {
        return "";
    }
}

function getLogodetails($compid, $path)
{
    $querylogo = db_query("SELECT LG_Logo FROM  " . TABLE_LOGO . " WHERE  `LG_UserFk` ='" . $compid . "'");
    $Fetchlogo = mysql_fetch_array($querylogo);
    $logo      = $path . $Fetchlogo['LG_Logo'];

    if ($Fetchlogo['LG_Logo'] != '' && file_exists($logo)) {
        echo $Fetchlogo['LG_Logo'];
    } else {
        echo 'images/default/no_logo.png';
    }

}


function getLogodetailsgallery($compid, $path)
{
    $querylogo = db_query("SELECT LG_Logo FROM  " . TABLE_LOGO . " WHERE  `LG_UserFk` ='" . $compid . "'");
    $Fetchlogo = mysql_fetch_array($querylogo);
    $logo      = $path . $Fetchlogo['LG_Logo'];

    if ($Fetchlogo['LG_Logo'] != '' && file_exists($logo)) {
        echo $Fetchlogo['LG_Logo'];
    } else {
        echo 'images/default/no_logo_gallery.png';
    }
}

function getSectordetails($secid)
{
    $querysector = db_query("SELECT S_Name FROM  " . TABLE_SECTOR . " WHERE  `Id` ='" . $secid . "'");
    $Fetchsector = mysql_fetch_array($querysector);
    echo $Fetchsector['S_Name'];
}
function getAreadetails($areaid)
{
    $queryarea = db_query("SELECT AM_Area FROM  " . TABLE_AREAMASTER . " WHERE  `AM_Id` ='" . $areaid . "'");
    $Fetcharea = mysql_fetch_array($queryarea);
    if ($Fetcharea['AM_Area'] != '') {
        echo $Fetcharea['AM_Area'] . ', ';
    }

}
function getPindetails($pinid)
{
    $querypin = db_query("SELECT PM_Pincode FROM  " . TABLE_PINCODEMASTER . " WHERE  PM_Id ='" . $pinid . "'");
    $Fetchpin = mysql_fetch_array($querypin);
    if ($Fetchpin['PM_Pincode'] != '') {
        echo ' - ' . $Fetchpin['PM_Pincode'] . ', ';
    } else {
        echo ',';
    }

}
function getCitydetails($cityid)
{
    $querycity = db_query("SELECT Area FROM  " . TABLE_GENERALAREAMASTER . " WHERE  `Id` ='" . $cityid . "'");
    $Fetchcity = mysql_fetch_array($querycity);
    if ($Fetchcity['Area'] != '') {
        echo $Fetchcity['Area'] . ', ';
    }
}
function getStatedetails($stateid)
{
    $querystate = db_query("SELECT St_Name FROM  " . TABLE_GENERALSTATEMASTER . " WHERE  `Id` ='" . $stateid . "'");
    $Fetchstate = mysql_fetch_array($querystate);
    if ($Fetchstate['St_Name'] != '') {
        echo $Fetchstate['St_Name'];
    }
}
function getCountrydetails($countryid, $pinid)
{
    $querycountry = db_query("SELECT Country_Name FROM  " . TABLE_GENERALCOUNTRYMASTER . " WHERE  `Id` ='" . $countryid . "'");
    $Fetchcountry = mysql_fetch_array($querycountry);
    if ($Fetchcountry['Country_Name'] != '') {
        if ($pinid != '')
            echo $Fetchcountry['Country_Name'] . '.';
        else
            echo StringAppend($Fetchcountry['Country_Name'], ', ', 2, STR_PAD_LEFT);
    }
}

function getCountrydetails2($countryid)
{
    $querycountry = db_query("SELECT Country_Name FROM  " . TABLE_GENERALCOUNTRYMASTER . " WHERE  `Id` ='" . $countryid . "'");
    $Fetchcountry = mysql_fetch_array($querycountry);
    if ($Fetchcountry['Country_Name'] != '') {
        echo $Fetchcountry['Country_Name'] . '.';
    }
}

function getDescriptiondetails($descid)
{
    $querydesc = db_query("SELECT PDS_Pk,PDS_Desc FROM  " . TABLE_PROFILEDETAILS . " WHERE  `PDS_CreatedBy` ='" . $descid . "' ORDER BY PDS_Pk DESC;");
    $Fetchdesc = mysql_fetch_array($querydesc);
    if (strlen($Fetchdesc['PDS_Desc']) > 65) {
        echo substr($Fetchdesc['PDS_Desc'], 0, 90) . '...';
    } else {
        echo $Fetchdesc['PDS_Desc'];
    }
}

function getRelatedSearchComp($sectordata, $alreadylisteddetails, $findcitymatch, $findareamatch)
{

    if ($findareamatch != '')
        $area = "AND RGT_Area IN ($findareamatch)";
    else
        $area = '';

    $queryrelated = db_query("SELECT RGT_CompName FROM  " . TABLE_REGISTRATION . " WHERE RGT_Status=1 AND RGT_Type=2  AND RGT_PaymentStatus=1 AND  RGT_Sector IN ('" . $sectordata . "')  AND RGT_PK NOT IN ('" . $alreadylisteddetails . "') AND RGT_City =$findcitymatch $area");
    $countresult  = mysql_num_rows($queryrelated);
    if ($countresult > 0) {
        while ($Fetchrelated = mysql_fetch_array($queryrelated)) {
            $count       = strlen($Fetchrelated['RGT_CompName']);
            /*if($count>15){
            $displaydata=(substr($Fetchrelated['RGT_CompName'],0,15));
            $displaydata.='...';
            }
            else {
            */
            $displaydata = $Fetchrelated['RGT_CompName'];
            /*}*/
            echo '<li>';
            echo '<a onclick="';
            echo 'searchResult(';
            echo "'$displaydata'";
            echo ',\'\',1);';
            echo '" class="navlink" ><span>' . $displaydata . '</span></a>';
            echo '</li>';
        }
    } else {
        echo '<li>No Results</li>';
    }

}
function getRelatedSearchBestdeals($ps_id, $ps_fk, $citymatchdata)
{

    if ($citymatchdata != '')
        $wherecon = "AND PS_User_Fk IN (" . $citymatchdata . ")";

    if ($ps_id != '' || $ps_fk != '') {
        $selectcategoryfk = db_query("SELECT DISTINCT Category_fk FROM " . TABLE_PRODUCTRELATIVITY . " WHERE Product_fk IN (" . $ps_fk . ") ");
        while ($fetchcategoryfk = mysql_fetch_array($selectcategoryfk)) {
            $categoryids .= $fetchcategoryfk['Category_fk'] . ',';
        }
        $categoryids = substr($categoryids, 0, -1);
        $selectrelatedproducts = db_query("SELECT DISTINCT * FROM " . TABLE_PRODUCTSERVICE . " WHERE PS_CategoryFk IN (" . $categoryids . ") AND PS_Id NOT IN (" . $ps_id . ") $wherecon ");

        $countresult = mysql_num_rows($selectrelatedproducts);
        if ($countresult > 0) {

            while ($fetchrelatedproduct = mysql_fetch_array($selectrelatedproducts)) {


                /*if($count>15){
                $displaydata=(substr($fetchrelatedproduct['PS_Display'],0,15));
                $displaydata.='...';
                }
                else {*/
                $displaydata = $fetchrelatedproduct['PS_Display'];
                /*}*/

                echo '<li><span>';
                echo '<a target="_blank" href="Bestdealsajax.php?user=';
                echo get_data_from_registration($fetchrelatedproduct['PS_User_Fk'], RGT_ProfileUrl);
                echo '&BDId=' . $fetchrelatedproduct['PS_Id'];
                echo '" class="navlink">';
                echo $displaydata;
                echo '</a></span></li>';



                echo '<a onclick="';
                echo 'searchResult(';
                echo "'".$fetchrelatedproduct['PS_Display']."'";
                echo ');';
                echo '" class="navlink" style="color:#1274C0;text-decoration:none;">'.$fetchrelatedproduct['PS_Display'].'</a>';
                echo '</li>';
                 


            }
        } else {
            echo '<li>No Results</li>';
        }
    } else
        echo '<li>No Results</li>';

}

function nameLimiter($string, $count)
{
    $strcount = strlen($string);
    if ($strcount > $count) {
        $result = substr($string, 0, $count) . '...';
    } else {
        $result = $string;
    }
    return $result;
}


function display_area_list($citycode, $selectt, $key)
{

    if ($key == 'name')
        $citycode = get_Search_Id(TABLE_GENERALAREAMASTER, "Id", "Area", $citycode);
    else
        $citycode = $citycode;

    $queryarea = db_query("SELECT AM_Id, AM_Area, AM_Status  FROM " . TABLE_AREAMASTER . " WHERE AM_City =$citycode ");
    echo '<option>Select Area in ' . CityName($citycode) . '</option>';
    while ($fetchquery = mysql_fetch_array($queryarea)) {
        $Selector = ($fetchquery['AM_Id'] == $selectt) ? 'selected=selected' : '';
        echo '<option value="' . $fetchquery['AM_Id'] . '"  ' . $Selector . ' >' . $fetchquery['AM_Area'] . '</option>';
    }
}
function display_city_name($cityid)
{
    $querycityname = db_query("SELECT  Area FROM " . TABLE_GENERALAREAMASTER . " WHERE Id =$cityid ");
    $fetchcityname = db_fetch_array($querycityname);
    return $fetchcityname['Area'];
}



/*
Create a thumbnail of $srcFile and save it to $destFile.
The thumbnail will be $width pixels.
*/

function createThumbnail($srcFile, $destFile, $new_w, $new_h, $quality = 75)
{
    $thumbnail = '';

    if (file_exists($srcFile) && isset($destFile)) {
        $size   = getimagesize($srcFile);
        $old_x  = $size[0];
        $old_y  = $size[1];
        $ratio1 = $old_x / $new_w;
        $ratio2 = $old_y / $new_h;
        if ($ratio1 > $ratio2) {
            $thumb_w = $new_w;
            $thumb_h = $old_y / $ratio1;
        } else {
            $thumb_h = $new_h;
            $thumb_w = $old_x / $ratio2;
        }
        $thumbnail = copyImage($srcFile, $destFile, $thumb_w, $thumb_h, $quality);
    }
    // return the thumbnail file name on sucess or blank on fail
    return basename($thumbnail);
}

/*
Copy an image to a destination file. The destination
image size will be $w X $h pixels
*/
function copyImage($srcFile, $destFile, $w, $h, $quality = 75)
{
    $tmpSrc  = pathinfo(strtolower($srcFile));
    $tmpDest = pathinfo(strtolower($destFile));
    $size    = getimagesize($srcFile);

    if ($tmpDest['extension'] == "gif" || $tmpDest['extension'] == "jpg") {
        $destFile = substr_replace($destFile, 'jpg', -3);
        $dest     = imagecreatetruecolor($w, $h);
        imageantialias($dest, TRUE);
    } elseif ($tmpDest['extension'] == "png") {
        $dest = imagecreatetruecolor($w, $h);
        imageantialias($dest, TRUE);
    } else {
        return false;
    }

    switch ($size[2]) {
        case 1: //GIF
            $src = imagecreatefromgif($srcFile);
            break;
        case 2: //JPEG
            $src = imagecreatefromjpeg($srcFile);
            break;
        case 3: //PNG
            $src = imagecreatefrompng($srcFile);
            break;
        default:
            return false;
            break;
    }

    imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $h, $size[0], $size[1]);
    switch ($size[2]) {
        case 1:
        case 2:
            imagejpeg($dest, $destFile, $quality);
            break;
        case 3:
            imagepng($dest, $destFile);
    }
    return $destFile;
}

function getExtension($str)
{
    $i = strrpos($str, ".");
    if (!$i) {
        return "";
    }
    $l   = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return $ext;
}
function UserFileSize($UserId)
{
    $SqlRun = db_query("SELECT SFS_FileSize FROM " . TABLE_STOREFILESIZE . " WHERE SFS_UserFk='" . $UserId . "' ");
    while ($Fetch = db_fetch_array($SqlRun)) {
        $Result += $Fetch['SFS_FileSize'];
    }
    return $Result;
}

function UserFileSizeLimit($UserId)
{
    $SqlRun = db_query("SELECT RGT_Filesize FROM " . TABLE_REGISTRATION . " WHERE RGT_PK='" . $UserId . "' AND RGT_Type='2' ");
    $Fetch  = db_fetch_array($SqlRun);
    return $Fetch[0];
}

function get_company_name($productId)
{
    $querycompname = db_query("SELECT RGT_CompName    FROM " . TABLE_REGISTRATION . " WHERE RGT_PK IN (SELECT PS_User_Fk FROM " . TABLE_PRODUCTSERVICE . " WHERE PS_Id=$productId) ");
    $fetchcompname = mysql_fetch_array($querycompname);
    return $fetchcompname['RGT_CompName'];
}

function get_data_from_registration($userfk, $tofetch)
{
    $querydetails = db_query("SELECT $tofetch FROM " . TABLE_REGISTRATION . " WHERE RGT_PK=$userfk ");
    $fetchdetails = mysql_fetch_array($querydetails);
    return $fetchdetails[$tofetch];

}

function get_data_from_table($tablename, $tofetch, $where, $value)
{
    $querydata = db_query("SELECT $tofetch FROM " . $tablename . " WHERE $where = $value");
    while ($fetchdata = mysql_fetch_array($querydata)) {
        $returndata = $fetchdata[$tofetch];
    }
    return $returndata;
}

function ProfileUrl($Id)
{
    $querydetails = db_query("SELECT RGT_ProfileUrl FROM " . TABLE_REGISTRATION . " WHERE RGT_PK='" . $Id . "'");
    $fetchdetails = db_fetch_array($querydetails);
    return $fetchdetails['RGT_ProfileUrl'];
}

function list_featured()
{
    $featuredquery = db_query("SELECT RGT_CompName FROM " . TABLE_REGISTRATION . " WHERE RGT_Featured=0 AND RGT_Type = 2 AND RGT_Status=1 AND RGT_PaymentStatus=1 order by RGT_CompName asc LIMIT 10");
    if (db_num_rows($featuredquery) > 0) {
        while ($fetchfeatured = db_fetch_array($featuredquery)) {
            echo '<li>' . $fetchfeatured['RGT_CompName'] . '</li>';
        }
    } else
        echo '<li>No Featured Company</li>';
}

function list_featured_product()
{
    $featuredquery = db_query("SELECT PS_Display FROM " . TABLE_PRODUCTSERVICE . " WHERE PS_Featured=0 AND PS_Status = 1 order by PS_Display asc LIMIT 10");
    if (db_num_rows($featuredquery) > 0) {
        while ($fetchfeatured = db_fetch_array($featuredquery)) {
            echo '<li>' . $fetchfeatured['PS_Display'] . '</li>';
        }
    } else
        echo '<li>No Featured Products</li>';
}

function find_user_online($userid)
{
    $findonline = db_query("SELECT RGT_PK FROM " . TABLE_REGISTRATION . " WHERE RGT_LastActiveTime > NOW()-10 AND RGT_ProfileUrl='$userid' ");
    $count      = mysql_num_rows($findonline);
    return $count;
}

function find_page_username($url)
{
    $findonline = db_query("SELECT RGT_UserName FROM " . TABLE_REGISTRATION . " WHERE RGT_ProfileUrl='$url' ");
    while ($fetchuserid = db_fetch_array($findonline)) {
        $data = $fetchuserid['RGT_UserName'];
    }
    return $data;
}

function find_user_url($userid)
{
    $findonline = db_query("SELECT RGT_ProfileUrl FROM " . TABLE_REGISTRATION . " WHERE RGT_PK='$userid' ");
    while ($fetchuserid = db_fetch_array($findonline)) {
        $data = $fetchuserid['RGT_ProfileUrl'];
    }
    if (isset($data) && !empty($data))
        return $data;
}

function clear_visitedpage($userid)
{
    db_query("UPDATE " . TABLE_REGISTRATION . " SET RGT_VisitingPage='' WHERE RGT_PK=$userid");
    db_query("UPDATE " . TABLE_REGISTRATION . " SET RGT_onlinestatus='0' WHERE RGT_PK='" . $_SESSION['LID'] . "'");
}

function track_page_visits($user, $visitedpage, $ipaddress)
{
    $trackpagevisit = db_query("INSERT INTO tbl_visitors (RGT_Pk,visited_page,visited_time,visitor_ip) VALUES ('" . $user . "','" . $visitedpage . "',CURRENT_TIMESTAMP,'" . $ipaddress . "') ");
    db_query("UPDATE " . TABLE_REGISTRATION . " SET RGT_VisitingPage='$visitedpage' WHERE RGT_PK='" . $_SESSION['LID'] . "'");
}

function find_profile_id($url)
{
    $findonline = db_query("SELECT RGT_PK FROM " . TABLE_REGISTRATION . " WHERE RGT_ProfileUrl='$url' ");
    while ($fetchuserid = db_fetch_array($findonline)) {
        $data = $fetchuserid['RGT_PK'];
    }
    return $data;
}

function getRealIPAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) //check ip from share internet
        {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //to check ip is pass from proxy
        {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getPrimaryId($field, $table, $id, $compare)
{
    $sqlquery = db_query("select $id from $table where $field='" . $compare . "'");
    $fetchid  = db_fetch_array($sqlquery);
    return $fetchid[0];
}
function getMemberKeywords($memberid)
{
    $result = '';
    $checkexist = db_query("SELECT Kd_Keyword FROM " . TABLE_MEMBERKEYWORD . " a, " . TABLE_KEYWORDMST . " b WHERE Mk_MemFk='" . $memberid . "' and Mk_KeywordFk=Kd_Id and b.Kd_Status=1");
    if (db_num_rows($checkexist) > 0) {
        while ($fetch = db_fetch_array($checkexist)) {
            if ($fetch['Kd_Keyword'] != '') {
                if ($result == '')
                    $result = $fetch['Kd_Keyword'];
                else
                    $result .= ', ' . $fetch['Kd_Keyword'];
            }
        }
    } else
        $result = '';
    if (isset($result) && !empty($result))
        return $result;
}


function getKeywordListFromSearchedIndustry($searchkey)
{
    $queryrelated = db_query("SELECT a.Kd_Id, a.Kd_Keyword FROM  " . TABLE_KEYWORDMST . " a, " . TABLE_SECTOR . " b  WHERE a.Kd_IndustryFk=b.Id and  b.S_Name='" . $searchkey . "' and a.Kd_Keyword!='' and a.Kd_Status=1");
    $countresult  = mysql_num_rows($queryrelated);
    if ($countresult > 0) {
        while ($Fetchrelated = mysql_fetch_array($queryrelated)) {
            $orginal = $Fetchrelated['Kd_Keyword'];
            $count   = strlen($Fetchrelated['Kd_Keyword']);
            if ($count > 15) {
                $displaydata = (substr($Fetchrelated['Kd_Keyword'], 0, 15));
                $displaydata .= '...';
            } else {
                $displaydata = $Fetchrelated['Kd_Keyword'];
            }
            echo '<li>';
            echo '<a onclick="';
            echo 'searchResult(';
            echo "'$orginal'";
            echo ',\'\',3);';
            echo '" class="navlink" ><span>' . $displaydata . '</span></a>';
            echo '</li>';
        }
    } else {
        echo '<li>No Results</li>';
    }

}

function getKeywordCompListFromSearchedKeyword($searchkey)
{
    $ResIndustryIds = '';
    $KeywordsIds    = get_Search_Id(TABLE_KEYWORDMST, "Kd_Id", "Kd_Keyword", $searchkey);
    if ($KeywordsIds != '') {
        $IndustryIds = db_query("SELECT RGT_Sector,RGT_PK FROM " . TABLE_REGISTRATION . " WHERE RGT_Status=1 AND RGT_Type=2 AND  RGT_PK IN (SELECT Mk_MemFk FROM " . TABLE_MEMBERKEYWORD . " WHERE   Mk_KeywordFk IN (" . $KeywordsIds . "))");
        while ($FetchIndustryIds = db_fetch_array($IndustryIds)) {
            if ($ResIndustryIds == '')
                $ResIndustryIds = $FetchIndustryIds['RGT_Sector'];
            else
                $ResIndustryIds .= ',' . $FetchIndustryIds['RGT_Sector'];
            if ($ResCompIds == '')
                $ResCompIds = $FetchIndustryIds['RGT_PK'];
            else
                $ResCompIds .= ',' . $FetchIndustryIds['RGT_PK'];
        }

        if ($ResIndustryIds != '') {

            //company list
            $queryrelated = db_query("SELECT RGT_CompName FROM " . TABLE_REGISTRATION . " WHERE RGT_Status=1 AND RGT_Type=2 AND  RGT_Sector IN (" . $ResIndustryIds . ") AND RGT_PK NOT IN (" . $ResCompIds . ")");
            $countresult  = mysql_num_rows($queryrelated);
            if ($countresult > 0) {
                while ($Fetchrelated = mysql_fetch_array($queryrelated)) {
                    $orginal = $Fetchrelated['RGT_CompName'];
                    $count   = strlen($Fetchrelated['RGT_CompName']);
                    if ($count > 15) {
                        $displaydata = (substr($Fetchrelated['RGT_CompName'], 0, 15));
                        $displaydata .= '...';
                    } else {
                        $displaydata = $Fetchrelated['RGT_CompName'];
                    }
                    echo '<li>';
                    echo '<a onclick="';
                    echo 'searchResult(';
                    echo "'$orginal'";
                    echo ',\'\',1);';
                    echo '" class="navlink" ><span>' . $displaydata . '</span></a>';
                    echo '</li>';
                }
            }
            //keyword list

            $queryrelated2 = db_query("SELECT Kd_Keyword FROM " . TABLE_KEYWORDMST . " WHERE Kd_Status=1 and Kd_IndustryFk  IN (" . $ResIndustryIds . ") AND Kd_Keyword!='' AND Kd_Id NOT IN (" . $KeywordsIds . ")");
            $countresult2  = mysql_num_rows($queryrelated2);
            if ($countresult2 > 0) {
                while ($Fetchrelated2 = mysql_fetch_array($queryrelated2)) {
                    $orginal2 = $Fetchrelated2['Kd_Keyword'];
                    $count2   = strlen($Fetchrelated2['Kd_Keyword']);
                    if ($count2 > 15) {
                        $displaydata2 = (substr($Fetchrelated2['Kd_Keyword'], 0, 15));
                        $displaydata2 .= '...';
                    } else {
                        $displaydata2 = $Fetchrelated2['Kd_Keyword'];
                    }
                    echo '<li>';
                    echo '<a onclick="';
                    echo 'searchResult(';
                    echo "'$orginal2'";
                    echo ',\'\',3);';
                    echo '" class="navlink" ><span>' . $displaydata2 . '</span></a>';
                    echo '</li>';
                }
            }



        } else {
            echo '<li>No Results</li>';
        }

    } else {
        echo '<li>No Results</li>';
    }
}


function getKeywordCompListFromSearchedCompany($searchkey)
{
    $ResIndustryIds = '';
    $ResCompIds     = '';
    $CompanyIds     = get_Search_Id(TABLE_REGISTRATION, "RGT_PK", "RGT_CompName", $searchkey);
    if ($CompanyIds != '') {
        $IndustryIds = db_query("SELECT RGT_Sector,RGT_PK FROM " . TABLE_REGISTRATION . " WHERE RGT_Status=1 AND RGT_Type=2 AND  RGT_PK IN (" . $CompanyIds . ")");
        while ($FetchIndustryIds = db_fetch_array($IndustryIds)) {
            if ($ResIndustryIds == '')
                $ResIndustryIds = $FetchIndustryIds['RGT_Sector'];
            else
                $ResIndustryIds .= ',' . $FetchIndustryIds['RGT_Sector'];
            if ($ResCompIds == '')
                $ResCompIds = $FetchIndustryIds['RGT_PK'];
            else
                $ResCompIds .= ',' . $FetchIndustryIds['RGT_PK'];
        }

        if ($ResIndustryIds != '') {

            //company list
            $queryrelated = db_query("SELECT RGT_CompName FROM " . TABLE_REGISTRATION . " WHERE RGT_Status=1 AND RGT_Type=2 AND  RGT_Sector IN (" . $ResIndustryIds . ") AND RGT_PK NOT IN (" . $CompanyIds . ")");
            $countresult  = mysql_num_rows($queryrelated);
            if ($countresult > 0) {
                while ($Fetchrelated = mysql_fetch_array($queryrelated)) {
                    $orginal = $Fetchrelated['RGT_CompName'];
                    $count   = strlen($Fetchrelated['RGT_CompName']);
                    if ($count > 15) {
                        $displaydata = (substr($Fetchrelated['RGT_CompName'], 0, 15));
                        $displaydata .= '...';
                    } else {
                        $displaydata = $Fetchrelated['RGT_CompName'];
                    }
                    echo '<li>';
                    echo '<a onclick="';
                    echo 'searchResult(';
                    echo "'$orginal'";
                    echo ',\'\',1);';
                    echo '" class="navlink" ><span>' . $displaydata . '</span></a>';
                    echo '</li>';
                }
            }
            //keyword list

            $queryrelated2 = db_query("SELECT Kd_Keyword FROM " . TABLE_KEYWORDMST . " WHERE Kd_Status=1 and Kd_Keyword!='' and Kd_IndustryFk  IN (" . $ResIndustryIds . ") ");
            $countresult2  = mysql_num_rows($queryrelated2);
            if ($countresult2 > 0) {
                while ($Fetchrelated2 = mysql_fetch_array($queryrelated2)) {
                    $orginal2 = $Fetchrelated2['Kd_Keyword'];
                    $count2   = strlen($Fetchrelated2['Kd_Keyword']);
                    if ($count2 > 15) {
                        $displaydata2 = (substr($Fetchrelated2['Kd_Keyword'], 0, 15));
                        $displaydata2 .= '...';
                    } else {
                        $displaydata2 = $Fetchrelated2['Kd_Keyword'];
                    }
                    echo '<li>';
                    echo '<a onclick="';
                    echo 'searchResult(';
                    echo "'$orginal2'";
                    echo ',\'\',3);';
                    echo '" class="navlink" ><span>' . $displaydata2 . '</span></a>';
                    echo '</li>';
                }
            }



        } else {
            echo '<li>No Results</li>';
        }

    } else {
        echo '<li>No Results</li>';
    }
}

function XbitImage($ProductId)
{
    $SelectQuery = db_query("Select PSG_ImgPath From " . TABLE_PRODUCTSERVICEGALLERY . " WHERE PSG_PSFk='" . $ProductId . "' order by PSG_Id asc");
    $FetchQuery  = db_fetch_array($SelectQuery);
    return ucfirst($FetchQuery[0]);
}

function CompanyType($Id)
{
    if ($Id == 1)
        $result = 'Cooperative Societies';
    else if ($Id == 2)
        $result = 'Government Based';
    else if ($Id == 3)
        $result = 'Joint Stock Companies';
    else if ($Id == 4)
        $result = 'Partnership';
    else if ($Id == 5)
        $result = 'Private Limited';
    else if ($Id == 5)
        $result = 'Sole Proprietorship';
    else
        $result = '';
    return $result;
}

function getOperatingAreas($memberid)
{
    $checkexist = db_query("SELECT Area FROM " . TABLE_OPERATINGAREA . " a, " . TABLE_GENERALAREAMASTER . " b WHERE Op_BusFk='" . $memberid . "' and  Op_AreaFk =Id and b.Status=1");
    if (db_num_rows($checkexist) > 0) {
        while ($fetch = db_fetch_array($checkexist)) {
            if ($fetch['Area'] != '') {
                if (isset($result) && !empty($result))
                    if ($result == '')
                        $result = $fetch['Area'];
                    else
                        $result .= ', ' . $fetch['Area'];
            }
        }
    } else
        $result = '-';
    if (isset($result) && !empty($result))
        return $result;
}
?>
