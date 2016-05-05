<?php include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
include("../../../Mailer/class.phpmailer.php");
$_REQUEST['DisplayName'] = (isset($_REQUEST['DisplayName']) ? $_REQUEST['DisplayName'] : '');
$_REQUEST['Product'] = (isset($_REQUEST['Product']) ? $_REQUEST['Product'] : '');
$_REQUEST['IndustryList'] = (isset($_REQUEST['IndustryList']) ? $_REQUEST['IndustryList'] : '');
$_REQUEST['Category'] = (isset($_REQUEST['Category']) ? $_REQUEST['Category'] : '');
$_REQUEST['SubCategory'] = (isset($_REQUEST['SubCategory']) ? $_REQUEST['SubCategory'] : '');
$_REQUEST['Type'] = (isset($_REQUEST['Type']) ? $_REQUEST['Type'] : '');
$_REQUEST['Descr'] = (isset($_REQUEST['Descr']) ? $_REQUEST['Descr'] : '');
$_REQUEST['BusType'] = (isset($_REQUEST['BusType']) ? $_REQUEST['BusType'] : '');
$_REQUEST['Keyword'] = (isset($_REQUEST['Keyword']) ? $_REQUEST['Keyword'] : '');
$_REQUEST['ExistId'] = (isset($_REQUEST['ExistId']) ? $_REQUEST['ExistId'] : '');
$_REQUEST['LID'] = (isset($_REQUEST['LID']) ? $_REQUEST['LID'] : '');
$_REQUEST['action'] = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');
$_REQUEST['Mode'] = (isset($_REQUEST['Mode']) ? $_REQUEST['Mode'] : '');
$_REQUEST['PdfPath'] = (isset($_REQUEST['PdfPath']) ? $_REQUEST['PdfPath'] : '');
$_REQUEST['CoverImgPath'] = (isset($_REQUEST['CoverImgPath']) ? $_REQUEST['CoverImgPath'] : '');
$_REQUEST['Name'] = (isset($_REQUEST['Name']) ? $_REQUEST['Name'] : '');
$_REQUEST['Price'] = (isset($_REQUEST['Price']) ? $_REQUEST['Price'] : '');
$_REQUEST['Currency'] = (isset($_REQUEST['Currency']) ? $_REQUEST['Currency'] : '');
$_REQUEST['Unit'] = (isset($_REQUEST['Unit']) ? $_REQUEST['Unit'] : '');
$_REQUEST['UserType'] = (isset($_REQUEST['UserType']) ? $_REQUEST['UserType'] : '');


$DisplayName      = trim($_REQUEST['DisplayName']);
$Product          = trim($_REQUEST['Product']);
$IndustryList     = trim($_REQUEST['IndustryList']);
$Category         = trim($_REQUEST['Category']);
$SubCategory      = trim($_REQUEST['SubCategory']);
$Type             = trim($_REQUEST['Type']);
$Descr            = trim(addslashes($_REQUEST['Descr']));
$BusType          = trim($_REQUEST['BusType']);
$Keyword          = trim($_REQUEST['Keyword']);
$ExistId          = trim($_REQUEST['ExistId']);
$UId              = trim($_SESSION['LID']);
$Action           = trim($_REQUEST['action']);
$Mode             = trim($_REQUEST['Mode']);
$PdfPath          = trim($_REQUEST['PdfPath']);
$CoverImgPath     = trim($_REQUEST['CoverImgPath']);
$Name             = trim($_REQUEST['Name']);
$Price            = trim($_REQUEST['Price']);
$Currency         = trim($_REQUEST['Currency']);
$Unit             = trim($_REQUEST['Unit']);
$UserType         = trim($_REQUEST['UserType']);

$PdfPath2          = filesize('../../'.$PdfPath);
$CoverImgPath2     = filesize('../../'.$CoverImgPath);

