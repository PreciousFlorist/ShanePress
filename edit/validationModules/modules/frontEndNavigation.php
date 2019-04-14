<?php
/*--------------------------------------------------------------
# Frontend Navigation
--------------------------------------------------------------*/

// Reset variables (before information is processed)
$homeLink           = "";

$navLinkOne         = "";
$navLinkTwo         = "";
$navLinkThree       = "";

$socialLinkOne      = "";
$socialLinkTwo      = "";
$socialLinkThree    = "";

$emailAccount       = "";

/*--------------------
# Admin Permissions
--------------------*/

if ($_SESSION["permission"] == "admin"){

    if(
      isset($_POST["firstLink"] )      == TRUE

    ||isset($_POST["secondLink"] )       == TRUE
    ||isset($_POST["thirdLink"] )        == TRUE
    ||isset($_POST["fourthLink"] )       == TRUE

    ||isset($_POST["socialMediaOne"] )   == TRUE
    ||isset($_POST["socialMediaTwo"] )   == TRUE
    ||isset($_POST["socialMediaThree"] ) == TRUE

    ||isset($_POST["emailAddress"] )     == TRUE
    ){

        // We're going to store these changes into the database, so establish a connection to the server here...
        $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

        if ($serverConnection->connect_error) {
            die("The server connection failed: " . $mysqli->connect_error);
        }

        // Here, I have placed all of the form fields and SQL SET locations into an array
        // We will store the $_POST data location and the SQL location wihtin one string, before we explode it from within a foreach loop
        // the content is organized by the FORM FIELD LOCATION then the SQL SET LOCATION
        $inputDataField = array(
            "firstLink home",

            "secondLink linkOne",
            "thirdLink linkTwo",
            "fourthLink linkThree",

            "emailAddress email"
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

                    $sql = "UPDATE      navigation 
                            SET         linkValue = \"$formField\" 
                            WHERE       type = \"$sqlDestination\"
                        ";

                    mysqli_query($serverConnection, $sql);
                }
            }
        }

        $inputDataField = array(
            "socialMediaOne socialMediaOne",
            "socialMediaTwo socialMediaTwo",
            "socialMediaThree socialMediaThree"
        );

        foreach($inputDataField as $data){


            $data = explode(" ", $data);

            $formField      = $data[0];
            $sqlDestination = $data[1];

            $formField            = filter_var(trim ($_POST["$formField"] ));            

            if (isset($_POST["$formField"]) ){

                $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
                $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");
                
                $formField            = str_replace($svgMarkdown, $svgMarkUp, $formField);
                $formField = filter_var( trim ($_POST["$formField"]), FILTER_SANITIZE_STRING);

                if(ctype_space($formField) == FALSE){

                    $sql = "UPDATE      navigation 
                            SET         linkValue = \"$formField\" 
                            WHERE       type = \"$sqlDestination\"
                        ";

                    mysqli_query($serverConnection, $sql);
                }
            }
        }
    }
}