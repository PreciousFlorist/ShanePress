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
        
        header("location: https://www.shanewalders.com/backend/backendIndex");
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

    ){

        // We"re going to store these changes into the database, so establish a connection to the server here...
        $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

        if ($serverConnection->connect_error) {
            die("The server connection failed: " . $mysqli->connect_error);
        }

        // Here, I have placed all of the form fields and SQL SET locations into an array
        // We will store the $_POST data location and the SQL location wihtin one string, before we explode it from within a foreach loop
        // the content is organized by the FORM FIELD LOCATION then the SQL SET LOCATION
        $inputDataField = array(
            "adminIndexTitle title",
            "adminIndexParagraph paragraph"
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
                            WHERE   pageName = \"AdminIndex\"
                        ";

                    mysqli_query($serverConnection, $sql);
                }
            }
        }

        $serverConnection->close();
        header("location: https://www.shanewalders.com/backend/backendIndex");
        die();
    }
} 