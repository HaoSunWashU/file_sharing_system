<!DOCTYPE html>
    <html>
        <head>
            <title> File Sharing System </title>
            <link rel="stylesheet" type="text/css" href="theStyle.css">
        </head>
        <body>
            <div id="main">
                <h1>Welcome to File Sharing System!</h1>
                <!--
                1. type in user name and press the login button, direct to login_signup_page.php
                2. type in user name and press the signup, direct to login_signup_page.php
                there are "login" and "signup" judgement in login_signup_page.php
                -->
                <form name="input" action="login_signup_page.php" method="POST">
                    <label for="userName">User Name (No ~!@#$%^&*()):</label>
                    <input type="text" name="userName">
                    <input type="submit" name="Login" value="Login">
                    <input type="submit" name="Signup" value="Signup">
                </form>
                    
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                    <label for="userName">User Name (No ~!@#$%^&*()):</label>
                    <input type="text" name="userName">
                    <input type="submit" name="Check" value="Check User Name">
                    <input type="submit" name="Login" value="Login">
                    <input type="submit" name="Signup" value="Signup">
                </form>
                
                <?php
                
                    //if user press check user name button
                    //give the information about whether the user name user just typed in exist
                    if(isset($_POST['Check'])){
                        
                        //check whether userName is set
                        if(isset($_POST['userName'])) {
                            //check users.txt file
                            $file = fopen("/srv/users.txt", "r"); 
                            $username = $_POST['userName'];
                            $isExist = false;
                            #check whether the username is in the file
                            // make sure username is valid
                            if (preg_match('/^[\w_\.\-]+$/', $username)) {   
                                while (!feof($file)) {
                                    //fgets reads the contents of a line, and trim() gets the value of fgets() for compare string
                                    if ($username == trim(fgets($file))) {      //find same user name
                                        $isExist = true;
                                        printf("<p><strong>%s already exists</strong></p>\n",
                                            htmlentities($_POST['userName']));
                                        fclose($file);
                                        exit;
                                    }
                                }
                                fclose($file);                  
                                if($isExist == false){                          //no same user name                   
                                    printf("<p><strong>%s can be used</strong></p>\n",
                                            htmlentities($_POST['userName']));
                                        exit;
                                    
                                }
                            }
                            else{
                                echo "Invalid username";
                                exit;
                            }   
                        }
                        else{  //user name is not set
                            echo "null user name";
                            exit;
                        }
                    }
                    //if user press login button
                    
                    //if user press create button
                ?>
                
        </body>
    </html>