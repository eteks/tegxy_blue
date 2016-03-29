// JavaScript Document
$(document).ready(function(){
var Chkstatus=1;
$(document).click(function(){
$("#SearchListRes").fadeOut('slow');
$("#SearchListPro").fadeOut('slow');
});
$("#searchlist").focus(function() {this.val=''; });

$("#searchlist").keyup(function(event){
	var offset = $("#searchlist").offset();
	var width = $("#searchlist").width()-2;
	if($('#requestTypeCom').attr('checked'))
	Chkstatus = 1;
	else
	Chkstatus = 2;

	$("#SearchListRes").css("left",offset.left);
	$("#SearchListRes").css("width",width);
	 // alert(event.keyCode);
	 var searchlist = $("#searchlist").val();

	 if(searchlist.length)
	 {
		 if(event.keyCode != 40 && event.keyCode != 38  && event.keyCode != 32 && event.keyCode != 13)
		 {
			 $("#loading").css("visibility","visible");
				getUrl = "include/BlModules/Bl_SearchList.php?action="+Chkstatus;

			 $.ajax({
			   type: "POST",
			   url: getUrl,
			   data: "data="+searchlist,
			   success: function(msg){
				if(msg != 0)
				{
				  $("#SearchListRes").fadeIn("slow").html(msg);
				  $("#SearchListRes").css('border','1px solid #8789E7');
				  $("#SearchListRes").css('background','none repeat scroll 0 0 #FFFFFF');
				}
				else
				{
				  $("#SearchListRes").fadeIn("slow");
				  if(Chkstatus==1)
				  {
		 		  $("#SearchListRes").html('<div style="text-align:left;font-family:verdana;font-size:11px;width:498px;padding:2px 4px;" class="no_matches">Sorry! No such item found</div>');
				  $("#SearchListRes").css('border','1px solid #8789E7');
				  $("#SearchListRes").css('background','none repeat scroll 0 0 #FFFFFF');
				  }
				  else
				  {
				  $("#SearchListRes").css('border','none');
				  $("#SearchListRes").css('background','none');
				  $("#SearchListRes").html('');
				  }

				}
				$("#loading").css("visibility","hidden");
			   }
			 });
			$("#SearchListRes").scrollTop(0);
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
				  $("#SearchListRes li").each(function(){
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
					var sel = $("#SearchListRes li[class='selected']");
					sel.next().addClass("selected");
					sel.removeClass("selected");

					if (downLiSel > 3)
					{
						divTop = (downLiSel-3) * 17;
						if (divTop < 0) divTop = 0;
						$("#SearchListRes").scrollTop(divTop);
					}
					else $("#SearchListRes").scrollTop(0);
				  }
				  else{
						$("#SearchListRes li:first").addClass("selected");
						$("#SearchListRes").scrollTop(0);
					}
				 }
			 break;
			 case 38:
			 {
				$("#SearchListRes").scrollTop(divTop);

				  found = 0;
				  flg = true;
				  upLiSel = 1;
				  $("#SearchListRes li").each(function(){
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
					var sel = $("#SearchListRes li[class='selected']");
					sel.prev().addClass("selected");
					sel.removeClass("selected");

					if (upLiSel > 3)
					{
						divTop = (upLiSel-3) * 17;
						if (divTop < 0) divTop = 0;
						$("#SearchListRes").scrollTop(divTop);
					}
					else $("#SearchListRes").scrollTop(0);
				  }
				  else {
						$("#SearchListRes li:last").addClass("selected");
						divTop = $("#SearchListRes ul").height() - (3 * 17);
						if (divTop < 0) divTop = 0;
						$("#SearchListRes").scrollTop(divTop);
					}
			 }
			 break;
			 case 13:
				$("#SearchListRes").fadeOut("slow");
			 	var searchresult = $("#SearchListRes li[class='selected'] a").text().split('**');
		  		$("#searchlist").val(searchresult[0]);
				if(Chkstatus==1)
				{
				$("#cityvalue").html(searchresult[2]);
				$("#userCity").val(searchresult[2]);
				changeArealist(searchresult[1],searchresult[3],'');
				}
				var type2;
				type2     = searchresult[5];
				$("#type2").val(type2);
				if($("#Searchmodel").val()==1)
				{
				var requestType=$("input[name='requestType']:checked").val();
				var userCityy;

				if(Chkstatus==1)
				{
				userCityy = searchresult[2];
				userArea  = searchresult[3];
				}
				else
				{
				userCityy = 'Pondicherry';
				userArea = '';
				}
				 window.location.href="Searchpage.php?action=Add&searchkey="+$('#searchlist').val()+"&requesttype="+requestType+"&usercity="+userCityy+"&userarea="+userArea+"&type2="+type2;
				}
				else
				searchResult($('#searchlist').val(),searchresult[3],type2);

			 break;
			}
		 }
	 }
	 else {
		$("#SearchListRes").fadeOut("slow");
		}

});
$("#comp_searchid").keyup(function(event){
	var offset = $("#comp_searchid").offset();
	var width = $("#comp_searchid").width()-2;
	// $("#SearchListRes").css("left",offset.left);
	// $("#SearchListRes").css("width",width);
	 // alert(event.keyCode);
	 var searchlist = $("#comp_searchid").val();

	 if(searchlist.length)
	 {
		 if(event.keyCode != 40 && event.keyCode != 38  && event.keyCode != 32 && event.keyCode != 13)
		 {
			 $("#loading").css("visibility","visible");
				getUrl = "include/BlModules/Bl_SearchList.php?action=3";

			 $.ajax({
			   type: "POST",
			   url: getUrl,
			   data: "data="+searchlist,
			   success: function(msg){
				if(msg != 0)
				{
				  $("#SearchListRes").fadeIn("slow").html(msg);
				  $("#SearchListRes").css('border','1px solid #8789E7');
				  $("#SearchListRes").css('background','none repeat scroll 0 0 #FFFFFF');
				}
				else
				{
				  $("#SearchListRes").fadeIn("slow");
				  if(Chkstatus==1)
				  {
				  $("#SearchListRes").html('<div style="text-align:left;font-family:verdana;font-size:11px;width:498px;padding:2px 4px;" class="no_matches">Sorry! No such item found</div>');
				  $("#SearchListRes").css('border','1px solid #8789E7');
				  $("#SearchListRes").css('background','none repeat scroll 0 0 #FFFFFF');
				  }
				  else
				  {
				  $("#SearchListRes").css('border','none');
				  $("#SearchListRes").css('background','none');
				  $("#SearchListRes").html('');
				  }

				}
				$("#loading").css("visibility","hidden");
			   }
			 });
			$("#SearchListRes").scrollTop(0);
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
				  $("#SearchListRes li").each(function(){
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
					var sel = $("#SearchListRes li[class='selected']");
					sel.next().addClass("selected");
					sel.removeClass("selected");

					if (downLiSel > 3)
					{
						divTop = (downLiSel-3) * 17;
						if (divTop < 0) divTop = 0;
						$("#SearchListRes").scrollTop(divTop);
					}
					else $("#SearchListRes").scrollTop(0);
				  }
				  else{
						$("#SearchListRes li:first").addClass("selected");
						$("#SearchListRes").scrollTop(0);
					}
				 }
			 break;
			 case 38:
			 {
				$("#SearchListRes").scrollTop(divTop);

				  found = 0;
				  flg = true;
				  upLiSel = 1;
				  $("#SearchListRes li").each(function(){
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
					var sel = $("#SearchListRes li[class='selected']");
					sel.prev().addClass("selected");
					sel.removeClass("selected");

					if (upLiSel > 3)
					{
						divTop = (upLiSel-3) * 17;
						if (divTop < 0) divTop = 0;
						$("#SearchListRes").scrollTop(divTop);
					}
					else $("#SearchListRes").scrollTop(0);
				  }
				  else {
						$("#SearchListRes li:last").addClass("selected");
						divTop = $("#SearchListRes ul").height() - (3 * 17);
						if (divTop < 0) divTop = 0;
						$("#SearchListRes").scrollTop(divTop);
					}
			 }
			 break;
			 case 13:
				$("#SearchListRes").fadeOut("slow");
			 	var searchresult = $("#SearchListRes li[class='selected'] a").text().split('**');
		  		$("#searchlist").val(searchresult[0]);
				if(Chkstatus==1)
				{
				$("#cityvalue").html(searchresult[2]);
				$("#userCity").val(searchresult[2]);
				changeArealist(searchresult[1],searchresult[3],'');
				}
				var type2;
				type2     = searchresult[5];
				$("#type2").val(type2);
				if($("#Searchmodel").val()==1)
				{
				var requestType=$("input[name='requestType']:checked").val();
				var userCityy;

				if(Chkstatus==1)
				{
				userCityy = searchresult[2];
				userArea  = searchresult[3];
				}
				else
				{
				userCityy = 'Pondicherry';
				userArea = '';
				}
				 window.location.href="Searchpage.php?action=Add&searchkey="+$('#searchlist').val()+"&requesttype="+requestType+"&usercity="+userCityy+"&userarea="+userArea+"&type2="+type2;
				}
				else
				searchResult($('#comp_searchid').val(),searchresult[3],type2);

			 break;
			}
		 }
	 }
	 else {
		$("#SearchListRes").fadeOut("slow");
		}

});
$("#searchid").keyup(function(event){
	var offset = $("#searchid").offset();
	var width = $("#searchid").width()-2;
	// $("#SearchListRes").css("left",offset.left);
	// $("#SearchListRes").css("width",width);
	 // alert(event.keyCode);
	 var searchlist = $("#searchid").val();
	 // alert('searchlist'+searchlist);

	 if(searchlist.length)
	 {
		 if(event.keyCode != 40 && event.keyCode != 38  && event.keyCode != 32 && event.keyCode != 13)
		 {
			 $("#loading").css("visibility","visible");
				getUrl = "include/BlModules/Bl_SearchList.php?action=4";
			 $.ajax({
			   type: "POST",
			   url: getUrl,
			   data: "data="+searchlist,
			   success: function(msg){			  
				if(msg != 0){
				  $("#SearchListPro").fadeIn("slow").html(msg);
				  $("#SearchListPro").css('border','1px solid #8789E7');
				  $("#SearchListPro").css('background','none repeat scroll 0 0 #FFFFFF');
				}
				else{
				  $("#SearchListPro").fadeIn("slow");
				  if(Chkstatus==1)
				  {
				  $("#SearchListPro").html('<div style="text-align:left;font-family:verdana;font-size:11px;width:498px;padding:2px 4px;" class="no_matches">Sorry! No such item found</div>');
				  $("#SearchListPro").css('border','1px solid #8789E7');
				  $("#SearchListPro").css('background','none repeat scroll 0 0 #FFFFFF');
				  }
				  else
				  {
				  $("#SearchListPro").css('border','none');
				  $("#SearchListPro").css('background','none');
				  $("#SearchListPro").html('');
				  }

				}
				$("#loading").css("visibility","hidden");
			   }
			 });
			$("#SearchListPro").scrollTop(0);
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
				  $("#SearchListPro li").each(function(){
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
					var sel = $("#SearchListPro li[class='selected']");
					sel.next().addClass("selected");
					sel.removeClass("selected");

					if (downLiSel > 3)
					{
						divTop = (downLiSel-3) * 17;
						if (divTop < 0) divTop = 0;
						$("#SearchListPro").scrollTop(divTop);
					}
					else $("#SearchListPro").scrollTop(0);
				  }
				  else{
						$("#SearchListPro li:first").addClass("selected");
						$("#SearchListPro").scrollTop(0);
					}
				 }
			 break;
			 case 38:
			 {
				$("#SearchListPro").scrollTop(divTop);

				  found = 0;
				  flg = true;
				  upLiSel = 1;
				  $("#SearchListPro li").each(function(){
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
					var sel = $("#SearchListPro li[class='selected']");
					sel.prev().addClass("selected");
					sel.removeClass("selected");

					if (upLiSel > 3)
					{
						divTop = (upLiSel-3) * 17;
						if (divTop < 0) divTop = 0;
						$("#SearchListPro").scrollTop(divTop);
					}
					else $("#SearchListPro").scrollTop(0);
				  }
				  else {
						$("#SearchListPro li:last").addClass("selected");
						divTop = $("#SearchListPro ul").height() - (3 * 17);
						if (divTop < 0) divTop = 0;
						$("#SearchListPro").scrollTop(divTop);
					}
			 }
			 break;
			 case 13:
				$("#SearchListPro").fadeOut("slow");
			 	var searchresult = $("#SearchListPro li[class='selected'] a").text().split('**');
		  		$("#searchlist").val(searchresult[0]);
				if(Chkstatus==1)
				{
				$("#cityvalue").html(searchresult[2]);
				$("#userCity").val(searchresult[2]);
				changeArealist(searchresult[1],searchresult[3],'');
				}
				var type2;
				type2     = searchresult[5];
				$("#type2").val(type2);
				if($("#Searchmodel").val()==1)
				{
				var requestType=$("input[name='requestType']:checked").val();
				var userCityy;

				if(Chkstatus==1)
				{
				userCityy = searchresult[2];
				userArea  = searchresult[3];
				}
				else
				{
				userCityy = 'Pondicherry';
				userArea = '';
				}
				 window.location.href="Searchpage.php?action=Add&searchkey="+$('#searchlist').val()+"&requesttype="+requestType+"&usercity="+userCityy+"&userarea="+userArea+"&type2="+type2;
				}
				else
				searchResult($('#searchid').val(),searchresult[3],type2);

			 break;
			}
		 }
	 }
	 else {
		$("#SearchListPro").fadeOut("slow");
		}

});
$("#SearchListRes").mouseover(function(){
	$(this).find("li a:first-child").mouseover(function () {
		  $(this).addClass("selected");
	});
	$(this).find("li a:first-child").mouseout(function () {
		  $(this).removeClass("selected");
	});
	$(this).find("li a:first-child").click(function () {
          var searchresult = $(this).text().split('**');
          // alert('searchresult'+searchresult[0]);
		  $("#searchlist").val(searchresult[0]);
		  if(Chkstatus==1)
		  {
		  $("#cityvalue").html(searchresult[2]);
		  $("#userCity").val(searchresult[2]);
		  changeArealist(searchresult[1],searchresult[3],'');
		  }
		  var type2;
          type2 = searchresult[5];
          // alert('type2'+type2);
		  $("#type2").val(type2);
		  if($("#Searchmodel").val()==1)
          {
			var userCityy;
			var requestType=$("input[name='requestType']:checked").val();

			if(Chkstatus==1)
			{
			userCityy = searchresult[2];
			userArea  = searchresult[3];
			}
			else
			{
			userCityy = 'Pondicherry';
			userArea  = '';
			}
			window.location.href="Searchpage.php?action=Add&searchkey="+$('#searchlist').val()+"&requesttype="+requestType+"&usercity="+userCityy+"&userarea="+searchresult[3]+"&type2=1";
		  }
		  else
		  searchResult($('#searchlist').val(),searchresult[3],type2);
		  $("#SearchListRes").fadeOut("slow");
	});
});
});



