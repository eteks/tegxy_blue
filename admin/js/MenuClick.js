// JavaScript Document

function createXmlObject() 
{
	if (window.XMLHttpRequest) 
	{
		xmlhttp = new XMLHttpRequest();
	} 
	else if(window.ActiveXObject) 
	{
		xmlhttp = new ActiveXObject("MSXML2.XMLHTTP");
	}
}
///////////////////////Ajax For Scroll Menu////////////////////////////////

function OnclickMenu(obj,Extra,obj1,startdata,optid)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	/* var ModuleId=document.getElementById('ModuleId').value; */
	if (startdata != undefined)
		str = "s="+obj+"&ModuleId="+Extra+"&startdata="+startdata+"&optid="+optid+"&r="+ran_number;
	else
		str = "s="+obj+"&ModuleId="+Extra+"&optid="+optid+"&r="+ran_number;
		
	var url = ""+obj1+".php";
	//alert(url+'?'+str); 
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = showNetDisplay
}
function OnclickMenu_Edit(obj,Extra,obj1,startdata,optid,SearchFilterFieldList,SearchFilterField)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	/* var ModuleId=document.getElementById('ModuleId').value; */
	if (startdata != undefined)
		str = "s="+obj+"&ModuleId="+Extra+"&startdata="+startdata+"&optid="+optid+"&SearchFilterFieldList="+SearchFilterFieldList+"&SearchFilterField="+SearchFilterField+"&r="+ran_number;
	else
		str = "s="+obj+"&ModuleId="+Extra+"&optid="+optid+"&SearchFilterFieldList="+SearchFilterFieldList+"&SearchFilterField="+SearchFilterField+"&r="+ran_number;
		
	var url = ""+obj1+".php";
	// alert(url+'?'+str); 
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = showNetDisplay
}
function showNetDisplay() 
{
	if (xmlhttp.readyState == 4) 
	{
	var response = xmlhttp.responseText;
		if (response != "") 
		{
			document.getElementById('ScrollText').innerHTML=response;
		}
	}
}

function OnClickLeftNavigation(str,str1)
{
	document.getElementById('networkBarPopup').style.display='block';
	for(var i=1;i<=parseFloat(str1);i++)
	{
		var ModuleCat = 'ModuleCat'+i;
		var ModuleCat_scr = 'ModuleCat'+i+'_scr';
		if(i==parseFloat(str))
		{
			document.getElementById(ModuleCat).style.display='block';	
			document.getElementById(ModuleCat_scr).style.display='block';
			document.getElementById('MainMenuNavigation'+i).style.color='#00cc00';	
		}
		else
		{
			document.getElementById(ModuleCat).style.display='none';	
			document.getElementById(ModuleCat_scr).style.display='none';
			document.getElementById('MainMenuNavigation'+i).style.color='white';	
		}
	}
	//fullscreeneventchange('in');
}
