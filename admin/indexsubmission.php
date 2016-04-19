<?php 
$_REQUEST['formname'] = (isset($_REQUEST['formname']) ? $_REQUEST['formname'] : '');
if($_REQUEST['formname']=='ModuleCategoryForm')
include("include/BlModules/Bl_ModuleCategory.php");

if($_REQUEST['formname']=='ModuleListForm')
include("include/BlModules/Bl_ModuleCategoryList.php");

include("include/BlModules/Bl_Role.php");

if($_REQUEST['formname']=='AdminUserForm')
include("include/BlModules/Bl_AdminUser.php");

if($_REQUEST['formname']=='Authenticationform')
include("include/BlModules/Bl_Authentication.php");

if($_REQUEST['formname']=='GeneralCountryForm')
include("include/BlModules/Bl_GeneralCountry.php");

if($_REQUEST['formname']=='GeneralStateForm')
include("include/BlModules/Bl_GeneralState.php");

if($_REQUEST['formname']=='GeneralAreaForm')
include("include/BlModules/Bl_GeneralArea.php");

if($_REQUEST['formname']=='ProdSpecForm')
include("include/BlModules/Bl_ProductSpecification.php");


include("include/BlModules/Bl_Sector.php");
include("include/BlModules/Bl_ChangePassword.php");

include("include/BlModules/Bl_ProductCategory.php");
include("include/BlModules/Bl_ProductSubCategory.php");
include("include/BlModules/Bl_ProductType.php");
include("include/BlModules/Bl_Productlist.php");
include("include/BlModules/Bl_AdvertisementCurrency.php");

if($_REQUEST['formname']=='AreaMasterForm')
include("include/BlModules/Bl_AreaMaster.php");

if($_REQUEST['formname']=='PincodeMasterForm')
include("include/BlModules/Bl_PincodeMaster.php");

// if($_REQUEST['formname']=='PostAdv')
// include("include/BlModules/Bl_Advertisement.php");

 ?>
