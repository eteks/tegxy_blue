<?php 
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();
$HL=5;
include("CommonHeader.php");?>
<div style="width:990px;height:auto;clear:left;margin-top:0px;margin-left:auto;margin-right:auto;">
<div id="contentwrapper">
<div id="contentcolumn">
<div class="innertube">
<center><h2 style="position:relative;color:#E76524;font-weight:bold;text-align:center;padding:5px 0px;">Contact Us</h2></center>
<div class="comment more" style="border:0px solid #E76524;border-radius:5px;">
<?php
$sqltot="SELECT CI_Title,CI_Address,CI_Address2,CI_Country,CI_State,CI_City,CI_Area,CI_Pincode,CI_Phone, 	CI_Email,CI_Person,CI_Fax FROM ".TABLE_CONTACT."  WHERE  CI_UserFk 	='".$LID."' order by  CI_Id  desc";

$SqlRun=db_query($sqltot);
$Count = db_num_rows($SqlRun);
if($Count>0){
?>
<table style="padding-left:10px;">
<?php 
while(list($CI_Title,$CI_Address,$CI_Address2,$CI_Country,$CI_State,$CI_City,$CI_Area,$CI_Pincode,$CI_Phone,$CI_Email,$CI_Person,$CI_Fax) = db_fetch_array($SqlRun)){
?>

<tr>
<td style="color:#136578;font-size:16px;font-weight:bold;"><?php echo $CI_Title;?></td>
</tr>
<tr>
<td><?php echo $CI_Person;?></td>
</tr>
<tr>
<td><?php echo $CI_Address;?></td>
</tr>
<tr>
<td><?php echo $CI_Address2;?></td>
</tr>
<tr>
<td><?php echo AreaName($CI_Area) ;?></td>
</tr>
<?php
if((PincodeName($CI_Pincode)) != "")
{
?>
<tr>
<td><?php echo CityName($CI_City)."-". PincodeName($CI_Pincode);?></td>
</tr>
<?php
}
else
{
?>
<tr>
<td><?php echo CityName($CI_City);?></td>
</tr>
<?php
}
?>
<tr>
<td><?php echo StateName($CI_State);?></td>
</tr>
<tr>
<td><?php echo CountryName($CI_Country);?></td>
</tr>
<tr>
<td><b>Phone: </b><?php echo $CI_Phone;?></td>
</tr>
<tr>
<td><b>Email: </b><a href="mailto:<?php echo $CI_Email;?>" style="text-decoration:none;color:#E76524;"><?php echo $CI_Email;?></a></td>
</tr>
<tr>
<td><b>Fax: </b><?php echo $CI_Fax;?></td>
</tr>

<tr height="10"></tr>

<?php if(isset($Pid) && !empty($Pid)) $Pid++; }?>
</table>
<?php } else echo '<center class="msgalert">No Record Found</center>'; ?>     
</div>
</div>
</div>
<?php include("ProfileRight.php");?>
</div>
</div>
