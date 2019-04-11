<?php 
session_start();

    if( $_SESSION["permission"] == "admin" && isset($_SESSION["timer"]) ){

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

        }
        
    } elseif( $_SESSION["permission"] == "visitor"  && isset($_SESSION["timer"]) ){

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

        }

    } else{
        // If the users sessions are set to either BOTH visitor and admin, OR they're set to NEITHER, we'll send them back to the home page
        header("location: https://www.shanewalders.com/admin.php");
        die();
    }
?>