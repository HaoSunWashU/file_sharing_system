<?php
	session_start();

	#Get the filename and make sure it is valid
	#if $_FILES['uploadedFiles']['name'] is null, that means upload failue
	if($_FILES['uploadedFiles']['name']){
		$filename = basename($_FILES['uploadedFiles']['name']);
		if (!preg_match('/^[\w_\.\-]+$/', $filename)) {
			echo "Invalid filename";
			exit;
		}

		#Get the username and make sure it is valid
		$userName = $_SESSION['userName'];
		if (!preg_match('/^[\w_\.\-]+$/', $userName)) {
			echo "Invalid userName";
			exit;
		}
        
		//if file path is not exist, create it.
		if (!file_exists("/srv/uploads/$userName/")) {
			mkdir("/srv/uploads/$userName");
			chmod("/srv/uploads/$userName", 0777);
		}
		//get full file path
		$full_path = sprintf("/srv/uploads/%s/%s", $userName, $filename);
	
		//judge whether uploading is successful
		if (move_uploaded_file($_FILES['uploadedFiles']['tmp_name'], $full_path)) {
			header("Location: upload_success.html");
			exit;
		}else{
			header("Location: upload_failure.html");
			exit;
		}
	}
	else{
		header("Location: upload_failure.html");
		exit;
	}
	
	
?>