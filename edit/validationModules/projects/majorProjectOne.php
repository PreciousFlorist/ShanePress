<?php

/*--------------------------------------------------------------
# MAJOR PROJECT 1
--------------------------------------------------------------*/
/*--------------------
# Admin Permissions
--------------------*/
if ($_SESSION["permission"] == "admin" && isset($_SESSION["timer"]) ){

    if(
        isset($_POST["firstProjectTitle"] )              == TRUE
        ||isset($_POST["firstProjectIntroParagraph"] )   == TRUE
        
        ||isset($_POST["firstSVGOne"] )                  == TRUE
        ||isset($_POST["firstSVGTwo"] )                  == TRUE
        ||isset($_POST["firstSVGThree"] )                == TRUE
        ||isset($_POST["firstSVGFour"] )                 == TRUE
        ||isset($_POST["firstSVGFive"] )                 == TRUE
        
        ||isset($_POST["firstSubHeadingOne"] )           == TRUE
        ||isset($_POST["firstExcerptOne"] )              == TRUE
        
        ||isset($_POST["firstSubHeadingTwo"] )           == TRUE
        ||isset($_POST["firstExcerptTwo"] )              == TRUE
        
        ||isset($_POST["firstSubHeadingThree"] )         == TRUE
        ||isset($_POST["firstExcerptThree"] )            == TRUE
        
        ||isset($_POST["firstSubHeadingFour"] )          == TRUE
        ||isset($_POST["firstExcerptFour"] )             == TRUE
    ){

        // We're going to store these changes into the database, so establish a connection to the server here...
        $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

        if ($serverConnection->connect_error) {
            die("The server connection failed: " . $mysqli->connect_error);
        }

/*--------------------
# DELETE THE SVG CONTETNT
--------------------*/

        $deleteSVG = array(
            "deleteFirstSVGOne projectSymbolSVGOne",
            "deleteFirstSVGTwo projectSymbolSVGTwo",
            "deleteFirstSVGThree projectSymbolSVGThree",
            "deleteFirstSVGFour projectSymbolSVGFour",
            "deleteFirstSVGFive projectSymbolSVGFive"
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
                        WHERE   projectID = 1";

                mysqli_query($serverConnection, $sql);

                header("location: https://www.shanewalders.com/edit/majorProjectFirst");
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
            "firstProjectTitle projectTitle",
            "firstProjectIntroParagraph projectIntroParagraph",
            
            "firstSubHeadingOne projectSubHeaderOne",
            "firstExcerptOne projectSubExcerptOne",

            "firstSubHeadingTwo projectSubHeaderTwo",
            "firstExcerptTwo projectSubExcerptTwo",

            "firstSubHeadingThree projectSubHeaderThree",
            "firstExcerptThree projectSubExcerptThree",

            "firstSubHeadingFour projectSubHeaderFour",
            "firstExcerptFour projectSubExcerptFour"
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
                            WHERE   projectID = 1";

                    mysqli_query($serverConnection, $sql);
                }
            }
        }

/*--------------------
# UPDATE SVG ICONS
--------------------*/

        $inputDataField = array(
            "firstSVGOne projectSymbolSVGOne",
            "firstSVGTwo projectSymbolSVGTwo",
            "firstSVGThree projectSymbolSVGThree",
            "firstSVGFour projectSymbolSVGFour",
            "firstSVGFive projectSymbolSVGFive"
        );

        foreach($inputDataField as $data){

            $data = explode(" ", $data);

            $svgField      = $data[0];
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
                            WHERE   projectID = 1";

                    mysqli_query($serverConnection, $sql);

                } else {

                    $sql = "UPDATE  projects
                            SET     $sqlDestination = NULL 
                            WHERE   projectID = 1";

                    mysqli_query($serverConnection, $sql);

                }
            }
        }

        // And finally, close the server connection, and direct the user to the appropriate page
        $serverConnection->close();
        header("location: https://www.shanewalders.com/projectProfiles/seymour-digital.php");
        die();
    }
}