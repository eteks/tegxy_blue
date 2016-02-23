<?php include_once("include/Configuration.php");?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tracemein</title>
<link rel="icon" href="images/favicon.ico">
</head>
<?php  include("CommonHeader.php");?>
<div style="width:990px;height:auto;clear:left;margin-top:0px;margin-left:auto;margin-right:auto;">
<div id="contentwrapper">
<div id="contentcolumn">
<div class="innertube"><br /><input type="hidden" id="ELogIdd" name="ELogIdd" value="<?php echo $LID;?>" />
<input type="hidden" id="EventStartData" name="EventStartData" value="0" />

<div class="comment more" id="EventsGrid">
<?php $sqltot="SELECT ET_Id ,ET_Image ,ET_Desp ,ET_From,ET_To,ET_Title FROM ".TABLE_EVENTS." WHERE ET_UserFk 	='".$LID."' AND ET_Id = '".$_REQUEST['isd']."'order by ET_From DESC LIMIT 5";
$SqlRun=db_query($sqltot);
list($ET_Id,$ET_Image,$ET_Desp,$ET_From,$ET_To,$ET_Title) = db_fetch_array($SqlRun);?>

<div style="width:100%;height:10px;"><p align="right"><a <?php  if(isset($HL) && !empty($HL)) if($HL==3){?> class="current" <?php }?> onclick="ProfileViewGrid('EventsView.php?user=<?php $_REQUEST['user'] = (isset($_REQUEST['user']) ? $_REQUEST['user'] : ''); echo $_REQUEST['user'];?>');" style="text-decoration:none;color:#FC5826;font-size:14px;"><img src="images/back-alt-icon.png" style="cursor:pointer;" title="Back"/></a></p></div>
<div style="height:33px;padding-top:0px;float:left;color:#016479;font-weight:600;font-size:15px;padding-bottom:0px;line-height:18px;" valign="top"><span style="color:#E76524;font-size:16px;"><?php echo $ET_Title;?></span><br/><span style="font-size:12px;">Date : </span><span style="color:#000;font-size:12px;"><?php echo ChangeDateforShow($ET_From);?><?php echo StringLeftArrow(ChangeDateforShow($ET_To),' - ',3);?></span></div><br/><br/>
<p> <div style="width:125px;height:151px;background:url(images/eventnoimage.png) no-repeat;float:left;"><div style="width:103px;height:120px;margin:5px 0px 0px 5px;"><a href="#thumb" class="thumbnail"><img src="<?php echo $ET_Image;?>" width="103" height="120" /><span><img src="<?php echo $ET_Image;?>" width="300" height="200" /></span></a></div></div><?php echo $ET_Desp;?></p>

</div>
</div>
</div>
<?php include("ProfileRight.php");?>
</div>
</div>
<!-- Footer -->
