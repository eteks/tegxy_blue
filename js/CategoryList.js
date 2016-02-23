$(document).ready(function(){
$(document).click(function(){
if($("#"+CDataChk).val()!='' && $("#"+ClearData).val()=='')
{
$("#"+CAjaxResponsee).fadeOut('slow');
}
});
$("#"+CDataGett).click(function(event){
var searchbox = $("#"+CDataChk).val();
if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13 && event.keyCode != 32)
{
$("#loading").css("visibility","visible");
getUrl = "include/BlModules/"+CFile;                   
$.ajax({
type: "POST",
url: getUrl,
data: "data="+searchbox,
success: function(msg){	
if(msg != 0)
$("#"+CAjaxResponsee).fadeIn("slow").html(msg);
else
{
$("#"+CAjaxResponsee).fadeIn("slow");	
$("#"+CAjaxResponsee).html('<div style="text-align:left;font-family:verdana;font-size:11px;width:200px;padding:2px 4px;">No Matches Found</div>');
}
$("#loading").css("visibility","hidden");
}
});
$("#"+CAjaxResponsee).scrollTop(0);
}

});
$("#"+CAjaxResponsee).mouseover(function(){
$(this).find("li a:first-child").mouseover(function () {
$(this).addClass("selected");
});
$(this).find("li a:first-child").mouseout(function () {
$(this).removeClass("selected");
});
$(this).find("li a:first-child").click(function () {
	
var dataa = $(this).text();
var resdata = dataa.split('**');
$("#"+DataShow1).val(resdata[0]);
$("#"+DataShow2).val(resdata[1]);	
	
});
});
});

function ChooseCategory(Clear,File,Response)
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

function CloseCategory(id)
{
$("#"+id).fadeOut('slow');
}

function ClearCategory(fieldid,id,fieldidd)
{
$("#"+fieldid).val('');
$("#"+fieldidd).val('');
$("#"+id).fadeOut('slow');
}