<?php 
// Here we will check to see whether or not the user is already signed in
session_start();

    if( $_SESSION["permission"] == "admin"
    ||  $_SESSION["permission"] == "visitor"
    &&  isset($_SESSION["timer"]) ){

        $theTime = $_SESSION["timer"];
        //Check if the last reset was more than 30 minutes ago
        if ( (time() - $theTime > 1800)) {

            // unset $_SESSION variable for the run-time 
            session_unset($_SESSION["timer"]);
            session_unset($_SESSION["permission"]);
            // destroy session data in storage
            session_destroy();   
            // And finally, send the user back to the sign-in page
            header("location: https://www.shanewalders.com/admin.php");
            die();

        } elseif ( time() - $theTime < 1800 ){

            // The user is still active, so we'll reset the time stamp
            $_SESSION["timer"] = time();
            // And we'll route the user back to the admin index page
            header("location: https://www.shanewalders.com/backend/backendIndex.php");
            die();
        }
    }
    
$usernamePlaceholder = "Input your username here...";
$passwordPlaceholder = "Input your password here...";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shane Walders - Admin</title>
    <?php
        require_once('modules/headerFiles.php');
    ?>
</head>
<body class="adminAccess">
    <div class="contentBody">
        <div class="wrapper"> 
            <h1> Admin Login </h1>
            <form method="POST" action="backend/backendValidation.php">
                <div class="formGroup">
                <!-- Username -->
                    <label for="username" class="formTitle username">Username:</label><br>
                    <input type="text" name="username" id="username"
                    <?php 
                        echo "\" placeholder=\"$usernamePlaceholder\"";
                    ?> required=""><br>

            <!-- Password -->
                    <label for="password" class="formTitle">Password:</label><br>
                    <input type="password" name="password" id="password"
                    <?php 
                        echo "\" placeholder=\"$passwordPlaceholder\"";
                    ?> required="">
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
