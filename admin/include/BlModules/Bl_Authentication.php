<?php 

if($_REQUEST['btnAutsave']=='Submit')
echo "<script>var serty=OnclickMenu('0','".$ModuleId."','Authentication');</script>";

if($_REQUEST['action']=='AdminRole')
{
	include_once("../Configuration.php");
	include_once("../DatabaseConnection.php");
	db_connect();

	if($_REQUEST['action1']=='Role')
	{ ?><select id="AdminUser" name="AdminUser" class="dropdown" onchange="return AdminUserPermissionDetails(this.value);"><option value="" title="Select User">--Select User--</option><?php
		if($_REQUEST['RoleId']!='')
		{
			$WhereCond="where `AdminUser_Role`='".$_REQUEST['RoleId']."' ";
		}
		else
		{
			$WhereCond="where 1";
		}
		$AdminUserList="Select `AdminUser_Name`,`Admin_Id` From ".TABLE_ADMINUSER." ".$WhereCond." order by AdminUser_Name Asc ";
		$AdminUserList_Qry=db_query($AdminUserList);
		$AdminUserList_Num=@db_num_rows($AdminUserList_Qry);
		if($AdminUserList_Num>0)
		{	
			while($AdminUserList_Ftch = db_fetch_array($AdminUserList_Qry))
			{ ?>
				<option value="<?php echo $AdminUserList_Ftch['Admin_Id'];?>" title="<?php echo $AdminUserList_Ftch['AdminUser_Name'];?>"><?php echo $AdminUserList_Ftch['AdminUser_Name']; ?></option><?php 
			}
		} ?></select><?php exit;
	}
}
if($_REQUEST['action']=='AdminRoleDetail')
{
	include_once("../Configuration.php");
	include_once("../DatabaseConnection.php");
	db_connect();
	if($_REQUEST['AdminID']!='')
	{
		$SelectAdminUserPermission = "Select `AdminUser_fk`,ModuleCategory_fk,ModuleList_fk,ModuleList from ".TABLE_ADMINUSERPERMISSION." WHERE AdminUser_fk='".$_REQUEST['AdminID']."'";
		$SelectAdminUserPermission_Qry = @db_query($SelectAdminUserPermission);
		$SelectAdminUserPermission_Num = @db_num_rows($SelectAdminUserPermission_Qry);
		if($SelectAdminUserPermission_Num>0)
		{
			while($SelectAdminUserPermission_Ftch = db_fetch_array($SelectAdminUserPermission_Qry))
			{
				$AdminPermission[$SelectAdminUserPermission_Ftch['ModuleCategory_fk']][$SelectAdminUserPermission_Ftch['ModuleList_fk']][$SelectAdminUserPermission_Ftch['ModuleList']]='1';					
			}
		}
	}
	
	?>######<table cellpadding="0" cellspacing="0" width="90%" align="center" style="color:#FFFFFF;">
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
                                    <td align="left" class="gridtxt">&nbsp;&nbsp;<?php echo $SelectModuleList_Ftch[1];?></td>
									<?php 
									$SectionCount=0;
                                    for($i=1;$i<=4;$i++)
                                    { 
									if($AdminPermission[$SelectMainModule_Ftch['ModuleCategory_pk']][$SelectModuleList_Ftch['ModuleList_pk']][$i]=='1')
									{
										$Checked='Checked';
										$SectionCount++;
									}	
									else
									{
										$Checked='';	
									} 
									?>                                    
                                    <td align="left" class="gridtxt">&nbsp;&nbsp;<input type="checkbox" class="inputchk" name="SubMenu_<?php echo $i.'_'.$MainSlNo.'_'.$SubSlNo;?>" id="SubMenu_<?php echo $i.'_'.$MainSlNo.'_'.$SubSlNo;?>" value="<?php echo $SelectMainModule_Ftch['ModuleCategory_pk'].'_'.$SelectModuleList_Ftch['ModuleList_pk'].'_'.$i;?>" onclick="return AdminUserSubMenuList('<?php echo $MainSlNo;?>','<?php echo $SubSlNo;?>','<?php echo $i;?>')" <?php echo $Checked; ?>/></td><?php
                                    } 
									if($SectionCount=='4'){ $Checked1='Checked';} else { $Checked1=''; }?>
                                    <td align="left" class="gridtxt">&nbsp;&nbsp;<input type="checkbox" class="inputchk" name="SubMenuSelectAll<?php echo $MainSlNo.'_'.$SubSlNo;?>" id="SubMenuSelectAll<?php echo $MainSlNo.'_'.$SubSlNo;?>" value="5" onclick="return AdminUserSubMenuListAll('<?php echo $MainSlNo;?>','<?php echo $SubSlNo;?>','');" <?php echo $Checked1;?> /><input type="hidden" name="InsertPer" id="InsertPer" value="InsertPerVal" /></td>
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
    </table><?php
}
if($_REQUEST['btnAutsave']=='Submit')
{
	if($_REQUEST['AdminUser'])
	{
		$DeleteAdminUserPermission = "Delete from ".TABLE_ADMINUSERPERMISSION." where AdminUser_fk='".$_REQUEST['AdminUser']."'";
		$DeleteAdminUserPermission_Qry = db_query($DeleteAdminUserPermission);
	}

		
	for($i=1;$i<=$_REQUEST['OverallMainMenuCount'];$i++)
	{
		for($j=1;$j<=$_REQUEST['OverallSubMenuCount'.$i];$j++)
		{
			for($k=1;$k<=4;$k++)
			{
				if($_REQUEST['SubMenu_'.$k.'_'.$i.'_'.$j]!='')
				{
					$explodeValue = @explode('_',$_REQUEST['SubMenu_'.$k.'_'.$i.'_'.$j]);
					$insertAdminUserPermisssion = "Insert Into ".TABLE_ADMINUSERPERMISSION." SET AdminUser_fk='".$_REQUEST['AdminUser']."' ,ModuleCategory_fk='".$explodeValue[0]."',ModuleList_fk='".$explodeValue[1]."',ModuleList='".$explodeValue[2]."',Created_by='".$_SESSION['Admin_Id']."',Created_on=NOW()";
					$insertAdminUserPermisssion_Qry = db_query($insertAdminUserPermisssion);
				}
			}			
		}	
	}
	echo "<script type='text/javascript' language='javascript'>var serty=OnclickMenu('5','".$ModuleId."','Authentication');</script>";
} ?>

