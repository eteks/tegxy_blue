// JavaScript Document
function AdminUserSubMenuListAll(str,str1,refer)
{ 
	if(str!='' && str1!='')
	{
		if(document.getElementById('SubMenuSelectAll'+str+'_'+str1).checked==true)
		{
			var str3=true;
		}
		else
		{
			var str3=false;
			document.getElementById('OverallMainMenuCheckAll').checked=false;
			document.getElementById('OverallSubMenuCheckAll'+str).checked=false;
			document.getElementById('SubMenuSelectAll'+str+'_'+str1).checked=false;
		}
		document.getElementById('SubMenu_1_'+str+'_'+str1).checked=str3;
		document.getElementById('SubMenu_2_'+str+'_'+str1).checked=str3;
		document.getElementById('SubMenu_3_'+str+'_'+str1).checked=str3;
		document.getElementById('SubMenu_4_'+str+'_'+str1).checked=str3;
		document.getElementById('SubMenuSelectAll'+str+'_'+str1).checked=str3;
		if(str3==true)
		{
			if(refer!='All')
			{
				var checktrueselection = CheckSelectionTrueSubmainList(str);
			}
		}
	}
}

function AdminUserSubMenuAll(str,refer)
{
	if(str!='')
	{
		var str3= parseFloat(document.getElementById('OverallSubMenuCount'+str).value);
		if(document.getElementById('OverallSubMenuCheckAll'+str).checked==true)
		{
			str4=true;
		}
		else
		{
			str4=false;
			document.getElementById('OverallMainMenuCheckAll').checked=false;
		}
		for(var i=1;i<=str3;i++)
		{
			document.getElementById('SubMenuSelectAll'+str+'_'+i).checked=str4;
			var str5 = AdminUserSubMenuListAll(str,i,'All');
		}
		if(str4==true)
		{
			if(refer!='All')
			{
				var checktrueselection = CheckSelectionTrueSubmain();
			}
		}
	}
}

function AdminUserMenuMenuAll(refer)
{
	var str3= parseFloat(document.getElementById('OverallMainMenuCount').value);
	if(document.getElementById('OverallMainMenuCheckAll').checked==true)
	{
		str4=true;
	}
	else
	{
		str4=false;
	}
	for(var i=1;i<=str3;i++)
	{
		document.getElementById('OverallSubMenuCheckAll'+i).checked=str4;
		var str5 = AdminUserSubMenuAll(i,'All');
	}
}

function CheckSelectionTrueSubmain()
{
	var j=0;
	var str = document.getElementById('OverallMainMenuCount').value	;
	for(var i=1;i<=str;i++)
	{
		if(document.getElementById('OverallSubMenuCheckAll'+i).checked==false)
		{
			var j=1;
			break;	
		}
	}
	if(j==0)
	{
		document.getElementById('OverallMainMenuCheckAll').checked=true;
	}
	else
	{
		document.getElementById('OverallMainMenuCheckAll').checked=false;
	}
}
function CheckSelectionTrueSubmainList(str2)
{
	var j=0;
	var str= parseFloat(document.getElementById('OverallSubMenuCount'+str2).value);
	for(var i=1;i<=str;i++)
	{
		if(document.getElementById('SubMenuSelectAll'+str2+'_'+i).checked==false)
		{
			var j=1;
			break;	
		}
	}
	if(j==0)
	{
		document.getElementById('OverallSubMenuCheckAll'+str2).checked=true;
	}
	else
	{
		document.getElementById('OverallSubMenuCheckAll'+str2).checked=false;
	}
	var OverSubMenuCheck = CheckSelectionTrueSubmain();
}
function AdminUserSubMenuList(str,str1,str2)
{
	/*if(document.getElementById('SubMenu_'+str2+'_'+str+'_'+str1).checked==true)
	{
		var str3=1;	
	}
	else
	{
		var str3=0;
	}*/
	var j=0;
	for(var i=1;i<=4;i++)
	{
		if(document.getElementById('SubMenu_'+i+'_'+str+'_'+str1).checked==false)
		{
			var j=1;
			break;	
		}
	}
	if(j==0)
	{
		document.getElementById('SubMenuSelectAll'+str+'_'+str1).checked=true;
	}
	else
	{
		document.getElementById('SubMenuSelectAll'+str+'_'+str1).checked=false;
	}
	CheckSelectionTrueSubmainList(str);
}

function OnchangeAdminUserRole(str1,str2)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
		
	var AdminRole = document.getElementById('AdminRole').value;

	var str = "action=AdminRole&action1="+str2+"&RoleId="+AdminRole+"&r="+ran_number;
	var url = "include/BlModules/Bl_Authentication.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = showOnchangeAdminUserRole
}
function showOnchangeAdminUserRole() 
{ 
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			var SplitResponse = response.split('######');
			if(SplitResponse[0]!='' && SplitResponse[0]!=undefined)
			{
				document.getElementById('AdminUserListOption').innerHTML = SplitResponse[0];
			}
		}
	}
}

function AdminUserPermissionDetails(str1)
{	
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
		
	var str = "action=AdminRoleDetail&AdminID="+str1+"&r="+ran_number;
	var url = "include/BlModules/Bl_Authentication.php";

	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = showAdminUserPermissionDetails
}
function showAdminUserPermissionDetails() 
{ 
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			var SplitResponse = response.split('######');
			if(SplitResponse[1]!='' && SplitResponse[1]!=undefined)
			{
				document.getElementById('AdminUserPermissionListDetails').innerHTML = SplitResponse[1];
			}
		}
	}
}
function ValidateFormAdminUserPermission()
{
	if(document.getElementById('AdminRole').value=='')
	{
		//document.getElementById('msg_content').innerHTML='Please Select Admin User';
		alert('Please Select Admin Role');
		document.getElementById('AdminRole').focus();
		return false;
	}
	if(document.getElementById('AdminUser').value=='')
	{
		//document.getElementById('msg_content').innerHTML='Please Select Admin User';
		alert('Please Select Admin User');
		document.getElementById('AdminUser').focus();
		return false;
	}
	document.getElementById('msg_content').innerHTML='';
}



