<?php
/*--------------------------------------------------------------
# MINOR PROJECT 1
--------------------------------------------------------------*/
/*--------------------
# Admin Permissions
--------------------*/
if ($_SESSION["permission"] == "admin" && isset($_SESSION["timer"]) ){

    if(
        isset($_POST["thirdProjectTitle"] )              == TRUE
        ||isset($_POST["thirdProjectIntroParagraph"] )   == TRUE
        
        ||isset($_POST["thirdSVGOne"] )                  == TRUE
        ||isset($_POST["thirdSVGTwo"] )                  == TRUE
        ||isset($_POST["thirdSVGThree"] )                == TRUE
        ||isset($_POST["thirdSVGFour"] )                 == TRUE
        ||isset($_POST["thirdSVGFive"] )                 == TRUE
        
        ||isset($_POST["thirdSubHeadingOne"] )           == TRUE
        ||isset($_POST["thirdExcerptOne"] )              == TRUE
        
        ||isset($_POST["thirdSubHeadingTwo"] )           == TRUE
        ||isset($_POST["thirdExcerptTwo"] )              == TRUE
        
        ||isset($_POST["thirdSubHeadingThree"] )         == TRUE
        ||isset($_POST["thirdExcerptThree"] )            == TRUE
        
        ||isset($_POST["thirdSubHeadingFour"] )          == TRUE
        ||isset($_POST["thirdExcerptFour"] )             == TRUE
    ){

        // We"re going to store these changes into the database, so establish a connection to the server here...
        $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

        if ($serverConnection->connect_error) {
            die("The server connection failed: " . $mysqli->connect_error);
        }

    // Delete the SVG Icons, if requested
        if( isset($_POST["deleteThirdSVGOneSVGOne"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGOne = NULL
                    WHERE   projectID = 3
                ";

            mysqli_query($serverConnection, $sql);

            header("location: https://www.shanewalders.com/edit/minorProjectFirst.php");
            die();
        }
        if( isset($_POST["deleteThirdSVGTwo"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGTwo = NULL
                    WHERE   projectID = 3
                ";

            mysqli_query($serverConnection, $sql);
            header("location: https://www.shanewalders.com/edit/minorProjectFirst.php");
            die();
        }
        if( isset($_POST["deleteThirdSVGThree"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGThree = NULL
                    WHERE   projectID = 3
                ";

            mysqli_query($serverConnection, $sql);

            header("location: https://www.shanewalders.com/edit/minorProjectFirst.php");
            die();
        }
        if( isset($_POST["deleteThirdSVGFour"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGFour = NULL
                    WHERE   projectID = 3
                ";

            mysqli_query($serverConnection, $sql);

            header("location: https://www.shanewalders.com/edit/minorProjectFirst.php");
            die();
        }
        if( isset($_POST["deleteThirdSVGFive"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGFive = NULL
                    WHERE   projectID = 3
                ";

            mysqli_query($serverConnection, $sql);

            header("location: https://www.shanewalders.com/edit/minorProjectFirst.php");
            die();
        }

        // Once we"re connected to the mySQL database, check if the page title has changed
        if(
            empty($_POST["thirdProjectTitle"] ) == FALSE
        ){
            $projectTitle = filter_var(ucfirst(trim ($_POST["thirdProjectTitle"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectTitle) == FALSE){

                // Sanitize the variable
                $projectTitle      = mysqli_real_escape_string($serverConnection, $projectTitle);
                // Then, check to ensure that the content is not already the same as what's already been stored within the database
                $sql = "SELECT  projectTitle
                        FROM    projects
                        WHERE   projectID = 3
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedTitle     = $retrievedArray['projectTitle'];

                if($projectTitle !== $retrievedTitle){

                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectTitle = \"$projectTitle\" 
                            WHERE   projectID = 3
                        ";

                    mysqli_query($serverConnection, $sql); 
                }

            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["thirdProjectIntroParagraph"] ) == FALSE
        ){
            $projectParagraph = filter_var(ucfirst(trim ($_POST["thirdProjectIntroParagraph"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectParagraph) == FALSE){
                    
                // Sanitize the variable
                $projectParagraph      = mysqli_real_escape_string($serverConnection, $projectParagraph);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectIntroParagraph = \"$projectParagraph\" 
                        WHERE   projectID = 3
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        } 

    // Check the SVG inputs
    // First SVG
        if(
            empty($_POST["thirdSVGOne"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["thirdSVGOne"] ));
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
                        WHERE   projectID = 3
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGOne'];

                if($svg !== $retrievedSVG){

                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGOne = \"$svg\" 
                            WHERE   projectID = 3
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }

    // Second SVG
        if(
            empty($_POST["thirdSVGTwo"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["thirdSVGTwo"] ));
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
                        WHERE   projectID = 3
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGTwo'];

                if($svg !== $retrievedSVG){

                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGTwo = \"$svg\" 
                            WHERE   projectID = 3
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }

    // Third SVG
        if(
            empty($_POST["thirdSVGThree"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["thirdSVGThree"] ));
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
                        WHERE   projectID = 3
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGThree'];

                if($svg !== $retrievedSVG){


                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGThree = \"$svg\" 
                            WHERE   projectID = 3
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }

    // Fourth SVG
        if(
            empty($_POST["thirdSVGFour"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["thirdSVGFour"] ));
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
                        WHERE   projectID = 3
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGFour'];

                if($svg !== $retrievedSVG){


                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGFour = \"$svg\" 
                            WHERE   projectID = 3
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }
    // Fifth SVG
        if(
            empty($_POST["thirdSVGFive"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["thirdSVGFive"] ));

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
                        WHERE   projectID = 3
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGFive'];

                if($svg !== $retrievedSVG){

                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGFive = \"$svg\" 
                            WHERE   projectID = 3
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }

//
// This is the first set of headers and excerpts
//
        if(
            empty($_POST["thirdSubHeadingOne"] ) == FALSE
        ){
            $projectSubTitle = filter_var(trim ($_POST["thirdSubHeadingOne"] ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubTitle) == FALSE){

                // Sanitize the variable
                $projectSubTitle      = mysqli_real_escape_string($serverConnection, $projectSubTitle);

                $sql = "UPDATE  projects
                        SET     projectSubHeaderOne = \"$projectSubTitle\" 
                        WHERE   projectID = 3
                ";
                
                mysqli_query($serverConnection, $sql); 
            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["thirdExcerptOne"] ) == FALSE
        ){
            $projectSubExcerpt = filter_var(ucfirst(trim ($_POST["thirdExcerptOne"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubExcerpt) == FALSE){
                    
                // Sanitize the variable
                $projectSubExcerpt      = mysqli_real_escape_string($serverConnection, $projectSubExcerpt);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectSubExcerptOne = \"$projectSubExcerpt\" 
                        WHERE   projectID = 3
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        }
//
// This is the second set of headers and excerpts
//
        if(
            empty($_POST["thirdSubHeadingTwo"] ) == FALSE
        ){
            $projectSubTitle = filter_var(trim ($_POST["thirdSubHeadingTwo"] ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubTitle) == FALSE){

                // Sanitize the variable
                $projectSubTitle      = mysqli_real_escape_string($serverConnection, $projectSubTitle);

                $sql = "UPDATE  projects
                        SET     projectSubHeaderTwo = \"$projectSubTitle\" 
                        WHERE   projectID = 3
                ";
                
                mysqli_query($serverConnection, $sql); 
            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["thirdExcerptTwo"] ) == FALSE
        ){
            $projectSubExcerpt = filter_var(ucfirst(trim ($_POST["thirdExcerptTwo"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubExcerpt) == FALSE){
                    
                // Sanitize the variable
                $projectSubExcerpt      = mysqli_real_escape_string($serverConnection, $projectSubExcerpt);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectSubExcerptTwo = \"$projectSubExcerpt\" 
                        WHERE   projectID = 3
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        }
//
// This is the third set of headers and excerpts
//
        if(
            empty($_POST["thirdSubHeadingThree"] ) == FALSE
        ){
            $projectSubTitle = filter_var(trim ($_POST["thirdSubHeadingThree"] ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubTitle) == FALSE){

                // Sanitize the variable
                $projectSubTitle      = mysqli_real_escape_string($serverConnection, $projectSubTitle);

                $sql = "UPDATE  projects
                        SET     projectSubHeaderThree = \"$projectSubTitle\" 
                        WHERE   projectID = 3
                ";
                
                mysqli_query($serverConnection, $sql); 
            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["thirdExcerptThree"] ) == FALSE
        ){
            $projectSubExcerpt = filter_var(ucfirst(trim ($_POST["thirdExcerptThree"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubExcerpt) == FALSE){
                    
                // Sanitize the variable
                $projectSubExcerpt      = mysqli_real_escape_string($serverConnection, $projectSubExcerpt);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectSubExcerptThree = \"$projectSubExcerpt\" 
                        WHERE   projectID = 3
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        } 

//
// This is the fourth set of headers and excerpts
//
        if(
            empty($_POST["thirdSubHeadingFour"] ) == FALSE
        ){
            $projectSubTitle = filter_var(trim ($_POST["thirdSubHeadingFour"] ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubTitle) == FALSE){

                // Sanitize the variable
                $projectSubTitle      = mysqli_real_escape_string($serverConnection, $projectSubTitle);

                $sql = "UPDATE  projects
                        SET     projectSubHeaderFour = \"$projectSubTitle\" 
                        WHERE   projectID = 3
                ";
                
                mysqli_query($serverConnection, $sql); 
            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["thirdExcerptFour"] ) == FALSE
        ){
            $projectSubExcerpt = filter_var(ucfirst(trim ($_POST["thirdExcerptFour"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubExcerpt) == FALSE){
                    
                // Sanitize the variable
                $projectSubExcerpt      = mysqli_real_escape_string($serverConnection, $projectSubExcerpt);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectSubExcerptFour = \"$projectSubExcerpt\" 
                        WHERE   projectID = 3
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        }

        // And finally, close the server connection, and direct the user to the home page

        $serverConnection->close();
        header("location: https://www.shanewalders.com/projectProfiles/compass.php");
        die();
    }
}

