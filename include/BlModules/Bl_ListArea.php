<?php
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

if(isset($_REQUEST['act'])=='listarea'){
$citycode = $_REQUEST['citycode'];
$selectt  = $_REQUEST['selectt'];
$key  = $_REQUEST['key'];
display_area_list($citycode,$selectt,$key);
}
echo '***'.display_city_name($citycode);
?>