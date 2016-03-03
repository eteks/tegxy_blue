								
$(document).click(function(){
$("#"+LAjaxResponsee).fadeOut('slow');
});

$("#"+LDataGett).focus(function() {this.val=''; });
$("#"+LDataGett).keyup(function(event){
	
var searchbox = $("#"+LDataGett).val();
if(searchbox.length)
{
$("#"+LClearData).val('');
$("#"+LCAjaxResponsee).fadeOut('slow');
$("#"+LDataShow1).val('');
$("#"+LDataShow2).val('');
$("#"+LDataShow3).val('');
if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13 && event.keyCode != 32)
{
$("#loading").css("visibility","visible");
getUrl = "include/BlModules/"+LFile;                   
$.ajax({
type: "POST",
url: getUrl,
data: "data="+searchbox,
success: function(msg){	
if(msg != 0)
$("#"+LAjaxResponsee).fadeIn("slow").html(msg);
else
{
$("#"+LAjaxResponsee).fadeIn("slow");	
$("#"+LAjaxResponsee).html('<div style="text-align:left;font-family:verdana;font-size:11px;width:200px;padding:2px 4px;">No Matches Found</div>');
}
$("#loading").css("visibility","hidden");
}
});
$("#"+LAjaxResponsee).scrollTop(0);
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
$("#"+LAjaxResponsee+ " li").each(function(){
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
var sel = $("#"+LAjaxResponsee+ " li[class='selected']");
sel.next().addClass("selected");
sel.removeClass("selected");

if (downLiSel > 3)
{
divTop = (downLiSel-3) * 17;
if (divTop < 0) divTop = 0;
$("#"+LAjaxResponsee).scrollTop(divTop); 
}
else $("#"+LAjaxResponsee).scrollTop(0); 
}
else{
$("#"+LAjaxResponsee+ " li:first").addClass("selected");
$("#"+LAjaxResponsee).scrollTop(0);
}
}
break;
case 38:
{
$("#"+LAjaxResponsee).scrollTop(divTop);

found = 0;
flg = true;
upLiSel = 1;
$("#"+LAjaxResponsee+ " li").each(function(){
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
var sel = $("#"+LAjaxResponsee+ " li[class='selected']");
sel.prev().addClass("selected");
sel.removeClass("selected");

if (upLiSel > 3)
{
divTop = (upLiSel-3) * 17;
if (divTop < 0) divTop = 0;
$("#"+LAjaxResponsee).scrollTop(divTop); 
}
else $("#"+LAjaxResponsee).scrollTop(0);
}
else {
$("#"+LAjaxResponsee+ " li:last").addClass("selected");
divTop = $("#"+LAjaxResponsee+ " ul").height() - (3 * 17);
if (divTop < 0) divTop = 0;
$("#"+LAjaxResponsee).scrollTop(divTop); 
}
}
break;
case 13:
$("#"+LAjaxResponsee).fadeOut("slow");
$("#"+LDataGett).val($("#"+LAjaxResponsee+ " li[class='selected'] a").text());

var dataa = $("#"+LAjaxResponsee+ " li[class='selected'] a").text();
var resdata = dataa.split('**');
$("#"+LDataGett).val(resdata[0]);
$("#"+LDataShow1).val(resdata[1]);
$("#"+LDataShow2).val(resdata[2]);
$("#"+LDataShow3).val(resdata[3]);
$("#"+LAjaxResponsee).fadeOut("slow");

break;
}
}
}
else {
$("#"+LAjaxResponsee).fadeOut("slow");
}

});
$("#"+LAjaxResponsee).mouseover(function(){
$(this).find("li a:first-child").mouseover(function () {
$(this).addClass("selected");
});
$(this).find("li a:first-child").mouseout(function () {
$(this).removeClass("selected");
});
$(this).find("li a:first-child").click(function () {

var dataa = $(this).text();
var resdata = dataa.split('**');
$("#"+LDataGett).val(resdata[0]);
$("#"+LDataShow1).val(resdata[1]);
$("#"+LDataShow2).val(resdata[2]);
$("#"+LDataShow3).val(resdata[3]);
$("#"+LAjaxResponsee).fadeOut("slow");
});
});