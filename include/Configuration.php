<?php 
ob_start(); 
session_start();

define('DB_SERVER','localhost');define('DB_SERVER_USERNAME','root');define('DB_SERVER_PASSWORD','root');
define('DB_DATABASE','tracemein2');// tracemein tracemein_live_db
define('HTTP_URL','localhost/xyget2015');
$Title = 'XYget.com';


define('HTTP_SERVER', 'http://'.HTTP_URL.'/');
define('DIR_WS_INCLUDES', 'include/');
define('PAGE_DBCONNECTION', DIR_WS_INCLUDES . 'DatabaseConnection.php');


define('TABLE_SECTOR', 'tbl_sector');
define('TABLE_GENERALCOUNTRYMASTER', 'tbl_generalcountrymaster');
define('TABLE_GENERALSTATEMASTER', 'tbl_generalstatemaster');
define('TABLE_GENERALAREAMASTER', 'tbl_generalareamaster');
define('TABLE_REGISTRATION', 'tbl_registration');
define('TABLE_PROFILE', 'tbl_profile');
define('TABLE_PROFILEDETAILS', 'tbl_profiledetails');

define('TABLE_PRODUCTRELATIVITY','tbl_productrelativity');
define('TABLE_PRODUCTCATEGORY', 'tbl_productcategory');			
define('TABLE_PRODUCTSUBCATEGORY', 'tbl_productsubcategory');	
define('TABLE_PRODUCTTYPE', 'tbl_producttype');					
define('TABLE_ADMINPRODUCT','tbl_adminproduct');
define('TABLE_PRODUCTSPECIFICATION','tbl_productspecification');

define('TABLE_PRODUCTSERVICE','tbl_productservice');
define('TABLE_PRODUCTSERVICEGALLERY','tbl_productservicegallery');
define('TABLE_SPECIFICATION','tbl_specification');


define('TABLE_LOGO',' tbl_logo');
define('TABLE_GALLERY',' tbl_gallery');

define('TABLE_AREAMASTER',' tbl_areamaster');
define('TABLE_PINCODEMASTER',' tbl_pincodemaster');
define('TABLE_LOCATION',' tbl_location');
define('TABLE_EVENTS',' tbl_events');
define('TABLE_CONTACT',' tbl_contact');
define('TABLE_ADVCURRENCY', 'tbl_adv_currency');
define('TABLE_STOREFILESIZE', 'tbl_storefilesize');
define('TABLE_ADVERTISEMENT', 'tbl_advertisement');

define('TABLE_KEYWORDMST','tbl_keywordmst');
define('TABLE_MEMBERKEYWORD','tbl_memberkeyword');
define('TABLE_OPERATINGAREA','tbl_operatingarea');
?>
