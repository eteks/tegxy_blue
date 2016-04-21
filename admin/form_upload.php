<?php
	include_once("include/Configuration.php");
	include_once(PAGE_DBCONNECTION);
	db_connect();
	if(!$_FILES['adv_image']['error'])
	{
		
		$valid_file = true;
		if($_FILES['adv_image']['size'] > (1024000)) //can't be larger than 1 MB
		{
			$valid_file = false;
			$message = 'Oops!  Your file\'s size is to large.';
		}
		
		//if the file has passed the test
		if($valid_file)
		{
			//move it to where we want it to be
			$time = time();
			$new_file_name = strtolower($time.$_FILES['adv_image']['name']); //rename file
			move_uploaded_file($_FILES['adv_image']['tmp_name'], 'images/'.$new_file_name);
			$title = $_POST['adv_title'];
			$desc = $_POST['adv_description'];
			$page = $_POST['adv_targetpage'];
			$location = $_POST['adv_location'];
			$sector = $_POST['adv_sector'];
			$audience = $_POST['adv_audience'];
			$sql = mysql_query("select * from tbl_advertisement where ADV_Name = '$title' ");
			if(!mysql_num_rows($sql)){
				$new = mysql_query("insert into tbl_advertisement set ADV_Name = '$title',ADV_Description = '$desc',ADV_Targetpage='$page',ADV_Sector='$sector',ADV_Totalaudience = '$audience',ADV_Imagepath = 'admin/images/$new_file_name'");
			}
			echo 'Congratulations!  Your file was accepted.';
		}
	}
	//if there is an error...
	else
	{
		//set that to be the returned message
		echo 'Ooops!  Your upload triggered the following error:  '.$_FILES['photo']['error'];
	}
	
?>