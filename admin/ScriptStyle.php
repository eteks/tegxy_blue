<link rel="stylesheet" type="text/css" href="css/style_msg.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" language="javascript"  src="js/Common.js"></script>

<script type="text/javascript" language="javascript" src="js/jquery-1.6.js"></script>
<script type="text/javascript" language="javascript"  src="js/MenuClick.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.scrollable.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function()
{
	$("#networkBarButtonArrow").click(function()
	{
			if(document.getElementById('networkBarButtonvalue').value=='1')
			{
				document.getElementById('networkBarButtonvalue').value='';
				document.getElementById('networkBarButtonArrow').innerHTML='<img src="images/Arrow_Up.png" alt="Mouse hover to Hide the Module" title="Mouse hover to Hide the Module" width="16" height="16" border="0" style="cursor:pointer;" />';
				$("#networkBarPopup").css({position: 'fixed',backgroundcolor:'#000000',width:'740px'});
				$("#networkBarPopup").slideDown(500);	
				$("#networkBarControls").css({position: 'fixed'});
				$("#AminMainContent").animate({marginTop: "170px"}, 500 );
			}
			else
			{
				document.getElementById('networkBarButtonvalue').value='1';
				document.getElementById('networkBarButtonArrow').innerHTML='<img src="images/Arrow_Down.png" alt="Mouse hover to Hide the Module" title="Mouse hover to Hide the Module" width="16" height="16" border="0" style="cursor:pointer;" />';
				$("#networkBarPopup").css({position: '',backgroundcolor:'#000000',width:'740px'});
				$("#networkBarPopup").slideUp(500);
				$("#networkBarControls").css({position: 'fixed'});
				$("#AminMainContent").animate({marginTop: "0px"}, 0 );
			}
	});
});
jQuery(document).ready(function()
{ <?php
$SelectModuleCategory = "Select ModuleCategory_pk,ModuleCategory_Name,ModuleCategory_Function from ".TABLE_MODULECATEGORY." where ModuleCategory_Status='1'";
$SelectModuleCategory_Qry = db_query($SelectModuleCategory);
$SelectModuleCategory_num = db_num_rows($SelectModuleCategory_Qry); 
$i=1;
while ($SelectModuleCategory_fetch = db_fetch_array($SelectModuleCategory_Qry))
{ 
	$ArrayModuleCategory[$i] =$SelectModuleCategory_fetch['ModuleCategory_Name'];
	$ArrayModuleCategoryFunction[$i] =$SelectModuleCategory_fetch['ModuleCategory_Function'];
	$ArrayModuleCategoryPk[$i] =$SelectModuleCategory_fetch['ModuleCategory_pk']; 
	
	$SelectModuleCategoryList = "Select ModuleList_pk,ModuleList_name,ModuleList_function,ModuleList_image from ".TABLE_MODULECATEGORYLIST." where ModuleList_status='1' and ModuleList_fk='".$ArrayModuleCategoryPk[$i]."'"; 
	$SelectModuleCategoryList_Qry = db_query($SelectModuleCategoryList);
	$SelectModuleCategoryList_num = @db_num_rows($SelectModuleCategoryList_Qry); 
	if($SelectModuleCategoryList_num>3)
	{ ?>
		jQuery("#scrollable<?php echo $i;?>").scrollable({horizontal:true,size: 0});<?php  
	} $i++;
} ?>
});
</script>
<script type="text/javascript" language="javascript" src="js/Role.js"></script>
<script type="text/javascript" language="javascript" src="js/AdminUser.js"></script>
<script type="text/javascript" language="javascript" src="js/Authentication.js"></script>
<script type="text/javascript" language="javascript" src="js/Sector.js"></script>
<script type="text/javascript" language="javascript" src="js/ChangePassword.js"></script>
<script type="text/javascript" src="js/GeneralCountry.js"></script>
<script type="text/javascript" language="javascript" src="js/GeneralState.js"></script>
<script type="text/javascript" language="javascript" src="js/GeneralArea.js"></script>
<script type="text/javascript" language="javascript" src="js/Login.js"></script>
<script type="text/javascript" language="javascript" src="js/ModuleCategory.js"></script>
<script type="text/javascript" language="javascript" src="js/ModuleCategoryList.js"></script>
<script type="text/javascript" language="javascript" src="js/ForgetPassword.js"></script>
<script type="text/javascript" language="javascript" src="js/ProductCategory.js"></script>
<script type="text/javascript" language="javascript" src="js/ProductSubCategory.js"></script>
<script type="text/javascript" language="javascript" src="js/ProductType.js"></script>
<script type="text/javascript" language="javascript" src="js/ProductList.js"></script>
<script type="text/javascript" src="js/ProductSpecification.js"></script>
<script type="text/javascript" language="javascript" src="js/AreaMaster.js"></script>
<script type="text/javascript" language="javascript" src="js/PincodeMaster.js"></script>
<script type="text/javascript" language="javascript" src="js/AdvertisementCurrency.js"></script>
