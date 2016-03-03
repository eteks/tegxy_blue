<?php
include('db.php');
if(isset($_POST['comp_search'])){

    $temp_arr = array();
    $query ="select RGT_CompName from tbl_registration a where RGT_Status=1 AND RGT_Type=2 AND a.RGT_CompName like '%".$_POST['comp_search']."%' ";
    $sql_res=mysql_query($query);
    while($row = mysql_fetch_assoc($sql_res)) {
        $temp_arr[] =$row;
    }
    print(json_encode($temp_arr));
}
?>
