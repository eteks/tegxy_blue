<?php
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
if(isset($_REQUEST)){
if(isset($_REQUEST['act'])=='listarea'){
$citycode = $_REQUEST['citycode'];
$selectt  = $_REQUEST['selectt'];
$key  = $_REQUEST['key'];
display_area_list($citycode,$selectt,$key);
}
//echo '***'.display_city_name($citycode);
}
if(isset($_POST)){
    $city_id = $_POST['city_id'];
    $query = mysql_query("select * from tbl_areamaster where AM_City = '$city_id'");
    while($row = mysql_fetch_array($query)) {
        echo "<option value=".$row['AM_Id'].">".$row['AM_Area']."</option>";
    }
}
?>
