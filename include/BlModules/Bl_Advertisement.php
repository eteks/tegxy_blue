<?php include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
include("../../../Mailer/class.phpmailer.php");
$action = $_REQUEST['action'];
$user   = $_REQUEST['user'];
if($action==1)
{
$type   = $_REQUEST['type'];
if($type==1)
{?>
<select id="Selectionlistadv" name="Selectionlistadv" class="memberinput" size="10">
<?php 
$Select=db_query("Select PS_Id,PS_Display From ".TABLE_PRODUCTSERVICE." WHERE PS_User_Fk='".$user."'  Order by PS_Display asc"); 
while(list($PS_Id,$PS_Display)=db_fetch_array($Select))
{ ?>
<option  value="<?php echo $PS_Id; ?>" ><?php echo $PS_Display; ?></option><?php 
}?>
</select>######	
<?php }
if($type==2)
{?>
<select id="Selectionlistadv" name="Selectionlistadv" class="memberinput" size="10">
<?php 
$Select=db_query("Select ET_Id,ET_Title From ".TABLE_EVENTS." WHERE ET_UserFk='".$user."'  Order by ET_Title asc"); 
while(list($ET_Id,$ET_Title)=db_fetch_array($Select))
{ ?>
<option  value="<?php echo $ET_Id; ?>" ><?php echo $ET_Title; ?></option><?php 
}?>
</select>######	
<?php }
if($type==3)
{?>
<select id="Selectionlistadv" name="Selectionlistadv" class="memberinput" size="10">
<?php 
$Select=db_query("Select GY_Id,GY_Title From ".TABLE_GALLERY." WHERE GY_UserFk 	='".$user."' AND ((GY_Type=0 AND GY_Type2=1) || (GY_Type=0 AND GY_Type2=2)) Order by GY_Title asc"); 
while(list($GY_Id,$GY_Title)=db_fetch_array($Select))
{ ?>
<option  value="<?php echo $GY_Id; ?>" ><?php echo $GY_Title; ?></option><?php 
}?>
</select>######	
<?php }
if($type=='')
{?>
<select>
</select>######	
<?php }
}
if($action==2)
{
$advname                      =  $_REQUEST['Advname'];
$advselectiontype             =  $_REQUEST['Advselectiontype'];
$advselectionlist             =  $_REQUEST['Advselectionlist'];
$advlinkselection             =  $_REQUEST['Advlinkselection'];
$advlinkurl                   =  $_REQUEST['Advlinkurl'];
$advimage                     =  $_REQUEST['Advimage'];
$advdescription               =  $_REQUEST['Advdescription'];
$advisplayformate             =  $_REQUEST['Advisplayformate']; 
$advtargetpage                =  $_REQUEST['Advtargetpage'];
$advlocation                  =  $_REQUEST['Advlocation'];
$advsector                    =  $_REQUEST['Advsector'];
$advaudience                  =  $_REQUEST['Advaudience'];
$advfromtimeline              =  $_REQUEST['Advfromtimeline'];
$advtotimeline                =  $_REQUEST['Advtotimeline']; 
$advamount                    =  $_REQUEST['Advamount'];
$advbudget                    =  $_REQUEST['Advbudget']; 
$advertise                    =  $_REQUEST['Advertise']; 
$advertiselevel               =  $_REQUEST['Advertiselevel']; 
if($advertise =='')
{
db_query("INSERT INTO ".TABLE_ADVERTISEMENT." SET ADV_Userfk='".$user."',ADV_Existornew='".$advertiselevel."',ADV_Selection='".$advselectiontype."',ADV_Name='".$advname."',ADV_Selectionfk='".$advselectionlist."',ADV_Linkyouradvto='".$advlinkselection."',ADV_Url='".$advlinkurl."',ADV_Imagepath='".$advimage."',ADV_Description='".$advdescription."',ADV_Displayformate='".$advisplayformate."',ADV_Targetpage='".$advtargetpage."',ADV_Sector='".$advsector."',ADV_Totalaudience='".$advaudience."',ADV_From='".ChangeDateforDB($advfromtimeline)."',ADV_To='".ChangeDateforDB($advtotimeline)."',ADV_Createdon=Now(),ADV_TotalAmount='".$advamount."', ADV_TotalBudget='".$advbudget."'");
$InsertId = db_insert_id();
if($InsertId){
	$Details = db_query("SELECT reg.RGT_Email,reg.RGT_OwnerName,adv.ADV_Name FROM ".TABLE_REGISTRATION." as reg INNER JOIN `tbl_advertisement` as adv ON adv.ADV_Userfk=reg.RGT_Pk where adv.ADV_Name='".$advname."' AND reg.RGT_Status=1");
	$FetDetails = db_fetch_array($Details);
	$ToAddress = $FetDetails['RGT_Email'];
	$ToName    = $FetDetails['RGT_OwnerName'];
	$AdvertisementName = $FetDetails['ADV_Name'];	
	$Message     = "<table border='0' cellpadding='0' cellspacing='0'  style='font-size: 12px; line-height: 25px;font-family:Arial, Helvetica, sans-serif; padding-left:5px;'>
					<tr><td height='10'></td></tr>
					<tr><td style='color:#006DB8;font-size:15px;'>Dear ".$ToName.",</td></tr>
					<tr><td ><p>Your Advertisement was approved by the XYget Admin</p><p>Your Advertisement Details are,</p></td></tr>
					<tr><td >
					<table width='100%' border='0' cellpadding='0' cellspacing='0'  style='font-size: 12px; line-height: 25px;font-family:Arial, Helvetica, sans-serif;padding-left:5px;'>
					<tr>
					<td width='20%'>Username</td>
					<td width='3%'>:</td>
					<td width='77%'>".$AdvertisementName."</td>
					</tr>
					<tr>
					</table>
					</td></tr>
					</table>";	
	$mailContent = file_get_contents("../../../MailTemplate.php");
	$Message = str_replace('MSGCONTENT',$Message, $mailContent);
	$Message = str_replace('../../../images/',HTTP_SERVER.'../../../images/', $Message);
	$Subject='Confirmation Mail';
	$FromName='XYget';
	$FromAddress='services@tracemein.com';	
	$sent = mail($Message,$Subject,$ToAddress,$ToName,$FromAddress,$FromName,'','');	
	if($sent)	   
		{
			echo "sucess";
		}
		else{
			echo "fail";
		}
}
echo "Added Successfully######";
}
else
{
db_query("UPDATE ".TABLE_ADVERTISEMENT." SET ADV_Existornew='".$advertiselevel."',ADV_Selection='".$advselectiontype."',ADV_Name='".$advname."',ADV_Selectionfk='".$advselectionlist."',ADV_Linkyouradvto='".$advlinkselection."',ADV_Url='".$advlinkurl."',ADV_Imagepath='".$advimage."',ADV_Description='".$advdescription."',ADV_Displayformate='".$advisplayformate."',ADV_Targetpage='".$advtargetpage."',ADV_Sector='".$advsector."',ADV_Totalaudience='".$advaudience."',ADV_From='".ChangeDateforDB($advfromtimeline)."',ADV_To='".ChangeDateforDB($advtotimeline)."',ADV_Createdon=Now(),ADV_TotalAmount='".$advamount."', ADV_TotalBudget='".$advbudget."' WHERE ADV_Id='".$advertise."'");
// echo "Renewed Successfully######";
echo "Updated Successfully######";		
}

}

