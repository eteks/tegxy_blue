<?php 
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();
$HL=3;
include("CommonHeader.php");?>
<style type="text/css">
.thumbnail{
position: relative;
z-index: 0;
cursor:url(images/zoomin.cur),auto;
}
.thumbnail:hover{
background-color: transparent;
z-index: 50;
}
.thumbnail span{ /*CSS for enlarged image*/
position: absolute;
background-color: lightyellow;
padding: 5px;
left: -1000px;
border: 1px solid #aaa;
visibility: hidden;
color: black;
text-decoration: none;
top:-1000px;
}
.thumbnail span img{ /*CSS for enlarged image*/
border-width: 0;
padding: 2px;
cursor:default;
}

.thumbnail:hover span{ /*CSS for enlarged image on hover*/
visibility: visible;
z-index: 1000;
left: 130px; /*position where enlarged image should offset horizontally */
top:-130px;
}
</style>
<div style="width:990px;height:auto;clear:left;margin-top:0px;margin-left:auto;margin-right:auto;">
<div id="contentwrapper">
<div id="contentcolumn">
<div class="innertube"><center><h2 style="position:relative;color:#E76524;font-weight:bold;text-align:center;padding:5px 0px;">Activities</h2></center>
<input type="hidden" id="ELogIdd" name="ELogIdd" value="<?php echo $LID;?>" />
<input type="hidden" id="EventStartData" name="EventStartData" value="0" />

<div class="comment more" id="EventsGrid">
<?php if($EnableCount3>0){?>
<table>
<?php 
$Overallsql = "SELECT ET_Id ,ET_Image ,ET_Desp ,ET_From,ET_To,ET_Title FROM ".TABLE_EVENTS." WHERE ET_UserFk 	='".$LID."' order by ET_From";
$Overallcount = db_num_rows(db_query($Overallsql));

$sqltot=$Overallsql." DESC LIMIT 5";
$SqlRun=db_query($sqltot);

/*$sqltot="SELECT ET_Id ,ET_Image ,ET_Desp ,ET_From,ET_To,ET_Title FROM ".TABLE_EVENTS." WHERE  ET_UserFk 	='".$LID."' order by  ET_Id  desc";
$tot=db_query($sqltot);
$rtot=db_num_rows($tot);
$totalrecord=$rtot;  $pagesize=10;
$noofpages=$totalrecord/$pagesize;
$startdata=0;
$SqlRun=db_query($sqltot." limit $startdata,$pagesize");*/
$Count = db_num_rows($SqlRun);
if($Count>0){
$Pid=0;
while(list($ET_Id,$ET_Image,$ET_Desp,$ET_From,$ET_To,$ET_Title) = db_fetch_array($SqlRun)){
$msg_id=$ET_From;
?>
<tr <?php if($Pid>4){?> data-id="3" style="display: none;" <?php }?>>
<td  valign="bottom" style="width: 115px; height: 141px; float: left; background: url(&quot;images/eventnoimage.png&quot;) no-repeat scroll 0px 0px transparent;"><div style="width:103px;height:120px;margin:5px 0px 0px 5px;"><a href="#thumb" class="thumbnail"><img src="<?php echo $ET_Image;?>" width="103" height="120" /><span><img src="<?php echo $ET_Image;?>" width="300" height="200" /></span></a></div></td>
<td valign="top">
<table>
<tr>
<td style="height:33px;padding-top:0px;float:left;color:#016479;font-weight:600;font-size:15px;padding-bottom:0px;line-height:18px;" valign="top"><span style="color:#E76524;font-size:16px;"><?php if(strlen(stripslashes($ET_Title))>60){ echo substr(stripslashes($ET_Title),0,65).'...' ;} else { echo stripslashes($ET_Title);} ?></span><br/><span style="font-size:12px;">Date : </span><span style="color:#000;font-size:12px;"><?php echo ChangeDateforShow($ET_From);?><?php echo StringLeftArrow(ChangeDateforShow($ET_To),' - ',3);?></span></td>
</tr>
<tr>
<td valign="top" colspan="2"  style="border:1px solid #CFCFCF;">
<table>
<tr>
<td valign="top"  style="width:600px;height:55px;font-size:12px;padding-left:5px;padding-right:5px;"><?php if(strlen(stripslashes($ET_Desp))>100){ echo substr(stripslashes($ET_Desp),0,150).'...' ;} else { echo stripslashes($ET_Desp);} ?></td>
</tr>
<?php if(strlen(stripslashes($ET_Desp))>100){?><tr>
<td valign="bottom" ><span align="right"><input type="button" style="width:80px;height:24px;background:transparent url(images/know-morw.png) no-repeat;border:none;cursor:pointer;float:right;" onclick="ProfileViewGrid('Eventviewmore.php?user=<?php echo $_REQUEST['user'];?>&isd=<?php echo $ET_Id;?>');"  /></span></td>
</tr><?php }?></table>
</td></tr>
</table>
</td>
</tr>
<?php $Pid++; }}?>
</table>
<?php /*?><table cellpadding="0" cellspacing="0" border="0" align="right">
<tr class="gridbgcolor"  height="25"><td colspan="5"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'EventsViewPage'); ?></td></tr>
</table><?php */
if($Overallcount>5){?>
<div onclick="ViewMoree('more<?php echo $msg_id; ?>','<?php echo $msg_id; ?>','EventsGrid','Bl_EventsView','pass',<?php echo "'".$_REQUEST['user']."'";?>)" id="more<?php echo $msg_id; ?>" class="viewmoree">
View More
</div><div style="height:10px""></div><?php }?>
<?php } else echo '<center class="msgalert">No Record Found</center>'; ?>     
</div>
</div>
</div>
<?php include("ProfileRight.php");?>
</div>
</div>
