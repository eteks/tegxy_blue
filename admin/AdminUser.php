<?php
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();

$PageName = basename($_SERVER['SCRIPT_FILENAME'],'.php');

if(!isset($_SESSION['Admin_Id']))
header("location:Login.php");
$_REQUEST['id'] = (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
$ModuleId = $_REQUEST['ModuleId'];
$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);
include("include/BlModules/Bl_AdminUser.php");
$sql = "Select * from ".TABLE_ADMINUSER." WHERE Admin_Id='".$_REQUEST['id']."'";
$Select=db_query($sql);
$Fetch=db_fetch_array($Select);
$_REQUEST['startdata'] = (isset($_REQUEST['startdata']) ? $_REQUEST['startdata'] : '');
if($_REQUEST['startdata']=='')
$_REQUEST['startdata']=0;
if($_REQUEST['startdata']==-1)
$_REQUEST['startdata']=0;

?>
<div id="ScrollText" style="overflow:auto;">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
<td align="left" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="9" align="left" valign="top"><img src="images/gridbox/title_l_bg.gif" width="9" height="29" /></td>
<td align="left" valign="top" class="title">Admin User</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="left" valign="top" class="tdcom">
<form method="post" id="AdminUserForm" name="AdminUserForm" action="index.php" onSubmit="return ValidateAdminUserForm();">
<input type="hidden" value="<?php echo $Fetch['Admin_Id']; ?>" id="ExistId" name="ExistId" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="7" align="center"><span id="msgdisplay">&nbsp;<?php $_REQUEST['s'] = (isset($_REQUEST['s']) ? $_REQUEST['s'] : '');
if($_REQUEST['s']==1){ echo "Added Successfully!"; }
if($_REQUEST['s']==2){ echo "This RoleType Name Already Exist!"; }
if($_REQUEST['s']==3){ echo "Deleted Successfully"; }
if($_REQUEST['s']==4){ echo "Status Updated Successfully"; }
if($_REQUEST['s']==5){ echo "Updated Successfully"; }
?></span></td></tr>
<tr>
<td width="17%" height="24" align="right"><span class="feildstxt">*Code</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="30%" height="24">
<?php
$autoCode = getMaxId(TABLE_ADMINUSER, 'Admin_Id') + 1;
$autoCode = 'ADM'.$autoCode;
if ($_REQUEST['action']=='edit' && $Fetch['AdminUser_Code'] == '')
$autoCode = 'ADM'.$_REQUEST['id'];
else if ($_REQUEST['action']=='view' || $_REQUEST['action']=='edit')
$autoCode = $Fetch['AdminUser_Code'];
?><input type="text" name="AdminUserCode" id="AdminUserCode" class="input" <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?> value="<?php if($_REQUEST['action']=='view' || $_REQUEST['action']=='edit') echo $autoCode; else echo $autoCode; ?>" autocomplete="off" style="width:200px;"/></td>
<td width="2%"></td>
<td width="10%" height="24" align="right">&nbsp;</td>
<td width="2%" height="24" align="center">&nbsp;</td>
<td width="37%" height="24">&nbsp;</td>
</tr>
<tr>
<td width="17%" height="24" align="right"><span class="feildstxt">*Name</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="30%" height="24"><input type="text" autocomplete="off" name="AdminUserName" id="AdminUserName" value="<?php echo $Fetch['AdminUser_Name'] ?>" <?php if($_REQUEST['action']=='view' ){ ?> readonly="" <?php }?> class="input" style="width:200px;" /></td>
<td width="2%"></td>
<td width="10%" height="24" align="right"><span class="feildstxt">*User Role</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="37%" height="24"><select name="AdminRole" id="AdminRole" class="dropdown" <?php if($_REQUEST['action']=='view'){ ?> disabled="disabled"<?php }?>><option value="">- Select -</option><?php
$queryRole = db_query("Select * from ".TABLE_ROLE." where Status='1'");
$numRole = @db_num_rows($queryRole);
if($numRole>0)
{ 
while($fetchRole = db_fetch_array($queryRole))
{ ?>
<option value="<?php echo $fetchRole['Id'];?>" <?php if($fetchRole['Id']==$Fetch['AdminUser_Role']) {?> Selected <?php } ?>>
<?php echo $fetchRole['Role_Name'];?></option><?php 
}
} ?>
</select>
</td>
</tr>
<tr>         
<td width="17%" height="24" align="right"><span class="feildstxt">*Email</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="30%" height="24"><input type="text" autocomplete="off"  name="AdminUserEmail" id="AdminUserEmail" value="<?php echo $Fetch['AdminUser_Email'] ?>" <?php if($_REQUEST['action']=='view' ){ ?> readonly="" <?php }?> class="input" style="width:200px;" /></td>
<td width="2%"></td>
<td width="10%" height="24" align="right"><span class="feildstxt">Phone</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="37%" height="24"><input type="text" autocomplete="off"  name="AdminUserPhone" id="AdminUserPhone" value="<?php echo $Fetch['AdminUser_Phone'] ?>" <?php if($_REQUEST['action']=='view' ){ ?> readonly="" <?php }?> class="input" style="width:200px;" /></td>
</tr>
<tr>
<td width="17%" height="24" align="right"><span class="feildstxt">*Login Name</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="30%" height="24" colspan="5"><input type="text" autocomplete="off"  name="AdminUserLogin" id="AdminUserLogin" value="<?php echo $Fetch['AdminUser_LoginId'] ?>" <?php if($_REQUEST['action']=='view' ){ ?> readonly="" <?php }?> class="input" style="width:200px;" /></td>
</tr>
<tr>
<td width="17%" height="24" align="right"><span class="feildstxt">*Password</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="30%" height="24"><input type="password" autocomplete="off"  name="AdminUserPassword" id="AdminUserPassword" value="<?php echo $Fetch['AdminUser_Password'] ?>" <?php if($_REQUEST['action']=='view' ){ ?> readonly="" <?php }?> class="input" style="width:200px;" /></td>
<td width="2%"></td>
<td width="10%" height="24" align="right"><span class="feildstxt">*Confirm Password</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="37%" height="24"><input type="password" autocomplete="off"  name="AdminUserCPassword" id="AdminUserCPassword" value="<?php echo $Fetch['AdminUser_Password'] ?>" <?php if($_REQUEST['action']=='view' ){ ?> readonly="" <?php }?> class="input" style="width:200px;" /></td>
</tr>
<tr>
<td width="17%" height="24" align="right"><span class="feildstxt">User Details</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24" colspan="5"><textarea autocomplete="off" <?php $_REQUEST['action'] = (isset($_REQUEST['action']) ? $_REQUEST['action'] : ''); if($_REQUEST['action']=='view' ){ ?> readonly="" <?php }?> name="AdminUserDetails" id="AdminUserDetails" class="input" style="width:550px;height:60px;"><?php $Fetch['AdminUser_Address1'] = (isset($Fetch['AdminUser_Address1']) ? $Fetch['AdminUser_Address1'] : ''); echo $Fetch['AdminUser_Address1'];?></textarea></td>
</tr>
<tr>
<td height="24" align="right"><span class="feildstxt">Active Status </span></td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24"><input type="checkbox" name="AdminUserStatus" id="AdminUserStatus" style="width:20px;border:0px;" autocomplete="off" class="input" value="1" <?php if($Fetch['AdminUser_Status']=='1') { echo 'checked="checked"'; } if ($_REQUEST['action']!='edit' && $_REQUEST['action']!='view'){ echo 'checked="checked"'; } ?> <?php if($_REQUEST['action']=='view') { echo 'disabled'; } ?> /></td>
</tr>
<tr>
<td height="30" colspan="7" align="center">
<?php 
$submitName = 'SubmitAdminUser';
$fileName   = 'AdminUser';
include_once('opt_Table.php'); ?>
<input type="hidden" id="formname" name="formname" value="AdminUserForm" />
<input type="hidden" id="ModuleId" name="ModuleId" value="<?php echo $ModuleId ?>" />
<input type="hidden" id="fileName" name="fileName" value="<?php echo $fileName ?>" />
<input type="hidden" id="startdata" name="startdata" value="<?php echo $_REQUEST['startdata'] ?>" />
<input type="hidden" id="hidSearchFilterFieldList" name="hidSearchFilterFieldList" value="<?php echo $_REQUEST['SearchFilterFieldList'] ?>" />
<input type="hidden" id="hidSearchFilterField" name="hidSearchFilterField" value="<?php echo $_REQUEST['SearchFilterField'] ?>" /></td>
</tr>
</table>
</form>
</td>
</tr>
<tr><td align="center">&nbsp;
</td></tr>
<tr>
<td>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td align="left" class="feildstxt"><strong>Filter</strong></td>
<td align="right"><span class="feildstxt">User Name :</span><span id="FilterFieldList"><input type="hidden" name="SearchFilterFieldList" id="SearchFilterFieldList" value="UserName" /></span><span id="FilterField"><input type="text" name="SearchFilterField" id="SearchFilterField" value="<?php $_REQUEST['SearchFilterField'] = (isset($_REQUEST['SearchFilterField']) ? $_REQUEST['SearchFilterField'] : ''); echo $_REQUEST['SearchFilterField']; ?>" class="input"/></span><span>&nbsp;&nbsp;<input type="button" name="SearchFilter" id="SearchFilter" value="Search Filter" onclick="return OnChangeFilterElement('SearchFilterField','<?php echo $ModuleId;?>','Bl_AdminUser');"/></span></td>
</tr>
</table>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td align="left" valign="top">
<div id="DetailList">
<?php $_REQUEST['optid'] = (isset($_REQUEST['optid']) ? $_REQUEST['optid'] : '');
$optId = $_REQUEST['optid'];
$all_Sql = "Select DISTINCT a.Admin_Id, a.AdminUser_Name, b.Role_Name, a.AdminUser_Status From ".TABLE_ADMINUSER." a LEFT JOIN ".TABLE_ROLE." b ON a.AdminUser_Role=b.Id ";
$orderBy = ' a.Admin_Id ';
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='UserName')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.AdminUser_Name like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if(isset($WhereCont) && !empty($WhereCont))
if($WhereCont=='')
$WhereCont = ' where 1';
$gridHead = 'Admin User Details';
$colHead  = array("Sl.No.", "User Name", "User Role", "Status", "Action");
include_once('five_col_grid.php');
?>
</div>
</td>
</tr>
</table>
</div>
