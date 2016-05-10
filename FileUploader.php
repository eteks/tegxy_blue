<?php ob_start();session_start(); 
 
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();
$UId = trim($_SESSION['LID']);

$LID=trim($_SESSION["LID"])!=""?trim($_SESSION["LID"]):session_id();
// echo $_REQUEST['objtype'];
if(isset($_REQUEST['objtype']) && $_REQUEST['objtype']=="mov")
	$allowExt = "movie";
else if($_REQUEST['objtype']=="doc")
	$allowExt = "doc";
else
	$allowExt = "pdf";	

$ImageDisp = $_REQUEST['disp'];
$FilePath = $_REQUEST['path'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>File Uploader</title>
<!-- <link rel="stylesheet" type="text/css" href="css/memberprofile.css" media="screen" /> -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
function checkopenerclose()
{	
	window.close();
}
function uploadimagecheck()
{
	var imagePath = $('#ImgUpload').val();
	var pathLength = imagePath.length;
	var lastDot = imagePath.lastIndexOf(".");
	var fileType = imagePath.substring(lastDot,pathLength);	
	var file = document.getElementById('ImgUpload').files[0];	
	// var FileSize = $('#FileSize').val();
	var FileSize = 1000000;
	var Check = parseInt(file.size);
	// alert('allowed size'+parseInt($('#FileSizeLimit').val()));
	// alert('current size'+Check);
	// alert(parseInt(FileSize) < parseInt(Check));
	// if(parseInt($('#FileSizeLimit').val()) < parseInt(Check))
	if(parseInt(FileSize) < parseInt(Check))
	{
	alert('Can not upload');
	return false;
	}	
	<?php if($allowExt=="doc"){ ?>
	if((fileType == ".gif") || (fileType == ".jpg") || (fileType == ".png") || (fileType == ".GIF") || (fileType == ".JPG") || (fileType == ".PNG"))
	{
		alert('file uploaded successfully');
		return true;
	} 
	else 
	{
		alert("Please upload the valid image file");
		return false;
	}
	// else if(FileSize>1048576){
	// 	alert("Please upload the image file below 1mb");
	// 	return false;
	// } 
	<?php } 
	
	else if($allowExt=="pdf"){ ?>
	 if((fileType == ".pdf") || (fileType == ".PDF") )
	{
		return true;
	} 
   else 
	{
		alert("Please upload the valid file");
		return false;
	}
	<?php }
	else { ?>
		if((fileType == ".flv")||(fileType == ".FLV"))
		{
			return true;
		} 
		else 
		{
			alert("Please upload the valid Presentation file");
			return false;
		}
	<?php } ?>
	
	
}
</script>
</head>
<body><?php 
if($_POST['Upload']=='Upload')
{	
	$image=$_FILES['ImgUpload']['name'];
	if($image)  
	{
		$filename = stripslashes($_FILES['ImgUpload']['name']);
		$extension = getExtension($filename); 
		$extension = strtolower($extension);
		if (($extension != "pdf") && ($extension != "flv") &&($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))    
		{
			//echo '<h1>Unknown extension!</h1>'; 
			$errors=1;
		}  
		else  
		{
			$size=filesize($_FILES['ImgUpload']['tmp_name']);
			$image_name=$LID.time().'1.'.$extension;
			$newlogo=$_POST["Path"].$image_name;
			$copied = copy($_FILES['ImgUpload']['tmp_name'], $newlogo);
			if ($copied) 
			{ 
				$mainMesage = $newlogo;
			}
		}?>
		<script type="text/javascript" language="javascript">	
			window.opener.document.getElementById('<?php echo $_REQUEST['fieldName']; ?>').value="<?php echo $mainMesage;?>";
			<?php if($_REQUEST['objtype']=='pdf')
			{?>
			window.opener.document.getElementById('<?php echo $_REQUEST['Disp']; ?>').innerHTML='<a href="<?php echo $mainMesage;?>" target="_blank"><img width="30" height="30" src="images/pdf.png"></a>&nbsp;&nbsp;<span style="color: #00677D;cursor: pointer;font-size: 11px;font-weight: bold;" onclick="DeleteFromFolder(\'<?php echo $mainMesage;?>\',\'<?php echo $_POST['Disp'];?>\',\'<?php echo $_REQUEST['fieldName']; ?>\');" >Delete</span>&nbsp;&nbsp;';
			<?php }
			else if($_POST['Disp']=='UploadLogoList'){ 
				//newly added by kalai
				$logo_path = $mainMesage;
				$Check = db_query("SELECT LG_Id,LG_Logo FROM ".TABLE_LOGO." WHERE LG_UserFk='".$UId."'");
				list($LG_Id,$LG_Logo) =db_fetch_array($Check);
				if(db_num_rows($Check)>0)
					$sql = "UPDATE ".TABLE_LOGO." SET LG_Logo='".$logo_path."',LG_ModifiedOn=NOW() WHERE LG_Id='".$LG_Id."'";
				else
					$sql = "INSERT INTO ".TABLE_LOGO." set  LG_UserFk='".$UId."', LG_Logo='".$logo_path."',LG_CreatedOn=NOW(),LG_ModifiedOn=NOW()";
				$insert=db_query($sql) or die(db_error());
				$cc=db_insert_id();

			?>
			window.opener.document.getElementById('<?php echo $_POST['Disp']; ?>').innerHTML='<img width="200" height="200" src="<?php echo $mainMesage;?>" />&nbsp;&nbsp;<span style="color: #00677D;cursor: pointer;font-size: 11px;font-weight: bold;" onclick="DeleteFromFolder(\'<?php echo $mainMesage;?>\',\'<?php echo $_POST['Disp'];?>\',\'<?php echo $_REQUEST['fieldName']; ?>\');" >Delete</span>&nbsp;&nbsp;';
			<?php } 
			else{?>
			window.opener.document.getElementById('<?php echo $_POST['Disp']; ?>').innerHTML='<img width="30" height="30" src="<?php echo $mainMesage;?>" />&nbsp;&nbsp;<span style="color: #00677D;cursor: pointer;font-size: 11px;font-weight: bold;" onclick="DeleteFromFolder(\'<?php echo $mainMesage;?>\',\'<?php echo $_POST['Disp'];?>\',\'<?php echo $_REQUEST['fieldName']; ?>\');" >Delete</span>&nbsp;&nbsp;';
			<?php } ?>
			window.close();
        </script> <?php 
	}
} else{ ?>
	<script type="text/javascript" language="javascript">
		$(document).ready(function(){
			$("#fieldName").val("<?php echo $_REQUEST['idname']; ?>");		
		});
	</script>
<?php
}
if($LID!='')
{ ?>
<form id="ImageUploader" name="ImageUploader" method="post" enctype="multipart/form-data" action="FileUploader.php"  onsubmit="return uploadimagecheck();">
<input type="hidden" id="Path" name="Path" value="<?php echo $FilePath ;?>" />
<input type="hidden" id="Disp" name="Disp" value="<?php echo $ImageDisp ;?>" />
<input type="hidden" id="FileSize" name="FileSize"  value="<?php echo UserFileSize($UId);?>" />

<input type="hidden" id="FileSizeLimit" name="FileSizeLimit"  value="<?php echo UserFileSizeLimit($UId);?>" />

<table cellpadding="0" cellspacing="1" bgcolor="#FFCC99" width="300" align="center">
    <tr>
        <td bgcolor="#FFFFFF" height="250" valign="middle">
                <table cellpadding="4" cellspacing="4" border="0" width="300" align="center">	
                    <tr><td colspan="3" align="center" class="membertxtdate"> <strong>Upload File</strong></td></tr>
                    <tr>
                        <td class="tex1"> Upload </td>
                        <td class="tex1"> : </td>
                        <td class="tex1"> <input type="file" id="ImgUpload" class="memberinput" name="ImgUpload" value="" />
                        <input type="hidden" value="" name="fieldName" id="fieldName" />
                        <input type="hidden" id="objtype" value="<?php echo $_REQUEST['objtype'];?>" name="objtype" />
                        </td>
                    </tr>
                    <tr class="tex1">
                        <td colspan="3" align="center"><input type="submit" id="Upload" name="Upload" value="Upload" class="btn_b" onclick="return uploadimagecheck();"/>&nbsp;&nbsp;&nbsp;<input type="button" id="CloseUpload" name="CloseUpload" value="Close" onclick="checkopenerclose();" class="btn_b"/></td>
                    </tr> 	
                            
                </table>
        </td>
    </tr>
</table>
</form>
	<?php
} 
else
{ ?>
	<script type="text/javascript" language="javascript">window.close();</script><?php
}?>
</body>
</html>