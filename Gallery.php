<div class="heading" style="text-align:center">Gallery</div>
<div id="personal" style="margin-left:50px; padding-bottom:30px;width:680px;">
<div id="GalleryEntryLevel"  style="display:none;">
<div class="pagination handsym" onclick="GridShowHide('GalleryEntryLevel','GalleryEntryGrid','Grid','');" style="line-height: 49px;"><img width="30" height="30" src="images/Back-icon.png" title="Back"></div><div style="clear:both"></div>
<fieldset id="Fields">
<input type="hidden" id="GalryStateData" value="0"  />
<input type="hidden" id="GalryExistId" />
<legend>Gallery</legend>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td>Upload Image</td>
<td> :&nbsp;</td>
<td><input type="hidden" name="GalleryImage" id="GalleryImage" value="" /><span onclick="FileUploadValidate('GalleryImage','doc','GalleryImageDisp','Document/Gallery/');"  style="cursor:pointer;"><img src="images/upload-icon.png" /> upload</span>&nbsp;&nbsp;<span id="GalleryImageDisp"></span><br/><em><span class="alertmsg">(gif,jpg,png Files Only - Below 1MB - Recommended size 500X400)</span></em></td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td>Title</td>
<td> :&nbsp;</td>
<td><input type="text" id="GalleryTitle" name="GalleryTitle" class="inp-text"  style="width:538px;" /></td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td>Description</td>
<td> :&nbsp;</td>
<td><textarea id="GalleryDesp" name="GalleryDesp" class="inp-text"  style="width:538px;"></textarea></td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td>Display it on the header</td>
<td> :&nbsp;</td>
<td><input type="checkbox" id="HeadChk" name="HeadChk" /></td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td colspan="3" align="center">
<input type="button" onclick="AddGallery();" class="submit-btn" id="GallerySmt" name="GallerySmt" value="Add" />
<input type="button" onclick="GalleryReset();" class="submit-btn" value="Reset" />
<input type="button" value="Cancel" class="submit-btn" onclick="GridShowHide('GalleryEntryLevel','GalleryEntryGrid','Grid','');" />
</td> 
</tr>
</table>
</fieldset>
</div>
<div id="GalleryEntryGrid" style="display:block;">
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="mfieldset">
<tr class="pagination heading2"><td width="90%" colspan="2"><span onclick="GridShowHide('GalleryEntryLevel','GalleryEntryGrid','Page','');GalleryReset();"><b>Add New Image&nbsp;</b></span></td><td width="10%"><span class="handsym" onclick="GridShowHide('GalleryEntryLevel','GalleryEntryGrid','Page','');GalleryReset();"><img src="images/Add.jpg" width="30" height="30" title="Add" /></span></td></tr>
<tr><td colspan="5" class="gridbgcolor" >
<div id="GalleryGrid" class="gridpad">
<?php $sqltot="SELECT GY_Id,GY_Image,GY_Title,GY_Type2 FROM ".TABLE_GALLERY." WHERE ((GY_Type=0) || (GY_Type=1 AND GY_Type2=0)) AND  GY_UserFk='".$UId."' order by  GY_Id desc";
$tot=db_query($sqltot);
$rtot=db_num_rows($tot);
$totalrecord=$rtot;  $pagesize=5;
$noofpages=$totalrecord/$pagesize;
$startdata=0;
$SqlRun=db_query($sqltot." limit $startdata,$pagesize");
$Count = db_num_rows($SqlRun);
?>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="manageborder">
<tr height="35">
<td width="10%">S.No.</td>
<td width="35%">Image</td>
<td width="45%">Title</td>
<td width="10%">Action</td>
</tr>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<?php
if($Count>0){
$Pid=1;
while(list($GY_Id,$GY_Image,$GY_Title,$GY_Type2) = db_fetch_array($SqlRun)){
?>
<tr class="gridcenbgcolor"  height="40">
<td width="10%"><?php  echo $Pid;?></td>
<td width="35%"><img src="<?php echo $GY_Image;?>" width="30" height="30" border="0" /></td>
<td width="40%"><?php if(strlen(stripslashes($GY_Title))>25){ echo substr(stripslashes($GY_Title),0,50).'...' ;} else { echo stripslashes($GY_Title);} ?></td>
<td width="10%" class="handsym"><img width="16" border="0" height="16" onclick="GalleryEdit(<?php echo $GY_Id;?>);" src="images/b_edit.png" title="Edit">&nbsp;<img width="16" border="0" height="16" src="images/b_drop.png" onclick="GalleryDelete(<?php echo $GY_Id;?>,<?php echo $Count;?>,<?php echo $startdata;?>,<?php echo $GY_Type2 ;?>);" title="Delete"></td>
</tr>

<?php  $Pid++;}?>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<tr class="gridbgcolor"  height="25"><td colspan="5"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'PageGallery'); ?></td></tr>
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
