								
$(document).click(function(){
$("#"+SpAjaxResponsee).fadeOut('slow');
});

$("#"+SpDataGett).focus(function() {this.val=''; });
$("#"+SpDataGett).keyup(function(event){
	
var searchbox = $("#"+SpDataGett).val();
if(searchbox.length)
{
if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13 && event.keyCode != 32)
{
$("#loading").css("visibility","visible");
getUrl = "include/BlModules/"+SpFile;                   
$.ajax({
type: "POST",
url: getUrl,
data: "data="+searchbox,
success: function(msg){	
if(msg != 0)
$("#"+SpAjaxResponsee).fadeIn("slow").html(msg);
else
{
$("#"+SpAjaxResponsee).fadeIn("slow");	
$("#"+SpAjaxResponsee).html('<div style="text-align:left;font-family:verdana;font-size:11px;width:200px;padding:2px 4px;">No Matches Found</div>');
}
$("#loading").css("visibility","hidden");
}
});
$("#"+SpAjaxResponsee).scrollTop(0);
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
$("#"+SpAjaxResponsee+ " li").each(function(){
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
var sel = $("#"+SpAjaxResponsee+ " li[class='selected']");
sel.next().addClass("selected");
sel.removeClass("selected");

if (downLiSel > 3)
{
divTop = (downLiSel-3) * 17;
if (divTop < 0) divTop = 0;
$("#"+SpAjaxResponsee).scrollTop(divTop); 
}
else $("#"+SpAjaxResponsee).scrollTop(0); 
}
else{
$("#"+SpAjaxResponsee+ " li:first").addClass("selected");
$("#"+SpAjaxResponsee).scrollTop(0);
}
}
break;
case 38:
{
$("#"+SpAjaxResponsee).scrollTop(divTop);

found = 0;
flg = true;
upLiSel = 1;
$("#"+SpAjaxResponsee+ " li").each(function(){
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
var sel = $("#"+SpAjaxResponsee+ " li[class='selected']");
sel.prev().addClass("selected");
sel.removeClass("selected");

if (upLiSel > 3)
{
divTop = (upLiSel-3) * 17;
if (divTop < 0) divTop = 0;
$("#"+SpAjaxResponsee).scrollTop(divTop); 
}
else $("#"+SpAjaxResponsee).scrollTop(0);
}
else {
$("#"+SpAjaxResponsee+ " li:last").addClass("selected");
divTop = $("#"+SpAjaxResponsee+ " ul").height() - (3 * 17);
if (divTop < 0) divTop = 0;
$("#"+SpAjaxResponsee).scrollTop(divTop); 
}
}
break;
case 13:
$("#"+SpAjaxResponsee).fadeOut("slow");
$("#"+SpDataGett).val($("#"+SpAjaxResponsee+ " li[class='selected'] a").text());

var dataa = $("#"+SpAjaxResponsee+ " li[class='selected'] a").text();
var resdata = dataa.split('**');
$("#"+SpDataGett).val(resdata[0]);
$("#"+SpDataShow1).val(resdata[1]);
$("#"+SpAjaxResponsee).fadeOut("slow");

break;
}
}
}
else {
$("#"+SpAjaxResponsee).fadeOut("slow");
}

});
$("#"+SpAjaxResponsee).mouseover(function(){
$(this).find("li a:first-child").mouseover(function () {
$(this).addClass("selected");
});
$(this).find("li a:first-child").mouseout(function () {
$(this).removeClass("selected");
});
$(this).find("li a:first-child").click(function () {

var dataa = $(this).text();
var resdata = dataa.split('**');
$("#"+SpDataGett).val(resdata[0]);
$("#"+SpDataShow1).val(resdata[1]);
$("#"+SpAjaxResponsee).fadeOut("slow");
});
});