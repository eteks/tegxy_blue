<?php
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();
?>
<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Title;?></title>
<link href="css/homepage.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/jsapi.js"></script>
<script src="js/jquery-latest.js"></script>
<script type="text/javascript" src="js/Common.js"></script>
<script type="text/javascript" src="js/Searchlist.js"></script>
<script type="text/javascript">
function Searchpage()
{
var searchKey = $("#searchlist").val();
if(searchKey=="")
{ 
alert("Please Enter the Search Box Value");
DocId('searchlist').focus();
return false;
}
else{
var requestType=$("input[name='requestType']:checked").val();
var userCity=$("#userCity").val();
//alert(userCity);
var userArea;
if(selectarea=='')
userArea=$("#selectarea").val();
else
userArea=selectarea;
window.location.href="Searchpage.php?action=Add&searchkey="+searchKey+"&requesttype="+requestType+"&usercity="+userCity+"&userarea="+userArea+"&type2=1";
}
}
function adv_Searchpage()
{
searchKey = $("#searchlist").val();
var requestType=$("input[name='requestType']:checked").val();
var userCity=$("#userCity").val();
var userArea;
if(selectarea=='')
userArea=$("#selectarea").val();
else
userArea=selectarea;
window.location.href="adv_search.php?action=Add&searchkey="+searchKey+"&requesttype="+requestType+"&usercity="+userCity+"&userarea="+userArea+"&type2=1";

}
function Searchusingenterkey(e)
{
// look for window.event in case event isn't passed in
}
</script>
<style type="text/css">
#ListCityRes{
	border : 1px solid #8789E7;
	background : #FFFFFF;
	position:absolute;
	display:none;
	padding:2px 0px;
	top:auto;
	font-family :verdana;
	font-size:12px;
	width: 280px !important;
	overflow-x: hidden;
	overflow-y: auto;
	height:130px;
	z-index:100;
	top:30px;
	left: 0px !important;
}
#ListCityRes .list {
	width: 280px;
	padding:0px 0px;
	margin:0px;
	list-style : none;
}
#SearchListRes{
	border : 1px solid #8789E7;
	background : #FFFFFF;
	position:absolute;
	display:none;
	padding:2px 0px;
	font-family :verdana;
	font-size:12px;
	top: 420px;
    width: 475px !important;
	overflow-x: hidden;
	overflow-y: auto;
	height:130px;
	z-index:100;
}

