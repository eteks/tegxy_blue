<?php
ob_start();
session_start();

define('DB_SERVER','localhost');
define('DB_SERVER_PASSWORD','root');
define('DB_SERVER_USERNAME','root');
define('DB_DATABASE','xyget.com');
define('HTTP_URL','localhost/tegxy_blue');

$Title = 'XYget - Admin';



define('HTTP_SERVER', 'http://'.HTTP_URL.'/admin/');
define('DIR_WS_INCLUDES', 'include/');
define('PAGE_DBCONNECTION', DIR_WS_INCLUDES . 'DatabaseConnection.php');

define('TABLE_ADMINUSER', 'tbl_adminuser');
define('TABLE_ADMINUSERPERMISSION', 'tbl_adminuserpermission');
define('TABLE_MODULECATEGORY', 'tbl_modulecategory');
define('TABLE_MODULECATEGORYLIST', 'tbl_modulecategorylist');
define('TABLE_ROLE', 'tbl_role');

define('TABLE_SECTOR', 'tbl_sector');
define('TABLE_GENERALCOUNTRYMASTER', 'tbl_generalcountrymaster');
define('TABLE_GENERALSTATEMASTER', 'tbl_generalstatemaster');
define('TABLE_GENERALAREAMASTER', 'tbl_generalareamaster');
define('TABLE_REGISTRATION', 'tbl_registration');

define('TABLE_PRODUCTRELATIVITY','tbl_productrelativity');
define('TABLE_PRODUCTCATEGORY', 'tbl_productcategory');
define('TABLE_PRODUCTSUBCATEGORY', 'tbl_productsubcategory');
define('TABLE_PRODUCTTYPE', 'tbl_producttype');
define('TABLE_ADMINPRODUCT','tbl_adminproduct');
define('TABLE_PRODUCTSERVICE', 'tbl_productservice');
define('TABLE_PRODUCTSPECIFICATION','tbl_productspecification');
define('TABLE_ADVERTISEMENT','tbl_advertisement');
define('TABLE_AREAMASTER',' tbl_areamaster');
define('TABLE_PINCODEMASTER',' tbl_pincodemaster');
define('TABLE_ADVCURRENCY', 'tbl_adv_currency');
?>
