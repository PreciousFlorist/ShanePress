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

    // We"re going to store these changes into the database, so establish a connection to the server here...
    $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

    if ($serverConnection->connect_error) {
        die("The server connection failed: " . $mysqli->connect_error);
    }

    // Once we"re connected to the mySQL database, check if the page title has changed
    if(
        empty($_POST["firstLink"] ) == FALSE
    ){

        $firstLink = filter_var(ucfirst(trim ($_POST["firstLink"] ) ), FILTER_SANITIZE_STRING);

        if(ctype_space($firstLink) == FALSE){  
            
            // Sanitize the variable
            $firstLink      = mysqli_real_escape_string($serverConnection, $firstLink);

            $sql = "UPDATE      navigation 
                    SET         linkValue = \"$firstLink\" 
                    WHERE       type = \"home\";
                ";

            mysqli_query($serverConnection, $sql);
        }
    } 

    if(
        empty($_POST["secondLink"] ) == FALSE
    ){
        $secondLink = filter_var(ucfirst(trim ($_POST["secondLink"] ) ), FILTER_SANITIZE_STRING);

        if(ctype_space($secondLink) == FALSE){               
            // Sanitize the variable
            $secondLink      = mysqli_real_escape_string($serverConnection, $secondLink);

            $sql = "UPDATE      navigation 
                    SET         linkValue = \"$secondLink\" 
                    WHERE       type = \"linkOne\";
                ";

            mysqli_query($serverConnection, $sql);
        }
    }
        
    if(
        empty($_POST["thirdLink"] ) == FALSE
    ){
        $thirdLink = filter_var(ucfirst(trim ($_POST["thirdLink"] ) ), FILTER_SANITIZE_STRING);

        if(ctype_space($thirdLink) == FALSE){               
            // Sanitize the variable
            $thirdLink      = mysqli_real_escape_string($serverConnection, $thirdLink);

            $sql = "UPDATE      navigation 
                    SET         linkValue = \"$thirdLink\" 
                    WHERE       type = \"linkTwo\";
                ";

            mysqli_query($serverConnection, $sql);
        }
    } 

    if(
        empty($_POST["fourthLink"] ) == FALSE
    ){
        $fourthLink = filter_var(ucfirst(trim ($_POST["fourthLink"] ) ), FILTER_SANITIZE_STRING);

        if(ctype_space($fourthLink) == FALSE){               
            // Sanitize the variable
            $fourthLink      = mysqli_real_escape_string($serverConnection, $fourthLink);

            $sql = "UPDATE      navigation 
                    SET         linkValue = \"$fourthLink\" 
                    WHERE       type = \"linkThree\";
                ";

            mysqli_query($serverConnection, $sql);
        }
    }

    if(
        empty($_POST["socialMediaOne"] ) == FALSE
    ){

        $svg            = filter_var(trim ($_POST["socialMediaOne"] ));

        $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
        $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");
        
        $svg            = str_replace($svgMarkdown, $svgMarkUp, $svg);

        $svg            = filter_var($svg, FILTER_SANITIZE_STRING);

        if(ctype_space($svg) == FALSE){
                
                // And push the data upto the projects database
                $sql = "UPDATE      navigation 
                        SET         linkValue = \"$svg\" 
                        WHERE       type = \"socialMediaOne\";
                ";

                mysqli_query($serverConnection, $sql); 
            }
        }
    }

    if(
        empty($_POST["socialMediaTwo"] ) == FALSE
    ){
        $svg            = filter_var(trim ($_POST["socialMediaTwo"] ));

        $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
        $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");
        
        $svg            = str_replace($svgMarkdown, $svgMarkUp, $svg);

        $svg            = filter_var($svg, FILTER_SANITIZE_STRING);

        if(ctype_space($svg) == FALSE){
                
            // And push the data upto the projects database
            $sql = "UPDATE      navigation 
                    SET         linkValue = \"$svg\" 
                    WHERE       type = \"socialMediaTwo\";
            ";

            mysqli_query($serverConnection, $sql); 
        }
    }

    if(
        empty($_POST["socialMediaThree"] ) == FALSE
    ){
        $svg            = filter_var(trim ($_POST["socialMediaThree"] ));

        $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
        $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");
        
        $svg            = str_replace($svgMarkdown, $svgMarkUp, $svg);

        $svg            = filter_var($svg, FILTER_SANITIZE_STRING);

        if(ctype_space($svg) == FALSE){
                
            // And push the data upto the projects database
            $sql = "UPDATE      navigation 
                    SET         linkValue = \"$svg\" 
                    WHERE       type = \"socialMediaThree\";
            ";

            mysqli_query($serverConnection, $sql); 
        }
    }

    if(
        empty($_POST["emailAddress"] ) == FALSE
    ){
        $emailAddress = filter_var(trim ($_POST["emailAddress"]  ), FILTER_SANITIZE_STRING);

        if(ctype_space($emailAddress) == FALSE){               
            // Sanitize the variable
            $emailAddress      = mysqli_real_escape_string($serverConnection, $emailAddress);

            $sql = "UPDATE      navigation 
                    SET         linkValue = \"$emailAddress\" 
                    WHERE       type = \"email\";
                ";

            mysqli_query($serverConnection, $sql);
        }
    }
}