#SearchListRes .list {
	width: 505px;
	padding:0px 0px;
	margin:0px;
	list-style : none;
}
.list li a{
	text-align : left;
	padding:2px 4px;
	cursor:pointer;
	display:block;
	text-decoration : none;
	color:#000000;
}
.selected{
	background : #CCCFF2;
}
.bold{
	font-weight:bold;
	color: #131E9F;
}
</style>
</head>
<body class="background">
<?php include("OuterHeader.php");?>
<!--top-->
<!--mid-->
<div class="search_mid">
	<div id="noneedspaces1" style="width:990px;height:200px;"></div>
	<div id="noneedspaces2" style="width:990px;height:82px;" align="center"><div style="font-weight: bold; margin-top: 30px; font-family: Trebuchet MS; font-size: 80px;text-shadow: 4px 4px #000000;"><span style="color:#00667C;">X</span><span style="color:#C31118;">Y</span><span style="color:#00667C;">GET</span><span style="color:#C31118;font-size:55px;">.COM</span></div></div>
	<div id="noneedspaces3" align="center" style="width:990px;height:70px;display:none;">
	<div class="logoonsearch" >
	<a href="index.php"><img  id="topsidelogo" src="images/logo.png" /></a>
	</div>
	</div>
	<form>
		<div style="width:850px;height:30px;display:block;" align="center" >
			<input type="hidden" id="Searchmodel" value="1" />
			<input type="radio" id="requestTypeCom" name="requestType" checked="checked" value="company" title="Company" onclick="changesearchtype();" /><label for="requestTypeCom">Company</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="requestType" id="requestTypedeals" value="bestdeals" title="Xbit" onclick="changesearchtype();" /><label for="requestTypedeals" >Products</label>
		</div>
		<div style="width:990px;height:55px;" align="center">
			<input type="text" autocomplete="off" name="searchkey" id="searchlist"  class="mainsearchbox" placeholder="Please Enter Company Name / Sector / Keyword to Search" autofocus value="" onkeypress="Searchusingenterkey(event);" />
			<div id="SearchListRes"></div>
			<input id="searchsubmit" type="button" onclick="Searchpage();" value="Search" class="btnstyle"/>
			<!-- <img src="images/Green-Search-Icon.png" onClick="adv_Searchpage();" width="30" style="position:relative; top:9px; cursor:pointer; left:115px;" title="Advance Search"> -->
			<input type="button" class="btnstyle advance_btn" onclick="adv_Searchpage();" value="Advance Search">
			<div id="suggestions" style="display: none;"> <div style="width:504px;height:auto;position: relative; z-index: 9999; display: block;text-align:left;border:1px solid #ccc;left:0px;" id="suggestionsList"> &nbsp; </div></div>
			<input type="hidden" name="searchlisthidden" id="searchlisthidden" value="" />
		</div>
		<div style="width:990px;height:60px;" align="center">
			<table class="align_table" cellpadding="0" cellspacing="0" border="0">  
				<tr>
				    <td width="300" valign="top"><a onclick="Togglecity();" id="cityvalue" ></a>
						<input name="userCity" id="userCity"  type="hidden" value="" />
						<input name="userCityselect" placeholder="Select City" autocomplete="off" id="userCityselect"  type="text"  value="" style="width:280px;height:25px;border:1px solid #C8C8C8;color:#000000; display:none;" /><div id="ListCityRes"></div>
						<input type="hidden" name="citylisthidden" id="citylisthidden" value="" />
						<div id="citysuggestions" style="display: none;"> <div style="position: relative; width: 260px;  max-height: 300px; z-index: 9999; display: block;background: none repeat scroll 0 0 #FFFFFF;text-align:left;list-style: none outside none;border: 1px solid rgba(0, 51, 255, 0.5);cursor:pointer;" id="citysuggestionlist"> &nbsp; </div></div>
						<span style="display:none;">Select Area in <span id="citydisplayname"  >Pondicherry</span>?</span>
					</td>
				    <td>&nbsp;</td>
				        <td width="300" valign="top" style="display:none;">
				            <select name="selectarea" id="selectarea"  style="width:180px;padding:5px;color:#000000;border:1px solid #C8C8C8;">
					            <?php $queryarea=db_query("SELECT AM_Id, AM_Area, AM_Status FROM ".TABLE_AREAMASTER." WHERE AM_City =1 ");
					            echo '<option>Select Area in Pondicherry</option>';
					            while($fetchquery=mysql_fetch_array($queryarea)){
					             echo '<option value="'.$fetchquery['AM_Id'].'">'.$fetchquery['AM_Area'].'</option>';
					            } ?>
			        		</select>
						</td>
			    </tr>
			</table>
		</div>
	</form>
	<div id="searchResults" style="width:990px;min-height:513px;height:auto;margin-left:auto;margin-right:auto;">
	<link href="css/eventpopup.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript" src="js/script.js"></script>
	<div class="footermenu_link"  style="display:none;">
		<a href="#" class="topopup0" >About Us</a>
		<span style="color:#085A70;">|</span>
		<a href="#" class="topopup1" >Terms & Conditions</a>
		<span style="color:#085A70;">|</span>
		<a href="#" class="topopup2" >Advertisement</a>
		<span style="color:#085A70;">|</span>
		<a href="#" class="topopup3" >Contact Us</a>
		<div id="toPopup0">
        	<div class="close0"></div>
       		<span class="arrow"></span>
			<div id="popup_content">
	        	<p>
	            	<img src="images/logo.png" style="position:relative;top:-10px;"><br/>
	            	<p>The idea of <b>tracemein.com</b>, an innovation of <b>TECHDNS</b>, is to create an opportunity for all levels of business people from small, medium and large, to have their own dynamic web site and make changes of their own on day to day basis. This site helps everyone get listed is the search engine and allow the companies to have a new door to do business apart from their regular way.</p>
					<p>For those who don’t have a website, they can use this site as their own website. For those who already have website, this will act as an additional tool for promoting themselves.</p>
					<p>So <b>tracemein.com</b> is an e- exhibition to display & purchase, what all you need.</p>
					<p>Other Products of <b>TECHDNS</b> are,</p>
					<p><b>AIMS</b> (Atomic Institution Management System) – An ERP (Enterprise resource Planning) for all level of Educational Institutions - Universities/Colleges/Schools.</p>
					<p>Features of AIMS</p>
					<ul>
						<li>Specialized for Group Institutions</li>
						<li>Helps in Budgeting based on income & Expense</li>
						<li>Students Performance on hand</li>
						<li>Staff Performance on hand</li>
						<li>Exam Scheduling for Rooms & Staff allocation</li>
						<li>Centralized Fees collecting </li>
						<li>Communicates among the parents, students, staff, administration and Management </li>
						<li>Assign Levels & permissions to avoid transparency  Etc.,</li>
					</ul>
					<p><b>ReportIntel</b> – A dynamic report generating pack, which enables the client to create reports of their own, from multiple databases .</p>
					<ul>
						<li>A comprehensive web reporting tool.</li>
						<li>Upload of information as a single excel file.</li>
						<li>Auto created menu options with report formation.</li>
						<li>Any number of auto generated defined repots.</li>
						<li>Interactive module with internal mailing options.</li>
						<li>Authenticated entries for management level access.</li>
						<li>Log reports for analyzing the usage frequency.</li>
						<li>Highly logical alert systems for reminders.</li>
					</ul>
					<p><b>E - Catalog</b></p>
					<ul>
						<li>Totally Cost Effective compared to brochures & photos</li>
						<li>Impressive CD/Online Presentations.</li>
						<li>Add to Favorite option to filter the selected products for future reference.</li>
						<li>Detailed description of products with image displayed.</li>
						<li>Zooming of product images for better viewing.</li>
						<li>Easy upload option of the photos and descriptions with the help of a CMS Software.</li>
					</ul>
					<p><b>POS / BILLING - Sectors</b></p>
					<ul>
						<li>SME RETAIL – For small and medium enterprises</li>
						<li>PHARMA – POS for pharmacies</li>
						<li>STOCK STORAGE & DISTRIBUTION – For any sector</li>
						<li>RETAIL ERP – Extensive Retail ERP solution for Supermarkets.</li>
						<li>BEAUTY PARLORS RETAIL – For Parlors and Saloons.</li>
						<li>RESTURANT- POS.</li>
					</ul>
					<p><b>Feature</b></p>
					<ul>
						<li> 	Efficient – With Barcode scanners and touch screen interfaces the sales can be
							             Processed quickly and efficiently</li>
						<li> 	 Easy to Learn – No expensive training for staff, its as easy to learn</li>
						<li> 	 Easy to Use – Required minimum keystrokes with occasional use of keypad</li>
						<li> 	 Flexible – Handles any combination of discounts, taxes, offers, returns, credits and
							            sales special in one easy transaction</li>
						<li> 	 Automatic – Applies auto discounts or preferred price levels to special customers</li>
						<li> 	 Accommodating – Stock and inventory alerts for ROLs</li>
						<li> 	 Secure – Highly secure with user level authentications for every departments</li>
						<li> 	Versatile – accommodates both international and national clients</li>
						<li> 	 Modern – Very well integrates with all latest retail devices like barcode scanners, cash
						          drawers, display poles</li>
					</ul>
					<p><b>HRMS</b> – Human Resource Management system (HRMS) is an integrated system to capture the Service particulars of an employee from day one of the service till the end of the service. Depending on the service information, generate the monthly salary bill of employees by the concerned department.</p>
					<p>The system will helps the management in getting various MIS reports in decision making viz. the list of employees getting the annual increments in any given month, number of employees retiring in any month of the year, budget planning and controlling etc.</p>
					<p><b>HMS</b> – Hotel Management System is an ideal software solution for Hospitality Industry that can be used at hotels, motels, inns, resorts, lodges, hostel, military guest houses, ranch, suites, apartments, medical centers and bed, breakfast operations.</p>
					<p>It includes all the features required in a Hotel Management Software, Hotel Reservation Software, Hotel Reception Software (Front Office), Call Accounting, Hotel Point of Sales (Restaurant, Bar, Room Service, House Keeping or any other outlet), Inventory Management System and Hotel accounting software.</p>
					<p><b>Development Partner – Atomicka Softtech Pvt Ltd</b></p>
					<p>Atomicka softtech pvt ltd, which stamped their presence in the field of IT at Pondicherry for more than 6 years, with global IT Development & Business Consultation Concern focusing on areas of specialization including IT development with cutting end technologies like .Net(Silverlight), J2EE(Adobe Flex), Php, etc. Also we broaden with XML (web services), RDBMS (Data Transaction Services), Designing and Software Testing.</p>
					<p>Atomicka have been providing solutions to the clients for their sturdy manual process, using the latest technology, related to all the fields. Our team provides functional, technical and vertical market expertise with key technologies as mentioned, starting from the business assessments & requirement specification to project implementation and providing maintenance services. We focus on the complete life cycle delivery & implementation of the business projects. We base our architecture with n-tier.</p>

					<p><b>AREA OF BUSINESS</b></p>
					<ul>
						<li>Web hosting and Domain Name Registration</li>
						<li>Web application Development (RIA&RWA - ASP.Net/PHP) Web Designing (Dynamic /Action Scripts)</li>
						<li>Multimedia Windows application (Vb.Net)</li>
						<li>IT & Business Consultancy</li>
						<li>Corporate Training</li>
						<li>E- Commerce application Solution</li>
						<li>SEO (Search Engine Optimization)</li>
					</ul>
	            </p>
	        </div>
    	</div>

	    <div id="toPopup1">
	        <div class="close1"></div>
	       	<span class="arrow"></span>
			<div id="popup_content">
	            <p>
		            <img src="images/logo.png" style="position:relative;top:-10px;"><br/>
		           	<b> 1.	Service Utility; Tracemein Accounts</b>
					<p>This service comes to effect on your Account creation and approval by Tracemein (an <b>“Account”</b>). Tracemein has got all the rights to refuse or limit your access to the Services provided. You agree to that you are at least 18 years of age, an individual,  to hold an account with Tracemein. If as an organization or group of companies you have to provide your registration number for Authenticity.</p>

					<p>This account is valid for a period of one year, from the date of approval of the account and has to be renewed for further period of validity.</p>

					<p>By registering with Tracemein, you allow <b>TECHDNS</b> to serve, as applicable, (i) commercials and other Ads content, (ii) All searches and their results, and (iii) associated search queries and other links to your websites, and/or other assets approved by <b>TECHDNS</b> (each individually a <b>“assets”</b>). And also, you grant <b>TECHDNS</b> the right to access, index and reserve the assets, or any part thereof, including by automated means. <b>TECHDNS</b> may reject the Services to any assets, at any time.</p>

					<p>Any asset that is a software application and accesses our Services (a) necessitates preapproval by <b>TECHDNS</b> in writing, and (b) must act in accordance with <b>TECHDNS</b>   Software Principles.</p>

					<b>2.	Website usage</b>
					<ol>
						<li>By utilizing this Service, you affirm and represent to the <b>TECHDNS</b> that you are authorized to do so and to make use of information accessible via the website.</li>
						<li>TECHDNS reserves the right, in its sole discretion and at any time, to make changes to this account. </li>
						<li>Any changes made will be effective accordingly when made and the updated details will be sent to the member via e-mail.</li>
						<li>By becoming an account holder you are agreeing to be e bound by this agreement and any of the policies and procedures that may be made by TECHDNS from time to time.</li>
						<li>Any communications sent to you concerning the services or related matters are not intended to be made public.</li>
						<li>While TECHDNS makes reasonable efforts to ensure that the services are available at all times, TECHDNS does not guarantee that the Members will be able to access or use all the services or all of their features at all the times.</li>
						<li>The information that you supply during the resignation process is deemed accurate and complete by <b>TECHDNS</b></li>
						<li>Account holder is responsible for maintaining the confidentiality of their login id and password.</li>
					</ol>

					<b>3.	Trademarks</b>
					<p>The trademarks, names, logos and service marks (jointly “trademarks”) displayed on this website are registered and unregistered trademarks of <b>TECHDNS</b>. No content on this website should be interpreted as granting any license or rights to utilize any trademark without the prior written permission of <b>TECHDNS</b>.</p>

					<b>4.	External links</b>
					<p>Links may be provided from external source for your convenience, but they are not controlled by <b>TECHDNS</b> and no representation is made as to their content. Usage or dependence on any external links and the content thereon offered is at your individual risk</p>.
					
					<b>5.	Warranties</b>
					<ol>
						<li>The <b>TECHDNS</b> commits no warranties, representations, statements or guarantees (whether articulated, implied in law or enduring) regarding the service.</li>
						<li>You represent and warrant to <b>TECHDNS</b> that all of the information provided by you to <b>TECHDNS</b> to register as an account holder and participate in the services is correct and current, and that you have all necessary right, power and authority to enter in to this service.</li>
					</ol>

					<b>6.	VIOLATIONS:</b>
					<ol>
						<li>Violations of system and network security are prohibited, and may result in criminal and civil liability. Examples of system and network security violations include the following:<br/>
						a)	Any automated use of system.<br/>
						b)	Use of software that allows your account to stay logged on while you are not actively using the account.<br/>
						c)	Unauthorized access to or use of data, systems or networks, including any attempt to probe, scan or test the vulnerability of a system or network or to breach security or authentication measures without the express authorization of the owner of the system or network.</li>
						<li>TECHDNS may investigate incident involving such violations, any violations of this Account that may constitute or have the potential to constitute violations of law, and any activity by Members on network that constitute or may constitute violations of law. You understand that we may report any such activity to, and cooperate with, law enforcement, or other legal process.</li>
					</ol>

					<b>7.	Liability Disclaimer</b>
					<p>The <b>TECHDNS</b> shall not be accountable for and disown all accountability for any loss, liability, damage (whether direct, indirect or consequential), personal injury or expense of any nature whatsoever which may be suffered by you or any third party (including your company), as a result of or which may be attributable, directly or indirectly, to your access and use of the service, any information contained on the website, you or your company’s personal information or material and information conveyed over our system. In particular, neither the <b>TECHDNS</b> nor any third party or data or content provider shall be liable in any way to you or to any other person, firm or corporation whatsoever for any loss, liability, damage (whether direct or consequential), personal injury or expense of any nature whatsoever happening by any delays, factual errors, or omission of any share price information or the transmission thereof, or for any proceedings taken in trust thereon or occasioned thereby or by reason of non-performance or disruption, or termination thereof.</p>
					<b>8.	Conflict of terms</b>
					<p>If there is a conflict or contradiction between the provisions of these website terms and conditions and any other related terms and conditions, policies or notices, the other relevant terms and conditions, policies or notices which relate specifically to a particular section or part of the website shall prevail in respect of your use of the relevant section or part of the website.</p>
					<b>9.	Severability</b>
					<p>Any requisites of any relevant terms and conditions, policies and notices, which is or becomes unenforceable in any jurisdiction, whether due to being canceled, invalidity, illegality, unlawfulness or for any reason whatever, shall, in such jurisdiction only and only to the extent that it is so unenforceable, be treated as void and the remaining provisions of any relevant terms and conditions, policies and notices shall remain in full force and effect.</p>
					<b>10.	Laws Applicable</b>
					<p>Usage of this website will in all respect, be governed by the laws of the Union Territory of Puducherry, INDIA, despite of the laws that might be valid under principles of conflicts of law. The parties agree that the Puducherry courts located in Union Territory of Puducherry, INDIA, shall have exclusive jurisdiction over all controversies occurring under this contract and agree that location is fitting in those courts.</p>
	        	</p>
	    	</div>
	    </div>
	    <div id="toPopup2">
	        <div class="close2"></div>
	       	<span class="arrow"></span>
			<div id="popup_content">
	            <p> 2222222222222222222222222222222</p>
	        </div>
	    </div>

	    <div id="toPopup3">
	        <div class="close3"></div>
	       	<span class="arrow"></span>
			<div id="popup_content">
	            <p>
		            <img src="images/logo.png" style="position:relative;top:-10px;"><br/>
		            #50,First Floor, Sellaperumalpet<br/>
					Lawspet Main Road<br/>
					Lawspet<br/>
					Pondicherry-605008<br/>
					Pondicherry<br/>
					India<br/>
					Mobile: +91 9894964175 / 8940400934 / 8940400939
					<br/>
					Email ID - <a href="mailto:enquiry@tracemein.com" style="text-decoration:none;color:#006076;padding:0px;">enquiry@tracemein.com</a>
	            </p>
	        </div>
	    </div>
	   	<div id="backgroundPopup"></div>
	</div>
</div>
</div>

<?php include("Footer.php");?>
<!--mid-->

<!--Load Javascript-->
<script>
if(google.loader.ClientLocation)
{
    visitor_city = google.loader.ClientLocation.address.city;
    $("#userCity").val(visitor_city);
	$("#cityvalue").html(visitor_city);
}
else
{
alert('We are not able to choose city Please Select Manually');
}
$("#userCityselect").focusout(function(){
  $("#cityvalue").css('display','inline-block');
  $("#userCityselect").css('display','none');
});
// citysuggestions should be displayed none
//userCityselect
$("#userCityselect").focusout(function(){
     setTimeout("$('#citysuggestions').fadeOut();", 100);
});
$("#searchlist").focusout(function(){
    setTimeout("$('#suggestions').fadeOut();", 600);
});
</script>




</body>
</html>
