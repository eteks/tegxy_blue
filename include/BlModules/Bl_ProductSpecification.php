<?php include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

$ProductSpecific      = trim($_REQUEST['ProductSpecific']);
$ProductSpecificId    = trim($_REQUEST['ProductSpecificId']);
$ProdSpecDec          = trim($_REQUEST['ProdSpecDec']);
$SpExistId            = trim($_REQUEST['SpExistId']);
$ExistId              = trim($_REQUEST['ExistId']);
$Action               = trim($_REQUEST['action']);
$UId                  = trim($_SESSION['LID']);

if($ExistId=='')
$ExistId = 'Pro1';
else
$ExistId = $ExistId;

if($Action=='1')
{
if($SpExistId=='')
{

//Begin  product specification checking with admin product specification
// product specification check with admin product specification
$Pro_Chk_ADMPro = db_query("SELECT * FROM ".TABLE_PRODUCTSPECIFICATION." WHERE ProdSpecification='".$ProductSpecific."'");	
if(db_num_rows($Pro_Chk_ADMPro)>0)
list($ADMProduct_Id) = db_fetch_array($Pro_Chk_ADMPro);
else
{   
// Admin new specification insertion
$ADMProduct_LastId = db_query("SELECT ProdSpec_Code,ProdSpec_Id FROM ".TABLE_PRODUCTSPECIFICATION." ORDER BY ProdSpec_Id DESC LIMIT 1");
$ADMProduct_LastId_Fet = db_fetch_array($ADMProduct_LastId);
$ADMProd_Code = 'PDS'.($ADMProduct_LastId_Fet['ProdSpec_Id']+1);

db_query("INSERT INTO ".TABLE_PRODUCTSPECIFICATION." SET ProdSpecification='".$ProductSpecific."', ProdSpec_Code='".$ADMProd_Code."',CreatedById='".$UId."',Created_On =NOW(),ProdStatus='0' ,Created_By='user'");
$ADMProduct_Id=db_insert_id(); 
}
//End  product specification checking with admin product specification	

$SelCheck = db_query("Select * from ".TABLE_SPECIFICATION." Where SP_Specification ='".$ADMProduct_Id."' AND SP_UserFk='".$UId."' AND SP_PsFk='".$ExistId."'");
if(db_num_rows($SelCheck)>0)
echo "Already Exist";
else
{
db_query("INSERT INTO ".TABLE_SPECIFICATION." SET SP_UserFk='".$UId."',SP_PsFk='".$ExistId."',SP_Specification='".$ADMProduct_Id."',SP_SpecificDetail='".$ProdSpecDec."',SP_CreatedOn=Now(),SP_ModifiedOn=Now() ");
$InsertId = db_insert_id();
echo 'Added Successfullly';
}
}
else
{
db_query("UPDATE ".TABLE_SPECIFICATION." SET SP_UserFk='".$UId."',SP_PsFk='".$ExistId."',SP_Specification='".$ProductSpecificId."',SP_SpecificDetail='".$ProdSpecDec ."',SP_ModifiedOn=Now() WHERE SP_Id='".$SpExistId."'");
$InsertId = $SpExistId;
echo 'Updated Successfullly';
}


}
if($Action=='2')
{
db_query("DELETE FROM  ".TABLE_SPECIFICATION." WHERE SP_Id='".$SpExistId."'");
echo 'Deleted Successfullly';
}
if($Action=='3')
{
$Sql = db_query("SELECT SP_Id,SP_Specification,SP_SpecificDetail FROM ".TABLE_SPECIFICATION." WHERE SP_Id='".$SpExistId."'");
list($SP_Id,$SP_Specification,$SP_SpecificDetail) = db_fetch_array($Sql);
echo $SP_Specification.'*##*'.ProductSpecification($SP_Specification).'*##*'.$SP_SpecificDetail.'*##*'.$SP_Id.'*##*';
}

$sqltot="SELECT SP_Id,SP_Specification,SP_SpecificDetail FROM ".TABLE_SPECIFICATION." WHERE SP_UserFk='".$UId."' AND SP_PsFk='".$ExistId."' order by  SP_Id desc";
$tot=db_query($sqltot);
$rtot=db_num_rows($tot);
$totalrecord=$rtot;  $pagesize=5;
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
echo '######';	
$SqlRun=db_query($sqltot." limit $startdata,$pagesize");
$Count = db_num_rows($SqlRun);
if($Count>0){?><table border="0" cellspacing="0" cellpadding="0" width="100%" class="manageborder">
<tr height="35">
<td width="5%">S.No.</td>
<td width="35%"></td>
<td width="40%">Description</td>
<td width="20%">Action</td>
</tr>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<?php

$Pid=$i;
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
<?php }?>
