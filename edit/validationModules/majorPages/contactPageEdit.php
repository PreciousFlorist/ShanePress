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

        header("location: https://www.shanewalders.com/contact.php");
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

    if(
          isset($_POST["contactTitle"] )          == TRUE
        ||isset($_POST["contactExcerpt"] )        == TRUE

        ||isset($_POST["thankYouTitle"] )         == TRUE
        ||isset($_POST["thankYouExcerpt"] )       == TRUE

    ){

        $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

        if ($serverConnection->connect_error) {
            die("The server connection failed: " . $mysqli->connect_error);
        }

        if(
            // Check the title
            empty($_POST["contactTitle"] ) == FALSE
        ){
            $contactTitle = filter_var(ucfirst(trim ($_POST["contactTitle"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($contactTitle) == FALSE){

                // Sanitize the variable
                $contactTitle      = mysqli_real_escape_string($serverConnection, $contactTitle);

                $sql = "UPDATE  majorPages
                        SET     title = \"$contactTitle\" 
                        WHERE   pageName = \"Contact\"
                    ";

                mysqli_query($serverConnection, $sql);
            }
        }
    
        if(
            // Check the excerpt content
            empty($_POST["contactExcerpt"] ) == FALSE
        ){
            $contactExcerpt = filter_var(ucfirst(trim ($_POST["contactExcerpt"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($contactExcerpt) == FALSE){
                // Sanitize the variable
                $contactExcerpt      = mysqli_real_escape_string($serverConnection, $contactExcerpt);

                $sql = "UPDATE  majorPages
                        SET     paragraph = \"$contactExcerpt\" 
                        WHERE   pageName = \"Contact\"
                    ";

                mysqli_query($serverConnection, $sql);
            }

        } 

/*--------------------------------------------------------------
# CONTACT FORM - THANK YOU PAGE
--------------------------------------------------------------*/

        if(
            // Check the title
            empty($_POST["thankYouTitle"] ) == FALSE
        ){
            $thankYouTitle = filter_var(ucfirst(trim ($_POST["thankYouTitle"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($thankYouTitle) == FALSE){
                // Sanitize the variable
                $thankYouTitle      = mysqli_real_escape_string($serverConnection, $thankYouTitle);

                $sql = "UPDATE  majorPages
                        SET     title = \"$thankYouTitle\" 
                        WHERE   pageName = \"ThankYou\"
                    ";

                mysqli_query($serverConnection, $sql);
            }
        } 
    
        if(
            // Check the excerpt content
            empty($_POST["thankYouExcerpt"] ) == FALSE
        ){
            $thankYouExcerpt = filter_var(ucfirst(trim ($_POST["thankYouExcerpt"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($thankYouExcerpt) == FALSE){
                // Sanitize the variable
                $thankYouExcerpt      = mysqli_real_escape_string($serverConnection, $thankYouExcerpt);

                $sql = "UPDATE  majorPages
                        SET     paragraph = \"$thankYouExcerpt\" 
                        WHERE   pageName = \"ThankYou\"
                    ";

                mysqli_query($serverConnection, $sql);
            }

        } 

        unset($_SESSION["contactTitleSession"]);
        unset($_SESSION["contactExcerptSession"]);

        unset($_SESSION["thankYouTitleSession"]);
        unset($_SESSION["thankYouExcerptSession"]);

        $serverConnection->close();
        header("location: https://www.shanewalders.com/contact.php");
        die();
    }
}