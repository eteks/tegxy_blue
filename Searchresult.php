<?php 
include_once("../DatabaseConnection.php");
db_connect();
?>
<script type="text/javascript" src="js/Searchlist.js"></script>
<link href="css/popup.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/popupbox.js"></script>
<script type="text/javascript" src="js/Common.js"></script>
<script type="text/javascript">
    function Searchusingenterkey(e)
    {
    // look for window.event in case event isn't passed in
    // if (typeof e == 'undefined' && window.event) { e = window.event; }
    // if (e.keyCode == 13)
    // searchResult($('#searchlist').val(),'','');
    }
</script>
<style type="text/css">
    ul.leftsidebarlist
    {
    list-style:none;width:180px;height:20px;margin:0 0 0 0px;padding:0;
    }
    ul.leftsidebarlist li
    {
    border-bottom:1px solid #EBEBEB;padding:10px 0px;
    }
    ul.leftsidebarlist li.deal
    {
    border-bottom:1px solid #EBEBEB;padding:15px 0px 15px 0px;height:30px;
    }
    ul.leftsidebarlist li.deal img
    {
    float:left;border:1px solid #ccc;
    position:relative;top:-9px;
    margin-right:8px;
    }
</style>
<?php
    if (isset($_REQUEST['searchkey'])) {
        $searchkey   = $_REQUEST['searchkey'];
        $requestType = $_REQUEST['requesttype'];      
        $userCity    = $_REQUEST['usercity'];
       
        if (isset($_REQUEST['userarea'])) {
            $userArea = AreaName($_REQUEST['userarea']);
        } //isset($_REQUEST['userarea'])
        else {
            $userArea = '';
        }
        $type2         = $_REQUEST['type2'];
        //TO SEARCH AND FIND THE MERGED SQL
        $findcitymatch = get_Search_Id(TABLE_GENERALAREAMASTER, "Id", "Area", $userCity);
        if ($findcitymatch != '')
            $querycitymatch = "AND RGT_City IN (" . $findcitymatch . ")";
        else
            $querycitymatch = '';
        $findareamatch = get_Search_Id(TABLE_AREAMASTER, "AM_Id", "AM_Area", $userArea);
        if ($findareamatch != '')
            $queryareamatch = "AND RGT_Area IN (" . $findareamatch . ")";
        else
            $queryareamatch = '';
        if ($type2 == 1) {
            if ($searchkey != '')
                $searchsql = "`RGT_CompName` LIKE  '$searchkey%'  AND";
            else
                $searchsql = "";
        }       
        $relatedsearch        = '';
        $relatedsearch1       = '';
        $alreadylisteddetails = '';
        $citymatchdata        = '';
        $countresult          = '';
        if ($requestType == 'company') {         
            $searchtTitle = "Company List";//db connection
            $searchquery  = db_query("SELECT * FROM  " . TABLE_REGISTRATION . " WHERE  $searchsql RGT_Status=1 AND RGT_Type=2");
            $searchquery1 = db_query("SELECT * FROM  " . TABLE_REGISTRATION . " WHERE  $searchsql RGT_Status=1 AND RGT_Type=2");
            $searchquery2 = db_query("SELECT * FROM  " . TABLE_REGISTRATION . " WHERE  $searchsql RGT_Status=1 AND RGT_Type=2");
            $countresult  = mysql_num_rows($searchquery);
            
            while($fetchquery = mysql_fetch_array($searchquery1)){               
                $relatedsearch.= $fetchquery['RGT_Sector'].',';            
            }
            
        } 
        else if ($requestType == 'bestdeals') {
            $searchtTitle = "Xbit List";//db connection
            $searchquery_deals  = db_query("SELECT * FROM " . TABLE_PRODUCTSERVICE . "  WHERE PS_Display LIKE '$searchkey%' AND PS_Status=1");
            $searchquery1  = db_query("SELECT * FROM " . TABLE_PRODUCTSERVICE . "  WHERE PS_Display LIKE '$searchkey%' AND PS_Status=1");
            $searchquery2  = db_query("SELECT * FROM " . TABLE_PRODUCTSERVICE . "  WHERE PS_Display LIKE '$searchkey%' AND PS_Status=1");

            $countresult_deals  = mysql_num_rows($searchquery_deals);
            // while ($fetchquery = mysql_fetch_array($searchquery_deals)) {
            //     $relatedsearch .= $fetchquery['PS_Id'] . ',';
            // } 
            // while ($fetchquery1 = mysql_fetch_array($searchquery3)) {
            //         $relatedsearch1 .= $fetchquery1['PS_Fk'] . ',';
            // }

            if (isset($findcitymatch) || isset($findareamatch)) {
                $wherec          = "AND RGT_City= $findcitymatch $queryareamatch ";
                $querycitymatch1 = db_query("SELECT RGT_PK FROM " . TABLE_REGISTRATION . " WHERE  RGT_Status=1 " . $wherec . "");
                while ($fetchcitymatch = mysql_fetch_array($querycitymatch1)) {
                    $citymatchdata .= $fetchcitymatch['RGT_PK'] . ',';
                } 
                $citymatchdata = substr($citymatchdata, 0, -1);
            }
            $matchingids   = '';
            $queryprodname = db_query("SELECT PS_Id FROM " . TABLE_PRODUCTSERVICE . " WHERE PS_Display LIKE '$searchkey%'");
            while ($fetchprodid = mysql_fetch_array($queryprodname)) {
                $matchingids .= $fetchprodid['PS_Id'] . ',';
            } 
            $matchingids = substr($matchingids, 0, -1);
            if ($searchkey != '') {
                // Based On Keyword, Display             
                $findproductmatch = get_Search_Id(TABLE_PRODUCTSERVICE, "PS_Id", "PS_Display", $searchkey);
                $findkeywordmatch = get_Search_Id(TABLE_PRODUCTSERVICE, "PS_Id", "PS_Keyword", $searchkey);
                $finddisplaymatch = get_Search_Id(TABLE_PRODUCTSERVICE, "PS_Id", "PS_Display", $searchkey);           

                if ($findproductmatch != '' || $findkeywordmatch != '' || $finddisplaymatch != '') {
                    $con = " AND (PS_Display=''";
                    if ($findproductmatch != '') {
                        $con .= " OR ";
                        $con .= "PS_Fk IN (" . $findproductmatch . ")";
                    } 
                    if ($findkeywordmatch != '') {
                        $con .= " OR ";
                        $con .= "PS_Id IN (" . $findkeywordmatch . ")";
                    } 
                    if ($finddisplaymatch != '') {
                        $con .= " OR ";
                        $con .= "PS_Id IN (" . $finddisplaymatch . ")";
                    } 
                    $con .= ")";
                }
                else
                    $con = "AND PS_Display=''";
            }
            if ($citymatchdata != '') {
                $searchquery  = db_query("SELECT * FROM " . TABLE_PRODUCTSERVICE . " WHERE PS_User_Fk IN (" . $citymatchdata . ") $con");
                $searchquery1 = db_query("SELECT * FROM " . TABLE_PRODUCTSERVICE . " WHERE PS_User_Fk IN (" . $citymatchdata . ") $con");
                $searchquery2 = db_query("SELECT * FROM " . TABLE_PRODUCTSERVICE . " WHERE PS_User_Fk IN (" . $citymatchdata . ") $con");
                $searchquery3 = db_query("SELECT * FROM " . TABLE_PRODUCTSERVICE . " WHERE PS_User_Fk IN (" . $citymatchdata . ") $con");
                $countresult  = mysql_num_rows($searchquery);
                while ($fetchquery = mysql_fetch_array($searchquery1)) {
                    $relatedsearch .= $fetchquery['PS_Id'] . ',';
                } 
                while ($fetchquery1 = mysql_fetch_array($searchquery3)) {
                    $relatedsearch1 .= $fetchquery1['PS_Fk'] . ',';
                } 
            } 
        } 
        $relatedsearch  = substr($relatedsearch, 0, -1);
        $relatedsearch1 = substr($relatedsearch1, 0, -1);         
    } 

