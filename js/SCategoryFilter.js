								
$(document).click(function(){
$("#"+SAjaxResponsee).fadeOut('slow');
});

$("#"+SDataGett).focus(function() {this.val=''; });
$("#"+SDataGett).keyup(function(event){
	
var searchbox = $("#"+SDataGett).val();
if(searchbox.length)
{
$("#"+SClearData).val('');
$("#"+CSAjaxResponsee).fadeOut('slow');
$("#"+SDataShow1).val('');
$("#"+SDataShow2).val('');
$("#"+SDataShow3).val('');
if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13 && event.keyCode != 32)
{
$("#loading").css("visibility","visible");
getUrl = "include/BlModules/"+SFile;                   
$.ajax({
type: "POST",
url: getUrl,
data: "data="+searchbox,
success: function(msg){	
if(msg != 0)
$("#"+SAjaxResponsee).fadeIn("slow").html(msg);
else
{
$("#"+SAjaxResponsee).fadeIn("slow");	
$("#"+SAjaxResponsee).html('<div style="text-align:left;font-family:verdana;font-size:11px;width:200px;padding:2px 4px;">No Matches Found</div>');
}
$("#loading").css("visibility","hidden");
}
});
$("#"+SAjaxResponsee).scrollTop(0);
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
$("#"+SAjaxResponsee+ " li").each(function(){
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
var sel = $("#"+SAjaxResponsee+ " li[class='selected']");
sel.next().addClass("selected");
sel.removeClass("selected");

if (downLiSel > 3)
{
divTop = (downLiSel-3) * 17;
if (divTop < 0) divTop = 0;
$("#"+SAjaxResponsee).scrollTop(divTop); 
}
else $("#"+SAjaxResponsee).scrollTop(0); 
}
else{
$("#"+SAjaxResponsee+ " li:first").addClass("selected");
$("#"+SAjaxResponsee).scrollTop(0);
}
}
break;
case 38:
{
$("#"+SAjaxResponsee).scrollTop(divTop);

found = 0;
flg = true;
upLiSel = 1;
$("#"+SAjaxResponsee+ " li").each(function(){
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
var sel = $("#"+SAjaxResponsee+ " li[class='selected']");
sel.prev().addClass("selected");
sel.removeClass("selected");

if (upLiSel > 3)
{
divTop = (upLiSel-3) * 17;
if (divTop < 0) divTop = 0;
$("#"+SAjaxResponsee).scrollTop(divTop); 
}
else $("#"+SAjaxResponsee).scrollTop(0);
}
else {
$("#"+SAjaxResponsee+ " li:last").addClass("selected");
divTop = $("#"+SAjaxResponsee+ " ul").height() - (3 * 17);
if (divTop < 0) divTop = 0;
$("#"+SAjaxResponsee).scrollTop(divTop); 
}
}
break;
case 13:
$("#"+SAjaxResponsee).fadeOut("slow");
$("#"+SDataGett).val($("#"+SAjaxResponsee+ " li[class='selected'] a").text());

var dataa = $("#"+SAjaxResponsee+ " li[class='selected'] a").text();
var resdata = dataa.split('**');
$("#"+SDataGett).val(resdata[0]);
$("#"+SDataShow1).val(resdata[1]);
$("#"+SDataShow2).val(resdata[2]);
$("#"+SDataShow3).val(resdata[3]);
$("#"+SAjaxResponsee).fadeOut("slow");

break;
}
}
}
else {
$("#"+SAjaxResponsee).fadeOut("slow");
}

});
$("#"+SAjaxResponsee).mouseover(function(){
$(this).find("li a:first-child").mouseover(function () {
$(this).addClass("selected");
});
$(this).find("li a:first-child").mouseout(function () {
$(this).removeClass("selected");
});
$(this).find("li a:first-child").click(function () {

var dataa = $(this).text();
var resdata = dataa.split('**');
$("#"+SDataGett).val(resdata[0]);
$("#"+SDataShow1).val(resdata[1]);
$("#"+SDataShow2).val(resdata[2]);
$("#"+SDataShow3).val(resdata[3]);
$("#"+SAjaxResponsee).fadeOut("slow");
});
});