<?php

    require_once("modules/headerFiles.php");

    //  If the user has made errors in the form processing, use the error info
    if(        
       isset( $_SESSION["errorHeader"] )
    && isset( $_SESSION["errorContent"] )
    && isset( $_SESSION["errorImage"] ) ){

        $_SESSION["contactHeader"]    = $_SESSION["errorHeader"];
        $_SESSION["contactContent"]   = $_SESSION["errorContent"];
        $_SESSION["contactImage"]     = $_SESSION["errorImage"];

        $_SESSION["precontact"] = "visited";

        header("location: contact.php");
        die(); 

    }elseif(
        // If a visitor has submited changes via the backend editor, use those changes.
       isset( $_COOKIE["contactTitle"] )
    || isset( $_COOKIE["contactExcerpt"] )){

        if(isset( $_COOKIE["contactTitle"] ) ){
            $_SESSION["contactHeader"] = $_COOKIE["contactTitle"];

        }

        if(isset( $_COOKIE["contactExcerpt"] ) ){

            $_SESSION["contactContent"] = $_COOKIE["contactExcerpt"];

        }

        $_SESSION["contactImage"]   = "<img src=\"images/frontEnd/portrait_of_a_young_man.jpg\" alt=\"An oil ainting by Giovanni Bellini, titled 'Young Man in Red'\">";

        $_SESSION["precontact"] = "visited";
        header("location: contact.php");
        die();
    }
    
    else{
        $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

        if (!$serverConnection->connect_error) {

            $sql = "SELECT  title
                    FROM    majorPages
                    WHERE   pageName = \"Contact\"
                ";

            // Connect the query to the server
            $requestedData  = mysqli_query($serverConnection, $sql);
            // Convert the retrieved array into a variable
            $retrievedArray = mysqli_fetch_array($requestedData);
            // Collect the relevent data
            $titleContent   = $retrievedArray['title'];
            // Apply the markup stylings to the the database text
            $titleContent   = str_replace($markdown, $markup, $titleContent);

            $_SESSION["contactHeader"] = $titleContent;

            $sql = "SELECT  paragraph
                    FROM    majorPages
                    WHERE   pageName = \"Contact\"
                ";

            $requestedData    = mysqli_query($serverConnection, $sql);
            $retrievedArray   = mysqli_fetch_array($requestedData);
            $excerptContent   = $retrievedArray['paragraph'];
            $excerptContent   = str_replace($markdown, $markup, $excerptContent);

            $_SESSION["contactContent"] = $excerptContent;

            $_SESSION["contactImage"]   = "<img src=\"images/frontEnd/portrait_of_a_young_man.jpg\" alt=\"An oil ainting by Giovanni Bellini, titled 'Young Man in Red'\">";
            $_SESSION["precontact"] = "visited";

            $serverConnection->close();
        }

        header("location: contact.php");
        die();

    }

?>