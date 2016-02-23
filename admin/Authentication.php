<?php include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();

$PageName = basename($_SERVER['SCRIPT_FILENAME'],'.php');
if(!isset($_SESSION['Admin_Id']))
header("location:Login.php");
?>
<div id="ScrollText" style="overflow:auto;">
<form method="post" name="FormAdminUserPermission" id="FormAdminUserPermission" onsubmit="return ValidateFormAdminUserPermission();">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
<td align="left" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="9" align="left" valign="top"><img src="images/gridbox/title_l_bg.gif" width="9" height="29" /></td>
<td align="left" valign="top" class="title">Authentication</td>
</tr>
</table>
</td>
</tr>
<tr><td colspan="3" height="8"></td></tr>
<tr>
<td colspan="3">
<table cellpadding="0" cellspacing="0" border="0" align="center" width="80%">
<tr>
<td colspan="3" align="center"><div id="msg_content"><?php if($_REQUEST['s']==5){ ?> Permission set for the user Successfully! <?php } ?></div></td>
</tr>
<tr><td colspan="3" align="center">&nbsp; </td></tr>
<tr>
<td class="feildstxt" align="center" >&nbsp;Admin Role&nbsp;</td>
<td> : </td>
<td><select name="AdminRole" id="AdminRole"  class="dropdown" onchange="return OnchangeAdminUserRole(this.value,'Role');"><option value="">- Select -</option><?php	
$queryRole = db_query("Select * from ".TABLE_ROLE." where Status='1'");
$numRole = @db_num_rows($queryRole);
if($numRole>0)
{	
while($fetchRole = db_fetch_array($queryRole))
{?>
<option value="<?php echo $fetchRole['Id'];?>" <?php if(isset($FetchType) && !empty($FetchType)) if($FetchType['Role']==$fetchRole['Id']) {?> selected="selected" <?php } ?> title="<?php echo $fetchRole['Role_Name'];?>" ><?php echo $fetchRole['Role_Name'];?></option><?php 
}
}?></select>
</td>
</tr>
<tr><td colspan="3" align="center">&nbsp; </td></tr>
<tr>
<td class="feildstxt" align="center">&nbsp;User&nbsp;</td>
<td> : </td>
<td  align="left"><span id="AdminUserListOption"><select id="AdminUser" name="AdminUser" class="dropdown" onchange="return AdminUserPermissionDetails(this.value);"><option value="">--Select--</option></select></span>						
</td>
<td>&nbsp;</td>
</tr>

