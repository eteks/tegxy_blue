								
$(document).click(function(){
$("#"+SSpAjaxResponsee).fadeOut('slow');
});

$("#"+SSpDataGett).focus(function() {this.val=''; });
$("#"+SSpDataGett).keyup(function(event){
	
var searchbox = $("#"+SSpDataGett).val();
if(searchbox.length)
{
if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13 && event.keyCode != 32)
{
$("#loading").css("visibility","visible");
getUrl = "include/BlModules/"+SSpFile;                   
$.ajax({
type: "POST",
url: getUrl,
data: "data="+searchbox,
success: function(msg){	
if(msg != 0)
$("#"+SSpAjaxResponsee).fadeIn("slow").html(msg);
else
{
$("#"+SSpAjaxResponsee).fadeIn("slow");	
$("#"+SSpAjaxResponsee).html('<div style="text-align:left;font-family:verdana;font-size:11px;width:200px;padding:2px 4px;">No Matches Found</div>');
}
$("#loading").css("visibility","hidden");
}
});
$("#"+SSpAjaxResponsee).scrollTop(0);
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
$("#"+SSpAjaxResponsee+ " li").each(function(){
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
var sel = $("#"+SSpAjaxResponsee+ " li[class='selected']");
sel.next().addClass("selected");
sel.removeClass("selected");

if (downLiSel > 3)
{
divTop = (downLiSel-3) * 17;
if (divTop < 0) divTop = 0;
$("#"+SSpAjaxResponsee).scrollTop(divTop); 
}
else $("#"+SSpAjaxResponsee).scrollTop(0); 
}
else{
$("#"+SSpAjaxResponsee+ " li:first").addClass("selected");
$("#"+SSpAjaxResponsee).scrollTop(0);
}
}
break;
case 38:
{
$("#"+SSpAjaxResponsee).scrollTop(divTop);

found = 0;
flg = true;
upLiSel = 1;
$("#"+SSpAjaxResponsee+ " li").each(function(){
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
var sel = $("#"+SSpAjaxResponsee+ " li[class='selected']");
sel.prev().addClass("selected");
sel.removeClass("selected");

if (upLiSel > 3)
{
divTop = (upLiSel-3) * 17;
if (divTop < 0) divTop = 0;
$("#"+SSpAjaxResponsee).scrollTop(divTop); 
}
else $("#"+SSpAjaxResponsee).scrollTop(0);
}
else {
$("#"+SSpAjaxResponsee+ " li:last").addClass("selected");
divTop = $("#"+SSpAjaxResponsee+ " ul").height() - (3 * 17);
if (divTop < 0) divTop = 0;
$("#"+SSpAjaxResponsee).scrollTop(divTop); 
}
}
break;
case 13:
$("#"+SSpAjaxResponsee).fadeOut("slow");
$("#"+SSpDataGett).val($("#"+SSpAjaxResponsee+ " li[class='selected'] a").text());

var dataa = $("#"+SSpAjaxResponsee+ " li[class='selected'] a").text();
var resdata = dataa.split('**');
$("#"+SSpDataGett).val(resdata[0]);
$("#"+SSpDataShow1).val(resdata[1]);
$("#"+SSpAjaxResponsee).fadeOut("slow");

break;
}
}
}
else {
$("#"+SSpAjaxResponsee).fadeOut("slow");
}

});
$("#"+SSpAjaxResponsee).mouseover(function(){
$(this).find("li a:first-child").mouseover(function () {
$(this).addClass("selected");
});
$(this).find("li a:first-child").mouseout(function () {
$(this).removeClass("selected");
});
$(this).find("li a:first-child").click(function () {

var dataa = $(this).text();
var resdata = dataa.split('**');
$("#"+SSpDataGett).val(resdata[0]);
$("#"+SSpDataShow1).val(resdata[1]);
$("#"+SSpAjaxResponsee).fadeOut("slow");
});
});