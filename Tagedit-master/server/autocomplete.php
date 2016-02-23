<?php
include_once("../../include/Configuration.php");
include_once("../../".PAGE_DBCONNECTION);
db_connect();

session_start();

if($_SESSION['id']!='')
$wherecon    = "where  Kd_IndustryFk='".$_SESSION['id']."'";
$checkexist  = db_query("SELECT Kd_Id, Kd_Keyword FROM ".TABLE_KEYWORDMST." ".$wherecon."");
if(db_num_rows($checkexist)>0)
{	
while($fetch = db_fetch_array($checkexist))
{
$autocompletiondata[] = $fetch['Kd_Keyword'].'**'.$fetch['Kd_Id'];	
}
}
else
$autocompletiondata[]='';
/**
 * Script for the autocompletion in jQuery Plugin tagedit.
 *
 * @author Oliver Albrecht <info@webwork-albrecht.de>
 */

if(isset($_GET['term'])) {
    $result = array();
    foreach($autocompletiondata as $key => $valuee) {
		$value = explode('**',$valuee);
        if(strlen($_GET['term']) == 0 || strpos(strtolower($value[0]), strtolower($_GET['term'])) !== false) {
            $result[] = '{"id":'.$value[1].',"label":"'.$value[0].'","value":"'.$value[0].'"}';
        }
    }
    
    echo "[".implode(',', $result)."]";
}
?>