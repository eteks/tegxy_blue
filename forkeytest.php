<?php 


include_once("include/Configuration.php");
include_once("include/DatabaseConnection.php");
db_connect();


db_query("delete from tbl_table2 where id=1");

?>
