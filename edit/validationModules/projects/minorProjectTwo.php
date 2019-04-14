<?php

/*--------------------------------------------------------------
# MINOR PROJECT 2
--------------------------------------------------------------*/
/*--------------------
# Admin Permissions
--------------------*/
if ($_SESSION["permission"] == "admin" && isset($_SESSION["timer"]) ){

    if(
        isset($_POST["fourthProjectTitle"] )              == TRUE
        ||isset($_POST["fourthProjectIntroParagraph"] )   == TRUE
        
        ||isset($_POST["fourthSVGOne"] )                  == TRUE
        ||isset($_POST["fourthSVGTwo"] )                  == TRUE
        ||isset($_POST["fourthSVGThree"] )                == TRUE
        ||isset($_POST["fourthSVGFour"] )                 == TRUE
        ||isset($_POST["fourthSVGFive"] )                 == TRUE
        
        ||isset($_POST["fourthSubHeadingOne"] )           == TRUE
        ||isset($_POST["fourthExcerptOne"] )              == TRUE
        
        ||isset($_POST["fourthSubHeadingTwo"] )           == TRUE
        ||isset($_POST["fourthExcerptTwo"] )              == TRUE
        
        ||isset($_POST["fourthSubHeadingThree"] )         == TRUE
        ||isset($_POST["fourthExcerptThree"] )            == TRUE
        
        ||isset($_POST["fourthSubHeadingFour"] )          == TRUE
        ||isset($_POST["fourthExcerptFour"] )             == TRUE
    ){

        // We"re going to store these changes into the database, so establish a connection to the server here...
        $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

        if ($serverConnection->connect_error) {
            die("The server connection failed: " . $mysqli->connect_error);
        }
/*--------------------
# DELETE THE SVG CONTETNT
--------------------*/

            $deleteSVG = array(
                "deleteFourthSVGOne projectSymbolSVGOne",
                "deleteFourthSVGTwo projectSymbolSVGTwo",
                "deleteFourthSVGThree projectSymbolSVGThree",
                "deleteFourthSVGFour projectSymbolSVGFour",
                "deleteFourthSVGFive projectSymbolSVGFive"
            );

            foreach($deleteSVG as $data){
                // We will explode the string that includes both the form field and the sql destination
                // And then we will store this data into two seperate variables
                $data = explode(" ", $data);

                $svg            = $data[0];
                $sqlLocation    = $data[1];

                if (isset($_POST["$svg"]) ){

                    $sql = "UPDATE  projects
                            SET     $sqlLocation = NULL
                            WHERE   projectID = 4";

                    mysqli_query($serverConnection, $sql);

                    header("location: https://www.shanewalders.com/edit/minorProjectSecond");
                    die();
                }
            }

/*--------------------
# UPDATE HTML CONTETNT
--------------------*/

            // Here, I have placed all of the form fields and SQL SET locations into an array
            // We will store the $_POST data location and the SQL location wihtin one string, before we explode it from within a foreach loop
            // the content is organized by the FORM FIELD LOCATION then the SQL SET LOCATION
            $inputDataField = array(
                "fourthProjectTitle projectTitle",
                "fourthProjectIntroParagraph projectIntroParagraph",
                
                "fourthSubHeadingOne projectSubHeaderOne",
                "fourthExcerptOne projectSubExcerptOne",

                "fourthSubHeadingTwo projectSubHeaderTwo",
                "fourthExcerptTwo projectSubExcerptTwo",

                "fourthSubHeadingThree projectSubHeaderThree",
                "fourthExcerptThree projectSubExcerptThree",

                "fourthSubHeadingFour projectSubHeaderFour",
                "fourthExcerptFour projectSubExcerptFour"
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
                        $sql = "UPDATE  projects
                                SET     $sqlDestination = \"$formField\" 
                                WHERE   projectID = 4";

                        mysqli_query($serverConnection, $sql);
                    }
                }
            }


/*--------------------
# UPDATE SVG ICONS
--------------------*/

            $inputDataField = array(
                "fourthSVGOne projectSymbolSVGOne",
                "fourthSVGTwo projectSymbolSVGTwo",
                "fourthSVGThree projectSymbolSVGThree",
                "fourthSVGFour projectSymbolSVGFour",
                "fourthSVGFive projectSymbolSVGFive"
            );

            foreach($inputDataField as $data){

                $data = explode(" ", $data);

                $svgField       = $data[0];
                $sqlDestination = $data[1];

                if (isset($_POST["$svgField"]) ){

                    $svg            = filter_var(trim ($_POST["$svgField"] ));
                    $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
                    $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");

                    $svg            = str_replace($svgMarkdown, $svgMarkUp, $svg);
                    $svg            = filter_var($svg, FILTER_SANITIZE_STRING);

                    if(ctype_space($svg) == FALSE && !empty($svg) ){
                        $sql = "UPDATE  projects
                                SET     $sqlDestination = \"$svg\" 
                                WHERE   projectID = 4";

                        mysqli_query($serverConnection, $sql);

                    } else {

                        $sql = "UPDATE  projects
                                SET     $sqlDestination = NULL 
                                WHERE   projectID = 4";
    
                        mysqli_query($serverConnection, $sql);

                    }
                }
            }

        // And finally, close the server connection, and direct the user to the appropriate page
        $serverConnection->close();
        header("location: https://www.shanewalders.com/projectProfiles/newsletterSubscription.php");
        die();
    }
}