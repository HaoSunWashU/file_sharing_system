<?php
    session_start();

    $filename = $_POST['openfile'];
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

    #We need to get the MIME type
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($full_path);
    ob_clean();

    #Set the content-type header to the MIME type of the file and display it
    header("Content-Type: ".$mime);
    readfile($full_path);
?>
