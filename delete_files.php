<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Deleting your files</title>
<link rel="stylesheet" type="text/css" href="theStyle.css">
</head>
<body>
<div id="main">
<?php
          $filename = $_POST['deletefile'];
          #To make sure that the filename is in a valid format
          if (!preg_match('/^[\w_\.\-]+$/', $filename)) {
	          echo "Invalid filename";
	          exit;
          }


          #Get the username and make sure that it is alphanumeric with limited other characters.
          $userName = $_SESSION['userName'];
          if (!preg_match('/^[\w_\-]+$/', $userName)) {
	          echo "Invalid username";
												exit;
          }

          $full_path = sprintf("/srv/uploads/%s/%s",$userName,$filename);

          if (unlink($full_path)) {
    	      header("Location: deleted_success.html");
    	      exit;
          }else{
    	      header("Location: deleted_fail.html");
    	      exit;
          }

?>
</div>
</body>
</html>