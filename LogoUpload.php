<script language="javascript" type="text/javascript">
$(function()
{
	var btnUpload=$('#UploadLogo');
	var status=$('#UploadLogoStatus');
	new AjaxUpload(btnUpload, {
	action: 'LogoUploader.php',
	name: 'uploadfile',
	onSubmit: function(file, ext)
	{
	 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
     // extension is not allowed 
	status.text('Only JPG, PNG or GIF files are allowed');
	return false;
	}
	
	var TempFileSize = $('#LAppendFileCt').val();
	var FileSize = $('#FileSize').val();
	var Check = parseInt(TempFileSize) + parseInt(FileSize);
	if(parseInt($('#FileSizeLimit').val()) < parseInt(Check))
	{
	alert('Can not upload');
	return false;
	}
	
	status.text('Uploading...');
	},
	onComplete: function(file, response)
	{
		//On completion clear the status
		status.text('');
		//Add uploaded file to list
		var bb=response.substr(0,7)
		var idd=response.replace('success',' ');
		var idb =idd.replace(/^\s*|\s*$/g,'');
		var idFile = idb.split("###");
		if(bb=="success")
		{
			$("#UploadLogoList").load("LogoDisp.php");
			$("#FileSize").val(idFile[2]);
			status.text('Uploaded Successfully.');
		}
		else 
		{
			status.text(response);
		}
	}});
});

function deleteLogo(id,idd)
{
	var status=$('#'+idd);
	n=confirm("Do you want to delete?");
	if(n==true)
	{
		var aurl="LogoDelete.php?imageid="+id;
		var result=$.ajax({
			type:"GET",
			data:"stuff=1",
			url:aurl,
			async:false
		}).responseText;
		if(result!="")
		{
			status.text('Deleted Successfully.');
			$('#'+idd).load("LogoDisp.php");
		}
	}
}
</script>
<?php 
$SelectSlot= db_query("SELECT LG_Id,LG_Logo FROM ".TABLE_LOGO." WHERE LG_UserFk='".$UId."'");
$FetchSlot=db_fetch_array($SelectSlot)?>

<div class="heading" style="text-align:center">Logo Upload</div>
<div id="personal" style="margin-left:50px; padding-bottom:30px;width:680px;">
<input type="hidden" id="LAppendFileCt" />

<fieldset id="Fields">
<legend>Logo Upload</legend>


<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td>Upload Logo</td>
<td> :&nbsp;</td>
<td><span id="UploadLogo" style="cursor:pointer;"><img src="images/upload-icon.png" />&nbsp;upload</span><span style="display:none;" id="UploadLogoStatus"></span><br/><em><span class="alertmsg">(gif,jpg,png Files Only - Below 1MB - Recommended size 148X155)</span></em></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><span id="UploadLogoList"><a href="javascript:void(0)" onClick="deleteLogo('<?php echo $FetchSlot['LG_Id']; ?>','UploadLogoList');"><img src="<?php echo $FetchSlot['LG_Logo']; ?>" height="200"  width="200" style="margin:5px;" /></a><?php $NumSlotct=db_num_rows($SelectSlot);
if($NumSlotct>0)
echo '<em><span class="alertmsg">Click on the image to delete</span></em>';?>

</span></td>
</tr>
</table>
</fieldset>
</div>