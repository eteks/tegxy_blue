<?php 
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

	
	$str1 = addslashes($_POST['data']);
	if($str1!=''){
	$LocRel = 'SELECT PM_Country,PM_State,PM_City,PM_Area,PM_Id FROM '.TABLE_PINCODEMASTER.' a , '.TABLE_GENERALCOUNTRYMASTER.' b  WHERE a.PM_Country=b.Id AND b.Country_Name LIKE "%'.$str1.'%" AND b.Status=1 ';
	$result = db_query($LocRel) or die(db_error());
	
	$LocRel2 = 'SELECT Country_Name FROM '.TABLE_GENERALCOUNTRYMASTER.'  WHERE Country_Name LIKE "%'.$str1.'%"  AND Status=1  ';
	$result2 = db_query($LocRel2) or die(db_error());
	
	if(db_num_rows($result))
	{		
		echo '<ul class="list">';
		while($FetLocRel  = db_fetch_array($result))
		{	
		
		$final = StateName($FetLocRel['PM_State']).StringLeftArrow(CityName($FetLocRel['PM_City']),' >> ',4).StringLeftArrow(AreaName($FetLocRel['PM_Area']),' >> ',4).StringLeftArrow(PincodeName($FetLocRel['PM_Id']),' - ',4);
		$finalId = $FetLocRel['PM_State'].StringLeftArrow($FetLocRel['PM_City'],' >> ',4).StringLeftArrow($FetLocRel['PM_Area'],' >> ',4).StringLeftArrow($FetLocRel['PM_Id'],' >> ',4);
		echo '<li><a href=\'javascript:void(0);\'>'.$final.'<span style="display:none;">**'.$finalId.'</a></li>';
		 }
		echo '</ul>';
		echo '<div style="background-color: #DBDBDB;font-weight: bold;padding: 3px 8px;line-height:150%;">Not satisfied with the recommended location?<a class="ahighlight" style="cursor:pointer;" onclick="ChooseLocation(\'ProLocClear\',\'Bl_ProductLocList.php\',\'ProLocResponse\');">Choose your own location here</a></div>';
	}
	else if(db_num_rows($result2))
	echo '<div style="background-color: #DBDBDB;font-weight: bold;padding: 3px 8px;line-height:150%;">No Recommended Location Found. <a class="ahighlight" style="cursor:pointer;" onclick="ChooseLocation(\'ProLocClear\',\'Bl_ProductLocList.php\',\'ProLocResponse\');">Choose your own location here</a></div>';
	else
		echo '<div style="background-color: #DBDBDB;font-weight: bold;padding: 3px 8px;line-height:150%;">No Recommended Location Found. <a class="ahighlight" style="cursor:pointer;" onclick="ChooseLocation(\'ProLocClear\',\'Bl_ProductLocList.php\',\'ProLocResponse\');">Choose your own location here</a></div>';
	}
	else
	{?>
		<table border="0" cellspacing="0" cellpadding="0" width="100%" style="padding:5px;"> 
        <tr>
        <td>
        <select id="State" size="12"  name="State" onchange="OnclickState(this.value,'State','City','Area','Pincode','Bl_GeneralLocationFilter');">
			<?php $State=db_query("Select Id,St_Name From ".TABLE_GENERALSTATEMASTER." Where Status=1 order by St_Name asc");
            while($FetchState=db_fetch_array($State))
            { ?> 
                <option value="<?php echo $FetchState['Id']; ?>"><?php echo $FetchState['St_Name']; ?></option><?php
            } ?>
        </select>
        </td>
        <td>&nbsp;</td>
        <td><span id="ShowCityList"><select id="City" size="12"  name="City"></select></span></td>
        <td>&nbsp;</td>
        <td><span id="ShowAreaList"><select id="Area" size="12"  name="Area"></select></span></td>
        <td>&nbsp;</td>
        </tr>
        <tr><td colspan="6" height="20"></td></tr>
        <tr><td colspan="6"><input type="button" value="Ok" onclick="CloseLocation('ProLocResponse');" />&nbsp;&nbsp;<input type="button" value="Cancel" onclick="ClearLocation('ProLocationList','ProLocResponse','ProLocationListId');" /></td></tr>
        <tr><td colspan="6" height="20"></td></tr>
        </table>
	<?php }
?>	   