</table>
</td>
</tr>
<tr><td colspan="3" align="center">&nbsp; </td></tr>
<tr>
<td colspan="3" class="FromInputTD">
<div id="AdminUserPermissionListDetails" >
<table cellpadding="0" cellspacing="0" width="90%" align="center">
<tr><td class="title"><b>Permissions&nbsp; :</b></td></tr>
<tr><td height="8"></td></tr>
<tr>
<td>
<table cellpadding="0" cellspacing="0" width="100%" align="center"  class="tdmsg">
<tr>
<td class="gridtxt" colspan="2"><?php
$SelectMainModule_Qry=db_query("Select ModuleCategory_pk,ModuleCategory_Name FROM ".TABLE_MODULECATEGORY." Where ModuleCategory_Status=1");
$MainSlNo=1;	$SelectMainModule_Num=db_num_rows($SelectMainModule_Qry); ?>
<input type="hidden" name="OverallMainMenuCount" id="OverallMainMenuCount"  value="<?php echo $SelectMainModule_Num; ?>"/>
<input type="checkbox" class="inputchk" name="OverallMainMenuCheckAll" id="OverallMainMenuCheckAll" value="1" onclick="return AdminUserMenuMenuAll('All');" />&nbsp;SelectAll&nbsp;
</td>
</tr>
<tr><td height="8" colspan="2"></td></tr><?php 
while($SelectMainModule_Ftch=db_fetch_array($SelectMainModule_Qry))
{ 
$SelectModuleList_Qry = db_query("Select `ModuleList_pk`,`ModuleList_name` from ".TABLE_MODULECATEGORYLIST." where ModuleList_fk='".$SelectMainModule_Ftch['ModuleCategory_pk']."' and ModuleList_status='1'");
$SelectModuleList_Num = @db_num_rows($SelectModuleList_Qry);
$ViewCheck='';$AddCheck='';$EditCheck='';$DeleteCheck=''; ?>
<tr>
<td align="left" class="feildstxt" width="250"><b class="SubHeading"><?php echo $SelectMainModule_Ftch[1];?></b></td>
<td align="left" class="feildstxt" nowrap="nowrap">&nbsp;&nbsp;&nbsp;<input type="hidden" name="OverallSubMenuCount<?php echo $MainSlNo;?>" id="OverallSubMenuCount<?php echo $MainSlNo;?>"  value="<?php echo $SelectModuleList_Num; ?>"/><input type="checkbox" class="inputchk" name="OverallSubMenuCheckAll<?php echo $MainSlNo;?>" id="OverallSubMenuCheckAll<?php echo $MainSlNo;?>" onclick="return AdminUserSubMenuAll('<?php echo $MainSlNo;?>','<?php echo $MainSlNo;?>','')"/>&nbsp;&nbsp;&nbsp;Select All&nbsp;</td>
</tr>
<tr>
<td colspan="2">
<table cellpadding="0" cellspacing="1" border="0" width="100%"><?php
if($SelectModuleList_Num>0)
{ ?>
<tr>
<th align="left" class="gridtxt" width="250">&nbsp;Module Name</th>
<th align="left" class="gridtxt">&nbsp;View</th>
<th align="left" class="gridtxt">&nbsp;Add</th>
<th align="left" class="gridtxt">&nbsp;Edit</th>
<th align="left" class="gridtxt" width="100">&nbsp;Delete</th>
<th align="left" class="gridtxt">&nbsp;Select All</th>
</tr><?php $SubSlNo=1;
while($SelectModuleList_Ftch=db_fetch_array($SelectModuleList_Qry))
{ ?>                                
<tr>
<td align="left" class="gridtxt">&nbsp;&nbsp;<?php echo $SelectModuleList_Ftch[1];?></b></td><?php
for($i=1;$i<=4;$i++)
{ 
    if(isset($SelectAdminUserPermission) && !empty($SelectAdminUserPermission))
if($AdminPermission[$SelectAdminUserPermission_Ftch['ModuleCategory_fk']][$SelectMainModule_Ftch['ModuleList_pk']][$i]=='1')
$Checked='Checked';	
else
$Checked='';	
 ?>                                    
<td align="left" class="gridtxt">&nbsp;&nbsp;<input type="checkbox" class="inputchk" name="SubMenu_<?php echo $i.'_'.$MainSlNo.'_'.$SubSlNo;?>" id="SubMenu_<?php echo $i.'_'.$MainSlNo.'_'.$SubSlNo;?>" value="<?php echo $SelectMainModule_Ftch['ModuleCategory_pk'].'_'.$SelectModuleList_Ftch['ModuleList_pk'].'_'.$i;?>" onclick="return AdminUserSubMenuList('<?php echo $MainSlNo;?>','<?php echo $SubSlNo;?>','<?php echo $i;?>')" <?php if(isset($Checked) && !empty($Checked)) echo $Checked; ?>/></td><?php
} ?>
<td align="left" class="gridtxt">&nbsp;&nbsp;<input type="checkbox" class="inputchk" name="SubMenuSelectAll<?php echo $MainSlNo.'_'.$SubSlNo;?>" id="SubMenuSelectAll<?php echo $MainSlNo.'_'.$SubSlNo;?>" value="5" onclick="return AdminUserSubMenuListAll('<?php echo $MainSlNo;?>','<?php echo $SubSlNo;?>','');" /><input type="hidden" name="InsertPer" id="InsertPer" value="InsertPerVal" /></td>
</tr><?php $SubSlNo++;
} 
}?>
</table>
</td>
</tr><?php $MainSlNo++;
} ?>
</table>
</td>
</tr>
</table>    
</div>
</td>
</tr>
<tr><td colspan="3" height="8"></td></tr>
<tr>
<td colspan="3" align="center">
<div id="submithidedisplay" >
<input type="hidden" name="formname" id="formname" value="Authenticationform" />
<input name="btnAutsave" type="submit"  id="btnAutsave" value="Submit" class="menu" style="cursor:pointer" />&nbsp;&nbsp;
<input name="btnreset" type="button"  id="btnreset" value="Reset" class="menu"  onclick="return OnclickMenu('0','<?php echo $ModuleId;?>','Authentication');" style="cursor:pointer"/>&nbsp;&nbsp;<input name="btnsubmit" type="button"  class="menu" id="btnreset" value="Cancel"  style="outline:none; cursor:pointer;" onclick="return cancelpage();">
<input type="hidden" value="Submit" name="TxtSubmit" id="TxtSubmit"  />
</div>
</td>
</tr>				
<tr><td colspan="3" height="8"></td></tr>
<tr><td >&nbsp;</td></tr>
</table>
</form>
</div>		