if($Action=='1')
{
	if($ExistId=='')
	{
		
	/*//Begin  product checking with admin product
	// product check with admin product
	$Pro_Chk_ADMPro = db_query("SELECT * FROM ".TABLE_ADMINPRODUCT." WHERE ProductName='".$Name."'");	
	if(db_num_rows($Pro_Chk_ADMPro)>0)
	{
	list($ADMProduct_Id) = db_fetch_array($Pro_Chk_ADMPro);
	//admin product check with admin product relativity		
	$ADMPro_Chk_ADMProRelativity = db_query("SELECT * FROM ".TABLE_PRODUCTRELATIVITY." WHERE  Category_fk='".$Category."' AND `SubCategory_fk`='".$SubCategory."' AND `ProductType_fk`='".$Type."' AND Product_fk='".$ADMProduct_Id."'");
	if(db_num_rows($ADMPro_Chk_ADMProRelativity)==0) 
	// Admin product relativity	insertion
	db_query("INSERT INTO ".TABLE_PRODUCTRELATIVITY." SET `Category_fk`='".$Category."',`SubCategory_fk`='".$SubCategory."',`ProductType_fk`='".$Type."', Product_fk='".$ADMProduct_Id."',`Createdby`='".$UId."',`Createdon`=NOW(),UserOrAdmin='user'");
	}
	else
	{   
	// Admin new product insertion
	$ADMProduct_LastId = db_query("SELECT ProductCode,Id FROM ".TABLE_ADMINPRODUCT." ORDER BY Id DESC LIMIT 1");
	$ADMProduct_LastId_Fet = db_fetch_array($ADMProduct_LastId);
	$ADMProd_Code = 'PRO'.($ADMProduct_LastId_Fet['Id']+1);

	db_query("INSERT INTO ".TABLE_ADMINPRODUCT." SET `ProductCode`='".$ADMProd_Code."',`ProductName`='".$Name."',`Status`='1',`Verify`='0',`Createdby`='".$UId."',`Createdon`=NOW(),UserOrAdmin='user'");
	$ADMProduct_Id=db_insert_id(); 

	db_query("INSERT INTO ".TABLE_PRODUCTRELATIVITY." SET `Category_fk`='".$Category."',`SubCategory_fk`='".$SubCategory."',`ProductType_fk`='".$Type."', Product_fk='".$ADMProduct_Id."',`Createdby`='".$UId."',`Createdon`=NOW(),UserOrAdmin='user'");	
	}
	//End Nm product checking with admin product	*/


		$checkexist      = db_query("SELECT Kd_Id FROM ".TABLE_KEYWORDMST." WHERE Kd_Keyword='".$Name."'");	
		$fetchcheckexist = db_fetch_array($checkexist);
		if(db_num_rows($checkexist)>0)
		$keyid = $fetchcheckexist['Kd_Id'];
		else
		{
		db_query("INSERT INTO ".TABLE_KEYWORDMST." SET Kd_IndustryFk='".$IndustryList."', Kd_Keyword='".$Name."', Kd_CreatedOn=Now(), Kd_ModifiedOn=Now()");
		$keyid = db_insert_id();
		}
		
		db_query("INSERT INTO ".TABLE_PRODUCTSERVICE." SET PS_User_Fk='".$UId."',PS_Mode='".$Mode."',PS_Fk='".$keyid."',PS_IndustryFk='".$IndustryList."',PS_CategoryFk='".$Category."',PS_SubCategoryFk='".$SubCategory."',PS_TypeFk='".$Type."',PS_Display='".$DisplayName."',PS_Description='".$Descr."',PS_BusinessType='".$BusType."',PS_Keyword='".$Keyword."',PS_Brochure='".$PdfPath."',PS_CoverImg='".$CoverImgPath."',PS_Price='".$Price."',PS_Currency='".$Currency."',PS_Unit='".$Unit."',PS_CreatedOn=Now(),PS_ModifiedOn=Now() ");
		$InsertId = db_insert_id();		

		if($PdfPath!='')
		db_query("INSERT INTO ".TABLE_STOREFILESIZE." SET SFS_UserFk='".$UId."',SFS_Fk='".$InsertId."',SFS_Mode='5',SFS_FileSize='".$PdfPath2."',SFS_CreatedOn=NOw(),SFS_ModifiedOn=NOw() ");

		if($CoverImgPath!='')
		db_query("INSERT INTO ".TABLE_STOREFILESIZE." SET SFS_UserFk='".$UId."',SFS_Fk='".$InsertId."',SFS_Mode='6',SFS_FileSize='".$CoverImgPath2."',SFS_CreatedOn=NOw(),SFS_ModifiedOn=NOw() ");
		
		//email admin approval
		if($InsertId){
		$Details = db_query("SELECT reg.RGT_Email,reg.RGT_OwnerName,reg.RGT_Mobile,pro.PS_Display FROM ".TABLE_REGISTRATION." as reg INNER JOIN `tbl_productservice` as pro ON pro.PS_User_Fk=reg.RGT_PK where pro.PS_Display='".$DisplayName."' AND reg.RGT_Status=1 ");
		// echo "string","SELECT reg.RGT_Email,reg.RGT_OwnerName,reg.RGT_Mobile,pro.PS_Display FROM ".TABLE_REGISTRATION." as reg INNER JOIN `tbl_productservice` as pro ON pro.PS_User_Fk=reg.RGT_PK where pro.PS_Display='".$DisplayName."' AND reg.RGT_Status=1 ";
		$FetDetails = db_fetch_array($Details);
		$ToAddress = $FetDetails['RGT_Email'];
		$ToName    = $FetDetails['RGT_OwnerName'];
		$ProductName = $FetDetails['PS_Display'];
		// echo 'ProductName',$ProductName;
		$number = $FetDetails['RGT_Mobile'];
		// echo "number--->",$number;		 
		$Message     = "<table border='0' cellpadding='0' cellspacing='0'  style='font-size: 12px; line-height: 25px;font-family:Arial, Helvetica, sans-serif; padding-left:5px;'>
		<tr><td height='10'></td></tr>
		<tr><td style='color:#006DB8;font-size:15px;'>Dear ".$ToName.",</td></tr>
		<tr><td ><p>Your Product was Successfullly posted</p><p>Your Product Details are,</p></td></tr>
		<tr><td >
		<table width='100%' border='0' cellpadding='0' cellspacing='0'  style='font-size: 12px; line-height: 25px;font-family:Arial, Helvetica, sans-serif;padding-left:5px;'>
		<tr>
		<td width='20%'>Username</td>
		<td width='3%'>:</td>
		<td width='77%'>".$ProductName ."</td>
		</tr>
		<tr>
		</table>
		</td></tr>
		</table>";
		$mailContent = file_get_contents("../../MailTemplate.php");
		// echo "mailContent",$mailContent;
		$Message = str_replace('MSGCONTENT',$Message, $mailContent);
		$Message = str_replace('../../../images/',HTTP_SERVER.'../../../images/', $Message);
		$Subject='Confirmation Mail after Product Posted';
		$FromName='XYget';
		$FromAddress='services@tracemein.com';
		// echo "from-->",$FromAddress;
		// echo "to---->",$ToAddress;
		// $sent = PHP_Mailer($Message,$Subject,$ToAddress,$ToName,$FromAddress,$FromName,'','');
		$sent = mail($Message,$Subject,$ToAddress,$ToName,$FromAddress,$FromName,'','');	
		
		// echo "sent--->",$sent;
		if($sent)	   
		{
			echo "sucess";
		}
		else{
			echo "fail";
		}				
         echo 'Added Successfullly';
         //email admin approval	
 	}   
	}
	else
	{
		$checkexist      = db_query("SELECT Kd_Id FROM ".TABLE_KEYWORDMST." WHERE Kd_Keyword='".$Name."'");	
		$fetchcheckexist = db_fetch_array($checkexist);
		if(db_num_rows($checkexist)>0)
		$keyid = $fetchcheckexist['Kd_Id'];
		else
		{
		db_query("INSERT INTO ".TABLE_KEYWORDMST." SET Kd_IndustryFk='".$IndustryList."', Kd_Keyword='".$Name."', Kd_CreatedOn=Now(), Kd_ModifiedOn=Now()");
		$keyid = db_insert_id();
		}	
		db_query("UPDATE ".TABLE_PRODUCTSERVICE." SET PS_Mode='".$Mode."',PS_Fk='".$keyid."',PS_IndustryFk='".$IndustryList."', PS_CategoryFk='".$Category."',PS_SubCategoryFk='".$SubCategory."',PS_TypeFk='".$Type."',PS_Display='".$DisplayName."',PS_Description='".$Descr."',PS_BusinessType='".$BusType."',PS_Keyword='".$Keyword."',PS_Brochure='".$PdfPath."',PS_CoverImg='".$CoverImgPath."',PS_ModifiedOn=Now(),PS_Price='".$Price."',PS_Currency='".$Currency."',PS_Unit='".$Unit."' WHERE PS_Id='".$ExistId."'");
		$InsertId = $ExistId;

		if($PdfPath!='')
		{

		$sqlCheck = db_query("SELECT * FROM ".TABLE_STOREFILESIZE." WHERE SFS_UserFk='".$UId."' AND  SFS_Mode='5' AND SFS_Fk='".$InsertId."' ");

		if(db_num_rows($sqlCheck)>0)
		db_query("UPDATE ".TABLE_STOREFILESIZE." SET SFS_FileSize='".$PdfPath2."' WHERE  SFS_UserFk='".$UId."' AND  SFS_Mode='5' AND SFS_Fk='".$InsertId."' ");
		else
		db_query("INSERT INTO ".TABLE_STOREFILESIZE." SET SFS_UserFk='".$UId."',SFS_Fk='".$InsertId."',SFS_Mode='5',SFS_FileSize='".$PdfPath2."',SFS_CreatedOn=NOw(),SFS_ModifiedOn=NOw() ");

		}

		if($CoverImgPath!='')
		{
		$sqlCheckk = db_query("SELECT * FROM ".TABLE_STOREFILESIZE." WHERE  SFS_UserFk='".$UId."' AND  SFS_Mode='6' AND SFS_Fk='".$InsertId."'");	

		if(db_num_rows($sqlCheckk)>0)
		db_query("UPDATE ".TABLE_STOREFILESIZE." SET SFS_FileSize='".$CoverImgPath2."' WHERE  SFS_UserFk='".$UId."' AND  SFS_Mode='6' AND SFS_Fk='".$InsertId."' ");
		else
		db_query("INSERT INTO ".TABLE_STOREFILESIZE." SET SFS_UserFk='".$UId."',SFS_Fk='".$InsertId."',SFS_Mode='6',SFS_FileSize='".$CoverImgPath2."',SFS_CreatedOn=NOw(),SFS_ModifiedOn=NOw() ");

		}
		echo 'Updated Successfullly';
	}

	db_query("UPDATE ".TABLE_PRODUCTSERVICEGALLERY." SET PSG_PSFk='".$InsertId."' Where PSG_UserFk ='".$UId."' AND PSG_PSFk ='Pro1'");

	db_query("UPDATE ".TABLE_STOREFILESIZE." SET SFS_Fk='".$InsertId."' WHERE  SFS_UserFk='".$UId."' AND  SFS_Mode='7' AND SFS_Fk='Pro1' ");

	db_query("UPDATE ".TABLE_SPECIFICATION." SET SP_PsFk='".$InsertId."' Where SP_UserFk ='".$UId."' AND SP_PsFk ='Pro1'");
	db_query("UPDATE ".TABLE_LOCATION." SET LN_PSFk='".$InsertId."' Where LN_UserFk ='".$UId."' AND LN_PSFk ='Pro1'");
}
if($Action=='2')
{
	
	$ImgPath=db_query("Select PS_Brochure,PS_CoverImg FROM ".TABLE_PRODUCTSERVICE." WHERE PS_Id='".$ExistId."'") or die(db_error());
	$FetImgPath = db_fetch_array($ImgPath);
	@unlink("../../".$FetImgPath['PS_Brochure']);	
	@unlink("../../".$FetImgPath['PS_CoverImg']);	

	$InImgPath=db_query("Select PSG_ImgPath FROM ".TABLE_PRODUCTSERVICEGALLERY." where PSG_UserFk='".$UId."' and PSG_PSFk='".$ExistId."'") or die(db_error());
	while($InFetImgPath = db_fetch_array($InImgPath))
	{
	@unlink("../../".$InFetImgPath['PSG_ImgPath']);	
	}

	db_query("DELETE FROM  ".TABLE_PRODUCTSERVICE." WHERE PS_Id='".$ExistId."'");
	db_query("DELETE FROM ".TABLE_PRODUCTSERVICEGALLERY." WHERE PSG_UserFk='".$UId."' AND PSG_PSFk ='".$ExistId."'");
	db_query("DELETE FROM ".TABLE_SPECIFICATION." WHERE SP_UserFk='".$UId."' AND SP_PsFk ='".$ExistId."'");
	db_query("DELETE FROM ".TABLE_LOCATION." WHERE LN_UserFk='".$UId."' AND LN_PSFk ='".$ExistId."'");
	db_query("DELETE FROM  ".TABLE_STOREFILESIZE." WHERE SFS_UserFk='".$UId."' AND	SFS_Fk='".$ExistId."' AND (SFS_Mode=5 || SFS_Mode=6 || SFS_Mode=7)");


	echo 'Deleted Successfullly';
}
if($Action=='3')
{
	
$Sql = db_query("SELECT PS_Id,PS_Display,PS_Fk,PS_CategoryFk,PS_SubCategoryFk,PS_TypeFk,PS_Description,PS_BusinessType,PS_Keyword,PS_Brochure,PS_CoverImg,PS_Mode,PS_Price,PS_Currency,PS_Unit,PS_IndustryFk FROM ".TABLE_PRODUCTSERVICE." WHERE PS_Id='".$ExistId."'");
list($PS_Id,$PS_Display,$PS_Fk ,$PS_CategoryFk,$PS_SubCategoryFk,$PS_TypeFk,$PS_Description,$PS_BusinessType,$PS_Keyword,$PS_Brochure,$PS_CoverImg,$PS_Mode,$PS_Price,$PS_Currency,$PS_Unit,$PS_IndustryFk) = db_fetch_array($Sql);
if($PS_Brochure!='')
$Pdff ='<a href='.$PS_Brochure.' target="_blank"><img width="30" height="30" src="images/pdf.png"></a>&nbsp;&nbsp;<span style="color: #00677D;cursor: pointer;font-size: 11px;font-weight: bold;" onclick="DeleteFromFolderDB('.$PS_Id.',\'ProdPdfPathDisp\',\'ProdPdfPath\',5);" >Delete</span>&nbsp;&nbsp;';
if($PS_CoverImg!='')
$Covimg = '<img width="30" height="30" src='.$PS_CoverImg.'>&nbsp;&nbsp;<span style="color: #00677D;cursor: pointer;font-size: 11px;font-weight: bold;" onclick="DeleteFromFolderDB('.$PS_Id.',\'ProdCoverImgDisp\',\'ProdCoverImgPath\',6);" >Delete</span>&nbsp;&nbsp;';
$Pdff=(isset($Pdff) && !empty($Pdff) ? trim($Pdff) : '');
$Covimg=(isset($Covimg) && !empty($Covimg) ? trim($Covimg) : '');
echo $PS_Display.'*##*'.$PS_Fk.'*##*'.ProductName($PS_Fk).'*##*'.$PS_CategoryFk.StringLeftArrow($PS_SubCategoryFk,' >> ',4).StringLeftArrow($PS_TypeFk,' >> ',4).'*##*'.ProductCategory($PS_CategoryFk).StringLeftArrow(ProductSubCategory($PS_SubCategoryFk),' >> ',4).StringLeftArrow(ProductType($PS_TypeFk),' >> ',4).'*##*'.stripslashes($PS_Description).'*##*'.$PS_BusinessType.'*##*'.$PS_Keyword.'*##*'.$PS_Id.'*##*'.$PS_Brochure.'*##*'.$Pdff.'*##*'.$PS_CoverImg.'*##*'.$Covimg.'*##*';
//Begin  Product Inner Images

$sql = "Select PSG_Id,PSG_ImgPath,PSG_PSFk FROM ".TABLE_PRODUCTSERVICEGALLERY." WHERE PSG_UserFk='".$UId."' AND PSG_PSFk='".$ExistId."'";

$SelectSlot=db_query($sql);
$NumSlot=db_num_rows($SelectSlot);
while($FetchSlot=db_fetch_array($SelectSlot))
{?>
<a href="javascript:void(0)" onClick="deleteGallery('<?php echo $FetchSlot['PSG_Id']; ?>','<?php echo $FetchSlot['PSG_PSFk']; ?>','PGalleryList');"><img src="<?php echo $FetchSlot['PSG_ImgPath']; ?>" height="30" width="30" style="margin:5px;" /></a><?php 
} 
if($NumSlot>0)
echo '<em><span class="alertmsg">Click on the image to delete</span></em>'; 
echo '*##*';
//End Nm Product Inner Images;
$sqltot="SELECT SP_Id,SP_Specification,SP_SpecificDetail FROM ".TABLE_SPECIFICATION." WHERE SP_UserFk='".$UId."' AND SP_PsFk='".$ExistId."' order by  SP_Id desc";
$tot=db_query($sqltot);
$rtot=db_num_rows($tot);
$totalrecord=$rtot;  $pagesize=5;
$noofpages=$totalrecord/$pagesize;
$startdata=0;
$SqlRun=db_query($sqltot." limit $startdata,$pagesize");
$Count = db_num_rows($SqlRun);
if($Count>0){?>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="manageborder">
<tr height="35">
<td width="5%">S.No.</td>
<td width="35%">Specification</td>
<td width="40%">Description</td>
<td width="20%">Action</td>
</tr>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<?php
$Pid=1;
while(list($SP_Id,$SP_Specification,$SP_SpecificDetail) = db_fetch_array($SqlRun)){
?>
<tr class="gridcenbgcolor"  height="25" <?php if($SP_Id == $SpExistId || $SP_Id == $InsertId) {?> style="font-weight:bold;" <?php }?>>
<td width="5%"><?php  echo $Pid;?></td>
<td width="35%"><?php echo ProductSpecification($SP_Specification);?></td>
<td width="40%"><?php if(strlen(stripslashes($SP_SpecificDetail))>25){ echo substr(stripslashes($SP_SpecificDetail),0,50).'...' ;} else { echo stripslashes($SP_SpecificDetail);} ?></td>
<td width="20%" class="handsym"><?php /*?><img width="16" border="0" height="16" onclick="SpProductEdit(<?php echo $SP_Id;?>);" src="images/b_edit.png" title="Edit">&nbsp;<?php */?><img width="16" border="0" height="16" src="images/b_drop.png" onclick="SpProductDelete(<?php echo $SP_Id;?>,<?php echo $Count;?>,<?php echo $startdata;?>);" title="Delete"></td>
</tr>
<?php  $Pid++;}?>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<tr  height="25"><td colspan="5"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'PageSpProduct'); ?></td></tr>
</table>
<?php } echo '*##*'.$PS_Mode.'*##*'; 