if($action==3)
{
$editid               =  $_REQUEST['editid']; 
$Select = db_query("SELECT ADV_Name,ADV_Existornew,ADV_Selection,ADV_Selectionfk,ADV_Linkyouradvto,ADV_Url,ADV_Imagepath,ADV_Description,ADV_Displayformate,ADV_Targetpage,ADV_Sector,ADV_Totalaudience,ADV_From,ADV_To,ADV_TotalAmount,ADV_TotalBudget,ADV_Id FROM ".TABLE_ADVERTISEMENT." WHERE ADV_Id='".$editid."'");
list($ADV_Name, $ADV_Existornew, $ADV_Selection, $ADV_Selectionfk, $ADV_Linkyouradvto, $ADV_Url, $ADV_Imagepath, $ADV_Description, $ADV_Displayformate, $ADV_Targetpage, $ADV_Sector, $ADV_Totalaudience, $ADV_From, $ADV_To, $ADV_TotalAmount, $ADV_TotalBudget,$ADV_Id) = db_fetch_array($Select);
echo '#**#'.$ADV_Name.'#**#'.$ADV_Existornew.'#**#'.$ADV_Selection.'#**#';

if($ADV_Selection==1)
{
echo '<select id="Selectionlistadv" name="Selectionlistadv" class="memberinput" size="10">';
$Select=db_query("Select PS_Id,PS_Display From ".TABLE_PRODUCTSERVICE." WHERE PS_User_Fk='".$user."' Order by PS_Display asc"); 
while(list($PS_Id,$PS_Display)=db_fetch_array($Select))
{
$Selectiondropdown1 = ($ADV_Selectionfk == $PS_Id) ? 'selected=selected':'erwerwer';	
echo '<option  value='.$PS_Id.' '.$Selectiondropdown1.'>'.$PS_Display.'</option>';
}
echo '</select>';
}
else if($ADV_Selection==2)
{
echo '<select id="Selectionlistadv" name="Selectionlistadv" class="memberinput" size="10">';
$Select=db_query("Select ET_Id,ET_Title From ".TABLE_EVENTS." WHERE ET_UserFk='".$user."'  Order by ET_Title asc"); 
while(list($ET_Id,$ET_Title)=db_fetch_array($Select))
{
$Selectiondropdown2 = ($ADV_Selectionfk == $ET_Id) ? 'selected=selected':'werwerwer';	
echo '<option  value='.$ET_Id.' '.$Selectiondropdown2.'>'.$ET_Title.'</option>';
}
echo '</select>';
}
else
{
echo '<select id="Selectionlistadv" name="Selectionlistadv" class="memberinput" size="10">';
$Select=db_query("Select GY_Id,GY_Title From ".TABLE_GALLERY." WHERE GY_UserFk 	='".$user."' AND ((GY_Type=0 AND GY_Type2=1) || (GY_Type=0 AND GY_Type2=2)) Order by GY_Title asc"); 
while(list($GY_Id,$GY_Title)=db_fetch_array($Select))
{
$Selectiondropdown3 = ($ADV_Selectionfk == $GY_Id) ? 'selected=selected':'';	
echo '<option  value='.$GY_Id.' '.$Selectiondropdown3.'>'.$GY_Title.'</option>';
}
echo '</select>';
}
echo '#**#'.$ADV_Linkyouradvto.'#**#'.$ADV_Url.'#**#'.$ADV_Imagepath.'#**#'.$ADV_Imagepath.'#**#'.$ADV_Description.'#**#'.$ADV_Displayformate.'#**#'.$ADV_Targetpage.'#**#'.$ADV_Sector.'#**#'.$ADV_Totalaudience.'#**#'.ChangeDateforShow($ADV_From).'#**#'.ChangeDateforShow($ADV_To).'#**#'.$ADV_TotalAmount.'#**#'.$ADV_TotalBudget.'#**#'.$ADV_Id;
}
?>