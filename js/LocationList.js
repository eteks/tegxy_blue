$(document).ready(function(){
$(document).click(function(){
if($("#"+LCDataChk).val()!='' && $("#"+LClearData).val()=='')
{
$("#"+LCAjaxResponsee).fadeOut('slow');
}
});
$("#"+LCDataGett).click(function(event){
var searchbox = $("#"+LCDataChk).val();
if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13 && event.keyCode != 32)
{
$("#loading").css("visibility","visible");
getUrl = "include/BlModules/"+LCFile;                   
$.ajax({
type: "POST",
url: getUrl,
data: "data="+searchbox,
success: function(msg){	
if(msg != 0)
$("#"+LCAjaxResponsee).fadeIn("slow").html(msg);
else
{
$("#"+LCAjaxResponsee).fadeIn("slow");	
$("#"+LCAjaxResponsee).html('<div style="text-align:left;font-family:verdana;font-size:11px;width:200px;padding:2px 4px;">No Matches Found</div>');
}
$("#loading").css("visibility","hidden");
}
});
$("#"+LCAjaxResponsee).scrollTop(0);
}

});
$("#"+LCAjaxResponsee).mouseover(function(){
$(this).find("li a:first-child").mouseover(function () {
$(this).addClass("selected");
});
$(this).find("li a:first-child").mouseout(function () {
$(this).removeClass("selected");
});
$(this).find("li a:first-child").click(function () {
	
var dataa = $(this).text();
var resdata = dataa.split('**');
$("#"+LDataShow1).val(resdata[0]);
$("#"+LDataShow2).val(resdata[1]);	
	
});
});
});

function ChooseLocation(Clear,File,Response)
{
$("#"+Clear).val('ok');	
searchbox='';
$("#loading").css("visibility","visible");
getUrl = "include/BlModules/"+File;                   
$.ajax({
type: "POST",
url: getUrl,
data: "data="+searchbox,
success: function(msg){	
if(msg != 0)
$("#"+Response).fadeIn("slow").html(msg);
else
{
$("#"+Response).fadeIn("slow");	
$("#"+Response).html('<div style="text-align:left;font-family:verdana;font-size:11px;width:200px;padding:2px 4px;">No Matches Found</div>');
}
$("#loading").css("visibility","hidden");
}
});
$("#"+Response).scrollTop(0);
}

function CloseLocation(id)
{
$("#"+id).fadeOut('slow');
}

function ClearLocation(fieldid,id,fieldidd)
{
$("#"+fieldid).val('');
$("#"+fieldidd).val('');
$("#"+id).fadeOut('slow');
}