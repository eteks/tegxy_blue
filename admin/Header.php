<?php include_once("include/Configuration.php");
	 
include_once(PAGE_DBCONNECTION);
db_connect();

$PageName = basename($_SERVER['SCRIPT_FILENAME'],'.php');
if(!isset($_SESSION['Admin_Id']))
{
	header("location:Login.php");
} 
$ModuleCat = PermissionList($_SESSION['Admin_Id'],'ModuleCategory_fk');
$ModuleCatList = PermissionList($_SESSION['Admin_Id'],'ModuleList_fk'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Title;?></title>
<?php include("ScriptStyle.php"); ?>
<script type="text/javascript">
$(document).ready(function (e) {
	$("#post_advertisement").live('submit',function(e) {
		var formdata = new FormData($(this)[0]);
		e.preventDefault();
		$.ajax({
			url: "form_upload.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: formdata, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			async: false,
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data){   // A function to be called if request succeeds
				alert(data);
				location.reload();
			}
		});
	});
});
</script>
</head>
<body style="height:100% !important;">

<input type="hidden" name="Keycal" id="Keycal" />
<table width="1000" height="100%" border="0" align="center" cellpadding="0"  cellspacing="0">
<tr>
    <td width="225" align="left" valign="top" class="td">
    <div id="LeftNaviGationTab" style="position:fixed;background-color:#000000;width:225px;float:left;">
    <table width="100%" border="0" class="inner_td" cellspacing="0" cellpadding="0">
        <tr><td height="94" align="left" ><img src="images/logo.png" width="200"></td></tr>
        <tr><td align="left" valign="top" class="space" ></td></tr>
        <tr>
            <td height="224" align="left" valign="top" >
                <table width="234" border="0" cellspacing="0" class="admin" cellpadding="0">
                    <tr><td height="75" class="lft_title">Admin Activities</td></tr>
                    <tr><td height="5"></td></tr>
                    <tr>
                        <td >
                            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0"><?php
                            for($i=1;$i<=count($ArrayModuleCategory);$i++)
                            {  
								$CatKey = @array_search($ArrayModuleCategoryPk[$i],$ModuleCat);
								if(@$CatKey>0) 
								{?>
                                <tr>
                                    <td width="15" height="26" align="center"><img src="images/list_icon.gif" width="4" height="8" /></td>
                                    <td height="26"><a <?php //echo $ArrayModuleCategoryFunction[$i]; ?> onclick="OnClickLeftNavigation('<?php echo $i;?>','<?php echo count($ArrayModuleCategory);?>');"  style="cursor:pointer;"  id="MainMenuNavigation<?php echo $i; ?>" ><?php echo $ArrayModuleCategory[$i];?></a></td>
                                </tr><?php
								}
								else
								{ ?><a id="MainMenuNavigation<?php echo $i; ?>" ></a><?php 									
								}
                            } ?>
                            </table>
                        </td>
                  </tr>
                </table>
            </td>
        </tr>
        <tr><td align="left" valign="top" class="space" ></td></tr>
        
    </table>
    </div>
    </td>
    <td align="left" valign="top" class="td" width="740">
        <table width="100%" class="inner_td" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="left" valign="top" width="740" height="500">
            <div id="networkBar" style="background-color:#000000;width:740px; position:fixed;">
                <div id="networkBarPopup" style="display:block;background-color:#000000;width:740px;">
                    <div id="networkBarBanners">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="40" align="left">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="100%" height="69" align="left" valign="top">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td height="45" align="right">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center"><img src="images/icon_1.gif" width="23" height="23" style="cursor:pointer;text-decoration:none;" onClick="window.location.href='index.php';" /></td>
                                                <td rowspan="2" align="center"><img src="images/menu-line.gif" width="1"  height="23" /></td>
                                                <td align="center"><img src="images/icon_5.gif" style="cursor:pointer;text-decoration:none;" onClick="return OnclickMenu('0','<?php echo $ModuleId;?>','ChangePassword');" width="21" height="21" border="0" /></td>
                                                <td rowspan="2" align="center"><img src="images/menu-line.gif" width="1"  height="23" /></td>
                                                <td align="center"><img src="images/icon_3.gif" border="0" width="22" height="22" /></td>
                                                <td rowspan="2" align="center"><img src="images/menu-line.gif" width="1" height="23" /></td>
                                                
                                                
                                                
                                                <td width="124" nowrap="nowrap" rowspan="2" class="wel">welcome to xyz <br />Logged : <?php echo $_SESSION['LoginId'];?></td>
                                            </tr>
                                            <tr>
                                                <td width="90" align="center" valign="top"><a id="HomeId" style="cursor:pointer;text-decoration:none;" onClick="window.location.href='index.php';" >Home</a></td>
                                                <td width="90" align="center" valign="top"><a style="cursor:pointer;text-decoration:none;" onClick="return OnclickMenu('0','<?php echo $ModuleId;?>','ChangePassword');" >Change Password</a></td>
                                                
                                                <td width="90" align="center" valign="top"><a style="cursor:pointer;text-decoration:none;" href="Logout.php">Logout</a></td>
                                                <!--<td width="50" align="center"><a href="#" onclick="return approval();">Approval</a></td>
                                                <td align="center"><a href="#" onclick="return cms();">CMS</a></td>-->
                                            </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="con_title"><?php
                                            for($i=1;$i<=count($ArrayModuleCategory);$i++)
                                            { 
                                                if($i==1){	$style='style="display:block"';	}
                                                else	{	$style='style="display:none"';	}  ?>
                                            <div id="ModuleCat<?php echo $i;?>" <?php echo $style; ?> ><?php echo $ArrayModuleCategory[$i];?></div><?php
                                            } ?>
                                        </td>
                                    </tr>
                                    </table>
                                    </td>
                                </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top">
                                <table width="500" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center" class="scr"><?php
                                    for($i=1;$i<=count($ArrayModuleCategory);$i++)
                                    {
                                        if($i==1){	$style='style="display:block"';	}
                                        else	{	$style='style="display:none"';	}  
                                        $SelectModuleCategoryList = "Select ModuleList_pk,ModuleList_name,ModuleList_function,ModuleList_image from ".TABLE_MODULECATEGORYLIST." where ModuleList_status='1' and ModuleList_fk='".$ArrayModuleCategoryPk[$i]."'"; 
                                        $SelectModuleCategoryList_Qry = db_query($SelectModuleCategoryList);
                                        $SelectModuleCategoryList_num = db_num_rows($SelectModuleCategoryList_Qry); ?>
                                        <div id="ModuleCat<?php echo $i;?>_scr" <?php echo $style; ?> >
                                            <div id="slide" style="display:block;">
                                                <div id="scrollable<?php echo $i;?>"> <a class="prev"></a> <a class="next"></a>
                                                <div class="items-scroll"><?php $countModu=0;
                                                while ($SelectModuleCategoryList_fetch = db_fetch_array($SelectModuleCategoryList_Qry))
                                                { 
                                                    $ModKey = @array_search($SelectModuleCategoryList_fetch['ModuleList_pk'],$ModuleCatList);
                                                    if(@$ModKey>0) 
                                                    {?>
                                                  <div class="slide-items"><span style="cursor:pointer;" <?php echo $SelectModuleCategoryList_fetch['ModuleList_function'];?>><?php if($SelectModuleCategoryList_fetch['ModuleList_image']!=''){ ?><img src='<?php echo $SelectModuleCategoryList_fetch['ModuleList_image'];?>' alt='<?php echo $SelectModuleCategoryList_fetch['ModuleList_name'];?>'   border="0" /><?php } ?></span></div><?php $countModu++;
                                                    }
                                                } 
                                                if($countModu<2)
                                                { ?>
                                                  <div class="slide-items"><span style="cursor:pointer;width:50px;"></span></div><div class="slide-items"><span style="cursor:pointer;width:50px;"></span></div><?php 										
                                                }
                                                ?>
                                                </div>                    
                                                </div>
                                            </div>
                                        </div><?php
                                    } ?>

                                    </td>
                                </tr>
                                </table>
                            </td>
                        </tr>
                        </table>
                    <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div id="AminMainContent" style="width:740px; margin-top:170px;">
            <div id="networkBarControls" style="text-align:left;position:fixed;"><a id="networkBarButton"><span class="" id="networkBarButtonArrow"><img src="images/Arrow_Up.png" alt="Mouse hover to Hide the Module" title="Mouse hover to Hide the Module" width="16" height="16" border="0" style="cursor:pointer;" /></span></a><input type="hidden" name="networkBarButtonvalue" id="networkBarButtonvalue" value='' /> </div><br />
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
            <tr>
                <td align="left" valign="top" class="ctd">
