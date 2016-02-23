<script language="javascript" type="text/javascript">
$(function()
{
    
	var btnUpload=$('#PGalleryUpload');
	var status=$('#PGalleryStatus');
	new AjaxUpload(btnUpload, {
	action: 'MultiProUploader.php',
	name: 'uploadfile',
	// Extension Validation
	
	onSubmit: function(file, ext)
	{
		
	 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
	alert('Please upload a valid image file');
	return false;
	}
	var TempFileSize = $('#AppendFileCt').val();
	var FileSize = $('#FileSize').val();
	var Check = parseInt(TempFileSize) + parseInt(FileSize);
	if(parseInt($('#FileSizeLimit').val()) < parseInt(Check))
	{
	alert('Can not upload');
	return false;
	}
	
	// Begin File Count Limit
	var proid = $("#ProExistId").val();
	var aurl="GalleryDisp.php?count=filecount&proid="+proid;
	var result=$.ajax({
			type:"GET",
			data:"stuff=1",
			url:aurl,
			async:false
		}).responseText;
	if(result>2)
	{
	alert('Maximum can upload only three images');
	return false;
	}
	//End File Count Limit
	
	this.setData({
        'proid1': $("#ProExistId").val()
    });
	status.text('Uploading...');
	},
	onComplete: function(file, response)
	{
		status.text('');
		var bb=response.substr(0,7)
		var idd=response.replace('success',' ');
		var idb =idd.replace(/^\s*|\s*$/g,'');
		var idFile = idb.split("###");
		if(bb=="success")
		{
		    var proid = $("#ProExistId").val();
			$("#PGalleryList").load("GalleryDisp.php?proid="+proid);
			$("#FileSize").val(idFile[2]);
			status.text('Uploaded Successfully.');
		}
		else 
		{
			status.text(response);
		}
	}});
});


function deleteGallery(id,proid,idd)
{
	var status=$('#'+idd);
	n=confirm("Do you want to delete?");
	if(n==true)
	{
		var aurl="GalleryDelete.php?imageid="+id+"&proid="+proid;
		var result=$.ajax({
			type:"GET",
			data:"stuff=1",
			url:aurl,
			async:false
		}).responseText;
		if(result!="")
		{
			status.text('Deleted Successfully.');
			$('#'+idd).load("GalleryDisp.php?proid="+proid);
		}
	}
}
</script>
<div class="heading" style="text-align:center">Best Deals</div>
<div id="personal" style="margin-left:50px; padding-bottom:30px;width:680px;">
<div id="ProductEntryLevel"  style="display:block;">
<div class="pagination handsym" onclick="GridShowHide('ProductEntryLevel','ProductEntryGrid','Grid','');" style="line-height: 49px;"><img width="30" height="30" src="images/Back-icon.png" title="Back"></div><div style="clear:both"></div>
<fieldset id="Fields">
<legend>Best Deals</legend> 
<input type="hidden" id="ProdStateData" value="0"  />
<input type="hidden" id="ProExistId" />
<input type="hidden" id="Prodt_Id"  />
<input type="hidden" id="ProCategoryListId"  />
<input type="hidden" id="ProClear"  />
<input type="hidden" id="ProSpecfStartData" value="0" />
<input type="hidden" id="SpProdStateData" value="0" />
<input type="hidden" id="ProductSpecificId" />
<input type="hidden" id="SpProExistId" />
<input type="hidden" id="LoctExistId" />
<input type="hidden" id="ProLocStateData" />
<input type="hidden" id="AppendFileCt" />
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td colspan="3" align="center">
<table border="0" cellspacing="0" cellpadding="0">  
  <tr>
    <td>Provider</td>
    <td>&nbsp;</td>
    <td><input type="radio" id="ProodType1" name="ProodType" value="1" /></td>
    <td>&nbsp;</td>
    <td>Seeker</td>
    <td>&nbsp;</td>
    <td><input type="radio" id="ProodType2" name="ProodType"  value="2" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
