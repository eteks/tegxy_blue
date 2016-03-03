<?php
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

$StateId = $_REQUEST['StateId'];
$CityId = $_REQUEST['CityId'];
$AreaId = $_REQUEST['AreaId'];
$PinId = $_REQUEST['PinId'];
$CId = $_REQUEST['CId'];
$CId2 = $_REQUEST['CId2'];
$CId3 = $_REQUEST['CId3'];
$SId = $_REQUEST['SId'];
$SId2 = $_REQUEST['SId2'];
$SId3 = $_REQUEST['SId3'];
$SId4 = $_REQUEST['SId4'];
$AId = $_REQUEST['AId'];
$AId2 = $_REQUEST['AId2'];
$PId = $_REQUEST['PId'];
$Action = $_REQUEST['action'];

if($Action=='Product')
{
if(isset($SId)) {  
?>
<select id="<?php echo $CityId;?>" name="<?php echo $CityId;?>" size="12"  onchange="return OnclickCity(this.value,'<?php echo $StateId;?>','<?php echo $CityId;?>','<?php echo $AreaId;?>','<?php echo $PinId;?>','Bl_GeneralLocationFilter');"  >
<?php 
$SelectCity=db_query("Select Id,Area From ".TABLE_GENERALAREAMASTER." WHERE Status='1' AND A_State ='".$SId."' order by Area asc"); 
while($FetchCity=db_fetch_array($SelectCity))
{ ?>
<option  value="<?php echo $FetchCity['Id']; ?>" ><?php echo $FetchCity['Area']; ?></option>
<?php 
}?>
</select><?php echo '######'.StateName($SId).'######'.$CityId.'######'.$SId;
} 
if(isset($CId)) { 
?>
<select id="<?php echo $AreaId;?>" name="<?php echo $AreaId;?>" size="12" onchange="OnclickArea(this.value,'<?php echo $StateId;?>','<?php echo $CityId;?>','<?php echo $AreaId;?>','<?php echo $PinId;?>','Bl_GeneralLocationFilter');">
<?php 
$SelectArea=db_query("Select AM_Id, AM_Area From ".TABLE_AREAMASTER." WHERE AM_Status='1' AND AM_State='".$SId2."' AND AM_City='".$CId."'"); 
while($FetchArea=db_fetch_array($SelectArea))
{ 
$SelectPin=db_query("Select PM_Id, PM_Pincode From ".TABLE_PINCODEMASTER." WHERE PM_Status='1' AND PM_State='".$SId2."' AND PM_City='".$CId."' AND PM_Area='".$FetchArea['AM_Id']."'"); 
$FetchPin=db_fetch_array($SelectPin);
?>
<option  value="<?php echo $FetchArea['AM_Id'].StringLeftArrow($FetchPin['PM_Id'],'_',1); ?>" ><?php echo $FetchArea['AM_Area'].StringLeftArrow($FetchPin['PM_Pincode'],' - ',3); ?></option>
<?php 
}?>
</select><?php echo '######'.StateName($SId2).StringLeftArrow(CityName($CId),' >> ',4).'######'.$AreaId.'######'.$SId2.StringLeftArrow($CId,' >> ',4);
}
if(isset($AId)) { 
$Split = explode('_',$AId);
?>
<?php /*?><select id="<?php echo $PinId;?>" name="<?php echo $PinId;?>" size="12" onchange="OnclickPin(this.value,'<?php echo $StateId;?>','<?php echo $CityId;?>','<?php echo $AreaId;?>','<?php echo $PinId;?>','Bl_GeneralLocationFilter');">
<?php 
$SelectPin=db_query("Select PM_Id, PM_Pincode From ".TABLE_PINCODEMASTER." WHERE PM_Status='1' AND PM_State='".$SId3."' AND PM_City='".$CId2."' AND PM_Area='".$AId."'"); 

while($FetchPin=db_fetch_array($SelectPin))
{ ?>
<option  value="<?php echo $FetchPin['PM_Id']; ?>" ><?php echo $FetchPin['PM_Pincode']; ?></option>
<?php 
}?>
</select><?php */?><?php echo '######'.StateName($SId3).StringLeftArrow(CityName($CId2),' >> ',4).StringLeftArrow(AreaName($Split[0]).StringLeftArrow(PincodeName($Split[1]),' - ',3),' >> ',4).'######'.$PinId.'######'.$SId3.StringLeftArrow($CId2,' >> ',4).StringLeftArrow($AId,' >> ',4);
}
if(isset($PId)) { 
echo '######'.StateName($SId4).StringLeftArrow(CityName($CId3),' >> ',4).StringLeftArrow(AreaName($AId2),' >> ',4).StringLeftArrow(PincodeName($PId),' - ',4).'######'.$PinId.'######'.$SId4.StringLeftArrow($CId3,' >> ',4).StringLeftArrow($AId2,' >> ',4).StringLeftArrow($PId,' >> ',4);
}
}