//related list detatils
    if (isset($searchquery2)) {       
        while ($fetchquery = db_fetch_array($searchquery2)) {       
            if ($requestType == 'company') {
                $alreadylisteddetails .= $fetchquery['RGT_PK'] . ',';
            } 
            if ($requestType == 'bestdeals') {
                $alreadylisteddetails .= $fetchquery['PS_Id'] . ',';
            } 
            $finaldetails = substr($alreadylisteddetails, 0, -1);
            ;
        }
    } 

      if ($requestType == 'company') {
    ?>
<div class="adleft_container">
    <div style="width:100%;height:40px;float:left;" align="right"></div> 
    <div style="width:250px;height:auto;float:left;">      
        <div class="adrelatedsearch">
            <div id="relatedresultsbox" style="display:<?php
                if ($searchkey == '') {
                    echo 'none';
                } //$searchkey == ''
                else
                    echo 'block';
                ?>" >
                <div class="adleftaccordiaon_top" >Related Searches</div>
                <div style="width:245px;height:auto;border:1px solid #C0C0C0;" >
                    <ul class="relatedsearch_ul">
                  <?php
                        if($requestType=='company'){
                        if($_REQUEST['type2']==1){ getKeywordCompListFromSearchedCompany($_REQUEST['searchkey']);  }  
                        if($_REQUEST['type2']==2){ getKeywordListFromSearchedIndustry($_REQUEST['searchkey']);     }
                        if($_REQUEST['type2']==3){ getKeywordCompListFromSearchedKeyword($_REQUEST['searchkey']);  }
                        } 
                        //getRelatedSearchComp($relatedsearch,$finaldetails,$findcitymatch,$findareamatch);
                        ?> 
                    </ul>
                </div>
            </div>
            <div id="featuredlistings" style="display:<?php
                if ($searchkey == '') {
                    echo 'block';
                } //$searchkey == ''
                else
                    echo 'none';
                ?>" >
                <div class="adleftaccordiaon_top" >Featured Companies</div>
                <div style="width:245px;height:auto;border:1px solid #C0C0C0;" >
                    <ul class="relatedsearch_ul">
                        <?php
                            if ($requestType == 'company') {
                                list_featured();
                            } //$requestType == 'company'
                            ?>
                    </ul>
                </div>
            </div>
            <div class="adleftaccordion_btm" ></div>
        </div><!--relatedsearch-->
    </div>  
    <div style="width:740px;height:auto;float:left;">
        <div style="width:740px; height:30px;display:none;" align="center">
            <input type="radio" id="requestTypeCom" name="requestType" checked="checked" value="company" title="Company" onclick="changesearchtype();" /><label for="requestTypeCom" >Company</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="requestType" id="requestTypedeals"  value="bestdeals" title="Xbit"onclick="changesearchtype();" /><label for="requestTypedeals" >Products</label>
        </div>        
        <div style="width:740px; height:50px;">
            <div class="adsearch_txbox" >
                <input type="text" autocomplete="off" name="searchkey" id="searchlist"  style="width:600px;height:30px;border:1px solid #999;" placeholder="Please Enter Company Name / Sector / Keyword to Search" autofocus value="<?php
                    echo $searchkey;
                    ?>"  onkeyup="Searchusingenterkey(event);"  /><!-- onkeypress="Searchusingenterkey(event);" -->
            <div id="SearchListRes"></div>
            </div>
            <div class="adsearch" align="center"><a href="#" onclick="searchResult($('#searchlist').val(),'','<?php
                echo $_REQUEST['type2'];
                ?>');">Search</a>
            </div>
        </div>
        <?php
            if ($countresult > 0) { 
               
            ?>
        <div class="adsearchresult_menu"><a id="Searchdisplaytypelist" class="active" href="#" onclick="SearchListStyle(<?php
            echo '\'' . $requestType . '\'' . ',' . '\'' . $searchkey . '\'';
            ?>,'1',<?php
            echo $type2;
            ?>);">List</a> | <a href="#" id="Searchdisplaytypegrid" onclick="SearchListStyle(<?php
            echo '\'' . $requestType . '\'' . ',' . '\'' . $searchkey . '\'';
            ?>,'2',<?php
            echo $type2;
            ?>);" >View Gallery</a>
        </div> 
        <!--ad-->
        <div id="mainsearchcontent">
            <?php 
                if($requestType=='company'){
                 while($fetchquery = mysql_fetch_array($searchquery)) {
                    $yearofestablishment = explode('-',$fetchquery['RGT_YrofEstablish']);
                 if(strlen(stripslashes($fetchquery['RGT_CompName']))>25){ $Compnamefixlimit = substr(stripslashes($fetchquery['RGT_CompName']),0,25).'...' ;} else { $Compnamefixlimit =  stripslashes($fetchquery['RGT_CompName']);} 
                $Compnamedisp = '<span style="cursor:pointer;" title="'.$fetchquery['RGT_CompName'].'">'.$Compnamefixlimit.'</span><span style="color:#007088;"> (Since - '.$yearofestablishment[0].')</span>'; 
            ?>
        
            <div class="singlead">               
                <div class="adtitle">
                    <div style="width:550px;color:#EC5324;float:left;"><b><?php
                        echo $Compnamedisp;
                        ?></b>
                    </div>                   
                </div>               
                <div class="adimage">
                    <div class="company_logo" align="right"><a href="#thumb" class="thumbnail">
                        <img src="<?php
                            if ($fetchquery['RGT_PK'] != '') {
                                echo getLogodetails($fetchquery['RGT_PK'], $path);
                            } //$fetchquery['RGT_PK'] != ''
                            else {
                                echo 'images/default/no_image.png';
                            }
                            ?>"  width="124" height="115" /><span><img  src="<?php
                            if ($fetchquery['RGT_PK'] != '') {
                                echo getLogodetails($fetchquery['RGT_PK'], $path);
                            } //$fetchquery['RGT_PK'] != ''
                            else {
                                echo 'images/default/no_image.png';
                            }
                            ?>" width="220" height="220" /></span></a><?php
                            /*?><img src="<?php getLogodetails($fetchquery['RGT_PK'],$path);?>" width="124" height="115" /><?php */
                            ?>
                    </div>
                    <div class="addetails_left">
                        <?php
                            if (strlen(getOperatingAreas($fetchquery['RGT_PK'])) > 35)
                                $dispareas = substr(getOperatingAreas($fetchquery['RGT_PK']), 0, 35) . '...';
                            else
                                $dispareas = getOperatingAreas($fetchquery['RGT_PK']);
                            ?>
                        <div><span>Operating Areas : <span style="cursor:pointer;" title="<?php
                            echo getOperatingAreas($fetchquery['RGT_PK']);
                            ?>"><?php
                            echo $dispareas;
                            ?></span></span>
                        </div>
                        <div style="height:5px;"></div>
                        <div><span>Working Days : <?php
                            echo $fetchquery['RGT_WorkingdayFrom'];
                            ?> - <?php
                            echo $fetchquery['RGT_WorkingdayTo'];
                            ?></span>
                        </div>
                        <div style="height:5px;"></div>
                        <div><span>Business Timing : <?php
                            echo $fetchquery['RGT_OfficetimeFrom'];
                            ?> - <?php
                            echo $fetchquery['RGT_OfficetimeTo'];
                            ?></span>
                        </div>
                        <div style="height:5px;"></div>
                        <div><span> Break Time : <?php
                            echo $fetchquery['RGT_BreaktimeFrom'];
                            ?> - <?php
                            echo $fetchquery['RGT_BreaktimeTo'];
                            ?></span>
                        </div>
                    </div>
                </div>                
                <div class="addetails" style="min-height:135px;">
                    <div class="addetails_left">
                        <span style="color:#EC5324;"><b>Company Details</b></span>
                        <div style="height:10px;"></div>
                        <span>
                            <?php
                                if ($fetchquery['RGT_CompType'] != '') {
                                ?><span>Company Type : <?php
                                if ($fetchquery['RGT_CompType'] == '1') {
                                    echo "Cooperative Societies";
                                } //$fetchquery['RGT_CompType'] == '1'
                                elseif ($fetchquery['RGT_CompType'] == '2') {
                                    echo "Government Based";
                                } //$fetchquery['RGT_CompType'] == '2'
                                    elseif ($fetchquery['RGT_CompType'] == '3') {
                                    echo "Joint Stock Companies";
                                } //$fetchquery['RGT_CompType'] == '3'
                                    elseif ($fetchquery['RGT_CompType'] == '4') {
                                    echo "Partnership";
                                } //$fetchquery['RGT_CompType'] == '4'
                                    elseif ($fetchquery['RGT_CompType'] == '5') {
                                    echo "Private Limited";
                                } //$fetchquery['RGT_CompType'] == '5'
                                    elseif ($fetchquery['RGT_CompType'] == '6') {
                                    echo "Sole Proprietorship";
                                } //$fetchquery['RGT_CompType'] == '6'
                                ?></span><?php
                                } //$fetchquery['RGT_CompType'] != ''
                                ?>
                            <div style="height:5px;"></div>
                            <span>Industry : </span> <?php
                                getSectordetails($fetchquery['RGT_Sector']);
                                ?>
                        </span>
                        <br/><?php //if(getMemberKeywords($fetchquery['RGT_PK'])!=''){
                            ?>
                        <div style="height:5px;" ></div>
                        <span>offers : </span><span style="cursor:pointer;" title="<?php
                            echo getMemberKeywords($fetchquery['RGT_PK']);
                            ?>"><?php
                            if (strlen(getMemberKeywords($fetchquery['RGT_PK'])) > 20)
                                $dispkeyword = substr(getMemberKeywords($fetchquery['RGT_PK']), 0, 20) . '...';
                            else
                                $dispkeyword = getMemberKeywords($fetchquery['RGT_PK']);
                            echo $dispkeyword;
                            ?></span><?php //}
                            ?>
                    </div>
                    <div class="addetails_sep" style="min-height:135px;"></div>
                    <div class="addetails_right">
                        <span style="color:#EC5324;"><b>Contact Details</b></span>
                        <div style="height:10px;"></div>
                        <?php
                            if (strlen($fetchquery['RGT_Address1']) > 15)
                                $dispaddress = substr($fetchquery['RGT_Address1'], 0, 15) . '...';
                            else
                                $dispaddress = $fetchquery['RGT_Address1'];
                            if (strlen($fetchquery['RGT_Address2']) > 15)
                                $dispaddress2 = substr($fetchquery['RGT_Address2'], 0, 15) . '...';
                            else
                                $dispaddress2 = $fetchquery['RGT_Address2'];
                            echo '<span style="cursor:pointer;" title="' . $fetchquery['RGT_Address1'] . '">' . $dispaddress . '</span>';
                            if ($fetchquery['RGT_Address2'] != '') {
                                echo ', <span style="cursor:pointer;" title="' . $fetchquery['RGT_Address2'] . '">' . $dispaddress2 . '</span><br/>';
                            } //$fetchquery['RGT_Address2'] != ''
                            if ($fetchquery['RGT_Area'] != '') {
                                getAreadetails($fetchquery['RGT_Area']);
                            } //$fetchquery['RGT_Area'] != ''
                            if ($fetchquery['RGT_City'] != '') {
                                getCitydetails($fetchquery['RGT_City']);
                            } //$fetchquery['RGT_City'] != ''
                            if ($fetchquery['RGT_State'] != '') {
                                getStatedetails($fetchquery['RGT_State']);
                            } //$fetchquery['RGT_State'] != ''
                            if ($fetchquery['RGT_Pincode'] != '') {
                                getPindetails($fetchquery['RGT_Pincode']);
                            } //$fetchquery['RGT_Pincode'] != ''
                            if ($fetchquery['RGT_Country'] != '') {
                                getCountrydetails($fetchquery['RGT_Country'], $fetchquery['RGT_Pincode']);
                            } //$fetchquery['RGT_Country'] != ''
                            ?>
                        <div><?php
                            if ($fetchquery['RGT_Landline'] != '')
                                echo 'Phone: ' . $fetchquery['RGT_Landline'];
                            else
                                echo 'Phone: ' . $fetchquery['RGT_Mobile'];
                            ?>
                        </div>
                        <div><?php
                            echo 'Email: ' . $fetchquery['RGT_Email'];
                            ?>
                        </div>
                    </div>
                </div>
                <div style="width:705px;height:39px;float:left;">
                    <?php
                        if ($fetchquery['RGT_PaymentStatus'] == '1') {
                        ?>
                    <div class="chat_details">
                        <div class="chat_curve"></div>
                        <div class="chat_style"><?php
                            if ($fetchquery['RGT_onlinestatus'] == 1) {
                            ?><img src="images/chatonline.png" style="position:relative;top:3px;" />&nbsp;&nbsp;<span style="color:#fff;">I'm Online</span><?php
                            } //$fetchquery['RGT_onlinestatus'] == 1
                            else {
                            ?> <img src="images/chatoffine.png" style="position:relative;top:3px;" />&nbsp;&nbsp;<span style="color:#fff;">I'm offline.</span><?php
                            }
                            ?>
                        </div>
                        <div class="chat_fullcurve"></div>
                        <div class="full_det"><a <?php
                            if ($_SESSION['LID'] != '') {
                            ?>href="<?php
                            echo $fetchquery['RGT_ProfileUrl'];
                            ?>" <?php
                            } //isset($_SESSION['LID'])
                            else {
                            ?> class="pop firstviewmore" onclick="getUserProfile('<?php
                            echo $fetchquery['RGT_ProfileUrl'];
                            ?>','','');" <?php
                            }
                            ?>   target="_blank"> View Full Details</a>
                        </div>
                    </div>
                    <?php
                        } //$fetchquery['RGT_PaymentStatus'] == '1'
                        ?>
                </div>
                <!--addetails-->
            </div>
            <br/><br/>
            <?php
                } //$fetchquery = mysql_fetch_array($searchquery)
                } //$requestType == 'company'
                ?>
            <!--ad-->
        </div>
        <?php
            } //$countresult > 0
            else {
                echo '<center class="msgalert">No Company Found</center>';
            }
            ?>
    </div>
    <!--740-->
