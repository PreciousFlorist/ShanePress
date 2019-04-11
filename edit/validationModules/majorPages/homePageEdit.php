<?php

/*--------------------------------------------------------------
# HOME PAGE
--------------------------------------------------------------*/

// Reset variables (before information is processed)
    $homeTitle                              = "";
    $homeParagraph                          = "";
    $homeImage                              = "";

/*--------------------
# Visitor Permissions
--------------------*/

if($_SESSION["permission"] == "visitor"){

    if(
      isset($_POST["homeTitle"] )          == TRUE
    ||isset($_POST["homeParagraph"] )      == TRUE
    ||isset($_POST["homeImage"] )          == TRUE
    ){
        
        if(
            // Check the title
            empty($_POST["homeTitle"] ) == FALSE
        ){
            //Sanitize the user input
            $homeTitle = filter_var(trim ($_POST["homeTitle"] ), FILTER_SANITIZE_STRING);
            if(ctype_space($homeTitle) == FALSE){
                // Set the input to a cookie
                setcookie("homeTitle", "$homeTitle", time() + (3600), "/" ); // 3600 seconds = 90 minutes
            }
        } else{
            // Remove any previous cookies that may have existed 
            unset($_COOKIE["homeTitle"]);
            setcookie("homeTitle", null, -1, "/");
        }

        if(
            // Check the paragraph content
            empty($_POST["homeParagraph"] ) == FALSE
        ){
            $homeParagraph = filter_var(trim ($_POST["homeParagraph"] ), FILTER_SANITIZE_STRING);

            if(ctype_space($homeParagraph) == FALSE){

                setcookie("homeParagraph", "$homeParagraph", time() + (3600), "/" ); // 3600 seconds = 90 minutes

            }
        } else{
            // Remove any previous cookies that may have existed 
            unset($_COOKIE["homeParagraph"]);
            setcookie("homeParagraph", null, -1, "/");
        }

        header("location: https://www.shanewalders.com/");
        die();
    }
}   

/*--------------------
# Admin Permissions
--------------------*/

elseif ($_SESSION["permission"] == "admin"){

    if(
          isset($_POST["homeTitle"] )        == TRUE
        ||isset($_POST["homeParagraph"] )    == TRUE
        ||isset($_POST["homeImage"] )        == TRUE
    ){

        // We"re going to store these changes into the database, so establish a connection to the server here...
        $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

        if ($serverConnection->connect_error) {
            die("The server connection failed: " . $mysqli->connect_error);
        }

        // Once we"re connected to the mySQL database, check if the page title has changed
        if(
            empty($_POST["homeTitle"] ) == FALSE
        ){
            $homeTitle = filter_var(ucfirst(trim ($_POST["homeTitle"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($homeTitle) == FALSE){               
                // Sanitize the variable
                $homeTitle      = mysqli_real_escape_string($serverConnection, $homeTitle);

                $sql = "UPDATE  majorPages
                        SET     title = \"$homeTitle\" 
                        WHERE   pageName = \"Home\"
                    ";

                mysqli_query($serverConnection, $sql);
            }
        } 

        // Then, check if the paragraph content has been changed
        if(
            empty($_POST["homeParagraph"] ) == FALSE
        ){
            $homeParagraph = filter_var(ucfirst(trim ($_POST["homeParagraph"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($homeParagraph) == FALSE){
                    
                // Sanitize the variable
                $homeParagraph      = mysqli_real_escape_string($serverConnection, $homeParagraph);

                // And push the data upto the majorPages database
                $sql = "UPDATE  majorPages
                        SET     paragraph = \"$homeParagraph\" 
                        WHERE   pageName = \"Home\"
                    ";

                mysqli_query($serverConnection, $sql);
            }
        } 

        //Remove any local stylings that may have been made using sessions on this device
        unset($_SESSION["homeTitleSession"]);
        unset($_SESSION["homeParagraphSession"]);
        // And finally, close the server connection, and direct the user to the home page
        $serverConnection->close();
        header("location: https://www.shanewalders.com/");
        die();
    }
}