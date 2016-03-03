<div class="heading" style="text-align:center">Header Settings</div>
<div id="personal" style="margin-left:50px; padding-bottom:30px;width:680px;">
<div id="HeadSetEntryLevel"  style="display:block;">
<div class="pagination handsym" onclick="GridShowHide('HeadSetEntryLevel','HeadSetEntryGrid','Grid','');" style="line-height: 49px;"><img width="30" height="30" src="images/Back-icon.png" title="Back"></div><div style="clear:both"></div>
<fieldset id="Fields">
<input type="hidden" id="HeadSetStateData" value="0"  />
<input type="hidden" id="HeadSetExistId" />
<legend>Header Settings</legend>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td>Upload Image</td>
<td> :&nbsp;</td>
<td><input type="hidden" name="HeadSetImage" id="HeadSetImage" value="" /><span onclick="FileUploadValidate('HeadSetImage','doc','HeadSetImageDisp','Document/Gallery/');"  style="cursor:pointer;"><img src="images/upload-icon.png" /> upload</span>&nbsp;&nbsp;<span id="HeadSetImageDisp"></span><br/><em><span class="alertmsg">(gif,jpg,png Files Only - Below 1MB - Recommended size 990X316)</span></em></td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td>Display it on the gallery</td>
<td> :&nbsp;</td>
<td><input type="checkbox" id="GallyChk" name="GallyChk" /></td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td colspan="3" align="center">
<input type="button" onclick="AddHeadSet();" class="submit-btn" id="HeadSetSmt" name="HeadSetSmt" value="Add" />
<input type="button" onclick="HeadSetReset();" class="submit-btn" value="Reset" />
<input type="button" value="Cancel" class="submit-btn" onclick="GridShowHide('HeadSetEntryLevel','HeadSetEntryGrid','Grid','');" />
</td> 
</tr>
</table>
</fieldset>
</div>
<div id="HeadSetEntryGrid" style="display:block;">
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="mfieldset">
<tr class="pagination heading2"><td width="90%" colspan="2"><span onclick="GridShowHide('HeadSetEntryLevel','HeadSetEntryGrid','Page','');HeadSetReset();"><b>Add New Image&nbsp;</b></span></td><td width="10%"><span class="handsym" onclick="GridShowHide('HeadSetEntryLevel','HeadSetEntryGrid','Page','');HeadSetReset();"><img src="images/Add.jpg" width="30" height="30" title="Add" /></span></td></tr>
<tr><td colspan="5" class="gridbgcolor" >
<div id="HeadSetGrid" class="gridpad">
<?php $sqltot="SELECT GY_Id,GY_Image,GY_Desp,GY_Type FROM ".TABLE_GALLERY." WHERE ((GY_Type2=1) || (GY_Type=0 AND GY_Type2=1))  AND GY_UserFk='".$UId."' order by  GY_Id desc";
$tot=db_query($sqltot);
$rtot=db_num_rows($tot);
$totalrecord=$rtot;  $pagesize=5;
$noofpages=$totalrecord/$pagesize;
$SqlRun=db_query($sqltot." limit $startdata,$pagesize");
$Count = db_num_rows($SqlRun);
?>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="manageborder">
<tr height="35">
<td width="10%">S.No.</td>
<td width="80%">Image</td>
<td width="10%">Action</td>
</tr>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<?php
if($Count>0){
$Pid=1;
while(list($GY_Id,$GY_Image,$GY_Desp,$GY_Type) = db_fetch_array($SqlRun)){
?>
<tr class="gridcenbgcolor"  height="40">
<td width="10%"><?php  echo $Pid;?></td>
<td width="80%"><img src="<?php echo $GY_Image;?>" width="30" height="30" border="0" /></td>
<td width="10%" class="handsym"><img width="16" border="0" height="16" onclick="HeadSetEdit(<?php echo $GY_Id;?>);" src="images/b_edit.png" title="Edit">&nbsp;<img width="16" border="0" height="16" src="images/b_drop.png" onclick="HeadSetDelete(<?php echo $GY_Id;?>,<?php echo $Count;?>,<?php echo $startdata;?>,<?php echo $GY_Type;?>);" title="Delete"></td>
</tr>

<?php  $Pid++;}?>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<tr class="gridbgcolor"  height="25"><td colspan="5"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'PageHeadSet'); ?></td></tr>
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
