<?php include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script>
$(document).ready(function(){								
$(document).click(function(){
$("#ajax_search_product_response").fadeOut('slow');
});

$("#SerproductName").focus(function() {this.val=''; });
$("#SerproductName").keyup(function(event){
var searchbox = $("#SerproductName").val();
if(searchbox.length)
{
$("#ssss").val('');
if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13 && event.keyCode != 32)
{
$("#loading").css("visibility","visible");
getUrl = "include/BlModules/Bl_ADMProductList.php";                   
$.ajax({
type: "POST",
url: getUrl,
data: "data="+searchbox,
success: function(msg){	
if(msg != 0)
$("#ajax_search_product_response").fadeIn("slow").html(msg);
else
{
$("#ajax_search_product_response").fadeIn("slow");	
$("#ajax_search_product_response").html('<div style="text-align:left;font-family:verdana;font-size:11px;width:200px;padding:2px 4px;">No Matches Found</div>');
}
$("#loading").css("visibility","hidden");
}
});
$("#ajax_search_product_response").scrollTop(0);
}
else
{
switch (event.keyCode)
{
case 40:
{
found = 0;
flg = true;
downLiSel = 1;
$("#ajax_search_product_response li").each(function(){
if (flg) downLiSel = downLiSel + 1;
if($(this).attr("class") == "selected")
{
found = 1;
flg = false;
}

});
// alert('downLiSel : '+downLiSel);
if(found == 1)
{
var sel = $("#ajax_search_product_response li[class='selected']");
sel.next().addClass("selected");
sel.removeClass("selected");

if (downLiSel > 3)
{
divTop = (downLiSel-3) * 17;
if (divTop < 0) divTop = 0;
$("#ajax_search_product_response").scrollTop(divTop); 
}
else $("#ajax_search_product_response").scrollTop(0); 
}
else{
$("#ajax_search_product_response li:first").addClass("selected");
$("#ajax_search_product_response").scrollTop(0);
}
}
break;
case 38:
{
$("#ajax_search_product_response").scrollTop(divTop);

found = 0;
flg = true;
upLiSel = 1;
$("#ajax_search_product_response li").each(function(){
if($(this).attr("class") == "selected")
{
found = 1;
flg = false;
}
if (flg) upLiSel = upLiSel + 1;
});
// alert('upLiSel : '+upLiSel);
if(found == 1)
{
var sel = $("#ajax_search_product_response li[class='selected']");
sel.prev().addClass("selected");
sel.removeClass("selected");

if (upLiSel > 3)
{
divTop = (upLiSel-3) * 17;
if (divTop < 0) divTop = 0;
$("#ajax_search_product_response").scrollTop(divTop); 
}
else $("#ajax_search_product_response").scrollTop(0);
}
else {
$("#ajax_search_product_response li:last").addClass("selected");
divTop = $("#ajax_search_product_response ul").height() - (3 * 17);
if (divTop < 0) divTop = 0;
$("#ajax_search_product_response").scrollTop(divTop); 
}
}
break;
case 13:
$("#ajax_search_product_response").fadeOut("slow");
$("#SerproductName").val($("#ajax_search_product_response li[class='selected'] a").text());
$("#ajax_search_product_response").fadeOut("slow");

break;
}
}
}
else {
$("#ajax_search_product_response").fadeOut("slow");
}

});
$("#ajax_search_product_response").mouseover(function(){
$(this).find("li a:first-child").mouseover(function () {
$(this).addClass("selected");
});
$(this).find("li a:first-child").mouseout(function () {
$(this).removeClass("selected");
});
$(this).find("li a:first-child").click(function () {

var dataa = $(this).text();
var resdata = dataa.split('**');
$("#SerproductName").val(resdata[0]);
$("#ProductCateList").val(resdata[1]);
$("#ajax_search_product_response").fadeOut("slow");
});
});
});
</script>
<style type="text/css">
#ajax_search_product_response, #ajax_search_productcat_response{
border : 1px solid #8789E7;
background : #FFFFFF;
position:absolute;
display:none;
padding:2px 0px;
top:auto;
font-family :verdana;
font-size:12px;
width: 325px !important;
overflow-x: hidden;
overflow-y: auto;
height:180px;
z-index:100;
}
#ajax_search_productcat_response{
border : 2px solid #7E9DB9;
background : #FFFFFF;
position:absolute;
display:none;
padding:2px 0px;
top:auto;
font-family :verdana;
font-size:12px;
width: 616px !important;
overflow-x: hidden;
overflow-y: auto;
height:auto;
z-index:100;
}

#ajax_search_product_response .list {
width: 325px;
padding:0px 0px;
margin:0px;
list-style : none;
}
#ajax_search_productcat_response .list {
width: 616px;
padding:0px 0px;
margin:0px;
list-style : none;
}

.list li a{
text-align : left;
padding:2px 4px;
cursor:pointer;
display:block;
text-decoration : none;
color:#000000;
}