</div>
<!--adleft_container-->
<?php
    } //$requestType == 'company'
    if ($requestType == 'bestdeals') {

    ?>
<!--adleft_container-->
<div class="adleft_container">
    <div style="width:100%;height:55px;float:left;" align="right">
    <!--     <div class="post_anadd">
            <a <?php
                if (isset($_SESSION['LID'])) {
                ?> target="_blank"  href="<?php
                echo 'Advertisement.php?user=' . base64_encode($_SESSION['Type']);
                ?>" <?php
                } //isset($_SESSION['LID'])
                else {
                ?> class="pop firstviewmore" onclick="Postafreead();" <?php
                }
                ?> title="View More" style="text-decoration: none;">
                <div class="post_addtxt">Post a Free Ad</div>
                <div class="post_findtxt">To find your Best Deal</div>
            </a>
        </div> -->
    </div>
    <!--250-->
    <div style="width:250px;height:auto;float:left;">
        <!--relatedsearch-->
        <div class="adrelatedsearch">
            <div id="relatedresultsbox" style="display:<?php
                if ($searchkey == '') {
                    echo 'none';
                } 
                else
                    echo 'block';
                ?>" >
                <div class="adleftaccordiaon_top" >Related Searches</div>
                <div style="width:245px;height:auto;border:1px solid #C0C0C0;" >
                    <ul class="relatedsearch_ul">
                        <?php
                            if ($requestType == 'bestdeals') {
                                // echo "rel Products--->",$relatedsearch;
                                // echo "rel11 Products--->",$relatedsearch1;
                                getRelatedSearchBestdeals($relatedsearch, $relatedsearch1);
                            } 
                            ?>
                    </ul>
                </div>
            </div>
            <div id="featuredlistings" style="display:<?php
                if ($searchkey == '') {
                    echo 'block';
                } //$searchkey == ''
                else
                    echo 'none';
                ?>" >
                <div class="adleftaccordiaon_top" >Featured Products</div>
                <div style="width:245px;height:auto;border:1px solid #C0C0C0;" >
                    <ul class="relatedsearch_ul">                  
                        <?php
                            if ($requestType == 'bestdeals') {
                                list_featured_product();
                            } //$requestType == 'company'
                        ?>
                    </ul>
                </div>
            </div>
            <div class="adleftaccordion_btm" ></div>
        </div>
        <!--relatedsearch-->
    </div>
    <!--250-->
    <!--740-->
    <div style="width:740px;height:auto;float:left;">
    <!--     <div style="width:740px; height:30px;display:none;" align="center">
            <input type="radio" id="requestTypeCom" name="requestType"  value="company" title="Company" onclick="changesearchtype();" /><label for="requestTypeCom" >Company</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="requestType" id="requestTypedeals" checked="checked" value="bestdeals" title="Xbit" onclick="changesearchtype();" /><label for="requestTypedeals">Products</label>
        </div> -->
      
        <div style="width:740px; height:50px;">
            <div class="adsearch_txbox" >
                <input type="text" autocomplete="off" name="searchkey" id="searchlist"  style="width:600px;height:30px;border:1px solid #999;" placeholder="Please Enter Product / Service to Search" autofocus value="<?php
                    echo $searchkey;
                    ?>" onkeyup="Searchusingenterkey(event);"  /><!-- onkeypress="Searchusingenterkey(event);" -->
                <div id="SearchListRes"></div>
            </div>
            <div class="adsearch" align="center"><a href="#" onclick="searchResult($('#searchlist').val(),'','<?php
                echo $_REQUEST['type2'];
                ?>');">Search</a>
            </div>
        </div>

        <?php
            if ($countresult_deals > 0) {       
            ?>
         <div class="adsearchresult_menu"><a id="Searchdisplaytypelist" class="active" href="#" onclick="SearchListStyle(<?php
            echo '\'' . $requestType . '\'' . ',' . '\'' . $searchkey . '\'';
            ?>,'1',<?php
            echo $type2;
            ?>);">List</a> | <a id="Searchdisplaytypegrid" href="#" onclick="SearchListStyle(<?php
            echo '\'' . $requestType . '\'' . ',' . '\'' . $searchkey . '\'';
            ?>,'2',<?php
            echo $type2;
            ?>);" >View Gallery</a>
        </div>
        <!--ad-->
        <div id="mainsearchcontent">
            <?php if($requestType=='bestdeals'){                                 
            while($fetchquery=mysql_fetch_array($searchquery_deals)){
            $yearofestablishment = explode('-',get_data_from_registration($fetchquery['PS_User_Fk'],'RGT_YrofEstablish'));
             if(strlen(stripslashes(get_company_name($fetchquery['PS_Id'])))>25){ $Compnamefixlimit = substr(stripslashes(get_company_name($fetchquery['PS_Id'])),0,25).'...' ;} else { $Compnamefixlimit =  stripslashes(get_company_name($fetchquery['PS_Id']));} 
             
            if($yearofestablishment[2]!='')
            $Since = '<span style="color:#007088;"> (Since - '.$yearofestablishment[0].')</span>';
            else
            $Since ='';
            $Compnamedisp = $Compnamefixlimit.$Since; 
            ?>
            <div class="singlead">
                <!--title-->
                <div class="adtitle">
                    <div style="width:550px;color:#EC5324;float:left;"><b><?php
                        echo $Compnamedisp;
                        ?></b></div>                  
                </div>               
                <div class="adimage">
                    <div class="company_logo">
                        <a href="#thumb" class="thumbnail">
                        <img src="<?php
                            if ($fetchquery['PS_CoverImg'] != '') {
                                echo $fetchquery['PS_CoverImg'];
                            } //$fetchquery['PS_CoverImg'] != ''
                            else {
                                echo 'images/default/no_image.png';
                            }
                            ?>"  width="124" height="115" /><span><img src="<?php
                            if ($fetchquery['PS_CoverImg'] != '') {
                                echo $fetchquery['PS_CoverImg'];
                            } //$fetchquery['PS_CoverImg'] != ''
                            else {
                                echo 'images/default/no_image.png';
                            }
                            ?>" width="220" height="220" /></span></a>
                    </div>
                    <div>
                        <div><?php
                            echo $fetchquery['PS_Display'];
                            ?>
                        </div>
                        <div><?php
                            if ($fetchquery['PS_Price'] != '' && $fetchquery['PS_Price'] != '0') {
                                echo '<span> Price :' . ' ' . $fetchquery['PS_Price'] . ' ' . CurrencyName($fetchquery['PS_Currency']) . '</span>';
                            } //$fetchquery['PS_Price'] != '' && $fetchquery['PS_Price'] != '0'
                            if ($fetchquery['PS_Unit'] != '') {
                                echo '<span> Unit :' . ' ' . $fetchquery['PS_Unit'] . '</span>';
                            } //$fetchquery['PS_Unit'] != ''
                            ?>
                        </div>
                    </div>
                </div>              
                <div class="addetails">
                    <div class="addetails_left">
                        <span style="color:#EC5324;"><b>Business Descriptions</b></span>
                        <div style="height:10px;"></div>
                        <?php
                            if (strlen($fetchquery['PS_Description']) > 150) {
                                echo substr($fetchquery['PS_Description'], 0, 150) . '...';
                            } //strlen($fetchquery['PS_Description']) > 150
                            else {
                                echo $fetchquery['PS_Description'];
                            }
                            ?>
                    </div>
                    <div class="addetails_sep"></div>
                    <div class="addetails_right">
                        <span style="color:#EC5324;"><b>Contact Details</b></span>
                        <div style="height:10px"></div>
                        <?php
                            getAreadetails(get_data_from_registration($fetchquery['PS_User_Fk'], 'RGT_Area'));
                            getCitydetails(get_data_from_registration($fetchquery['PS_User_Fk'], 'RGT_City'));
                            getStatedetails(get_data_from_registration($fetchquery['PS_User_Fk'], 'RGT_State'));
                            getPindetails(get_data_from_registration($fetchquery['PS_User_Fk'], 'RGT_Pincode'));
                            getCountrydetails2(get_data_from_registration($fetchquery['PS_User_Fk'], 'RGT_Country'));
                            ?>
                        <div><?php
                            if (get_data_from_registration($fetchquery['PS_User_Fk'], 'RGT_Mobile') != '')
                                echo 'Phone: ' . get_data_from_registration($fetchquery['PS_User_Fk'], 'RGT_Mobile');
                            else
                                echo 'Phone: ' . get_data_from_registration($fetchquery['PS_User_Fk'], 'RGT_Landline');
                            ?>
                        </div>
                        <div><?php
                            echo 'Email: ' . get_data_from_registration($fetchquery['PS_User_Fk'], 'RGT_Email');
                            ?>
                        </div>
                    </div>
                </div>
                <div style="width:705px;height:39px;float:left;">
                    <div class="chat_details">
                        <div class="chat_curve"></div>
                        <div class="chat_style"><img src="images/chat_online.png" style="position:relative;top:3px;" />&nbsp;&nbsp;<a href="#"> I'm Offline</a></div>
                        <div class="chat_fullcurve"></div>
                        <?php
                            if (get_data_from_registration($fetchquery['PS_User_Fk'], RGT_Type) == 1)
                                $user_id = $fetchquery['PS_User_Fk'];
                            else
                                $user_id = get_data_from_registration($fetchquery['PS_User_Fk'], RGT_ProfileUrl);
                            ?>
                        <div class="full_det"><a <?php
                            if ($_SESSION['LID'] != '' ) {
                            ?> target="_blank"  href="<?php
                            echo 'Bestdealsajax.php?type=' . base64_encode(get_data_from_registration($fetchquery['PS_User_Fk'], RGT_Type)) . '&user=' . $user_id . '&BDId=' . $fetchquery['PS_Id'];
                            ?>" <?php
                            } //isset($_SESSION['LID'])
                            else {
                            ?> class="pop firstviewmore" onclick="getUserProfile('<?php
                            echo $user_id;
                            ?>','<?php
                            echo $fetchquery['PS_Id'];
                            ?>','<?php
                            echo base64_encode(get_data_from_registration($fetchquery['PS_User_Fk'], RGT_Type));
                            ?>');" <?php
                            }
                            ?> >View Full Details</a></div>
                    </div>
                </div>                
            </div>
            <br/><br/>
            <?php
                } //$fetchquery = mysql_fetch_array($searchquery)
                } //$requestType == 'bestdeals'
                ?>
            <!--ad-->
        </div>
        <?php
            } //$countresult > 0
            else {
                echo '<center class="msgalert">No Result Found</center>';
            }
            ?>
    </div>
    <!--740-->
</div>
<!--adleft_container-->
<?php
    } //$requestType == 'bestdeals'
    ?>
