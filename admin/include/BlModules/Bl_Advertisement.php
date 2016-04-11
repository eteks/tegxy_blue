<?php  ob_start();
$ModuleId = $_REQUEST['ModuleId'];
$_REQUEST['action'] = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');
if($_REQUEST['action']=='FilterFieldList')
{ 
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
if($_REQUEST['SearchFilterFieldList']=='ProName') 
{ ?><input type="text" name="SearchFilterField" id="SearchFilterField" value="" class="input"/><?php }exit;
}
$_POST['Productlist'] = (isset($_POST['Productlist']) ? $_POST['Productlist'] : '');
$_REQUEST['Productlist'] = (isset($_REQUEST['Productlist']) ? $_REQUEST['Productlist'] : '');
if(($_POST['Productlist']=='Submit') || ($_REQUEST['Productlist']=='Update'))
{

$TxtProductCode= addslashes(trim($_POST['TxtProductCode']));
$TxtProductName= addslashes(trim($_POST["TxtProductName"]));
$ExistId=$_POST['ExistId']; 
$ActiveStatus=$_POST['ActiveStatus'];
$startdata=$_POST['startdata'];
$SearchFilterFieldList=$_POST['hidSearchFilterFieldList'];
$SearchFilterField=$_POST['hidSearchFilterField'];

if($ExistId=='')
{

$ValidCheck=db_query("Select * FROM ".TABLE_ADMINPRODUCT." WHERE ProductName='".$TxtProductName."' ");
$CountValid=db_num_rows($ValidCheck);
if($CountValid!=0)
{
db_query("DELETE FROM ".TABLE_PRODUCTRELATIVITY."  WHERE  Ses_Id='".session_id()."' ");
echo "<script>var serty=OnclickMenu('2','$ModuleId','Productlist','0','');</script>";
}
else
{
$Product_Query="INSERT INTO ".TABLE_ADMINPRODUCT." SET `ProductCode`='".$TxtProductCode."',`ProductName`='".$TxtProductName."',`Status`='".$ActiveStatus."',`Createdby`='".$_SESSION['Admin_Id']."',`Createdon`=NOW(),`Modifiedby`='".$_SESSION['Admin_Id']."',`Modifiedon`=NOW()";
$ProductType_Insert=db_query($Product_Query); 
$optId=mysql_insert_id();
db_query("UPDATE ".TABLE_PRODUCTRELATIVITY." SET  Product_fk='".$optId."',Ses_Id='' WHERE  Ses_Id='".session_id()."' ");
echo "<script>var serty=OnclickMenu('1','$ModuleId','Productlist','0','$optId');</script>";
}
}
else
{
$ProductType_Query="UPDATE ".TABLE_ADMINPRODUCT." SET `ProductCode`='".$TxtProductCode."',`ProductName`='".$TxtProductName."',`Status`='".$ActiveStatus."',`Modifiedby`='".$_SESSION['Admin_Id']."',`Modifiedon`=NOW() Where Id='".$ExistId."'";
$ProductType_Update=db_query($ProductType_Query); 
$optId=$ExistId; 
db_query("UPDATE ".TABLE_PRODUCTRELATIVITY." SET  Product_fk='".$optId."',Ses_Id='' WHERE  Ses_Id='".session_id()."' ");
echo "<script>var serty=OnclickMenu_Edit('5','$ModuleId','Productlist','$startdata', '$optId', '$SearchFilterFieldList', '$SearchFilterField');</script>";
}
exit;
} 
$_REQUEST['action'] = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');
$_REQUEST['Action'] = (isset($_REQUEST['Action']) ? $_REQUEST['Action'] : '');
if($_REQUEST['action']=='delete' || $_REQUEST['action']=='status' || $_REQUEST['action']=='Page' || $_REQUEST['Action']=='Filter' || $_REQUEST['action']=='verify')
{
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
include("../../../Mailer/class.phpmailer.php");

$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);

if($_REQUEST['action']=='delete')
{
db_query("DELETE FROM ".TABLE_ADMINPRODUCT." where Id=".$_REQUEST['id']."");
db_query("DELETE FROM ".TABLE_PRODUCTRELATIVITY." where Product_fk =".$_REQUEST['id']."");?>
<?php echo "<script>var serty=OnclickMenu('3','".$ModuleId."','Productlist','".$_REQUEST['startdata']."');</script>";
}