.list li a:hover{
color:#FFFFFF;
}
.selected{
background : #316AC5;
color:#FFFFFF;
}
/*.bold{
font-weight:bold;
color: #131E9F;
}*/
.ui-dropdown-trigger {
background: url("images/dpl-drop-down.png") no-repeat scroll right -1px transparent;
border: 1px solid #CCCCCC;
color: #000000 !important;
height: 16px;
padding: 0 19px 1px 0;}
#ProCategory,#ProSubCategory,#ProductType
{
width:100%;
}
/*#product-category-trigger .ui-textfield-system {
box-shadow: 0 0 0 transparent inset;
}
#commonCategoryName {
margin: 0;
width: 376px;
}
#commonCategoryName {
border: medium none;
}
.ui-dropdown-trigger {
background-color: #F7F7F7;
background-image: -moz-linear-gradient(center top , #FFFFFF, #EFEFEF);
background-repeat: repeat-x;
border-left: 1px solid #CCCCCC;
color: #666666;
height: 24px;
width: 17px;
}
.ui-textfield {
display: inline-block;
outline: medium none;
overflow: visible;
}
input, select, button {
vertical-align: middle;
}
*/
a.ahighlight
{ 
color:#0066CC; }
a:hover.ahighlight
{ 
color:#FF9900; }
</style>
<script>
$(document).ready(function(){
$(document).click(function(){
if($("#SerproductName").val()!='' && $("#ssss").val()=='')
{									
$("#ajax_search_productcat_response").fadeOut('slow');
}

});
//$("#ProCatList").focus(function() {this.val=''; });
$("#ProCatList").click(function(event){
var searchbox = $("#SerproductName").val();

//if(searchbox.length)
//{


if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13 && event.keyCode != 32)
{
$("#loading").css("visibility","visible");
getUrl = "include/BlModules/Bl_ProductCatList.php";                   
$.ajax({
type: "POST",
url: getUrl,
data: "data="+searchbox,
success: function(msg){	
if(msg != 0)
$("#ajax_search_productcat_response").fadeIn("slow").html(msg);
else
{
$("#ajax_search_productcat_response").fadeIn("slow");	
$("#ajax_search_productcat_response").html('<div style="text-align:left;font-family:verdana;font-size:11px;width:200px;padding:2px 4px;">No Matches Found</div>');
}
$("#loading").css("visibility","hidden");
}
});
$("#ajax_search_productcat_response").scrollTop(0);
}
else
{
switch (event.keyCode)
{
case 40:
{
found = 0;
flg = true;
downLiSel = 1;
$("#ajax_search_productcat_response li").each(function(){
if (flg) downLiSel = downLiSel + 1;
if($(this).attr("class") == "selected")
{
found = 1;
flg = false;
}

});
// alert('downLiSel : '+downLiSel);
if(found == 1)
{
var sel = $("#ajax_search_productcat_response li[class='selected']");
sel.next().addClass("selected");
sel.removeClass("selected");

if (downLiSel > 3)
{
divTop = (downLiSel-3) * 17;
if (divTop < 0) divTop = 0;
$("#ajax_search_productcat_response").scrollTop(divTop); 
}
else $("#ajax_search_productcat_response").scrollTop(0); 
}
else{
$("#ajax_search_productcat_response li:first").addClass("selected");
$("#ajax_search_productcat_response").scrollTop(0);
}
}
break;
case 38:
{
$("#ajax_search_productcat_response").scrollTop(divTop);

found = 0;
flg = true;
upLiSel = 1;
$("#ajax_search_productcat_response li").each(function(){
if($(this).attr("class") == "selected")
{
found = 1;
flg = false;
}
if (flg) upLiSel = upLiSel + 1;
});
// alert('upLiSel : '+upLiSel);
if(found == 1)
{
var sel = $("#ajax_search_productcat_response li[class='selected']");
sel.prev().addClass("selected");
sel.removeClass("selected");

if (upLiSel > 3)
{
divTop = (upLiSel-3) * 17;
if (divTop < 0) divTop = 0;
$("#ajax_search_productcat_response").scrollTop(divTop); 
}
else $("#ajax_search_productcat_response").scrollTop(0);
}
else {
$("#ajax_search_productcat_response li:last").addClass("selected");
divTop = $("#ajax_search_productcat_response ul").height() - (3 * 17);
if (divTop < 0) divTop = 0;
$("#ajax_search_productcat_response").scrollTop(divTop); 
}
}
break;
case 13:
$("#ajax_search_productcat_response").fadeOut("slow");
$("#ProCatList").val($("#ajax_search_productcat_response li[class='selected'] a").text());
$("#ajax_search_productcat_response").fadeOut("slow");

break;
}
}

//}
//else {
//$("#ajax_search_productcat_response").fadeOut("slow");
//}

});
$("#ajax_search_productcat_response").mouseover(function(){
$(this).find("li a:first-child").mouseover(function () {
$(this).addClass("selected");
});
$(this).find("li a:first-child").mouseout(function () {
$(this).removeClass("selected");
});
$(this).find("li a:first-child").click(function () {
$("#ProductCateList").val($(this).text());
//$("#ajax_search_productcat_response").fadeOut("slow");
});
});
});




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


function OnclickPCategory(str1)
{
createXmlObject();
var ran_unrounded=Math.random()*100000;
var ran_number=Math.floor(ran_unrounded);
var str = "Pcatid="+str1+"&r="+ran_number;
//alert(str);
var url = "include/BlModules/Bl_GeneralProductFilter.php";
xmlhttp.open("POST", url, true);  
xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
xmlhttp.send(str);
xmlhttp.onreadystatechange = showProductCategory
}

function showProductCategory() 
{ 
if (xmlhttp.readyState == 4) 
{
var response = xmlhttp.responseText;
if (response != "") 
{
var res = response.split("######");
document.getElementById('ShowProductSubCategory').innerHTML = res[0];
$("#ProductCateList").val(res[1]);

}
}
}




function OnclickPSubCategory(str1)
{
createXmlObject();
var ran_unrounded=Math.random()*100000;
var ran_number=Math.floor(ran_unrounded);
var pid=document.getElementById('ProCategory').value;
var str = "PSubcatid="+str1+"&pid="+pid+"&r="+ran_number;
//alert(str);
var url = "include/BlModules/Bl_GeneralProductFilter.php";
xmlhttp.open("POST", url, true);  
xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
xmlhttp.send(str);
xmlhttp.onreadystatechange = showProductSubCategory
}

function showProductSubCategory() 
{ 
if (xmlhttp.readyState == 4) 
{
var response = xmlhttp.responseText;
if (response != "") 
{
var res = response.split("######");
document.getElementById('ShowProductType').innerHTML = res[0];
$("#ProductCateList").val(res[1]);
}
}
}

function OnclickProductType(str1)
{
createXmlObject();
var ran_unrounded=Math.random()*100000;
var ran_number=Math.floor(ran_unrounded);
var pid=document.getElementById('ProCategory').value;
var PSubCateId=document.getElementById('ProSubCategory').value;
var str = "PType="+str1+"&PSubCateId="+PSubCateId+"&pid="+pid+"&r="+ran_number;
var url = "include/BlModules/Bl_GeneralProductFilter.php";
xmlhttp.open("POST", url, true);  
xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
xmlhttp.send(str);
xmlhttp.onreadystatechange = showProductType
}

function showProductType() 
{ 
if (xmlhttp.readyState == 4) 
{
var response = xmlhttp.responseText;
if (response != "") 
{
var res = response.split("######");
$("#ProductCateList").val(res[1]);
}
}
}


function test()
{
$("#ssss").val('t');	
searchbox='';
$("#loading").css("visibility","visible");
getUrl = "include/BlModules/Bl_ProductCatList.php";                   
$.ajax({
type: "POST",
url: getUrl,
data: "data="+searchbox,
success: function(msg){	
if(msg != 0)
$("#ajax_search_productcat_response").fadeIn("slow").html(msg);
else
{
$("#ajax_search_productcat_response").fadeIn("slow");	
$("#ajax_search_productcat_response").html('<div style="text-align:left;font-family:verdana;font-size:11px;width:200px;padding:2px 4px;">No Matches Found</div>');
}
$("#loading").css("visibility","hidden");
}
});
$("#ajax_search_productcat_response").scrollTop(0);

}

function Close(id)
{
$("#"+id).fadeOut('slow');
}
</script>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td>Product Name</td>
<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
<td><input type="text" id="SerproductName" name="SerproductName" class="memberinput" style="width:400px;border:1px solid #cccccc;" />
<div id="ajax_search_product_response"></div></td>
</tr>
<tr>
<td colspan="3">&nbsp;</td>
</tr>

<tr>
<td>Product Category</td>
<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
<td><a class="ui-dropdown-trigger" id="ProCatList"><input readonly="readonly" type="text" id="ProductCateList" name="ProductCateList" class="memberinput" style="width:380px;" /></a><div id="ajax_search_productcat_response"></div></td>
</tr>
<input type="hidden" id="ssss" />
</table>

<?php /*?><a class="ui-dropdown-trigger ui-dropdown-system" href="#" id="product-category-trigger" data-spm-anchor-id="0.0.0.0">
<input type="text" value="" onfoucs="this.blur();" name="_fmr.b._0.cat" class="ui-textfield ui-textfield-system ui-control-xl br-category" autocomplete="off" placeholder="Please select a category" id="commonCategoryName" data-widget-cid="widget-7" style="cursor: pointer;" title="Automobiles &amp; Motorcycles &gt;&gt; Body Parts &gt;&gt; Car Grills">
</a><?php */?>


