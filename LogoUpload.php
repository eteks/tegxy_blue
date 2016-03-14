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
<td>
	<!-- <input type="hidden" name="GalleryImage" id="GalleryImage" value="" />
	<span onclick="FileUploadValidate('GalleryImage','doc','GalleryImageDisp','Document/Gallery/');"  style="cursor:pointer;">
	<img src="images/upload-icon.png" /> upload</span>&nbsp;&nbsp;
	<span id="GalleryImageDisp"></span><br/>
	<em><span class="alertmsg">(gif,jpg,png Files Only - Below 1MB - Recommended size 500X400)</span></em> -->
	
	<input type="hidden" name="LogoImage" id="LogoImage" value="" />
	<span onclick="FileUploadValidate('LogoImage','doc','UploadLogoList','Document/Logo/');" style="cursor:pointer;">
	<img src="images/upload-icon.png" />&nbsp;upload</span>
	<span id="UploadLogoList"></span><br/>
	<em><span class="alertmsg">(gif,jpg,png Files Only - Below 1MB - Recommended size 148X155)</span></em>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>

</td>
</tr>
</table>
</fieldset>
</div>