if($_REQUEST['action']=='status')
{
db_query("UPDATE ".tbl_advertisement." SET ADV_Status='".$_REQUEST['val']."' where ADV_Id=".$_REQUEST['id']."");
$optId = $_REQUEST['id'];
//email admin approval
if($_REQUEST['val']==1)
{
$Details = db_query("SELECT reg.RGT_Email,reg.RGT_OwnerName,adv.ADV_Name FROM ".TABLE_REGISTRATION." as reg INNER JOIN `tbl_advertisement` as adv ON adv.ADV_Userfk=reg.RGT_PK where RGT_Status=1");

$FetDetails = db_fetch_array($Details);
$ToAddress = $FetDetails['RGT_Email'];
$ToName    = $FetDetails['RGT_OwnerName'];
$AdvertisementName = $FetDetails['ADV_Name'];

$Message     = "<table border='0' cellpadding='0' cellspacing='0'  style='font-size: 12px; line-height: 25px;font-family:Arial, Helvetica, sans-serif; padding-left:5px;'>
<tr><td height='10'></td></tr>
<tr><td style='color:#006DB8;font-size:15px;'>Dear ".$ToName.",</td></tr>
<tr><td ><p>Your Advertisement was approved by the XYget Admin</p><p>Your Advertisement Details are,</p></td></tr>
<tr><td >
<table width='100%' border='0' cellpadding='0' cellspacing='0'  style='font-size: 12px; line-height: 25px;font-family:Arial, Helvetica, sans-serif;padding-left:5px;'>
<tr>
<td width='20%'>Username</td>
<td width='3%'>:</td>
<td width='77%'>".$AdvertisementName."</td>
</tr>
<tr>
</table>
</td></tr>
</table>";
$mailContent = file_get_contents("../../../MailTemplate.php");
$Message = str_replace('MSGCONTENT',$Message, $mailContent);
$Message = str_replace('../../../images/',HTTP_SERVER.'../../../images/', $Message);
$Subject='Confirmation Mail';
$FromName='XYget';
$FromAddress='services@tracemein.com';
PHP_Mailer($Message,$Subject,$ToAddress,$ToName,$FromAddress,$FromName,'','');
}
//email admin approval
}
if($_REQUEST['action']=='verify')
{
db_query("UPDATE ".TABLE_ADMINPRODUCT." SET Verify='".$_REQUEST['val']."' where Id=".$_REQUEST['id']."");

$optId = $_REQUEST['id'];
} 

$all_Sql = "Select DISTINCT a.ADV_Id, a.ADV_Name, a.ADV_Status From ".tbl_advertisement." a ";
$orderBy = ' a.ADV_Id ';
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='ProName')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.ADV_Name like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if(isset($WhereCont) && !empty($WhereCont))
if($WhereCont=='')
$WhereCont = ' where 1';
$Verified='A';		
$gridHead = 'Product List Details';

$colHead  = array("Sl.No.",'', "Advertisement Name",'',"Status");
include_once('../../three_col_grid.php');
// $colHead  = array("Sl.No.", "Product Code", "Product Name", "Status","Verification","Action");
// include_once('../../five_col_grid.php');
} 


if(isset($_REQUEST["Pcatid"])) {  // sub product search

include_once("include/Configuration.php");
include_once("include/DatabaseConnection.php");
db_connect();
?>
<select id="CboSubCatName" name="CboSubCatName" class="dropdown"  <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?> onchange="return OnclickPSubCategory(this.value);"  >
<option value="" selected="selected">--Select Sub Product Category--</option>
<?php 
$SelectSubCategory=db_query("Select ProductSubCat_Pk,ProductSubCat_Name From ".TABLE_PRODUCTSUBCATEGORY." WHERE Status='1' AND ProductCat_Fk='".$_REQUEST["Pcatid"]."'"); 
while($FetchCat=db_fetch_array($SelectSubCategory))
{ ?>
<option  value="<?php echo $FetchCat['ProductSubCat_Pk']; ?>" <?php if($FetchCat['ProductSubCat_Pk']==$Fetch['SubCategory_fk']){ ?> selected <?php }?> ><?php echo $FetchCat['ProductSubCat_Name']; ?></option>
<?php 
}?>
</select>
<?php  exit; } ?>
<?php 
if(isset($_REQUEST["PSubcatid"])) { // product type search
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
?>
<select id="CboPtpeCode" name="CboPtpeCode" class="dropdown"  <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?>>
<option value="" selected="selected">--Select Product Type--</option>
<?php 
$SelectProductType=db_query("Select ProductType_Pk,ProductType_Name From ".TABLE_PRODUCTTYPE." WHERE Status='1' AND ProductCat_Fk='".$_REQUEST["pid"]."' AND ProductSubCat_Fk='".$_REQUEST["PSubcatid"]."'"); 
while($FetchCat=db_fetch_array($SelectProductType))
{ ?>
<option  value="<?php echo $FetchCat['ProductType_Pk']; ?>" <?php if($FetchCat['ProductType_Pk']==$Fetch['ProductType_fk']){ ?> selected <?php }?> ><?php echo $FetchCat['ProductType_Name']; ?></option>
<?php 
}?>
</select>
<?php exit; }
