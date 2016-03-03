<?php
$connection = mysql_connect('localhost','root','') or die(mysql_error());
$database = mysql_select_db('tracemein2') or die(mysql_error());

function confirm($msg)
{ 
echo '<script>alert('.$msg.');</script>';
}
?>
