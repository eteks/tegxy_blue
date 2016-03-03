/* 
	author: istockphp.com
*/
jQuery(function($) {
	
	$("a.topopup").click(function() {
			loading(); 
			setTimeout(function(){ 
				loadPopup(); 
			}, 500); 
	return false;
	});
	
	$("a.topopup0").click(function() {
			loading0(); 
			setTimeout(function(){ 
				loadPopup0(); 
			}, 500);
	return false;
	});
	
	$("a.topopup1").click(function() {
			loading1(); 
			setTimeout(function(){ 
				loadPopup1(); 
			}, 500);
	return false;
	});
	
	/*$("a.topopup2").click(function() {
			loading2(); 
			setTimeout(function(){ 
				loadPopup2(); 
			}, 500); 
	return false;
	});*/
	
	$("a.topopup3").click(function() {
			loading3(); 
			setTimeout(function(){ 
				loadPopup3(); 
			}, 500); 
	return false;
	});
	
	/* event for close the popup */
	$("div.close").hover(
					function() {
						$('span.ecs_tooltip').show();
					},
					function () {
    					$('span.ecs_tooltip').hide();
  					}
				);
	
	$("div.close").click(function() {
		disablePopup();  // function close pop up
	});
	
	$(this).keyup(function(event) {
		if (event.which == 27) { // 27 is 'Ecs' in the keyboard
			disablePopup();  // function close pop up
		}  	
	});
	
	$("div#backgroundPopup").click(function() {
		disablePopup();  // function close pop up
	});
	
	$('a.livebox').click(function() {
		alert('Hello World!');
	return false;
	});
	

	 /************** start: functions. **************/
	function loading() {
		$("div.loader").show();  
	}
	function closeloading() {
		$("div.loader").fadeOut('normal');  
	}
	
	var popupStatus = 0; // set value
	
	function loadPopup() { 
		if(popupStatus == 0) { // if value is 0, show popup
			closeloading(); // fadeout loading
			$("#toPopup").fadeIn(0500); // fadein popup div
			$("#backgroundPopup").css("opacity", "0.9"); // css opacity, supports IE7, IE8
			$("#backgroundPopup").fadeIn(0001); 
			popupStatus = 1; // and set value to 1
		}	
	}
		
	function disablePopup() {
		if(popupStatus == 1) { // if value is 1, close popup
			$("#toPopup").fadeOut("normal");  
			$("#backgroundPopup").fadeOut("normal");  
			popupStatus = 0;  // and set value to 0
		}
	}
	
	
	
	
	
	
	$("div.close0").hover(
					function() {
						$('span.ecs_tooltip').show();
					},
					function () {
    					$('span.ecs_tooltip').hide();
  					}
				);
	
	$("div.close0").click(function() {
		// function close pop up
		disablePopup0();
	});
	
	$(this).keyup(function(event) {
		if (event.which == 27) { // 27 is 'Ecs' in the keyboard
			disablePopup0();  // function close pop up
		}  	
	});
	
	$("div#backgroundPopup").click(function() {
		disablePopup0();  // function close pop up
	});
	
	
	
	function loading0() {
		$("div.loader").show();  
	}
	function closeloading0() {
		$("div.loader").fadeOut('normal');  
	}
	
	
	var popupStatus0 = 0; // set value
	
	function loadPopup0() { 
		if(popupStatus0 == 0) { // if value is 0, show popup
			closeloading(); // fadeout loading
			$("#toPopup0").fadeIn(0500); // fadein popup div
			$("#backgroundPopup").css("opacity", "0.9"); // css opacity, supports IE7, IE8
			$("#backgroundPopup").fadeIn(0001); 
			popupStatus0 = 1; // and set value to 1
		}	
	}
		
	function disablePopup0() {
		if(popupStatus0 == 1) { // if value is 1, close popup
			$("#toPopup0").fadeOut("normal");  
			$("#backgroundPopup").fadeOut("normal");  
			popupStatus0 = 0;  // and set value to 0
		}
	}
	
	
	
	$("div.close1").hover(
					function() {
						$('span.ecs_tooltip').show();
					},
					function () {
    					$('span.ecs_tooltip').hide();
  					}
				);
	
	$("div.close1").click(function() {
		// function close pop up
		disablePopup1();
	});
	
	$(this).keyup(function(event) {
		if (event.which == 27) { // 27 is 'Ecs' in the keyboard
			disablePopup1();  // function close pop up
		}  	
	});
	
	$("div#backgroundPopup").click(function() {
		disablePopup1();  // function close pop up
	});
	
	
	
	function loading1() {
		$("div.loader").show();  
	}
	function closeloading1() {
		$("div.loader").fadeOut('normal');  
	}
	
	
	var popupStatus1 = 0; // set value
	
	function loadPopup1() { 
		if(popupStatus1 == 0) { // if value is 0, show popup
			closeloading(); // fadeout loading
			$("#toPopup1").fadeIn(0500); // fadein popup div
			$("#backgroundPopup").css("opacity", "0.9"); // css opacity, supports IE7, IE8
			$("#backgroundPopup").fadeIn(0001); 
			popupStatus1 = 1; // and set value to 1
		}	
	}
		
	function disablePopup1() {
		if(popupStatus1 == 1) { // if value is 1, close popup
			$("#toPopup1").fadeOut("normal");  
			$("#backgroundPopup").fadeOut("normal");  
			popupStatus1 = 0;  // and set value to 0
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	$("div.close2").hover(
					function() {
						$('span.ecs_tooltip').show();
					},
					function () {
    					$('span.ecs_tooltip').hide();
  					}
				);
	
	$("div.close2").click(function() {
		// function close pop up
		disablePopup2();
	});
	
	$(this).keyup(function(event) {
		if (event.which == 27) { // 27 is 'Ecs' in the keyboard
			disablePopup2();  // function close pop up
		}  	
	});
	
	$("div#backgroundPopup").click(function() {
		disablePopup2();  // function close pop up
	});
	
	
	
	function loading2() {
		$("div.loader").show();  
	}
	function closeloading2() {
		$("div.loader").fadeOut('normal');  
	}
	
	
	var popupStatus2 = 0; // set value
	
	function loadPopup2() { 
		if(popupStatus2 == 0) { // if value is 0, show popup
			closeloading(); // fadeout loading
			$("#toPopup2").fadeIn(0500); // fadein popup div
			$("#backgroundPopup").css("opacity", "0.9"); // css opacity, supports IE7, IE8
			$("#backgroundPopup").fadeIn(0001); 
			popupStatus2 = 1; // and set value to 1
		}	
	}
		
	function disablePopup2() {
		if(popupStatus2 == 1) { // if value is 1, close popup
			$("#toPopup2").fadeOut("normal");  
			$("#backgroundPopup").fadeOut("normal");  
			popupStatus2 = 0;  // and set value to 0
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	$("div.close3").hover(
					function() {
						$('span.ecs_tooltip').show();
					},
					function () {
    					$('span.ecs_tooltip').hide();
  					}
				);
	
	$("div.close3").click(function() {
		// function close pop up
		disablePopup3();
	});
	
	$(this).keyup(function(event) {
		if (event.which == 27) { // 27 is 'Ecs' in the keyboard
			disablePopup3();  // function close pop up
		}  	
	});
	
	$("div#backgroundPopup").click(function() {
		disablePopup3();  // function close pop up
	});
	
	
	
	function loading3() {
		$("div.loader").show();  
	}
	function closeloading3() {
		$("div.loader").fadeOut('normal');  
	}
	
	
	var popupStatus3 = 0; // set value
	
	function loadPopup3() { 
		if(popupStatus3 == 0) { // if value is 0, show popup
			closeloading(); // fadeout loading
			$("#toPopup3").fadeIn(0500); // fadein popup div
			$("#backgroundPopup").css("opacity", "0.9"); // css opacity, supports IE7, IE8
			$("#backgroundPopup").fadeIn(0001); 
			popupStatus3 = 1; // and set value to 1
		}	
	}
		
	function disablePopup3() {
		if(popupStatus3 == 1) { // if value is 1, close popup
			$("#toPopup3").fadeOut("normal");  
			$("#backgroundPopup").fadeOut("normal");  
			popupStatus3 = 0;  // and set value to 0
		}
	}
		
	
	
	
	
	
	
	/************** end: functions. **************/
}); // jQuery End