</td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td>Display Name</td>
<td> :&nbsp;</td>
<td><input type="text" name="ProDisplayName" id="ProDisplayName"  autocomplete="off" class="inp-text" /></td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr> 
<td>Product / Service Name</td>
<td> :&nbsp;</td>
<td><input type="text" id="ProductName" name="ProductName"  autocomplete="off" class="inp-text" /><div id="ProductResponse"></div> 
<script type="text/javascript"> 
var AjaxResponsee = 'ProductResponse';
var DataGett     ='ProductName';
var ClearData    ='ProClear';
var File         ='Bl_ADMProductList.php';
var CAjaxResponsee = 'ProCategoryResponse';
var DataShow1     ='ProCategoryList';
var DataShow2    ='ProCategoryListId';
var DataShow3     ='Prodt_Id';
</script>  
<script type="text/javascript" src="js/CategoryFilter.js">
</script> 
</td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td>Industry</td>
<td> :&nbsp;</td>
<td><input type="text" id="ProCategoryList" name="ProCategoryList" style="width: 496px;" autocomplete="off" class="inp-text" placeholder="Please Select Industry" readonly="readonly"  /><a class="ui-dropdown-trigger" id="ProCatList"></a><div id="ProCategoryResponse"></div>
<script type="text/javascript">
var CDataChk     ='ProductName';
var CDataGett     ='ProCatList';
var CFile         ='Bl_ProductCatList.php';
</script>
<script type="text/javascript" src="js/CategoryList.js">
</script>
</td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td>Description</td>
<td> :&nbsp;</td>
<td><textarea name="ProDescr" id="ProDescr"  autocomplete="off" class="inp-text"></textarea></td>
</tr>
<tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td>Business Type</td>
<td> :&nbsp;</td>
<td>
<select id="ProBusType" name="ProBusType" class="mselect">
<option value="">--Select Business Type--</option>   
<option value="Manufacturer">Manufacturer</option>
<option value="Trading Company">Trading Company</option>
<option value="Distributor / Wholesaler">Distributor / Wholesaler</option>
<option value="Retailer">Retailer</option>
<option value="Consultant">Consultant</option>
<option value="Agent">Agent</option>
<option value="Government Agency / Organization">Government Agency / Organization</option>
<option value="Others">Others</option>
</select>
</td>
</tr>
<tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td>Keyword</td>
<td> :&nbsp;</td>
<td><input type="text" name="ProKeyword" id="ProKeyword"  autocomplete="off" class="inp-text" /></td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td colspan="3"><table cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td>Quantity</td>
    <td>:&nbsp;</td>
    <td><input type="text" id="Unit" name="Unit" onkeyup="Numbercharacteronly(this);" autocomplete="off" class="inp-text" style="width:55px;" /></td>
    <td>&nbsp;</td>
    <td>Price</td>
    <td>:&nbsp;</td>
    <td><input type="text" id="Price" name="Price" onkeyup="Numberdot(this);" autocomplete="off" class="inp-text" style="width:55px;" /></td>
    <td>&nbsp;</td>
    <td><select type="text" id="Currency" name="Currency" class="mselect" style="width:55px;">
<?php $SelectCurrrency=db_query("Select Id,Symbol From ".TABLE_ADVCURRENCY." WHERE Status=1 order by  CurrencyName asc");
while(list($CyId,$CyName)=db_fetch_array($SelectCurrrency))
{?>
<option  value="<?php echo $CyId; ?>"  ><?php echo $CyName; ?></option><?php 
}?></select></td>

  </tr>
</table>
</td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td colspan="3" height="10" class="specific">
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="profilee">
<tr><td colspan="3" height="10" style="font-weight:bold">Want to add more details</td></tr>
<tr><td colspan="3" height="30"></td></tr>

