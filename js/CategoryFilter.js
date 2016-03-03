								
$(document).click(function(){
$("#"+AjaxResponsee).fadeOut('slow');
});

$("#"+DataGett).focus(function() {this.val=''; });
$("#"+DataGett).keyup(function(event){
var IndustryList = $("#IndustryList").val();
if(IndustryList=='')
{
alert("Please Select Industry");
$("#ProductName").val('');
return false;	
}
var searchbox = $("#"+DataGett).val();
if(searchbox.length)
{
$("#"+ClearData).val('');
$("#"+CAjaxResponsee).fadeOut('slow');
$("#"+DataShow1).val('');
$("#"+DataShow2).val('');
$("#"+DataShow3).val('');

if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13 && event.keyCode != 32)
{
$("#loading").css("visibility","visible");
getUrl = "include/BlModules/"+File+"?ind="+IndustryList;                   
$.ajax({
type: "POST",
url: getUrl,
data: "data="+searchbox,
success: function(msg){	
if(msg != 0)
$("#"+AjaxResponsee).fadeIn("slow").html(msg);
else
{
$("#"+AjaxResponsee).fadeIn("slow");	
$("#"+AjaxResponsee).html('<div style="text-align:left;font-family:verdana;font-size:11px;width:200px;padding:2px 4px;">No Matches Found</div>');
}
$("#loading").css("visibility","hidden");
}
});
$("#"+AjaxResponsee).scrollTop(0);
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
$("#"+AjaxResponsee+ " li").each(function(){
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
var sel = $("#"+AjaxResponsee+ " li[class='selected']");
sel.next().addClass("selected");
sel.removeClass("selected");

if (downLiSel > 3)
{
divTop = (downLiSel-3) * 17;
if (divTop < 0) divTop = 0;
$("#"+AjaxResponsee).scrollTop(divTop); 
}
else $("#"+AjaxResponsee).scrollTop(0); 
}
else{
$("#"+AjaxResponsee+ " li:first").addClass("selected");
$("#"+AjaxResponsee).scrollTop(0);
}
}
break;
case 38:
{
$("#"+AjaxResponsee).scrollTop(divTop);

found = 0;
flg = true;
upLiSel = 1;
$("#"+AjaxResponsee+ " li").each(function(){
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
var sel = $("#"+AjaxResponsee+ " li[class='selected']");
sel.prev().addClass("selected");
sel.removeClass("selected");

if (upLiSel > 3)
{
divTop = (upLiSel-3) * 17;
if (divTop < 0) divTop = 0;
$("#"+AjaxResponsee).scrollTop(divTop); 
}
else $("#"+AjaxResponsee).scrollTop(0);
}
else {
$("#"+AjaxResponsee+ " li:last").addClass("selected");
divTop = $("#"+AjaxResponsee+ " ul").height() - (3 * 17);
if (divTop < 0) divTop = 0;
$("#"+AjaxResponsee).scrollTop(divTop); 
}
}
break;
case 13:
$("#"+AjaxResponsee).fadeOut("slow");
$("#"+DataGett).val($("#"+AjaxResponsee+ " li[class='selected'] a").text());

var dataa = $("#"+AjaxResponsee+ " li[class='selected'] a").text();
var resdata = dataa.split('**');
$("#"+DataGett).val(resdata[0]);
$("#"+DataShow1).val(resdata[1]);
$("#"+DataShow2).val(resdata[2]);
$("#"+DataShow3).val(resdata[3]);
$("#"+AjaxResponsee).fadeOut("slow");

break;
}
}
}
else {
$("#"+AjaxResponsee).fadeOut("slow");
}

});
$("#"+AjaxResponsee).mouseover(function(){
$(this).find("li a:first-child").mouseover(function () {
$(this).addClass("selected");
});
$(this).find("li a:first-child").mouseout(function () {
$(this).removeClass("selected");
});
$(this).find("li a:first-child").click(function () {

var dataa = $(this).text();
var resdata = dataa.split('**');
$("#"+DataGett).val(resdata[0]);
$("#"+DataShow1).val(resdata[1]);
$("#"+DataShow2).val(resdata[2]);
$("#"+DataShow3).val(resdata[3]);
$("#"+AjaxResponsee).fadeOut("slow");
});
});