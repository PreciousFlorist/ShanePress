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

        header("location: https://www.shanewalders.com/about");
        die();
    }
}

/*--------------------
# Admin Permissions
--------------------*/

elseif ($_SESSION["permission"] == "admin"){

    $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

    if ($serverConnection->connect_error) {
        die("The server connection failed: " . $mysqli->connect_error);
    }
    
    if(
          isset($_POST["aboutTitle"] )        == TRUE
        ||isset($_POST["aboutParagraph"] )    == TRUE

    ){

        // Here, I have placed all of the form fields and SQL SET locations into an array
        // We will store the $_POST data location and the SQL location wihtin one string, before we explode it from within a foreach loop
        // the content is organized by the FORM FIELD LOCATION then the SQL SET LOCATION
        $inputDataField = array(
            "aboutTitle title",
            "aboutParagraph paragraph"
        );

        foreach($inputDataField as $data){
            // We will explode the string that includes both the form field and the sql destination
            // And then we will store this data into two seperate variables
            $data = explode(" ", $data);

            $formField      = $data[0];
            $sqlDestination = $data[1];

            if (isset($_POST["$formField"]) ){
                $formField = filter_var( trim ($_POST["$formField"]), FILTER_SANITIZE_STRING);

                if(ctype_space($formField) == FALSE){
                    
                    $sql = "UPDATE  majorPages
                            SET     $sqlDestination = \"$formField\" 
                            WHERE   pageName = \"About\"
                        ";

                    mysqli_query($serverConnection, $sql);
                }
            }
        }

        $serverConnection->close();
        header("location: https://www.shanewalders.com/about");
        die();
    }
}