<tr>
<td height="24"   colspan="3">
<div id="ProdSpecf_new" >
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td height="24"  >
<input  type="text" name="ProductSpecific" id="ProductSpecific"  onfocus="return ClearSpecificData('ProductSpecific','Enter here')" onclick="return ClearSpecificData('ProductSpecific','Enter here')" onblur="ShowClearSpecificData('ProductSpecific','Enter here');" value="Enter here" class="specific"  /><div id="ProSpecificResponse"></div>&nbsp;</td>

<script type="text/javascript">
var SpAjaxResponsee = 'ProSpecificResponse';
var SpDataGett     ='ProductSpecific';
var SpFile         ='Bl_SpProductList.php';
var SpDataShow1     ='ProductSpecificId';
</script>
<script type="text/javascript" src="js/Filter.js">
</script>

<td height="24" ><input  type="text" name="ProdSpecDec" id="ProdSpecDec" onfocus="return ClearSpecificData('ProdSpecDec','Enter details here')" onclick="return ClearSpecificData('ProdSpecDec','Enter details here')" onblur="ShowClearSpecificData('ProdSpecDec','Enter details here');" value="Enter details here"   class="specific" /></td>
</tr>
</table>
</div>                      
</td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr align="center">
<td height="24"   colspan="3">
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td height="24"  ><input type="button" name="SpProductSmt" Id="SpProductSmt" class="btn_b" value="Add Specification"  onclick="AddSpProduct();"/></td>
<td>&nbsp;</td>
<td height="24" ><input type="button"  class="btn_b" value="Reset" onclick="SpProductReset();" /></td>
</tr>
</table>
</td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td colspan="3" bgcolor="#CCCCCC" >
<div id="ProdtSpecification" class="gridpad">
</div></td><tr>
</table></td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td>Brochure</td>
<td> :&nbsp;</td>
<td><input type="hidden" name="ProdPdfPath" id="ProdPdfPath" value="" /><span  onclick="FileUploadValidate('ProdPdfPath','pdf','ProdPdfPathDisp','Document/Pdf/');"  style="cursor:pointer;"><img src="images/upload-icon.png" /> upload</span>&nbsp;&nbsp;<span id="ProdPdfPathDisp"></span><br/><em><span class="alertmsg">(pdf File Only - Below 1MB)</span></em></td>
</tr>
<tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td>Cover Image<br /><em><span class="alertmsg">Maximum limit of three images</span></em></td>
<td> :&nbsp;</td>
<td><input type="hidden" name="ProdCoverImgPath" id="ProdCoverImgPath" value="" /><span onclick="FileUploadValidate('ProdCoverImgPath','doc','ProdCoverImgDisp','Document/CoverImages/');"  style="cursor:pointer;"><img src="images/upload-icon.png" /> upload</span>&nbsp;&nbsp;<span id="ProdCoverImgDisp"></span><br/><em><span class="alertmsg">(gif,jpg,png Files Only - Below 1MB)</span></em></td>
</tr>
<tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td>Inner Image</td>
<td> :&nbsp;</td>
<td><span id="PGalleryUpload" style="cursor:pointer;"><img src="images/upload-icon.png" />&nbsp;upload</span><span style="display:none;" id="PGalleryStatus"></span><span id="PGalleryList"></span><br/><em><span class="alertmsg">(gif,jpg,png Files Only - Below 1MB)</span></em></td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr style="display:none;"><td colspan="3" height="10">
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="profilee">
<tr>
<td>Country</td>
<td> :&nbsp;</td>
<td>
<input type="text" id="ProCountry" name="ProCountry"  autocomplete="off" class="inp-text" /><div id="ProLocationResponse"></div>
<script type="text/javascript">
var LAjaxResponsee  = 'ProLocationResponse';
var LDataGett       ='ProCountry';
var LClearData      ='ProLocClear';
var LFile           ='Bl_ADMLocationList.php';
var LCAjaxResponsee = 'ProLocResponse';
var LDataShow1      ='ProLocationList';
var LDataShow2      ='ProLocationListId';
var LDataShow3      ='ProLocdt_Id';
</script>
<script type="text/javascript" src="js/LocationFilter.js">
</script></td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input id="ProLocdt_Id" type="hidden" /><input id="ProLocationListId" type="hidden" /><input id="ProLocClear" type="hidden" /><input type="text" id="ProLocationList" name="ProLocationList" style="width: 496px;" autocomplete="off" class="inp-text" placeholder="Please Select State" readonly="readonly"  /><a class="ui-dropdown-trigger" id="ProLocList"></a><div id="ProLocResponse" style="height:140px;"></div>
<script type="text/javascript">
var LCDataChk      ='ProCountry';
var LCDataGett     ='ProLocList';
var LCFile         ='Bl_ProductLocList.php';
</script>
<script type="text/javascript" src="js/LocationList.js">
</script>
</td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr align="center">
<td height="24"   colspan="3">
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td height="24"  ><input type="button" name="ProLoctSmt" Id="ProLoctSmt" class="btn_b" value="Add Location"  onclick="AddProLocation();"/></td>
<td>&nbsp;</td>
<td height="24" ><input type="button"  class="btn_b" value="Reset" onclick="ShowProLocationReset();" /></td>
</tr>
</table>
</td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td colspan="3" bgcolor="#CCCCCC" >
<div id="ProLocationGrid"></div></td><tr>
</table>

