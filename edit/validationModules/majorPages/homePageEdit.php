<?php

/*--------------------------------------------------------------
# HOME PAGE
--------------------------------------------------------------*/

// Reset variables (before information is processed)
    $homeTitle                              = "";
    $homeParagraph                          = "";


/*--------------------
# Visitor Permissions
--------------------*/

if($_SESSION["permission"] == "visitor"){

    if(
      isset($_POST["homeTitle"] )          == TRUE
    ||isset($_POST["homeParagraph"] )      == TRUE

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

    $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

    if ($serverConnection->connect_error) {
        die("The server connection failed: " . $mysqli->connect_error);
    }
    
    if(
          isset($_POST["homeTitle"] )        == TRUE
        ||isset($_POST["homeParagraph"] )    == TRUE

    ){

        // Here, I have placed all of the form fields and SQL SET locations into an array
        // We will store the $_POST data location and the SQL location wihtin one string, before we explode it from within a foreach loop
        // the content is organized by the FORM FIELD LOCATION then the SQL SET LOCATION
        $inputDataField = array(
            "homeTitle title",
            "homeParagraph paragraph"
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
                            WHERE   pageName = \"Home\"
                        ";

                    mysqli_query($serverConnection, $sql);
                }
            }
        } 

        // And finally, close the server connection, and direct the user to the home page
        $serverConnection->close();
        header("location: https://www.shanewalders.com/");
        die();
    }
}