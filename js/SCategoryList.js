$(document).ready(function(){
$(document).click(function(){
if($("#"+SCDataChk).val()!='' && $("#"+SClearData).val()=='')
{
$("#"+CSAjaxResponsee).fadeOut('slow');
}
});
$("#"+SCDataGett).click(function(event){
var searchbox = $("#"+SCDataChk).val();
if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13 && event.keyCode != 32)
{
$("#loading").css("visibility","visible");
getUrl = "include/BlModules/"+CSFile;                   
$.ajax({
type: "POST",
url: getUrl,
data: "data="+searchbox,
success: function(msg){	
if(msg != 0)
$("#"+CSAjaxResponsee).fadeIn("slow").html(msg);
else
{
$("#"+CSAjaxResponsee).fadeIn("slow");	
$("#"+CSAjaxResponsee).html('<div style="text-align:left;font-family:verdana;font-size:11px;width:200px;padding:2px 4px;">No Matches Found</div>');
}
$("#loading").css("visibility","hidden");
}
});
$("#"+CSAjaxResponsee).scrollTop(0);
}

});
$("#"+CSAjaxResponsee).mouseover(function(){
$(this).find("li a:first-child").mouseover(function () {
$(this).addClass("selected");
});
$(this).find("li a:first-child").mouseout(function () {
$(this).removeClass("selected");
});
$(this).find("li a:first-child").click(function () {
	
var dataa = $(this).text();
var resdata = dataa.split('**');
$("#"+SDataShow1).val(resdata[0]);
$("#"+SDataShow2).val(resdata[1]);	
	
});
});
});

function SChooseCategory(Clear,SFile,Response)
{
$("#"+Clear).val('ok');	
searchbox='';
$("#loading").css("visibility","visible");
getUrl = "include/BlModules/"+SFile;                   
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

function SCloseCategory(id)
{
$("#"+id).fadeOut('slow');
}

function SClearCategory(fieldid,id,fieldidd)
{
$("#"+fieldid).val('');
$("#"+fieldidd).val('');
$("#"+id).fadeOut('slow');
}