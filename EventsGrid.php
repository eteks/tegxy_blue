<?php //href="EventsView.php?user=<?php echo $_REQUEST['user']; 
$sqltot="SELECT ET_Id ,ET_Image ,ET_Desp ,ET_From,ET_To,ET_Title FROM ".TABLE_EVENTS." WHERE  ET_UserFk 	='".$LID."' AND ET_Desp!='' order by  ET_From  desc";
$SqlRun=db_query($sqltot);
$Count = db_num_rows($SqlRun);
list($ET_Id ,$ET_Image ,$ET_Desp ,$ET_From,$ET_To,$ET_Title) = db_fetch_array($SqlRun)	
?>
<link href="css/eventpopup.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/script.js"></script>
<div class="eventbg"><b>Events</b>&nbsp;&nbsp;&nbsp;<img src="images/mic.png" style="position:relative;top:8px;" /></div>
<div style="width:85%;margin:0 1%;border:1px solid #9EA9B5;border-radius:5px 5px;padding:0px 7px; text-align:justify;font-size:13px;background:#F1F1F1;">
<?php if($Count>0){?>
<p style="padding:0 3%;"><a style="text-decoration:none;color:#000;" ><?php if(strlen(stripslashes($ET_Desp))>100){ echo substr(stripslashes($ET_Desp),0,150).'...' ;} else { echo stripslashes($ET_Desp);} ?></a></p>
<div style="width:98%;height:40px;margin:0 1%;">
<div style="width:50%;height:40px;float:left;"></div>
<div style="width:50%;height:30px;padding-top:10px;float:left;" align="right">	<a href="#" class="topopup" style="text-decoration:none;color:#F09B27;font-size:14px;font-style:italic;">Know More</a></div>
    <div id="toPopup"> 
        <div class="close"></div>
       	<span class="arrow"></span>
		<div id="popup_content"> <!--your content start-->
            <p style="float:left;margin-top:0px;"><img src="<?php echo $ET_Image;?>" width="103" height="120" style="margin-right:20px;border:2px solid #BCBCBC;" /><p style="margin-top:0px;color:#E76524;font-size:16px;font-weight:bold;"><?php echo $ET_Title;?><br/><span style="font-size:15px;color:#016479;font-weight:600;">Date : </span><span style="color:#000;font-size:12px;"><?php echo ChangeDateforShow($ET_From);?><?php echo StringLeftArrow(ChangeDateforShow($ET_To),' - ',3);?></span></p><p style="text-align:justify;height:auto;padding-right:10px;"><?php echo $ET_Desp;?></p></p>
        </div> <!--your content end-->
    </div> <!--toPopup end-->
	<div class="loader"></div>
   	<div id="backgroundPopup"></div>
</div>
<?php } else echo '<div style="height:55px;"></div><div style="height:75px;text-align:center;" class="coldefault">No Events</div>' ;?>
</div>
<div style="width:90%;height:27px;background:url(images/shadow.png) no-repeat center top;margin-left:auto;margin-right:auto;
z-index:-100px;position:relative;top:-15px;"></div>
