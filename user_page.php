<?php
session_start();
?>

<!DOCTYPE html>
    <html>
        <head>
            <title>Welcome to your file sharing system</title>
            <link rel="stylesheet" type="text/css" href="theStyle.css">
        </head>
                
        <body>
            <div id="main">
                <h1>Welcome to your file sharing system!</h1>
                <h2>
                    <!--//    //$time = date("a") == "am"? "Morning": "Afternoon";-->
                    <!--//    //printf("<p><strong>Good %s，%s.</strong></p>\n",-->
                    <!--//    //                    $time, htmlentities($_POST['userName']));-->
                    <!--//    echo "Hello, ".$_SESSION['userName'];-->
                    <?php
                        //include("main_page.php");
                        //session_start();
                        echo "Hello, ".$_SESSION['userName'];
                    ?>
                </h2>
                <!--Uploading a File, uploadFiles.php handles the uploaded file-->
                <form enctype="multipart/form-data" action="upload_file.php" method="POST">
                    <p>
                        <input type="hidden" name="MAX_FILE_SIZE" value="20000000"/>
                        <label for="uploadFiles_input">Choose a file to upload: </label>
                        <input type="file" name="uploadedFiles" id="uploadFiles_input"/>
                    </p>
                    <p>
                        <input type="submit" name="Upload File" value="Upload"/>
                    </p>
                </form>
                <h4>The list of files: </h4>
                <?php
                    //session_start();

                    $userName = $_SESSION['userName'];
                    //if file path is not exist, create it.
                    if (!file_exists("/srv/uploads/$userName/")) {
                        mkdir("/srv/uploads/$userName");
                        chmod("/srv/uploads/$userName", 0777);
                    }
                    $full_path = sprintf("/srv/uploads/%s",$userName);
                    $dh = opendir($full_path);

                    //list the files of this user
                    if (is_dir($full_path)) {
                        while (($file = readdir($dh)) !== false) {
                            if (($file != ".") && ($file != "..")) {#.$file."<br>"
                                echo "<br>";
                                echo "<form name=\"input\" action=\"open_files.php\" method=\"POST\">";
                                echo "<input type=\"hidden\" value=".$file." name=\"openfile\">";
                                echo "<input type=\"submit\" value=\"Open\">".$file."<br>";
                                echo "</form>";

                                echo "<form name=\"input\" action=\"delete_files.php\" method=\"POST\">";
                                echo "<input type=\"hidden\" value=".$file." name=\"deletefile\">";
                                echo "<input type=\"submit\" value=\"Delete\">".$file."<br>";
                                echo "</form>";
                            }
                        }
                        closedir($dh);
                    }

                ?>
                <br>
                
                <!--use self-submitting form realize logout-->
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                    <input type="submit" name="logout" value="Logout"/>
                </form>
                <?php
                    if(isset($_POST['logout'])){
                        // remove all session variables
                        session_unset(); 

                        // destroy the session 
                        session_destroy();          
                        header("Location: main_page.php"); 
                    }
                ?>
            </div>
        </body>
        
    </html>