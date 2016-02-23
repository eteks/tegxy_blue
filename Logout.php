<?php 
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
ob_start(); 
db_connect();
session_start();

if($_SESSION['LID']!=''){
clear_visitedpage($_SESSION['LID']);
}
session_destroy();
header("location:index.php");
 ?>