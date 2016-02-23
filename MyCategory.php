<?php 
$sqltot="SELECT Id,S_Name FROM ".TABLE_SECTOR." WHERE  Status =1 AND Id IN (SELECT PS_IndustryFk FROM ".TABLE_PRODUCTSERVICE." WHERE  PS_User_Fk =".$LID.") order by  Id  desc";
$SqlRun=db_query($sqltot);
$Count = db_num_rows($SqlRun);
?>
<div class="leftaccordiaon_top" >My Industry</div>
<div style="width:245px;height:auto;border:1px solid #C0C0C0;padding-bottom:5px;" >
<div id='cssmenu'>
<?php 
if($Count>0){
while(list($CatyId,$CatyName) = db_fetch_array($SqlRun)){
$sqltot1="SELECT PS_Id, PS_Fk  FROM ".TABLE_PRODUCTSERVICE." WHERE  PS_IndustryFk ='".$CatyId."' order by PS_Id  desc";	
$SqlRun1=db_query($sqltot1);
$Count1 = db_num_rows($SqlRun1);
	?>
 <ul>
   <li><a class="handsym" onclick="BestDealsFilter('<?php echo $CatyId.'_';?>');"><span><?php echo $CatyName;?></span></a>
   <?php if($Count1>0){?><ul><?php 
   while(list($SubCatyId,$SubCatyName) = db_fetch_array($SqlRun1)){
	   ?>	
         <li><a class="handsym" onclick="BestDealsFilter('<?php echo $CatyId.'_'.$SubCatyId;?>');"><?php echo ProductName($SubCatyName);?></a></li>
      <?php }?></ul><?php  }?>
   </li>
</ul>
<?php }} else echo '<div style="height:55px;"></div><div style="height:60px;text-align:center;" class="coldefault">No Industry Found</div>' ;?>
</div>
</div>
<div class="leftaccordion_btm" ></div>
