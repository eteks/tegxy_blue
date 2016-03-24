<?php
include("include/Configuration.php");
include("include/DatabaseConnection.php");
db_connect();

if(isset($_GET['email_check'])){
 $sql = "SELECT RGT_Email FROM tbl_registration WHERE RGT_Email = '".$_POST['Email']."'";
  $select=mysql_query($sql);
  $row = mysql_fetch_assoc($select);
  if (mysql_num_rows($select) > 0) {
      echo "exist";
      
  }else { echo 'notexist'; }
 }

?>