</td></tr>

<tr><td colspan="3" height="10"></td></tr>
<tr>
<td colspan="3" align="center">
<input type="button" onclick="AddProduct();" id="ProductSmt" name="ProSmt" value="Add" />
<input type="button" onclick="ProductReset();" value="Reset" />
<input type="button" value="Cancel" onclick="GridShowHide('ProductEntryLevel','ProductEntryGrid','Grid','');" />
</td> 
</tr>
<tr><td colspan="3" height="10"></td></tr>
</table>
</fieldset>
</div>
<div id="ProductEntryGrid" style="display:block;">
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="mfieldset">
<tr class="pagination heading2"><td width="90%" colspan="2"><span onclick="GridShowHide('ProductEntryLevel','ProductEntryGrid','Page','');ProductReset();"><b>Add New&nbsp;</b></span></td><td width="10%"><span class="handsym" onclick="GridShowHide('ProductEntryLevel','ProductEntryGrid','Page','');ProductReset();"><img src="images/Add.jpg" width="30" height="30" title="Add" /></span></td></tr>
<tr><td colspan="5" class="gridbgcolor" >
<div id="ProductGrid" class="gridpad">
<?php $sqltot="SELECT PS_Id,PS_Display,PS_Fk,PS_CategoryFk,CASE WHEN PS_Mode =1 Then 'Provider' else 'Seeker' END PS_Mode  FROM ".TABLE_PRODUCTSERVICE." WHERE PS_User_Fk='".$UId."' order by  PS_Id desc";
$tot=db_query($sqltot);
$rtot=db_num_rows($tot);
$totalrecord=$rtot;  $pagesize=10;
$noofpages=$totalrecord/$pagesize;
$SqlRun=db_query($sqltot." limit $startdata,$pagesize");
$Count = db_num_rows($SqlRun);
?>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="manageborder">
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
$Pid=1;
while(list($PS_Id,$PS_Display,$PS_Fk ,$PS_CategoryFk,$PS_Mode) = db_fetch_array($SqlRun)){
?>
<tr class="gridcenbgcolor"  height="25">
<td width="5%"><?php  echo $Pid;?></td>
<td width="25%"><?php echo $PS_Display;?></td>
<td width="30%"><?php echo ProductCategory($PS_CategoryFk);?></td>
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
</table>
</div>
</td></tr>
</table>
</div>
</div>
