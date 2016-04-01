// JavaScript Document
function BestDealsView(Type)
{
	
	createXmlObject();
	DocId('BDType').value=Type;
	var	Caty = DocId('BCategory').value;
	var SubCaty = DocId('BSubCategory').value;
	var LogIdd = DocId('LogIdd').value;
	var SearchText=DocId('SearchArea').value;
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "Type="+Type+"&SearchText="+SearchText+"&Caty="+Caty+"&SubCaty="+SubCaty+"&LogIdd="+LogIdd+"&r="+ran_number;
	var url = "include/BlModules/Bl_BestDealsView.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowBestDealsView
}

function ShowBestDealsView()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
		DocId('Bestdealslist').innerHTML=response;
		}
	}
}

function BestDealsSearch()
{
	
	createXmlObject();
	var Type = DocId('BDType').value;
	var SearchText=DocId('SearchArea').value;
	var	Caty = DocId('BCategory').value;
	var SubCaty = DocId('BSubCategory').value;
	var LogIdd = DocId('LogIdd').value;
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "Type="+Type+"&SearchText="+SearchText+"&Caty="+Caty+"&SubCaty="+SubCaty+"&LogIdd="+LogIdd+"&r="+ran_number;
	var url = "include/BlModules/Bl_BestDealsView.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowBestDealsSearch
}

function ShowBestDealsSearch()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
		DocId('Bestdealslist').innerHTML=response;
		}
	}
}

function BestDealsReset()
{
	DocId('SearchArea').value='';
	var Type = DocId('BDType').value;
	DocId('BCategory').value='';
	DocId('BSubCategory').value='';
	BestDealsView(Type);
}

function BestDealsFilter(Id)
{
	
	createXmlObject();

	var data    = Id.split('_');
	var Caty    = data[0]; 
	var SubCaty = data[1];  
	var Type = DocId('BDType').value;
	DocId('BCategory').value=Caty ;
	DocId('BSubCategory').value=SubCaty;
	var LogIdd = DocId('LogIdd').value;
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "Type="+Type+"&Caty="+Caty+"&SubCaty="+SubCaty+"&LogIdd="+LogIdd+"&r="+ran_number;
	var url = "include/BlModules/Bl_BestDealsView.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowBestDealsFilter
}

function ShowBestDealsFilter()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
		DocId('Bestdealslist').innerHTML=response;
		}
	}
}

function GalaryViewPage(startData)
{
	createXmlObject();
	var LogIdd = DocId('GLogIdd').value;
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	DocId('GalStartData').value = startData;
	var str = "LogIdd="+LogIdd+"&startdata="+startData+"&r="+ran_number;
	var url = "include/BlModules/Bl_GalleryView.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowGalaryViewPage
}

function ShowGalaryViewPage()
{
if (xmlhttp.readyState == 4) 
	{
	var response = xmlhttp.responseText;
	if (response != "") 
	{ 
	DocId('GalleryGrid').innerHTML=response;
	}
}
}
  

function BDViewPage(startData)
{
	createXmlObject();
	var Type = DocId('BDType').value;
	var SearchText=DocId('SearchArea').value;
	var	Caty = DocId('BCategory').value;
	var SubCaty = DocId('BSubCategory').value;
	var LogIdd = DocId('LogIdd').value;
	DocId('BDStartData').value = startData;
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "Type="+Type+"&SearchText="+SearchText+"&Caty="+Caty+"&SubCaty="+SubCaty+"&LogIdd="+LogIdd+"&startdata="+startData+"&r="+ran_number;
	var url = "include/BlModules/Bl_BestDealsView.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowBDViewPage
}

function ShowBDViewPage()
{
if (xmlhttp.readyState == 4) 
	{
	var response = xmlhttp.responseText;
	if (response != "") 
	{ 
	DocId('Bestdealslist').innerHTML=response;
	}
}
}

function EventsViewPage(startData)
{
	createXmlObject();
	var LogIdd = DocId('ELogIdd').value;
	DocId('EventStartData').value = startData;
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "LogIdd="+LogIdd+"&startdata="+startData+"&r="+ran_number;
	var url = "include/BlModules/Bl_EventsView.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowEventsViewPage
}

function ShowEventsViewPage()
{
if (xmlhttp.readyState == 4) 
	{
	var response = xmlhttp.responseText;
	if (response != "") 
	{ 
	DocId('EventsGrid').innerHTML=response;
	}
}
}

function ProfileViewGrid(page)
{
    alert(page);
$("#Profile_View_Grid").load(page);	
alert($("#Profile_View_Grid").html());
}
