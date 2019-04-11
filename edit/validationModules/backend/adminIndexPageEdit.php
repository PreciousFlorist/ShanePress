<?php

/*--------------------------------------------------------------
# ADMIN HOME PAGE
--------------------------------------------------------------*/

// Reset variables (before information is processed)
$adminIndexTitle                              = "";
$adminIndexParagraph                          = "";
$adminIndexImage                              = "";

/*--------------------
# Visitor Permissions
--------------------*/

if($_SESSION["permission"] == "visitor"){

    if(
      isset($_POST["adminIndexTitle"] )          == TRUE
    ||isset($_POST["adminIndexParagraph"] )      == TRUE
    ){

        
        if(
            // Check the title
            empty($_POST["adminIndexTitle"] ) == FALSE
        ){
            //Sanitize the user input
            $adminIndexTitle = filter_var(trim ($_POST["adminIndexTitle"] ), FILTER_SANITIZE_STRING);
            if(ctype_space($adminIndexTitle) == FALSE){
                // Set the input to a cookie
                setcookie("adminIndexTitle", "$adminIndexTitle", time() + (3600), "/" ); // 3600 seconds = 90 minutes


    
            }
        } else{
            // Remove any previous cookies that may have existed 
            unset($_COOKIE["adminIndexTitle"]);
            setcookie("adminIndexTitle", null, -1, "/");
        }
    
        // Check the first paragraph content
        if(
            empty($_POST["adminIndexParagraph"] ) == FALSE
        ){
            //Sanitize the user input
            $adminIndexParagraph = filter_var(trim ($_POST["adminIndexParagraph"] ), FILTER_SANITIZE_STRING);
            if(ctype_space($adminIndexParagraph) == FALSE){
                // Set the input to a cookie
                setcookie("adminIndexParagraph", "$adminIndexParagraph", time() + (3600), "/" ); // 3600 seconds = 90 minutes
    
            }
        } else{
            // Remove any previous cookies that may have existed 
            unset($_COOKIE["adminIndexParagraph"]);
            setcookie("adminIndexParagraph", null, -1, "/");
        }
    
        // Check the image
        if(
            empty($_POST["adminIndexImage"] ) == FALSE
        ){
            $adminIndexImage = filter_var((trim ($_POST["adminIndexImage"] ) ), FILTER_SANITIZE_STRING);
        }else{
            unset($_SESSION["adminIndexImage"]);
        }
        
        header("location: https://www.shanewalders.com/backend/backendIndex.php");
        die();
    }
}   

/*--------------------
# Admin Permissions
--------------------*/
if ($_SESSION["permission"] == "admin" && isset($_SESSION["timer"]) ){
    if(
        isset($_POST["adminIndexTitle"] )        == TRUE
        ||isset($_POST["adminIndexParagraph"] )    == TRUE
        ||isset($_POST["homeImage"] )              == TRUE
    ){

        // We"re going to store these changes into the database, so establish a connection to the server here...
        $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

        if ($serverConnection->connect_error) {
            die("The server connection failed: " . $mysqli->connect_error);
        }

        // Once we"re connected to the mySQL database, check if the page title has changed
        if(
            empty($_POST["adminIndexTitle"] ) == FALSE
        ){
            $adminIndexTitle = filter_var(ucfirst(trim ($_POST["adminIndexTitle"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($adminIndexTitle) == FALSE){

                // Sanitize the variable
                $adminIndexTitle      = mysqli_real_escape_string($serverConnection, $adminIndexTitle);

                $sql = "UPDATE  majorPages
                        SET     title = \"$adminIndexTitle\" 
                        WHERE   pageName = \"AdminIndex\"
                    ";

                mysqli_query($serverConnection, $sql);
            }
        } 

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["adminIndexParagraph"] ) == FALSE
        ){
            $adminIndexParagraph = filter_var(ucfirst(trim ($_POST["adminIndexParagraph"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($adminIndexParagraph) == FALSE){
                    
                // Sanitize the variable
                $adminIndexParagraph      = mysqli_real_escape_string($serverConnection, $adminIndexParagraph);

                // And push the data upto the majorPages database
                $sql = "UPDATE  majorPages
                        SET     paragraph = \"$adminIndexParagraph\" 
                        WHERE   pageName = \"AdminIndex\" 
                    ";

                mysqli_query($serverConnection, $sql);
            }
        } 
        
        // Check the image
        if(
            empty($_POST["adminIndexImage"] ) == FALSE
        ){
            $adminIndexImage = filter_var((trim ($_POST["adminIndexImage"] ) ), FILTER_SANITIZE_STRING);
        } else{
            unset($_SESSION["adminIndexImage"]);
        }
        //Remove any local stylings that may have been made using sessions on this device
        unset($_SESSION["adminIndexTitleSession"]);
        unset($_SESSION["adminIndexParagraphSession"]);
        // And finally, close the server connection, and direct the user to the home page

        $serverConnection->close();
        header("location: https://www.shanewalders.com/backend/backendIndex.php");
        die();
    }
} 