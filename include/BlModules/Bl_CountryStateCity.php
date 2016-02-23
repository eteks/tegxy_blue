<?php include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

$Country           =  $_REQUEST["Country"];
$State             =  $_REQUEST["State"];
$City             =  $_REQUEST["City"];
$Area             =  $_REQUEST["Area"];
$Action            =  $_REQUEST["Action"];

$CountName           =  $_REQUEST['CountName'];
$StaName           =  $_REQUEST['StaName'];
$CitName           =  $_REQUEST['CitName'];
$AreaName           =  $_REQUEST['AreaName'];
$Pincode           =  $_REQUEST['Pincode'];

$Coun1           =  $_REQUEST['Coun1'];
$State1           =  $_REQUEST['State1'];
$City1           =  $_REQUEST['City1'];



if($Action=='Country')
{
if($Country!='')
{ ?>
<select id="<?php echo $StaName ;?>" name="<?php echo $StaName ;?>" class="memberinput" onchange="return OnclickStatee(this.value,'<?php echo $CountName ;?>','<?php echo $StaName ;?>','<?php echo $CitName ;?>','<?php echo $AreaName ;?>','<?php echo $Pincode ;?>');"  >
<option value="" selected="selected">--Select State--</option><?php 
$SelectState=db_query("Select Id,St_Name From ".TABLE_GENERALSTATEMASTER." WHERE Status=1 AND St_Country='1' Order by Id asc"); // St_Country='".$Country."'
while(list($MSId,$MSName)=db_fetch_array($SelectState))
{ ?>
<option  value="<?php echo $MSId; ?>" ><?php echo $MSName; ?></option><?php 
}?>
</select>######<select id="<?php echo $CitName ;?>" name="<?php echo $CitName ;?>" class="memberinput"  >
</select>######<select id="<?php echo $AreaName ;?>" name="<?php echo $AreaName ;?>" class="memberinput" >
</select>######<select id="<?php echo $Pincode ;?>" name="<?php echo $Pincode ;?>" class="memberinput"  >
</select><?php echo '######'.$StaName.'######'.$CitName.'######'.$AreaName.'######'.$Pincode ; exit;
}
else
{?>
<select id="<?php echo $StaName ;?>" name="<?php echo $StaName ;?>"  class="memberinput"   >
</select>######<select id="<?php echo $CitName ;?>" name="<?php echo $CitName ;?>" class="memberinput" >
</select>######<select id="<?php echo $AreaName ;?>" name="<?php echo $AreaName ;?>" class="memberinput" >
</select>######<select id="<?php echo $Pincode ;?>" name="<?php echo $Pincode ;?>" class="memberinput" >
</select><?php echo '######'.$StaName.'######'.$CitName.'######'.$AreaName.'######'.$Pincode ; exit;
}
}
if($Action=='State')
{
if($State!='')
{ ?>
<select id="<?php echo $CitName ;?>" name="<?php echo $CitName ;?>" class="memberinput"  onchange="return OnclickCityy(this.value,'<?php echo $CountName ;?>','<?php echo $StaName ;?>','<?php echo $CitName ;?>','<?php echo $AreaName ;?>','<?php echo $Pincode ;?>');">
<option value="" selected="selected">--Select City--</option><?php 
$SelectArea=db_query("Select Id, Area From ".TABLE_GENERALAREAMASTER." WHERE Status=1 AND A_Country='".$Coun1."' AND A_State='".$State."' Order by Id asc");
echo "Select Id, Area From ".TABLE_GENERALAREAMASTER." WHERE Status=1 AND A_Country='".$Coun1."' AND A_State='".$State."' Order by Id asc"; 
while(list($Id,$Area)=db_fetch_array($SelectArea))
{ ?>
<option  value="<?php echo $Id; ?>" ><?php echo $Area; ?></option><?php 
}?>
</select>######<select id="<?php echo $AreaName ;?>" name="<?php echo $AreaName ;?>" class="memberinput" >
</select>######<select id="<?php echo $Pincode ;?>" name="<?php echo $Pincode ;?>" class="memberinput"  ><?php echo '######'.$CitName.'######'.$AreaName.'######'.$Pincode ; exit;
} 
else
{?>
<select id="<?php echo $CitName ;?>" name="<?php echo $CitName ;?>" class="memberinput" >
</select>######<select id="<?php echo $AreaName ;?>" name="<?php echo $AreaName ;?>" class="memberinput" >
</select>######<select id="<?php echo $Pincode ;?>" name="<?php echo $Pincode ;?>" class="memberinput" >
</select><?php echo '######'.$CitName.'######'.$AreaName.'######'.$Pincode ; exit;
}}

if($Action=='City')
{
if($City!='')
{ ?>
<select id="<?php echo $AreaName ;?>" name="<?php echo $AreaName ;?>" class="memberinput"  onchange="return OnclickAreaa(this.value,'<?php echo $CountName ;?>','<?php echo $StaName ;?>','<?php echo $CitName ;?>','<?php echo $AreaName ;?>','<?php echo $Pincode ;?>');">
<option value="" selected="selected">--Select Area--</option><?php 

$SelectArea=db_query("Select AM_Id, AM_Area From ".TABLE_AREAMASTER." WHERE AM_Status=1 AND AM_Country='".$Coun1."' AND AM_State='".$State1."' AND AM_City='".$City."' Order by AM_Id asc"); 
while(list($Id,$Area)=db_fetch_array($SelectArea))
{ ?>
<option  value="<?php echo $Id; ?>" ><?php echo $Area; ?></option><?php 
}?>
</select>######<select id="<?php echo $Pincode ;?>" name="<?php echo $Pincode ;?>" class="memberinput"  ></select>
<?php echo '######'.$AreaName.'######'.$Pincode  ; exit;
} 
else
{?>
<select id="<?php echo $AreaName ;?>" name="<?php echo $AreaName ;?>" class="memberinput"  >
</select>######<select id="<?php echo $Pincode ;?>" name="<?php echo $Pincode ;?>" class="memberinput" >
</select><?php echo '######'.$AreaName.'######'.$Pincode ; exit;
}}

if($Action=='Area')
{
if($Area!='')
{ ?>
<select id="<?php echo $Pincode ;?>" name="<?php echo $Pincode ;?>" class="memberinput"  >
<?php 

$SelectPin=db_query("Select PM_Id, PM_Pincode From ".TABLE_PINCODEMASTER." WHERE PM_Status=1 AND PM_Area='".$Area."' Order by PM_Id asc"); 

echo "Select PM_Id, PM_Pincode From ".TABLE_PINCODEMASTER." WHERE PM_Status=1  AND PM_Country='".$Coun1."' AND PM_State='".$State1."' AND PM_City='".$City1."' AND PM_Area='".$Area."' Order by PM_Id asc";
while(list($Id,$Pin)=db_fetch_array($SelectPin))
{ ?>
<option  value="<?php echo $Id; ?>" ><?php echo $Pin; ?></option><?php 
}?>
</select>
<?php echo '######'.$Pincode ; exit;
} 
else
{?>
<select id="<?php echo $Pincode ;?>" name="<?php echo $Pincode ;?>" class="memberinput"  >
</select><?php echo '######'.$Pincode; exit;
}}
