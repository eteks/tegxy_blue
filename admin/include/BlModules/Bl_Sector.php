<?php  ob_start();
$ModuleId = $_REQUEST['ModuleId'];
$_POST['SubSectmaster'] = (isset($_POST['SubSectmaster']) ? $_POST['SubSectmaster'] : '');
$_REQUEST['SubSectmaster'] = (isset($_REQUEST['SubSectmaster']) ? $_REQUEST['SubSectmaster'] : '');
if(($_POST['SubSectmaster'] == 'Submit') || ($_REQUEST['SubSectmaster'] == 'Update'))
{
	$Sectcode=$_POST["Sectcode"];
	$TxtSector=$_POST["TxtSector"];
	$Status=$_POST['Status'];
	$ExistId=$_POST['ExistId']; 
	$ActiveStatus=$_POST['ActiveStatus'];
	$startdata=$_POST['startdata'];
	$SearchFilterFieldList=$_POST['hidSearchFilterFieldList'];
	$SearchFilterField=$_POST['hidSearchFilterField'];
	if($ExistId=='')
	{
		$ValidCheck=db_query("Select S_Code FROM ".TABLE_SECTOR." WHERE S_Code='".$Sectcode."' or S_Name='".$TxtSector."' ");
		$CountValid=db_num_rows($ValidCheck);
		if($CountValid!=0)
		{
			echo "<script>var serty=OnclickMenu('2','".$ModuleId."','Sector','0', '');</script>";
			/*header("Location:".HTTP_SERVER."Membership.php?s=2");
			exit;*/
		}	
		else
		{
			$Role_Query="INSERT INTO ".TABLE_SECTOR." SET `S_Code`='".$Sectcode."' ,`S_Name`='".$TxtSector."' ,`Createdby`='".$_SESSION['Admin_Id']."',`Createdon`=NOW() ,`Modifiedon`=NOW() ,`Status`='".$ActiveStatus."'";
			$Role_Insert=db_query($Role_Query); 
			$optId=mysql_insert_id();
			echo "<script>var serty=OnclickMenu('1','".$ModuleId."','Sector','$startdata', '$optId');</script>";
		}
	}
	else
	{
		$Role_Query="UPDATE ".TABLE_SECTOR." SET `S_Code`='".$Sectcode."' ,`S_Name`='".$TxtSector."' ,`Modifiedon`=NOW() ,`Status`='".$ActiveStatus."' Where Id='".$ExistId."'";
		$Role_Insert=db_query($Role_Query); 
		$optId = $ExistId;
		echo "<script>var serty=OnclickMenu_Edit('5','".$ModuleId."','Sector','$startdata', '$optId', '$SearchFilterFieldList', '$SearchFilterField');</script>";
	}
	exit;
}
$_REQUEST['action'] = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');
$_REQUEST['Action'] = (isset($_REQUEST['Action']) ? $_REQUEST['Action'] : '');
if($_REQUEST['action']=='delete' || $_REQUEST['action']=='status' || $_REQUEST['action']=='Page' || $_REQUEST['Action']=='Filter')
{
	include_once("../Configuration.php");
	include_once("../DatabaseConnection.php");
	db_connect();
	
	$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);

	if($_REQUEST['action']=='delete')
	{
		db_query("delete from ".TABLE_SECTOR." where Id=".$_REQUEST['id']."");
		/* echo "<script>var serty=OnclickMenu('3','".$ModuleId."','Sector','".$_REQUEST['startdata']."');</script>"; */
	}
	
	if($_REQUEST['action']=='status')
	{
		db_query("Update ".TABLE_SECTOR." SET Status='".$_REQUEST['val']."' where Id=".$_REQUEST['id']."");
		/* echo "<script>var serty=OnclickMenu('4','".$ModuleId."','Sector','".$_REQUEST['startdata']."');</script>"; */
		$optId = $_REQUEST['id'];
	} ?>
	<?php
		$all_Sql = "Select DISTINCT a.Id, a.S_Code, a.S_Name, a.Status From ".TABLE_SECTOR." a ";
		$orderBy = ' a.Id ';
                $_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
		if($_REQUEST['SearchFilterFieldList']=='Sector')
		{
			if($_REQUEST['SearchFilterField']!='')
			{
				$WhereCont = ' where S_Name like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
			}	
			else
			{
				$WhereCont = ' where 1'	;
			}	
		}
		$gridHead = 'Sector Details';
		$colHead  = array("Sl.No.", "Sector Code", "Sector Name", "Status", "Action");
		include_once('../../five_col_grid.php');
	?>
	<?php
} ?>
