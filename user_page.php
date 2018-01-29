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
                        session_start();
                        echo "Hello, ".$_SESSION['userName'];
                    ?>
                </h2>
                <!--Uploading a File, uploadFiles.php handles the uploaded file-->
                <form enctype="multipart/form-data" action="uploadFiles.php" method="POST">
                    <p>
                        <input type="hidden" name="MAX_FILE_SIZE" value="20000000"/>
                        <label for="uploadFiles_input">Choose a file to upload: </label>
                        <input type="file" name="uploadedFiles" id="uploadFiles_input"/>
                    </p>
                    <p>
                        <input type="submit" name="Upload File" value="Upload"/>
                    </p>
                </form>
            </div>
        </body>
        
    </html>