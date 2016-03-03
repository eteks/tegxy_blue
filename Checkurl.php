<?php include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();

$Runsql = db_query("SELECT RGT_ProfileUrl FROM ".TABLE_REGISTRATION." WHERE RGT_ProfileUrl='".$_GET["q"]."'");
if(db_num_rows($Runsql)>0)
  $response="<span style='color:red'>Page Address Exists. Please Change it</span>";
else
  $response="";
echo $response;
?>