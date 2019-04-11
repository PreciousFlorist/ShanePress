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

    // Delete the SVG Icons, if requested
        if( isset($_POST["deleteFourthSVGOne"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGOne = NULL
                    WHERE   projectID = 4
                ";

            mysqli_query($serverConnection, $sql);

            header("location: https://www.shanewalders.com/edit/minorProjectSecond.php");
            die();
        }
        if( isset($_POST["deleteFourthSVGTwo"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGTwo = NULL
                    WHERE   projectID = 4
                ";

            mysqli_query($serverConnection, $sql);
            header("location: https://www.shanewalders.com/edit/minorProjectSecond.php");
            die();
        }
        if( isset($_POST["deleteFourthSVGThree"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGThree = NULL
                    WHERE   projectID = 4
                ";

            mysqli_query($serverConnection, $sql);

            header("location: https://www.shanewalders.com/edit/minorProjectSecond.php");
            die();
        }
        if( isset($_POST["deleteFourthSVGFour"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGFour = NULL
                    WHERE   projectID = 4
                ";

            mysqli_query($serverConnection, $sql);

            header("location: https://www.shanewalders.com/edit/minorProjectSecond.php");
            die();
        }
        if( isset($_POST["deleteFourthSVGFive"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGFive = NULL
                    WHERE   projectID = 4
                ";

            mysqli_query($serverConnection, $sql);

            header("location: https://www.shanewalders.com/edit/minorProjectSecond.php");
            die();
        }

        // Once we"re connected to the mySQL database, check if the page title has changed
        if(
            empty($_POST["fourthProjectTitle"] ) == FALSE
        ){
            $projectTitle = filter_var(ucfirst(trim ($_POST["fourthProjectTitle"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectTitle) == FALSE){

                // Sanitize the variable
                $projectTitle      = mysqli_real_escape_string($serverConnection, $projectTitle);
                // Then, check to ensure that the content is not already the same as what's already been stored within the database
                $sql = "SELECT  projectTitle
                        FROM    projects
                        WHERE   projectID = 4
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedTitle     = $retrievedArray['projectTitle'];

                if($projectTitle !== $retrievedTitle){

                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectTitle = \"$projectTitle\" 
                            WHERE   projectID = 4
                        ";

                    mysqli_query($serverConnection, $sql); 
                }

            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["fourthProjectIntroParagraph"] ) == FALSE
        ){
            $projectParagraph = filter_var(ucfirst(trim ($_POST["fourthProjectIntroParagraph"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectParagraph) == FALSE){
                    
                // Sanitize the variable
                $projectParagraph      = mysqli_real_escape_string($serverConnection, $projectParagraph);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectIntroParagraph = \"$projectParagraph\" 
                        WHERE   projectID = 4
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        } 

    // Check the SVG inputs
    // First SVG
        if(
            empty($_POST["fourthSVGOne"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["fourthSVGOne"] ));
            $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
            $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");

            $svg            = str_replace($svgMarkdown, $svgMarkUp, $svg);
            $svg            = filter_var($svg, FILTER_SANITIZE_STRING);

            if(ctype_space($svg) == FALSE){
                    
                // Sanitize the variable
                $svg = mysqli_real_escape_string($serverConnection, $svg);
                // Then, check to ensure that the content is not already the same as what's already been stored within the database
                $sql = "SELECT  projectSymbolSVGOne
                        FROM    projects
                        WHERE   projectID = 4
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGOne'];

                if($svg !== $retrievedSVG){

                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGOne = \"$svg\" 
                            WHERE   projectID = 4
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }

    // Second SVG
        if(
            empty($_POST["fourthSVGTwo"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["fourthSVGTwo"] ));
            $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
            $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");
            
            $svg            = str_replace($svgMarkdown, $svgMarkUp, $svg);
            $svg            = filter_var($svg, FILTER_SANITIZE_STRING);

            if(ctype_space($svg) == FALSE){
                    
                // Sanitize the variable
                $svg = mysqli_real_escape_string($serverConnection, $svg);
                // Then, check to ensure that the content is not already the same as what's already been stored within the database
                $sql = "SELECT  projectSymbolSVGTwo
                        FROM    projects
                        WHERE   projectID = 4
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGTwo'];

                if($svg !== $retrievedSVG){

                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGTwo = \"$svg\" 
                            WHERE   projectID = 4
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }

    // Third SVG
        if(
            empty($_POST["fourthSVGThree"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["fourthSVGThree"] ));
            $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
            $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");
            
            $svg            = str_replace($svgMarkdown, $svgMarkUp, $svg);
            $svg            = filter_var($svg, FILTER_SANITIZE_STRING);

            if(ctype_space($svg) == FALSE){
                    
                // Sanitize the variable
                $svg = mysqli_real_escape_string($serverConnection, $svg);
                // Then, check to ensure that the content is not already the same as what's already been stored within the database
                $sql = "SELECT  projectSymbolSVGThree
                        FROM    projects
                        WHERE   projectID = 4
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGThree'];

                if($svg !== $retrievedSVG){


                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGThree = \"$svg\" 
                            WHERE   projectID = 4
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }

    // Fourth SVG
        if(
            empty($_POST["fourthSVGFour"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["fourthSVGFour"] ));
            $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
            $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");
            
            $svg            = str_replace($svgMarkdown, $svgMarkUp, $svg);
            $svg            = filter_var($svg, FILTER_SANITIZE_STRING);

            if(ctype_space($svg) == FALSE){
                    
                // Sanitize the variable
                $svg = mysqli_real_escape_string($serverConnection, $svg);
                // Then, check to ensure that the content is not already the same as what's already been stored within the database
                $sql = "SELECT  projectSymbolSVGFour
                        FROM    projects
                        WHERE   projectID = 4
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGFour'];

                if($svg !== $retrievedSVG){


                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGFour = \"$svg\" 
                            WHERE   projectID = 4
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }
    // Fifth SVG
        if(
            empty($_POST["fourthSVGFive"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["fourthSVGFive"] ));

            $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
            $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");
            
            $svg            = str_replace($svgMarkdown, $svgMarkUp, $svg);

            $svg            = filter_var($svg, FILTER_SANITIZE_STRING);

            if(ctype_space($svg) == FALSE){
                    
                // Sanitize the variable
                $svg = mysqli_real_escape_string($serverConnection, $svg);
                // Then, check to ensure that the content is not already the same as what's already been stored within the database
                $sql = "SELECT  projectSymbolSVGFive
                        FROM    projects
                        WHERE   projectID = 4
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGFive'];

                if($svg !== $retrievedSVG){

                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGFive = \"$svg\" 
                            WHERE   projectID = 4
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }

//
// This is the first set of headers and excerpts
//
        if(
            empty($_POST["fourthSubHeadingOne"] ) == FALSE
        ){
            $projectSubTitle = filter_var(trim ($_POST["fourthSubHeadingOne"] ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubTitle) == FALSE){

                // Sanitize the variable
                $projectSubTitle      = mysqli_real_escape_string($serverConnection, $projectSubTitle);

                $sql = "UPDATE  projects
                        SET     projectSubHeaderOne = \"$projectSubTitle\" 
                        WHERE   projectID = 4
                ";
                
                mysqli_query($serverConnection, $sql); 
            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["fourthExcerptOne"] ) == FALSE
        ){
            $projectSubExcerpt = filter_var(ucfirst(trim ($_POST["fourthExcerptOne"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubExcerpt) == FALSE){
                    
                // Sanitize the variable
                $projectSubExcerpt      = mysqli_real_escape_string($serverConnection, $projectSubExcerpt);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectSubExcerptOne = \"$projectSubExcerpt\" 
                        WHERE   projectID = 4
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        }
//
// This is the second set of headers and excerpts
//
        if(
            empty($_POST["fourthSubHeadingTwo"] ) == FALSE
        ){
            $projectSubTitle = filter_var(trim ($_POST["fourthSubHeadingTwo"] ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubTitle) == FALSE){

                // Sanitize the variable
                $projectSubTitle      = mysqli_real_escape_string($serverConnection, $projectSubTitle);

                $sql = "UPDATE  projects
                        SET     projectSubHeaderTwo = \"$projectSubTitle\" 
                        WHERE   projectID = 4
                ";
                
                mysqli_query($serverConnection, $sql); 
            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["fourthExcerptTwo"] ) == FALSE
        ){
            $projectSubExcerpt = filter_var(ucfirst(trim ($_POST["fourthExcerptTwo"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubExcerpt) == FALSE){
                    
                // Sanitize the variable
                $projectSubExcerpt      = mysqli_real_escape_string($serverConnection, $projectSubExcerpt);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectSubExcerptTwo = \"$projectSubExcerpt\" 
                        WHERE   projectID = 4
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        }
//
// This is the third set of headers and excerpts
//
        if(
            empty($_POST["fourthSubHeadingThree"] ) == FALSE
        ){
            $projectSubTitle = filter_var(trim ($_POST["fourthSubHeadingThree"] ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubTitle) == FALSE){

                // Sanitize the variable
                $projectSubTitle      = mysqli_real_escape_string($serverConnection, $projectSubTitle);

                $sql = "UPDATE  projects
                        SET     projectSubHeaderThree = \"$projectSubTitle\" 
                        WHERE   projectID = 4
                ";
                
                mysqli_query($serverConnection, $sql); 
            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["fourthExcerptThree"] ) == FALSE
        ){
            $projectSubExcerpt = filter_var(ucfirst(trim ($_POST["fourthExcerptThree"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubExcerpt) == FALSE){
                    
                // Sanitize the variable
                $projectSubExcerpt      = mysqli_real_escape_string($serverConnection, $projectSubExcerpt);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectSubExcerptThree = \"$projectSubExcerpt\" 
                        WHERE   projectID = 4
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        } 

//
// This is the fourth set of headers and excerpts
//
        if(
            empty($_POST["fourthSubHeadingFour"] ) == FALSE
        ){
            $projectSubTitle = filter_var(trim ($_POST["fourthSubHeadingFour"] ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubTitle) == FALSE){

                // Sanitize the variable
                $projectSubTitle      = mysqli_real_escape_string($serverConnection, $projectSubTitle);

                $sql = "UPDATE  projects
                        SET     projectSubHeaderFour = \"$projectSubTitle\" 
                        WHERE   projectID = 4
                ";
                
                mysqli_query($serverConnection, $sql); 
            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["fourthExcerptFour"] ) == FALSE
        ){
            $projectSubExcerpt = filter_var(ucfirst(trim ($_POST["fourthExcerptFour"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubExcerpt) == FALSE){
                    
                // Sanitize the variable
                $projectSubExcerpt      = mysqli_real_escape_string($serverConnection, $projectSubExcerpt);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectSubExcerptFour = \"$projectSubExcerpt\" 
                        WHERE   projectID = 4
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        }

        // And finally, close the server connection, and direct the user to the home page

        $serverConnection->close();
        header("location: https://www.shanewalders.com/projectProfiles/newsletterSubscription.php");
        die();
    }
}
