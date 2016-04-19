<?php 
function db_connect($server = DB_SERVER, $username = DB_SERVER_USERNAME, $password = DB_SERVER_PASSWORD, $database = DB_DATABASE, $link = 'db_link') 
{
	global $$link;
    $$link = mysql_connect($server, $username, $password) or die("Couldnt connect DB");
	if ($$link) mysql_select_db($database);
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
	if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) 
	{
		if (!is_object($logger)) $logger = new logger;
		$logger->write($query, 'QUERY');
	}

	$result = mysql_query($query, $$link) or db_error($query, mysql_errno(), mysql_error());

	if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) 
	{
		if (mysql_error()) $logger->write(mysql_error(), 'ERROR');
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
	if ($action == 'insert') 
	{
		$query = 'insert into ' . $table . ' (';
		while (list($columns, ) = each($data)) 
		{
			$query .= $columns . ', ';
		}
		$query = substr($query, 0, -2) . ') values (';
		reset($data);
		while (list(, $value) = each($data)) 
		{
			switch ((string)$value) 
			{
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
	} 
	elseif ($action == 'update') 
	{
		$query = 'update ' . $table . ' set ';
		while (list($columns, $value) = each($data)) 
		{
			switch ((string)$value) 
			{
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
	if (is_string($string)) 
	{
		return trim(stripslashes($string));
	} 
	elseif (is_array($string)) 
	{
		reset($string);
		while (list($key, $value) = each($string)) 
		{
			$string[$key] = db_prepare_input($value);
		}
		return $string;
	} 
	else 
	{
		return $string;
	}
}

function GeneralCountry($Cid)
{
	$SelectCountry=db_query("Select CountryName From ".TABLE_GENERALCOUNTRY." WHERE Country_pk='".$Cid."'"); 
	$FetchCountry=db_fetch_array($SelectCountry);
	return ucfirst($FetchCountry[0]);
}

function PermissionList($string='',$string1='*',$string2='')
{
	if($string1!='*') { $string1= 'DISTINCT '.$string1; }
	if($string2!='') { $string2 = " and ModuleList_fk='".$string2."'";}
	$i=0;
	$SelectPermissionArray[$i] = $string1;$i++;
	$SelectPermission = "Select ".$string1." from ".TABLE_ADMINUSERPERMISSION." where AdminUser_fk='".$string."' ".$string2."";
	$SelectPermission_Qry = db_query($SelectPermission);
	$SelectPermission_Num = @db_num_rows($SelectPermission_Qry);
	if($SelectPermission_Num>0)
	{
		while($SelectPermission_Ftch = db_fetch_array($SelectPermission_Qry))
		{
			if($string2!='')
			{
				$SelectPermissionArray[$SelectPermission_Ftch[0]]=1;
			}
			else
			{
			$SelectPermissionArray[$i]=$SelectPermission_Ftch[0];$i++;
			}
		}	
	}
	return $SelectPermissionArray;
}

function getMaxId($table, $field)
{
	$SelectQuery=db_query("Select MAX(".$field.") From ".$table.""); 
	$FetchQuery=db_fetch_array($SelectQuery);
	if (!empty($FetchQuery[0]))
	return ucfirst($FetchQuery[0]);
	else
	return 0;
}


function CheckExist($sql)
{
	$res=db_query($sql);
	$result=db_fetch_array($res);
	$d = $result[0];
	if (!empty($d)) return true;
}

function ProductName($Iid)
{
	$SelectQuery=db_query("Select ProductName From ".TABLE_ADMINPRODUCT." WHERE Id='".$Iid."' "); 
	$FetchQuery=db_fetch_array($SelectQuery);
	return ucfirst($FetchQuery[0]);
}
function ProductCategory($Iid)
{
	$SelectQuery=db_query("Select ProductCat_Name From ".TABLE_PRODUCTCATEGORY." WHERE ProductCat_Pk='".$Iid."' "); 
	$FetchQuery=db_fetch_array($SelectQuery);
	return ucfirst($FetchQuery[0]);
}
function ProductSubCategory($Iid)
{
	$SelectQuery=db_query("Select ProductSubCat_Name From ".TABLE_PRODUCTSUBCATEGORY." WHERE ProductSubCat_Pk='".$Iid."' "); 
	$FetchQuery=db_fetch_array($SelectQuery);
	return ucfirst($FetchQuery[0]);
}
function ProductType($Iid)
{
	$SelectQuery=db_query("Select ProductType_Name From ".TABLE_PRODUCTTYPE." WHERE ProductType_Pk='".$Iid."' "); 
	$FetchQuery=db_fetch_array($SelectQuery);
	return ucfirst($FetchQuery[0]);
}

function PHP_Mailer($Message,$Subject,$ToAddress,$ToName,$FromAddress,$FromName,$Attachmenttemp,$Attachment)
{ 
$mail = new PHPMailer(true);
try {
$mail->AddAddress($ToAddress,$ToName);
$mail->SetFrom($FromAddress,$FromName);		  
$mail->Subject = $Subject;
if(isset($Attachment) && $Attachment!='')
$mail->AddAttachment($Attachmenttemp,$Attachment);
$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; 
$mail->MsgHTML($Message);
$mail->Send();
} catch (phpmailerException $e) {
echo $e->errorMessage(); 
} catch (Exception $e) {
echo $e->getMessage(); 
} 
}
?>