// JavaScript Document
$(document).ready(function(){
$(document).click(function(){
$("#ListCityRes").fadeOut('slow');
});

$("#userCityselect").focus(function() {this.val=''; });

$("#userCityselect").keyup(function(event){
	var offset = $("#userCityselect").offset();
	var width = $("#userCityselect").width()-2;
	$("#ListCityRes").css("left",offset.left);
	$("#ListCityRes").css("width",width);

	 // alert(event.keyCode);
	 var userCityselect = $("#userCityselect").val();

	 if(userCityselect.length)
	 {
		 if(event.keyCode != 40 && event.keyCode != 38  && event.keyCode != 32 && event.keyCode != 13)
		 {
			 $("#loading").css("visibility","visible");
				getUrl = "include/BlModules/Bl_ListCity.php";

			 $.ajax({
			   type: "POST",
			   url: getUrl,
			   data: "data="+userCityselect,
			   success: function(msg){
				if(msg != 0)
				  $("#ListCityRes").fadeIn("slow").html(msg);
				else
				{
				  $("#ListCityRes").fadeIn("slow");
				  $("#ListCityRes").html('<div style="text-align:left;font-family:verdana;font-size:11px;width:278px;padding:2px 4px;" class="no_matches">Sorry! No such item found</div>');
				}
				$("#loading").css("visibility","hidden");
			   }
			 });
			$("#ListCityRes").scrollTop(0);
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
				  $("#ListCityRes li").each(function(){
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
					var sel = $("#ListCityRes li[class='selected']");
					sel.next().addClass("selected");
					sel.removeClass("selected");

					if (downLiSel > 3)
					{
						divTop = (downLiSel-3) * 17;
						if (divTop < 0) divTop = 0;
						$("#ListCityRes").scrollTop(divTop);
					}
					else $("#ListCityRes").scrollTop(0);
				  }
				  else{
						$("#ListCityRes li:first").addClass("selected");
						$("#ListCityRes").scrollTop(0);
					}
				 }
			 break;
			 case 38:
			 {
				$("#ListCityRes").scrollTop(divTop);

				  found = 0;
				  flg = true;
				  upLiSel = 1;
				  $("#ListCityRes li").each(function(){
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
					var sel = $("#ListCityRes li[class='selected']");
					sel.prev().addClass("selected");
					sel.removeClass("selected");

					if (upLiSel > 3)
					{
						divTop = (upLiSel-3) * 17;
						if (divTop < 0) divTop = 0;
						$("#ListCityRes").scrollTop(divTop);
					}
					else $("#ListCityRes").scrollTop(0);
				  }
				  else {
						$("#ListCityRes li:last").addClass("selected");
						divTop = $("#ListCityRes ul").height() - (3 * 17);
						if (divTop < 0) divTop = 0;
						$("#ListCityRes").scrollTop(divTop);
					}
			 }
			 break;
			 case 13:
				$("#ListCityRes").fadeOut("slow");
			  var searchresult = $("#ListCityRes li[class='selected'] a").text().split('**');
			  $("#userCityselect").val(searchresult[0]);
			  $("#cityvalue").html(searchresult[1]);
			  $("#userCity").val(searchresult[1]);
			  $("#userCityselect").hide();
			  $("#cityvalue").show();
			  changeArealist(searchresult[2],'','');
			 break;
			}
		 }
	 }
	 else {
		$("#ListCityRes").fadeOut("slow");
		}

});
$("#ListCityRes").mouseover(function(){
	$(this).find("li a:first-child").mouseover(function () {
		  $(this).addClass("selected");
	});
	$(this).find("li a:first-child").mouseout(function () {
		  $(this).removeClass("selected");
	});
	$(this).find("li a:first-child").click(function () {

		  var searchresult = $(this).text().split('**');
		  $("#userCityselect").val(searchresult[0]);
		  $("#cityvalue").html(searchresult[1]);
		  $("#userCity").val(searchresult[1]);
		  $("#ListCityRes").fadeOut("slow");
	});
});
});

function changesearchtype()
{
$('#searchlist').val('');
$('#selectarea').val('');
/* $('#searchResults').html('');*/

if(google.loader.ClientLocation)
{
	visitor_city = google.loader.ClientLocation.address.city;
	$("#userCity").val(visitor_city);
	$("#cityvalue").html(visitor_city);
	changeArealist(visitor_city,'','name');
}

$( "#noneedspaces1" ).slideDown();
$( "#noneedspaces2" ).slideDown();
$('#topsidelogo').css('display','none');
$('#suggestions').css('display','none');
$("#searchlist").focus();
if($('#searchlist').attr('placeholder')=='Please Enter Company Name to Search'){
  $('#search_lookfor').attr('disabled',true);
  $('#searchlist').attr('placeholder','Please Enter Product / Service to Search');
  }
  else{
  $('#search_lookfor').attr('disabled',false);
	$('#searchlist').attr('placeholder','Please Enter Company Name to Search');
  }


}
