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

        header("location: https://shanewalders.com/work.php");
        die();
    }
}

/*--------------------
# Admin Permissions
--------------------*/

elseif ($_SESSION["permission"] == "admin"){
    if(
        isset($_POST["workTitle"] )          == TRUE
      ||isset($_POST["workExcerpt"] )        == TRUE

    ){

        $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);
        if ($serverConnection->connect_error) {
            die("The server connection failed: " . $mysqli->connect_error);
        }

        // Check the title
        if(
            empty($_POST["workTitle"] ) == FALSE
        ){
            $workTitle = filter_var(ucfirst(trim ($_POST["workTitle"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($workTitle) == FALSE){

                $workTitle      = mysqli_real_escape_string($serverConnection, $workTitle);

                $sql = "UPDATE  majorPages
                        SET     title = \"$workTitle\" 
                        WHERE   pageName = \"Work\"
                    ";

                mysqli_query($serverConnection, $sql);
            }
        } 
        // Check the excerpt content
        if(
            empty($_POST["workExcerpt"] ) == FALSE
        ){
            $workExcerpt = filter_var(ucfirst(trim ($_POST["workExcerpt"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($workExcerpt) == FALSE){

            // Sanitize the variable
                $workExcerpt      = mysqli_real_escape_string($serverConnection, $workExcerpt);

                $sql = "UPDATE  majorPages
                        SET     paragraph = \"$workExcerpt\" 
                        WHERE   pageName = \"Work\"
                    ";

                mysqli_query($serverConnection, $sql);
            }
        } 

        $serverConnection->close();
        header("location: https://shanewalders.com/work.php");
        die();
    }
}