<?php 
$sqltot="SELECT GY_Image,GY_Title FROM ".TABLE_GALLERY." WHERE  ((GY_Type=0) || (GY_Type=1 AND GY_Type2=0)) AND GY_UserFk='".$LID."' order by  GY_Id desc";
$SqlRun=db_query($sqltot);
$Count = db_num_rows($SqlRun);
?>
<div style="width:96%;margin:-3% 1% 0 1%;padding:1% 0 1% 0;text-align:center;background:url(images/title_ornage.png) no-repeat center;color:#fff;"><b>Gallery</b></div>
<div style="width:85%;margin:-2px 1% 0 1%;border:1px solid #9EA9B5;border-radius:5px 5px;padding:0px 7px; text-align:justify;font-size:13px;background:#F1F1F1;">
<div style="width:96%;height:5px;"></div>
<div style="width:96%;height:130px;" align="center">
<div id="lista2" class="als-container">
<span class="als-prev"><img src="images/left_arrow.png" alt="prev" title="previous" /></span>
<div class="als-viewport" align="center">
<ul class="als-wrapper">
<?php if($Count>0){ while(list($GY_Image,$GY_Title) = db_fetch_array($SqlRun)){
?>
<li class="als-item"><a onclick="ProfileViewGrid('GalleryView.php?user=<?php echo $_REQUEST['user'];?>');"><img src="<?php echo $GY_Image;?>" width="200" height="125"  /><!--<span style="line-height:16px;"><?php //if(strlen(stripslashes($GY_Title))>10){ echo substr(stripslashes($GY_Title),0,20).'...' ;} else { echo stripslashes($GY_Title);} ?></span>--></a></li><?php }} else echo '<div  style="height:55px;"></div><div style="height:75px;text-align:center;"><li class="als-item coldefault">No Gallery</li></div>' ;?>
</ul>
</div>
<span class="als-next"><img src="images/right_arrow.png" alt="next" title="next" /></span>
</div>
</div>
</div>
<div style="width:90%;height:27px;background:url(images/shadow.png) no-repeat center top;margin-left:auto;margin-right:auto;
z-index:-100px;position:relative;top:-15px;"></div>