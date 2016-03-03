
function onclicksignup()
{
	$('.newuser').show();
	document.getElementById('sradio').checked=true;
	document.getElementById('fradio').checked=false;
    $('#signin').removeClass('shad');
	$('#signup').addClass('shad');
	$("#signin").css('pointer-events','none');
    $("#signup").css('pointer-events','auto');
	$('#Fname').focus();
	$('#FRmsg').html('');
	$('input.txtbox').val('');
	return false;
}
function onclicksignin(){

	$('.registrd_usr').show();
	document.getElementById('fradio').checked=true;
	document.getElementById('sradio').checked=false;
	$('#signup').removeClass('shad');
	$('#signin').addClass('shad');
	$("#signin").css('pointer-events','auto');
    $("#signup").css('pointer-events','none');
	$('#FLusername').focus();
	$('#Fmsg').html('');
	$('input.txtbox').val('');
	return false;
}

function poploginreset()
{
	$('#Fmsg').html('');
	$('#FRmsg').html('');
	$('#Fgtmsg').html('');
	$('input.txtbox').val('');
    document.getElementById('fradio').checked=true;
	document.getElementById('sradio').checked=false;
	$("#signin").css('pointer-events','auto');
    $("#signup").css('pointer-events','none');
	$('.toggle2').hide();
	$('.toggle1').show();
	$('#FLusername').focus();
	$('.registrd_usr').show();
	$('.newuser').show();
	positionPopup();

}
$(function() {

	$('#signin').addClass('shad');

$('#toggle2').click(function() {
	$('.toggle2').show();
	$('.toggle1').hide();
	$('.registrd_usr').hide();
	$('.newuser').hide();
    $('#FFusername').focus();
	positionPopup();
	return false;
});



$('.firstviewmore').click(function() {
	poploginreset();
	positionPopup();

});

});

$(document).ready(function(){
$(".pop").click(function(){
  $("#overlay_form").fadeIn(1000);
  $(".background_overlay").fadeIn(500);
  $("#searchlist").focus();
  positionPopup();

  $('#FLusername').focus();
});

//close popup
$("#close, .background_overlay").click(function(){
	$("#overlay_form").fadeOut(500);
	$(".background_overlay").fadeOut(500);
});
});

//position the popup at the center of the page
function positionPopup(){
  if(!$("#overlay_form").is(':visible')){
    return;
  }
  $("#overlay_form").css({
      left: ($(window).width() - $('#overlay_form').width()) / 2,
      top: ($(window).width() - $('#overlay_form').width()) / 7,
      position:'absolute'
  });
}

//maintain the popup at center of the page when browser resized
$(window).bind('resize',positionPopup);
