<?php

/*--------------------------------------------------------------
# MAJOR PROJECT 2
--------------------------------------------------------------*/
/*--------------------
# Admin Permissions
--------------------*/
if ($_SESSION["permission"] == "admin" && isset($_SESSION["timer"]) ){

    if(
          isset($_POST["secondProjectTitle"] )            == TRUE
        ||isset($_POST["secondProjectIntroParagraph"] )   == TRUE
        
        ||isset($_POST["secondSVGOne"] )                  == TRUE
        ||isset($_POST["secondSVGTwo"] )                  == TRUE
        ||isset($_POST["secondSVGThree"] )                == TRUE
        ||isset($_POST["secondSVGFour"] )                 == TRUE
        ||isset($_POST["secondSVGFive"] )                 == TRUE
        
        ||isset($_POST["secondSubHeadingOne"] )           == TRUE
        ||isset($_POST["secondExcerptOne"] )              == TRUE
        
        ||isset($_POST["secondSubHeadingTwo"] )           == TRUE
        ||isset($_POST["secondExcerptTwo"] )              == TRUE
        
        ||isset($_POST["secondSubHeadingThree"] )         == TRUE
        ||isset($_POST["secondExcerptThree"] )            == TRUE
        
        ||isset($_POST["secondSubHeadingFour"] )          == TRUE
        ||isset($_POST["secondExcerptFour"] )             == TRUE

        ||isset($_POST["deletesecondSVGOne"] )            == TRUE
        ||isset($_POST["deletesecondSVGTwo"] )            == TRUE
        ||isset($_POST["deletesecondSVGThree"] )          == TRUE
        ||isset($_POST["deletesecondSVGFour"] )           == TRUE
        ||isset($_POST["deletesecondSVGFive"] )           == TRUE
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
            "deleteSecondSVGOne projectSymbolSVGOne",
            "deleteSecondSVGTwo projectSymbolSVGTwo",
            "deleteSecondSVGThree projectSymbolSVGThree",
            "deleteSecondSVGFour projectSymbolSVGFour",
            "deleteSecondSVGFive projectSymbolSVGFive"
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
                        WHERE   projectID = 2";

                mysqli_query($serverConnection, $sql);

                header("location: https://www.shanewalders.com/edit/majorProjectSecond");
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
            "secondProjectTitle projectTitle",
            "secondProjectIntroParagraph projectIntroParagraph",
            
            "secondSubHeadingOne projectSubHeaderOne",
            "secondExcerptOne projectSubExcerptOne",

            "secondSubHeadingTwo projectSubHeaderTwo",
            "secondExcerptTwo projectSubExcerptTwo",

            "secondSubHeadingThree projectSubHeaderThree",
            "secondExcerptThree projectSubExcerptThree",

            "secondSubHeadingFour projectSubHeaderFour",
            "secondExcerptFour projectSubExcerptFour"
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
                            WHERE   projectID = 2";

                    mysqli_query($serverConnection, $sql);
                }
            }
        }


/*--------------------
# UPDATE SVG ICONS
--------------------*/

        $inputDataField = array(
            "secondSVGOne projectSymbolSVGOne",
            "secondSVGTwo projectSymbolSVGTwo",
            "secondSVGThree projectSymbolSVGThree",
            "secondSVGFour projectSymbolSVGFour",
            "secondSVGFive projectSymbolSVGFive"
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
                            WHERE   projectID = 2";

                    mysqli_query($serverConnection, $sql);

                } else {

                    $sql = "UPDATE  projects
                            SET     $sqlDestination = NULL 
                            WHERE   projectID = 2";

                    mysqli_query($serverConnection, $sql);

                }
            }
        }

        // And finally, close the server connection, and direct the user to the appropriate page
        $serverConnection->close();
        header("location: https://www.shanewalders.com/projectProfiles/portfolio.php");
        die();
    }
}