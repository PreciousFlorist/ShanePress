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

        // Delete the SVG Icons, if requested
        if( isset($_POST["deleteSecondSVGOne"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGOne = NULL
                    WHERE   projectID = 2
                ";

            mysqli_query($serverConnection, $sql);

            header("location: https://www.shanewalders.com/edit/majorProjectSecond.php");
            die();
        }
        if( isset($_POST["deleteSecondSVGTwo"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGTwo = NULL
                    WHERE   projectID = 2
                ";

            mysqli_query($serverConnection, $sql);
            header("location: https://www.shanewalders.com/edit/majorProjectSecond.php");
            die();
        }
        if( isset($_POST["deleteSecondSVGThree"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGThree = NULL
                    WHERE   projectID = 2
                ";

            mysqli_query($serverConnection, $sql);

            header("location: https://www.shanewalders.com/edit/majorProjectSecond.php");
            die();
        }
        if( isset($_POST["deleteSecondSVGFour"])){

            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGFour = NULL 
                    WHERE   projectID = 2
                ";

            mysqli_query($serverConnection, $sql);

            header("location: https://www.shanewalders.com/edit/majorProjectSecond.php");
            die();
        }
        if( isset($_POST["deleteSecondSVGFive"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGFive = NULL
                    WHERE   projectID = 2
                ";

            mysqli_query($serverConnection, $sql);

            header("location: https://www.shanewalders.com/edit/majorProjectSecond.php");
            die();
        }

        // Once we"re connected to the mySQL database, check if the page title has changed
        if(
            empty($_POST["secondProjectTitle"] ) == FALSE
        ){
            $projectTitle = filter_var(ucfirst(trim ($_POST["secondProjectTitle"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectTitle) == FALSE){

                // Sanitize the variable
                $projectTitle      = mysqli_real_escape_string($serverConnection, $projectTitle);
                // Then, check to ensure that the content is not already the same as what's already been stored within the database
                $sql = "SELECT  projectTitle
                        FROM    projects
                        WHERE   projectID = 2
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedTitle     = $retrievedArray['projectTitle'];

                if($projectTitle !== $retrievedTitle){

                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectTitle = \"$projectTitle\" 
                            WHERE   projectID = 2
                        ";

                    mysqli_query($serverConnection, $sql); 
                }

            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["secondProjectIntroParagraph"] ) == FALSE
        ){
            $projectParagraph = filter_var(ucfirst(trim ($_POST["secondProjectIntroParagraph"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectParagraph) == FALSE){
                    
                // Sanitize the variable
                $projectParagraph      = mysqli_real_escape_string($serverConnection, $projectParagraph);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectIntroParagraph = \"$projectParagraph\" 
                        WHERE   projectID = 2
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        } 

    // Check the SVG inputs
    // First SVG
        if(
            empty($_POST["secondSVGOne"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["secondSVGOne"] ));
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
                        WHERE   projectID = 2
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGOne'];

                if($svg !== $retrievedSVG){

                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGOne = \"$svg\" 
                            WHERE   projectID = 2
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }

    // Second SVG
        if(
            empty($_POST["secondSVGTwo"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["secondSVGTwo"] ));
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
                        WHERE   projectID = 2
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGTwo'];

                if($svg !== $retrievedSVG){

                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGTwo = \"$svg\" 
                            WHERE   projectID = 2
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }

    // Third SVG
        if(
            empty($_POST["secondSVGThree"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["secondSVGThree"] ));
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
                        WHERE   projectID = 2
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGThree'];

                if($svg !== $retrievedSVG){


                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGThree = \"$svg\" 
                            WHERE   projectID = 2
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }

    // Fourth SVG
        if(
            empty($_POST["secondSVGFour"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["secondSVGFour"] ));
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
                        WHERE   projectID = 2
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGFour'];

                if($svg !== $retrievedSVG){


                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGFour = \"$svg\" 
                            WHERE   projectID = 2
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }
    // Fifth SVG
        if(
            empty($_POST["secondSVGFive"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["secondSVGFive"] ));

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
                        WHERE   projectID = 2
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGFive'];

                if($svg !== $retrievedSVG){

                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGFive = \"$svg\" 
                            WHERE   projectID = 2
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }

//
// This is the first set of headers and excerpts
//
        if(
            empty($_POST["secondSubHeadingOne"] ) == FALSE
        ){
            $projectSubTitle = filter_var(trim ($_POST["secondSubHeadingOne"] ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubTitle) == FALSE){

                // Sanitize the variable
                $projectSubTitle      = mysqli_real_escape_string($serverConnection, $projectSubTitle);

                $sql = "UPDATE  projects
                        SET     projectSubHeaderOne = \"$projectSubTitle\" 
                        WHERE   projectID = 2
                ";
                
                mysqli_query($serverConnection, $sql); 
            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["secondExcerptOne"] ) == FALSE
        ){
            $projectSubExcerpt = filter_var(ucfirst(trim ($_POST["secondExcerptOne"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubExcerpt) == FALSE){
                    
                // Sanitize the variable
                $projectSubExcerpt      = mysqli_real_escape_string($serverConnection, $projectSubExcerpt);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectSubExcerptOne = \"$projectSubExcerpt\" 
                        WHERE   projectID = 2
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        }
//
// This is the second set of headers and excerpts
//
        if(
            empty($_POST["secondSubHeadingTwo"] ) == FALSE
        ){
            $projectSubTitle = filter_var(trim ($_POST["secondSubHeadingTwo"] ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubTitle) == FALSE){

                // Sanitize the variable
                $projectSubTitle      = mysqli_real_escape_string($serverConnection, $projectSubTitle);

                $sql = "UPDATE  projects
                        SET     projectSubHeaderTwo = \"$projectSubTitle\" 
                        WHERE   projectID = 2
                ";
                
                mysqli_query($serverConnection, $sql); 
            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["secondExcerptTwo"] ) == FALSE
        ){
            $projectSubExcerpt = filter_var(ucfirst(trim ($_POST["secondExcerptTwo"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubExcerpt) == FALSE){
                    
                // Sanitize the variable
                $projectSubExcerpt      = mysqli_real_escape_string($serverConnection, $projectSubExcerpt);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectSubExcerptTwo = \"$projectSubExcerpt\" 
                        WHERE   projectID = 2
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        }
//
// This is the third set of headers and excerpts
//
        if(
            empty($_POST["secondSubHeadingThree"] ) == FALSE
        ){
            $projectSubTitle = filter_var(trim ($_POST["secondSubHeadingThree"] ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubTitle) == FALSE){

                // Sanitize the variable
                $projectSubTitle      = mysqli_real_escape_string($serverConnection, $projectSubTitle);

                $sql = "UPDATE  projects
                        SET     projectSubHeaderThree = \"$projectSubTitle\" 
                        WHERE   projectID = 2
                ";
                
                mysqli_query($serverConnection, $sql); 
            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["secondExcerptThree"] ) == FALSE
        ){
            $projectSubExcerpt = filter_var(ucfirst(trim ($_POST["secondExcerptThree"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubExcerpt) == FALSE){
                    
                // Sanitize the variable
                $projectSubExcerpt      = mysqli_real_escape_string($serverConnection, $projectSubExcerpt);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectSubExcerptThree = \"$projectSubExcerpt\" 
                        WHERE   projectID = 2
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        } 

//
// This is the fourth set of headers and excerpts
//
        if(
            empty($_POST["secondSubHeadingFour"] ) == FALSE
        ){
            $projectSubTitle = filter_var(trim ($_POST["secondSubHeadingFour"] ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubTitle) == FALSE){

                // Sanitize the variable
                $projectSubTitle      = mysqli_real_escape_string($serverConnection, $projectSubTitle);

                $sql = "UPDATE  projects
                        SET     projectSubHeaderFour = \"$projectSubTitle\" 
                        WHERE   projectID = 2
                ";
                
                mysqli_query($serverConnection, $sql); 
            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["secondExcerptFour"] ) == FALSE
        ){
            $projectSubExcerpt = filter_var(ucfirst(trim ($_POST["secondExcerptFour"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubExcerpt) == FALSE){
                    
                // Sanitize the variable
                $projectSubExcerpt      = mysqli_real_escape_string($serverConnection, $projectSubExcerpt);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectSubExcerptFour = \"$projectSubExcerpt\" 
                        WHERE   projectID = 2
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        }

        // And finally, close the server connection, and direct the user to the home page

        $serverConnection->close();
        header("location: https://www.shanewalders.com/projectProfiles/portfolio.php");
        die();
    }
}