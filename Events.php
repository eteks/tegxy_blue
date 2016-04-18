<div class="heading" style="text-align:center">Activities</div>
<div id="personal" style="margin-left:50px; padding-bottom:30px;width:680px;">
<div id="EventsEntryLevel"  style="display:none;">
<div class="pagination handsym" onclick="GridShowHide('EventsEntryLevel','EventsEntryGrid','Grid','');" style="line-height: 49px;"><img width="30" height="30" src="images/Back-icon.png" title="Back"></div><div style="clear:both"></div>
<form id="EventsForm">
<fieldset id="Fields">
<input type="hidden" id="EventssStateData" value="0"  />
<input type="hidden" id="EventssExistId" />
<legend>Activity</legend>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td>Upload Image</td>
<td> :&nbsp;</td>
<td><input type="hidden" name="EventsImage" id="EventsImage" value="" /><span onclick="FileUploader('EventsImage','doc','EventsImageDisp','Document/Events/');"  style="cursor:pointer;"><img src="images/upload-icon.png" /> upload</span>&nbsp;&nbsp;<span id="EventsImageDisp"></span><br/><em><span class="alertmsg">(gif,jpg,png Files Only - Below 1MB - Below 1MB - Recommended size 300X200)</span></em></td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td>Title</td>
<td> :&nbsp;</td>
<td><input type="text"  id="EventsTitle" name="EventsTitle" class="inp-text"  style="width:538px;" /></td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td>Description</td>
<td> :&nbsp;</td>
<td><textarea id="EventsDesp" name="EventsDesp" class="inp-text"  style="width:538px;font-family:Arial,Helvetica,sans-serif;"  ></textarea></td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td colspan="3">
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>From</td>
    <td>&nbsp;</td>
    <td><input  name="EFrom" style="height: 20px;width: 150px;" id="EFrom" type="text" size="30"  onFocus="return clearedate('EFrom')" onClick="return clearedate('EFrom')"   autocomplete="off" readonly="readonly"  /><img src="images/Cal.png" width="16" height="16" style="cursor:pointer" onClick="showCalendarControl(document.forms['EventsForm'].EFrom)"  /></td>
    <td>&nbsp;</td>
    <td>To</td>
    <td>&nbsp;</td>
    <td><input name="ETO" style="height: 20px;width: 150px;"  id="ETO" type="text" size="30"  onFocus="return clearedate('ETO')" onClick="return clearedate('ETO')"  autocomplete="off" readonly="readonly"  /><img src="images/Cal.png" width="16" height="16" style="cursor:pointer" onClick="showCalendarControl(document.forms['EventsForm'].ETO)"  /></td>
  </tr>
</table>
</td>
</tr>
<tr><td colspan="3" height="10"></td></tr>
<tr>
<td colspan="3" align="center">
<input type="button" class="submit-btn" onclick="AddEvents();" class="submit-btn" id="EventsSmt" name="EventsSmt" value="Add" />
<input type="button" class="submit-btn" onclick="EventsReset();" class="submit-btn" value="Reset" />
<input type="button" class="submit-btn" value="Cancel" class="submit-btn" onclick="GridShowHide('EventsEntryLevel','EventsEntryGrid','Grid','');" />
</td> 
</tr>
</table>
</fieldset>
</form>
</div>
<div id="EventsEntryGrid" style="display:block;">
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="mfieldset">
<tr class="pagination heading2">
  <td width="90%" colspan="2"><span onclick="GridShowHide('EventsEntryLevel','EventsEntryGrid','Page','');EventsReset();"><b>Add New Activity&nbsp;</b></span></td><td width="10%"><span class="handsym" onclick="GridShowHide('EventsEntryLevel','EventsEntryGrid','Page','');EventsReset();"><img src="images/Add.jpg" width="30" height="30" title="Add" /></span></td></tr>
<tr><td colspan="5" class="gridbgcolor" >
<div id="EventsGrid" class="gridpad">
<?php $sqltot="SELECT ET_Id,ET_Image,ET_Desp,ET_From,ET_To,ET_Title FROM ".TABLE_EVENTS." WHERE  ET_UserFk='".$UId."' order by  ET_Id desc";
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
<td width="25%">Image</td>
<td width="25%">Title</td>
<td width="30%">Date of the Activity</td>
<td width="10%">Action</td>
</tr>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<?php
if($Count>0){
$Pid=1;
while(list($ET_Id,$ET_Image,$ET_Desp,$ET_From,$ET_To,$ET_Title) = db_fetch_array($SqlRun)){
?>
<tr class="gridcenbgcolor"  height="40">
<td width="10%"><?php  echo $Pid;?></td>
<td width="25%"><img src="<?php echo $ET_Image;?>" width="30" height="30" border="0" /></td>
<td width="25%"><?php if(strlen(stripslashes($ET_Title))>25){ echo substr(stripslashes($ET_Title),0,50).'...' ;} else { echo stripslashes($ET_Title);} ?></td>
<td width="30%"><?php echo ChangeDateforShow($ET_From).StringLeftArrow(ChangeDateforShow($ET_To),' - ',3);?></td>
<td width="10%" class="handsym"><img width="16" border="0" height="16" onclick="EventsEdit(<?php echo $ET_Id;?>);" src="images/b_edit.png" title="Edit">&nbsp;<img width="16" border="0" height="16" src="images/b_drop.png" onclick="EventsDelete(<?php echo $ET_Id;?>,<?php echo $Count;?>,<?php echo $startdata;?>);" title="Delete"></td>
</tr>

<?php  $Pid++;}?>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<tr class="gridbgcolor"  height="25"><td colspan="5"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'PageEvents'); ?></td></tr>
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
