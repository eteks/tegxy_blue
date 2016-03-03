<div class="heading" style="text-align:center">List of Visitors - Online</div>
<div id="ChatGrid">
<div id="chatlist" style="float:right;padding-right: 335px;text-align:center">
<?php

$profileurl= find_user_url($_SESSION['LID']);
$listonlineusers=db_query("SELECT * FROM ".TABLE_REGISTRATION." WHERE RGT_LastActiveTime > NOW()-60 AND  RGT_Status=1 AND RGT_VisitingPage='$profileurl' AND NOT RGT_PK=".$_SESSION['LID']." ");
$count=mysql_num_rows($listonlineusers);
if($count!='0'){
while($fetchonlineusers=db_fetch_array($listonlineusers)){
 ?>
 
 <h3><a style='color:green;padding:5px;' href="javascript:void(0)" onclick="javascript:chatWith('<?php echo $fetchonlineusers['RGT_PK']; ?>','<?php echo $fetchonlineusers['RGT_UserName']; ?>')">Chat with <?php echo $fetchonlineusers['RGT_UserName']; ?></a></h3>   
<?php }}
else{
    echo 'No Users Online';
}
 ?>
</div>
</div>