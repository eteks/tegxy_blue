<?php include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();


if(isSet($_POST['lastmsg']))
{
$lastmsg=$_POST['lastmsg'];

?><table>
<?php 
echo $sqltot="SELECT ET_Id ,ET_Image ,ET_Desp ,ET_From,ET_To,ET_Title FROM ".TABLE_EVENTS." WHERE ET_Id<'$lastmsg' order by ET_Id desc limit 2";
$SqlRun=db_query($sqltot);
$Count = db_num_rows($SqlRun);
if($Count>0){
$Pid=0;
while(list($ET_Id,$ET_Image,$ET_Desp,$ET_From,$ET_To,$ET_Title) = db_fetch_array($SqlRun)){
$msg_id=$ET_Id;
?>
<tr <?php if($Pid>4){?> data-id="3" style="display: none;" <?php }?>>
<td  valign="bottom" style="width: 115px; height: 141px; float: left; background: url(&quot;images/eventnoimage.png&quot;) no-repeat scroll 0px 0px transparent;"><div style="width:103px;height:120px;margin:5px 0px 0px 5px;"><img src="<?php echo $ET_Image;?>" width="103" height="120" /></div></td>
<td valign="top">
<table>
<tr>
<td style="height:33px;padding-top:0px;float:left;color:#016479;font-weight:600;font-size:15px;padding-bottom:0px;line-height:18px;" valign="top"><span style="color:#E76524;font-size:16px;"><?php echo $ET_Title;?></span><br/><span style="font-size:12px;">Date : </span><span style="color:#000;font-size:12px;"><?php echo $ET_From;?><?php echo StringLeftArrow($ET_To,' - ',3);?></span></td>
</tr>
<tr>
<td colspan="2" style="width:600px;height:90px;border:1px solid #CFCFCF;font-size:12px;padding-left:5px;padding-right:5px;"><?php echo $ET_Desp;?></td>
</tr>
</table>
</td>
</tr>
<?php $Pid++; }}?>
</table>
<div id="more<?php echo $msg_id; ?>" class="morebox">
<a href="#" class="more" id="<?php echo $msg_id; ?>">more<?php echo $msg_id?></a>
</div>
<?php }?>