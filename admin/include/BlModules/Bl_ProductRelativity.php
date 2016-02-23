<?php 
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
$Category=$_REQUEST["Category"];
$SubCategory=$_REQUEST["SubCategory"];
$ProductType=$_REQUEST["ProductType"];
$ExistId=$_REQUEST["ExistId"];
$TxtEditId=$_REQUEST["TxtEditId"];
if($_REQUEST["action"]=="AddProductRelativity") 
{
	$sql_check="SELECT * FROM ".TABLE_PRODUCTRELATIVITY." WHERE Category_fk='".$Category."' AND SubCategory_fk='".$SubCategory."' AND ProductType_fk='".$ProductType."' AND  Product_fk='".$ExistId."'  ";
	$res_check=db_query($sql_check);
	$rec_count=db_num_rows($res_check);
	if($TxtEditId=='')
	{
		if($rec_count>0) {echo "1";exit;}
        else{
		db_query("INSERT INTO ".TABLE_PRODUCTRELATIVITY." SET Category_fk='".$Category."',SubCategory_fk='".$SubCategory."',ProductType_fk='".$ProductType."',Product_fk='".$ExistId."',Ses_Id='".session_id()."'");}
	}
	else
	{
		if($rec_count>0) {echo "1";exit;}
        else{
		db_query("UPDATE ".TABLE_PRODUCTRELATIVITY." SET Category_fk='".$Category."',SubCategory_fk='".$SubCategory."',ProductType_fk='".$ProductType."',Product_fk='".$ExistId."' WHERE Id='".$TxtEditId."'");}
	}

} 

if($_REQUEST["action"]=="EditProductRelativity")
{
	$SelProductRel=db_query("SELECT Id,Category_fk,SubCategory_fk,ProductType_fk FROM ".TABLE_PRODUCTRELATIVITY." WHERE Id='".$_REQUEST["Id"]."'");
	list($Id,$Category_fk,$SubCategory_fk,$ProductType_fk)=db_fetch_array($SelProductRel);
	echo $Id."###".$Category_fk."###";?>
	<select id="CboSubCatName" name="CboSubCatName" class="dropdown"   onchange="return OnclickPSubCategory(this.value);" >
        <option value="" selected="selected">--Select Sub Product Category--</option>
        <?php 
        $SelectSubCategory=db_query("Select ProductSubCat_Pk,ProductSubCat_Name From ".TABLE_PRODUCTSUBCATEGORY." WHERE Status='1' AND ProductCat_Fk='".$Category_fk."'"); 
        while($FetchCat=db_fetch_array($SelectSubCategory))
        { ?>
        <option  value="<?php echo $FetchCat['ProductSubCat_Pk']; ?>" <?php if($FetchCat['ProductSubCat_Pk']==$SubCategory_fk){ ?> selected <?php }?> ><?php echo $FetchCat['ProductSubCat_Name']; ?></option>
        <?php 
        }?>
</select>###
<select id="CboPtpeCode" name="CboPtpeCode" class="dropdown" >
    <option value="" selected="selected">--Select Product Type--</option>
    <?php 
    $SelectProductType=db_query("Select ProductType_Pk,ProductType_Name From ".TABLE_PRODUCTTYPE." WHERE Status='1' AND ProductCat_Fk='".$Category_fk."' AND ProductSubCat_Fk='".$SubCategory_fk."'"); 
    while($FetchCat=db_fetch_array($SelectProductType))
    { ?>
    <option  value="<?php echo $FetchCat['ProductType_Pk']; ?>" <?php if($FetchCat['ProductType_Pk']==$ProductType_fk){ ?> selected <?php }?> ><?php echo $FetchCat['ProductType_Name']; ?></option>
    <?php 
    }?>
</select>
<?php 
}

if($_REQUEST["action"]=="DeleteProductRelativity")
	db_query("DELETE FROM ".TABLE_PRODUCTRELATIVITY." WHERE Id='".$_REQUEST["Id"]."'");

if($ExistId=="") 
{
	$SqlRel="SELECT * FROM ".TABLE_PRODUCTRELATIVITY." WHERE  Product_fk=''";
	$ValidCheckSql ="Select * FROM ".TABLE_PRODUCTRELATIVITY." WHERE  Ses_Id='".session_id()."'";

}
else 
{
	$SqlRel="SELECT * FROM ".TABLE_PRODUCTRELATIVITY." WHERE Product_fk='".$ExistId."'";
    $ValidCheckSql ="Select * FROM ".TABLE_PRODUCTRELATIVITY." WHERE  Product_fk='".$ExistId."'";
}
$SelectRel=db_query($SqlRel);
$ValidCheckRel=db_query($ValidCheckSql);
$CountValidRel=db_num_rows($ValidCheckRel);
?> 
#######<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="left" valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="10" align="left" valign="top"><img src="images/gridbox/grid_l_bg.gif" width="10" height="27" /></td>
					<td align="left" class="gridmenu">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" >
						<tr>
                        <td width="10%" align="center" valign="top">S.No</td>
                        <td width="25%" align="left" valign="top">Category</td>
                        <td width="25%" align="left" valign="top">SubCategory</td>
                        <td width="20%" align="left" valign="top">Product Type</td>
                        <td width="20%" align="left" valign="top">Action</td>
						</tr>
						</table>
					</td>
					<td width="7" align="right" valign="top"><img src="images/gridbox/gird_r-bg.gif" width="7" height="27" /></td>
				</tr>
				</table>
			</td>
		</tr>
		
		<tr>
			<td align="left" valign="top" class="tdmsg">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" ><?php 
				$i=1;
				if(db_num_rows($SelectRel)>0){
				while($row=db_fetch_array($SelectRel)) 
				{ ?>
					<tr><td colspan="3"  height="2"></td></tr>
					<tr>
						<td width="10%"  align="center" class="gridtxt"><?php echo $i;?></td>
						<td width="25%" align="left" class="gridtxt"><?php echo ProductCategory($row["Category_fk"]); ?></td>
                        <td width="25%" align="left" class="gridtxt"><?php echo ProductSubCategory($row["SubCategory_fk"]); ?></td>
						<td width="20%" align="left" class="gridtxt"><?php echo ProductType($row["ProductType_fk"]); ?></td>
						<td width="20%" align="left" class="gridtxt"><span style="cursor:pointer;" onClick="EditProductCom(<?php echo $row["Id"] ?>);">Edit</span>/<span style="cursor:pointer;" onClick="DeleteProductCom(<?php echo $row["Id"] ?>);">Delete</span></td>
					</tr><?php 
					$i=$i+1; 
				} }else {?>
                     <tr>
                      <td align="left" valign="top" class="tdmsg">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                            <tr>
                            <td align="center" class="gridtxt">No Record Found</td>
                            </tr>
                          </table>
                      </td>
                     </tr>
                <?php }?>
				</table>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="6" width="7" align="left"><img src="images/gridbox/grid_l_bt.gif" width="7" height="6" /></td>
					<td height="6" background="images/gridbox/grid_m_bt.gif"></td>
					<td height="6" width="7" align="right"><img src="images/gridbox/grid_r_bt.gif" width="7" height="6" /></td>
				</tr>
				</table>
			</td>
		</tr>
	</table>
	  <input type="hidden" name="RelativityChk" id="RelativityChk" value="<?php echo $CountValidRel;?>" />
