
<?php 
$sqltot="SELECT PSG_ImgPath FROM ".TABLE_PRODUCTSERVICEGALLERY." WHERE  PSG_UserFk 	='".$LID."' order by  PSG_Id  desc";
$SqlRun=db_query($sqltot);
$Count = db_num_rows($SqlRun);
if($Count>0){?>
<div id="lista3" class="als-container" style="border:2px solid #136578;margin-top:20px;border-radius:35px;padding:10px 0px;">
<span class="als-prev"><img src="images/left_arrow.png" alt="prev" title="previous" style="position:relative;top:30px;left:5px;"  /></span>
<div class="als-viewport" align="center">
<ul class="als-wrapper">
<?php while(list($PSG_ImgPath) = db_fetch_array($SqlRun)){?>
<li class="als-item"><img src="<?php echo $PSG_ImgPath;?>" width="178" height="120" style="cursor:default;" /></li><?php }?>
</ul>
</div>
<span class="als-next"><img src="images/right_arrow.png" alt="next" title="next"  style="position:relative;top:30px;right:20px;" /></span>
</div><?php }?>