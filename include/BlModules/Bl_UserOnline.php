<?php
// @author [Cheenu]  @Timestamp Date: 28-10-2013  Time: 10:11
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
$pageuserid=$_REQUEST['page_user_id'];

if(isset($_REQUEST['action'])){
    if($_REQUEST['action']=='Find'){
    
     $findonline=db_query("SELECT COUNT(RGT_PK) AS UserOnlineStatus FROM ".TABLE_REGISTRATION." WHERE RGT_LastActiveTime > NOW()-10 AND RGT_PK='$pageuserid'");
    $fetchonline=db_fetch_array($findonline);
    echo $fetchonline['UserOnlineStatus'];
        
    }   
}



?>