$sqltot="SELECT LN_Id,LN_PSFk,LN_Country,LN_State,LN_City,LN_Area,LN_Pincode FROM ".TABLE_LOCATION." WHERE  LN_UserFk='".$UId."' AND LN_PSFk='".$ExistId."' order by  LN_Id desc";
$tot=db_query($sqltot);
$rtot=db_num_rows($tot);
$totalrecord=$rtot;  $pagesize=5;
$noofpages=$totalrecord/$pagesize;
$startdata=0;
$SqlRun=db_query($sqltot." limit $startdata,$pagesize");
$Count = db_num_rows($SqlRun);
if($Count>0){?>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="manageborder">
<tr height="35">
<td width="5%">S.No.</td>
<td width="20%">Country</td>
<td width="20%">State</td>
<td width="20%">City</td>
<td width="25%">Area</td>
<td width="10%">Action</td>
</tr>
<tr><td colspan="6" class="gridlinebgcolor"></td></tr>
<?php
$Pid=1;
while(list($LN_Id,$LN_PSFk,$LN_Country,$LN_State,$LN_City,$LN_Area,$LN_Pincode) = db_fetch_array($SqlRun)){
?>
<tr class="gridcenbgcolor"  height="40" <?php if($LN_Id == $ExistId || $LN_Id == $InsertId) {?> style="font-weight:bold;" <?php }?>>
<td width="5%"><?php  echo $Pid;?></td>
<td width="20%"><?php  echo CountryName($LN_Country);?></td>
<td width="20%"><?php  echo StateName($LN_State);?></td>
<td width="20%"><?php  echo CityName($LN_City);?></td>
<td width="25%"><?php  echo AreaName($LN_Area).StringLeftArrow(PincodeName($LN_Pincode),' - ',3);?></td>
<td width="10%" class="handsym"><img width="16" border="0" height="16" onclick="ProLocationEdit(<?php echo $LN_Id;?>);" src="images/b_edit.png" title="Edit">&nbsp;<img width="16" border="0" height="16" src="images/b_drop.png" onclick="ProLocationDelete(<?php echo $LN_Id;?>,<?php echo $Count;?>,<?php echo $startdata;?>);" title="Delete"></td>
</tr>
<?php  $Pid++;}?>
<tr><td colspan="6" class="gridlinebgcolor"></td></tr>
<tr height="25"><td colspan="6"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'PageProLocation'); ?></td></tr>
</table>
<?php  }
echo '*##*'.$PS_Price.'*##*.'.$PS_Currency.'*##*'.$PS_Unit.'*##*'.$PS_IndustryFk.'*##*';}

 $sqltot="SELECT PS_Id,PS_Display,PS_Fk,PS_CategoryFk,CASE WHEN PS_Mode =1 Then 'Provider' else 'Seeker' END PS_Mode ,PS_IndustryFk FROM ".TABLE_PRODUCTSERVICE." WHERE PS_User_Fk='".$UId."' order by  PS_Id desc";
