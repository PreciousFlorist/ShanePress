<?php
 
    $contactTitle                              = "";
    $contactExcerpt                            = "";

    $thankYouTitle                              = "";
    $thankYouExcerpt                            = "";

/*--------------------
# Visitor Permissions
--------------------*/
/*--------------------------------------------------------------
# CONTACT FORM - SUBMISSION PAGE
--------------------------------------------------------------*/

if($_SESSION["permission"] == "visitor"){

    if(
          isset($_POST["contactTitle"]   )        == TRUE
        ||isset($_POST["contactExcerpt"] )        == TRUE

        ||isset($_POST["thankYouTitle"] )         == TRUE
        ||isset($_POST["thankYouExcerpt"] )       == TRUE

    ){

        if(
            // Check the title
            empty($_POST["contactTitle"] ) == FALSE
        ){
            //Sanitize the user input
            $contactTitle = filter_var(trim ($_POST["contactTitle"] ), FILTER_SANITIZE_STRING);
            if(ctype_space($contactTitle) == FALSE){
                // Set the input to a cookie
                setcookie("contactTitle", "$contactTitle", time() + (3600), "/" ); // 3600 seconds = 90 minutes

            }
        } else{
            // Remove any previous cookies that may have existed 
            unset($_COOKIE["contactTitle"]);
            setcookie("contactTitle", null, -1, "/");
        }

        if(
            // Check the excerpt content
            empty($_POST["contactExcerpt"] ) == FALSE
        ){
            //Sanitize the user input
            $contactExcerpt = filter_var(trim ($_POST["contactExcerpt"] ), FILTER_SANITIZE_STRING);
            if(ctype_space($contactExcerpt) == FALSE){
                // Set the input to a cookie
                setcookie("contactExcerpt", "$contactExcerpt", time() + (3600), "/" ); // 3600 seconds = 90 minutes
            }
        } else{
            // Remove any previous cookies that may have existed 
            unset($_COOKIE["contactExcerpt"]);
            setcookie("contactExcerpt", null, -1, "/");
        }

/*--------------------------------------------------------------
# CONTACT FORM - THANK YOU PAGE
--------------------------------------------------------------*/
        if(
            // Check the title
            empty($_POST["thankYouTitle"] ) == FALSE
        ){
            //Sanitize the user input
            $thankYouTitle = filter_var(trim ($_POST["thankYouTitle"] ), FILTER_SANITIZE_STRING);
            if(ctype_space($thankYouTitle) == FALSE){
                // Set the input to a cookie
                setcookie("thankYouTitle", "$thankYouTitle", time() + (3600), "/" ); // 3600 seconds = 90 minutes
            }
        } else{
            // Remove any previous cookies that may have existed 
            unset($_COOKIE["thankYouTitle"]);
            setcookie("thankYouTitle", null, -1, "/");
        }

        // Check the excerpt content
        if(
            empty($_POST["thankYouExcerpt"] ) == FALSE
        ){
            //Sanitize the user input
            $thankYouExcerpt = filter_var(trim ($_POST["thankYouExcerpt"] ), FILTER_SANITIZE_STRING);
            if(ctype_space($thankYouExcerpt) == FALSE){
                // Set the input to a cookie
                setcookie("thankYouExcerpt", "$thankYouExcerpt", time() + (3600), "/" ); // 3600 seconds = 90 minutes
            }
        } else{
            // Remove any previous cookies that may have existed 
            unset($_COOKIE["thankYouExcerpt"]);
            setcookie("thankYouExcerpt", null, -1, "/");
        }

        header("location: https://www.shanewalders.com/contact");
        die();
    }

}

/*--------------------
# Admin Permissions
--------------------*/
/*--------------------------------------------------------------
# CONTACT FORM - SUBMISSION PAGE
--------------------------------------------------------------*/

elseif ($_SESSION["permission"] == "admin"){

    $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

    if ($serverConnection->connect_error) {
        die("The server connection failed: " . $mysqli->connect_error);
    }
    if(   isset($_POST["contactTitle"] )        == TRUE
        ||isset($_POST["contactExcerpt"] )      == TRUE
        ||isset($_POST["thankYouTitle"] )       == TRUE
        ||isset($_POST["thankYouExcerpt"] )     == TRUE){

        if(
              isset($_POST["contactTitle"] )        == TRUE
            ||isset($_POST["contactExcerpt"] )      == TRUE

        ){

            // Here, I have placed all of the form fields and SQL SET locations into an array
            // We will store the $_POST data location and the SQL location wihtin one string, before we explode it from within a foreach loop
            // the content is organized by the FORM FIELD LOCATION then the SQL SET LOCATION
            $inputDataField = array(
                "contactTitle title",
                "contactExcerpt paragraph"
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
                                WHERE   pageName = \"Contact\"
                            ";

                        mysqli_query($serverConnection, $sql);
                    }
                }
            }
        }
        

/*--------------------------------------------------------------
# CONTACT FORM - THANK YOU PAGE
--------------------------------------------------------------*/

        if(
          isset($_POST["thankYouTitle"] )        == TRUE
        ||isset($_POST["thankYouExcerpt"] )      == TRUE

        ){

            $inputDataField = array(
                "thankYouTitle title",
                "thankYouExcerpt paragraph"
            );

            foreach($inputDataField as $data){

                $data = explode(" ", $data);
                $formField      = $data[0];
                $sqlDestination = $data[1];

                if (isset($_POST["$formField"]) ){
                    $formField = filter_var( trim ($_POST["$formField"]), FILTER_SANITIZE_STRING);

                    if(ctype_space($formField) == FALSE){
                        
                        $sql = "UPDATE  majorPages
                                SET     $sqlDestination = \"$formField\" 
                                WHERE   pageName = \"ThankYou\"
                            ";

                        mysqli_query($serverConnection, $sql);
                    }
                }
            }
        }
        
        $serverConnection->close();
        header("location: https://www.shanewalders.com/contact");
        die(); 
    }
}
