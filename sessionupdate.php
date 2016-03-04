<?php 
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();
session_start();
if ($_SESSION["LID"]) 
{
mysql_query("UPDATE tbl_registration SET RGT_LastActiveTime = NOW() WHERE RGT_PK = '".$_SESSION['LID']."' ");
}
?>