$tot=db_query($sqltot);
$rtot=db_num_rows($tot);
$totalrecord=$rtot;  $pagesize=10;
$noofpages=$totalrecord/$pagesize;

if (!isset($_REQUEST['startdata']) || trim($_REQUEST['startdata'])=='' || trim($_REQUEST['startdata'])=='0')
$startdata=0;
else
$startdata=$_REQUEST['startdata'];

if(isset($_REQUEST['Count']) && $_REQUEST['Count']==1 && $startdata > 0){
	$startdata = $_REQUEST['startdata']-$pagesize;
	$i=$_REQUEST["startdata"]-($pagesize-1); 
}
else if(isset($_REQUEST['Count']) && $_REQUEST['Count']==1 && $startdata==0){
	$startdata = $_REQUEST['startdata'];
	$i=1;
}

else if($_REQUEST["startdata"]=="0")
	$i=1;	
elseif($_REQUEST["startdata"]!="0")
	$i=$_REQUEST["startdata"]+1; 
else
	$i=1; 	
	
$SqlRun=db_query($sqltot." limit $startdata,$pagesize");
$Count = db_num_rows($SqlRun);?>
######<table border="0" cellspacing="0" cellpadding="0" width="100%" class="manageborder">
<tr height="35">
<td width="5%">S.No.</td>
<td width="25%">Display Name</td>
<td width="30%">Industry</td>
<td width="30%">Type</td>
<td width="10%">Action</td>
</tr>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<?php
if($Count>0){
$Pid=$i;
while(list($PS_Id,$PS_Display,$PS_Fk ,$PS_CategoryFk,$PS_Mode,$PS_IndustryFk) = db_fetch_array($SqlRun)){
?>
<tr class="gridcenbgcolor"  height="25" <?php if($PS_Id == $ExistId || $PS_Id == $InsertId) {?> style="font-weight:bold;" <?php }?>>
<td width="5%"><?php  echo $Pid;?></td>
<td width="25%"><?php if(strlen(stripslashes($PS_Display))>25){ echo substr(stripslashes($PS_Display),0,25).'...' ;} else { echo stripslashes($PS_Display);} ?></td>
<td width="30%"><?php echo getSectordetails($PS_IndustryFk);?></td>
<td width="30%"><?php echo $PS_Mode;?></td>
<td width="10%" class="handsym"><img width="16" border="0" height="16"  onclick="ProductEdit(<?php echo $PS_Id;?>);" src="images/b_edit.png" title="Edit">&nbsp;<img width="16" border="0" height="16" src="images/b_drop.png" onclick="ProductDelete(<?php echo $PS_Id;?>,<?php echo $Count;?>,<?php echo $startdata;?>);"  title="Delete"></td>
</tr>
<?php  $Pid++;}?>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<tr class="gridbgcolor"  height="25"><td colspan="5"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'PageProduct'); ?></td></tr>
<?php } else {?>
<tr class="gridcenbgcolor" height="25"><td colspan="5" class="text-align-c">No Record Found</td></tr>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<tr class="gridbgcolor"   height="25"><td colspan="5"></td></tr>
<?php }?>
</table>######<?php echo UserFileSize($UId) ;?>
