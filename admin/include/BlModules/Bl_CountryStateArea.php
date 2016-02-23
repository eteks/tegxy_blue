<?php  include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
$Country=$_REQUEST["Country"];
$State=$_REQUEST["State"];
$City=$_REQUEST["City"];
if($_REQUEST['action']=="GeneralCountry"){
?>
<select id="SelState" name="SelState" class="dropdown" onchange="OnclickGeneralState(this.value);" <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?> >
    <option value="" selected="selected">--Select State--</option><?php 
    $SelectState=db_query("Select * From ".TABLE_GENERALSTATEMASTER." WHERE Status=1 AND St_Country='".$Country."'"); 
    while($FetchState=db_fetch_array($SelectState))
    { ?>
        <option  value="<?php echo $FetchState['Id']; ?>" <?php if($FetchState['Id']==$Fetch['A_State']){ ?> selected <?php }?> ><?php echo $FetchState['St_Name']; ?></option><?php 
    }?>
</select>
<?php	
}

if($_REQUEST['action']=="GeneralState"){
?>
<select id="SelCity" name="SelCity" class="dropdown" onchange="OnclickGeneralCity(this.value);" <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?> >
    <option value="" selected="selected">--Select City--</option><?php 
    $SelectCity=db_query("Select * From ".TABLE_GENERALAREAMASTER." WHERE Status=1 AND A_Country='".$Country."' AND A_State='".$State."'"); 
    while($FetchCity=db_fetch_array($SelectCity))
    { ?>
        <option  value="<?php echo $FetchCity['Id']; ?>"><?php echo $FetchCity['Area']; ?></option><?php 
    }?>
</select>
<?php	
} 


if($_REQUEST['action']=="GeneralCity"){
?>
<select id="SelArea" name="SelArea" class="dropdown"  <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?> >
    <option value="" selected="selected">--Select City--</option><?php 
    $SelectArea=db_query("Select * From ".TABLE_AREAMASTER." WHERE AM_Status=1 AND AM_Country='".$Country."' AND AM_State='".$State."' AND AM_City='".$City."'"); 
    while($FetchArea=db_fetch_array($SelectArea))
    { ?>
        <option  value="<?php echo $FetchArea['AM_Id']; ?>"><?php echo $FetchArea['AM_Area']; ?></option><?php 
    }?>
</select>
<?php	
} ?>