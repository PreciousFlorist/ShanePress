<?php

/*--------------------------------------------------------------
# ABOUT PAGE
--------------------------------------------------------------*/

    $aboutTitle         = "";
    $aboutParagraph     = "";

/*--------------------
# Visitor Permissions
--------------------*/

if($_SESSION["permission"] == "visitor"){

    if(
          isset($_POST["aboutTitle"] )         == TRUE
        ||isset($_POST["aboutParagraph"] )     == TRUE
        ||isset($_POST["aboutImage"] )         == TRUE
    ){


    if(
        // Check the title
        empty($_POST["aboutTitle"] ) == FALSE
    ){
        //Sanitize the user input
        $aboutTitle = filter_var(trim ($_POST["aboutTitle"] ), FILTER_SANITIZE_STRING);
        if(ctype_space($aboutTitle) == FALSE){
            // Set the input to a cookie
            setcookie("aboutTitle", "$aboutTitle", time() + (3600), "/" ); // 3600 seconds = 90 minutes
        }
    } else{
        // Remove any previous cookies that may have existed 
        unset($_COOKIE["aboutTitle"]);
        setcookie("aboutTitle", null, -1, "/");
    }

    if(
        // Check the paragraph content
        empty($_POST["aboutParagraph"] ) == FALSE
    ){
        $aboutParagraph = filter_var(ucfirst(trim ($_POST["aboutParagraph"] ) ), FILTER_SANITIZE_STRING);

        if(ctype_space($aboutParagraph) == FALSE){
            // Set the input to a cookie
            setcookie("aboutParagraph", "$aboutParagraph", time() + (3600), "/" ); // 3600 seconds = 90 minutes
        }

    } else{
        // Remove any previous cookies that may have existed 
        unset($_COOKIE["aboutParagraph"]);
        setcookie("aboutParagraph", null, -1, "/");
    }

        header("location: https://www.shanewalders.com/about.php");
        die();
    }
}

/*--------------------
# Admin Permissions
--------------------*/

elseif ($_SESSION["permission"] == "admin"){

    if(
        isset($_POST["aboutTitle"] )         == TRUE
      ||isset($_POST["aboutParagraph"] )     == TRUE
      ||isset($_POST["aboutImage"] )         == TRUE
    ){

        $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);
        if ($serverConnection->connect_error) {
            die("The server connection failed: " . $mysqli->connect_error);
        }

        // Check the title
        if(
            empty($_POST["aboutTitle"] ) == FALSE
        ){
            $aboutTitle = filter_var(ucfirst(trim ($_POST["aboutTitle"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($aboutTitle) == FALSE){

                $aboutTitle      = mysqli_real_escape_string($serverConnection, $aboutTitle);

                $sql = "UPDATE  majorPages
                        SET     title = \"$aboutTitle\" 
                        WHERE   pageName = \"About\"
                    ";

                mysqli_query($serverConnection, $sql);
            }
        } 

        // Check the first paragraph content
        if(
          empty($_POST["aboutParagraph"] ) == FALSE
        ){
            $aboutParagraph = filter_var(ucfirst(trim ($_POST["aboutParagraph"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($aboutParagraph) == FALSE){

                // Sanitize the variable
                $aboutParagraph      = mysqli_real_escape_string($serverConnection, $aboutParagraph);

                $sql = "UPDATE  majorPages
                        SET     paragraph = \"$aboutParagraph\" 
                        WHERE   pageName = \"About\"
                    ";

                mysqli_query($serverConnection, $sql);
          }
        } 
  
        //Remove any local stylings that may have been made using sessions on this device
        unset($_SESSION["aboutTitleSession"]);
        unset($_SESSION["aboutParagraphSession"]);

        $serverConnection->close();
        header("location: https://www.shanewalders.com/about.php");
        die();
    }
}