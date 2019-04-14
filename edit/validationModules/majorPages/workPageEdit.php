<?php

/*--------------------------------------------------------------
# WORK PAGE
--------------------------------------------------------------*/

    $workTitle                              = "";
    $workExcerpt                            = "";

/*--------------------
# Visitor Permissions
--------------------*/

if($_SESSION["permission"] == "visitor"){
    if(
          isset($_POST["workTitle"] )          == TRUE
        ||isset($_POST["workExcerpt"] )        == TRUE
    ){

        // Check the title
        if(
            empty($_POST["workTitle"] ) == FALSE
        ){
            //Sanitize the user input
            $workTitle = filter_var(trim ($_POST["workTitle"] ), FILTER_SANITIZE_STRING);
            if(ctype_space($workTitle) == FALSE){
                // Set the input to a cookie
                setcookie("workTitle", "$workTitle", time() + (3600), "/" ); // 3600 seconds = 90 minutes

            }
        } else{
            // Remove any previous cookies that may have existed 
            unset($_COOKIE["workTitle"]);
            setcookie("workTitle", null, -1, "/");
        }

        // Check the excerpt content
        if(
            empty($_POST["workExcerpt"] ) == FALSE
        ){
            //Sanitize the user input
            $workExcerpt = filter_var(trim ($_POST["workExcerpt"] ), FILTER_SANITIZE_STRING);
            if(ctype_space($workExcerpt) == FALSE){
                // Set the input to a cookie
                setcookie("workExcerpt", "$workExcerpt", time() + (3600), "/" ); // 3600 seconds = 90 minutes

            }
        } else{
            // Remove any previous cookies that may have existed 
            unset($_COOKIE["workExcerpt"]);
            setcookie("workExcerpt", null, -1, "/");
        }

        header("location: https://shanewalders.com/work");
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
          isset($_POST["workTitle"] )        == TRUE
        ||isset($_POST["workExcerpt"] )    == TRUE

    ){

        // Here, I have placed all of the form fields and SQL SET locations into an array
        // We will store the $_POST data location and the SQL location wihtin one string, before we explode it from within a foreach loop
        // the content is organized by the FORM FIELD LOCATION then the SQL SET LOCATION
        $inputDataField = array(
            "workTitle title",
            "workExcerpt paragraph"
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
                            WHERE   pageName = \"Work\"
                        ";

                    mysqli_query($serverConnection, $sql);
                }
            }
        }

        $serverConnection->close();
        header("location: https://shanewalders.com/work");
        die();
    }
}