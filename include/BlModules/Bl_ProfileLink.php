<?php include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

$LID           = $_SESSION['LID'];

$ProfileLink = $_REQUEST['ProfileLink'];


$SqlChk = db_query("SELECT RGT_ProfileUrl FROM ".TABLE_REGISTRATION."  WHERE RGT_ProfileUrl='".$ProfileLink."'");
if(db_num_rows($SqlChk)>0)
echo "Already Exists";
else
{
db_query("UPDATE ".TABLE_REGISTRATION." SET RGT_ProfileUrl='".$ProfileLink."' WHERE RGT_PK='".$LID."'");
echo "Saved Successfully";
}
$ProfileDetails=db_query("SELECT RGT_ProfileUrl FROM ".TABLE_REGISTRATION." WHERE RGT_PK='".$LID."' AND RGT_Type=2");
$FetProfileDetails = db_fetch_array($ProfileDetails);
?>
######<input class="inp-text" name="ProfileLink"  id="ProfileLink" autocomplete="off" onkeyup="showHint(this.value)" type="text" size="30" value="<?php echo $FetProfileDetails['RGT_ProfileUrl'];?>" />
