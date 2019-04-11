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
        ||isset($_POST["firstExcerptFour"] )  
    ){

        // We"re going to store these changes into the database, so establish a connection to the server here...
        $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

        if ($serverConnection->connect_error) {
            die("The server connection failed: " . $mysqli->connect_error);
        }

    // Delete the SVG Icons, if requested
        if( isset($_POST["deleteFirstSVGOne"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGOne = NULL
                    WHERE   projectID = \"1\"
                ";

            mysqli_query($serverConnection, $sql);

            header("location: https://www.shanewalders.com/edit/majorProjectFirst.php");
            die();
        }
        if( isset($_POST["deleteFirstSVGTwo"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGTwo = NULL
                    WHERE   projectID = \"1\"
                ";

            mysqli_query($serverConnection, $sql);
            header("location: https://www.shanewalders.com/edit/majorProjectFirst.php");
            die();
        }
        if( isset($_POST["deleteFirstSVGThree"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGThree = NULL
                    WHERE   projectID = \"1\"
                ";

            mysqli_query($serverConnection, $sql);

            header("location: https://www.shanewalders.com/edit/majorProjectFirst.php");
            die();
        }
        if( isset($_POST["deleteFirstSVGFour"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGFour = NULL
                    WHERE   projectID = \"1\"
                ";

            mysqli_query($serverConnection, $sql);

            header("location: https://www.shanewalders.com/edit/majorProjectFirst.php");
            die();
        }
        if( isset($_POST["deleteFirstSVGFive"])){
            // And push the data upto the projects database
            $sql = "UPDATE  projects
                    SET     projectSymbolSVGFive = NULL
                    WHERE   projectID = \"1\"
                ";

            mysqli_query($serverConnection, $sql);

            header("location: https://www.shanewalders.com/edit/majorProjectFirst.php");
            die();
        }

        // Once we"re connected to the mySQL database, check if the page title has changed
        if(
            empty($_POST["firstProjectTitle"] ) == FALSE
        ){
            $projectTitle = filter_var(ucfirst(trim ($_POST["firstProjectTitle"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectTitle) == FALSE){

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectTitle = \"$projectTitle\" 
                        WHERE   projectID = \"1\"
                    ";

                mysqli_query($serverConnection, $sql);
                
                # NOW that we have changed the page name, we must also update the projects url
                $pageName    = strtolower( str_replace(" ", "-", $projectTitle) );

                // Pull the page name from the archive
                $sql = "SELECT  pageName
                        FROM    projectPageName
                        WHERE   projectID = 1
                    ";

                // Connect the query to the server
                $requestedData      = mysqli_query($serverConnection, $sql);
                // Convert the retrieved array into a variable
                $retrievedArray     = mysqli_fetch_array($requestedData);
                // Collect the relevent data
                $registeredPageName   = $retrievedArray['pageName'];

                // Check to see if the two page names match, if not, update the content to match the new name
                if($pageName !== $registeredPageName){
                    // Rename the card file
                    rename("https://www.shanewalders.com/completedProjectCards/seymour-digital.php", "https://www.shanewalders.com/completedProjectCards/majorProjectOne.php");
                    // Rename the project profile
                    rename("https://www.shanewalders.com/projectProfiles/seymour-digital.php", "https://www.shanewalders.com/projectProfiles/majorProjectOne.php");

                    // Then, update the registered page name to match the new page name
                    $sql = "UPDATE  projectPageName
                            SET     pageName = \"$pageName\"
                            WHERE   projectID = 1
                        ";

                    mysqli_query($serverConnection, $sql);

                }
            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["firstProjectIntroParagraph"] ) == FALSE
        ){
            $projectParagraph = filter_var(ucfirst(trim ($_POST["firstProjectIntroParagraph"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectParagraph) == FALSE){
                    
                // Sanitize the variable
                $projectParagraph      = mysqli_real_escape_string($serverConnection, $projectParagraph);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectIntroParagraph = \"$projectParagraph\" 
                        WHERE   projectID = \"1\"
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        } 

    // Check the SVG inputs
    // First SVG
        if(
            empty($_POST["firstSVGOne"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["firstSVGOne"] ));
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
                        WHERE   projectID = \"1\"
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGOne'];

                if($svg !== $retrievedSVG){

                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGOne = \"$svg\" 
                            WHERE   projectID = \"1\"
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }

    // Second SVG
        if(
            empty($_POST["firstSVGTwo"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["firstSVGTwo"] ));
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
                        WHERE   projectID = \"1\"
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGTwo'];

                if($svg !== $retrievedSVG){

                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGTwo = \"$svg\" 
                            WHERE   projectID = \"1\"
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }

    // Third SVG
        if(
            empty($_POST["firstSVGThree"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["firstSVGThree"] ));
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
                        WHERE   projectID = \"1\"
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGThree'];

                if($svg !== $retrievedSVG){


                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGThree = \"$svg\" 
                            WHERE   projectID = \"1\"
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }

    // Fourth SVG
        if(
            empty($_POST["firstSVGFour"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["firstSVGFour"] ));
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
                        WHERE   projectID = \"1\"
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGFour'];

                if($svg !== $retrievedSVG){


                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGFour = \"$svg\" 
                            WHERE   projectID = \"1\"
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }
    // Fifth SVG
        if(
            empty($_POST["firstSVGFive"] ) == FALSE
        ){

            $svg            = filter_var(trim ($_POST["firstSVGFive"] ));

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
                        WHERE   projectID = \"1\"
                    ";

                $requestedData      = mysqli_query($serverConnection, $sql);
                $retrievedArray     = mysqli_fetch_array($requestedData);
                $retrievedSVG       = $retrievedArray['projectSymbolSVGFive'];

                if($svg !== $retrievedSVG){

                    // And push the data upto the projects database
                    $sql = "UPDATE  projects
                            SET     projectSymbolSVGFive = \"$svg\" 
                            WHERE   projectID = \"1\"
                        ";

                    mysqli_query($serverConnection, $sql); 
                }
            }
        }

//
// This is the first set of headers and excerpts
//
        if(
            empty($_POST["firstSubHeadingOne"] ) == FALSE
        ){
            $projectSubTitle = filter_var(trim ($_POST["firstSubHeadingOne"] ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubTitle) == FALSE){

                // Sanitize the variable
                $projectSubTitle      = mysqli_real_escape_string($serverConnection, $projectSubTitle);

                $sql = "UPDATE  projects
                        SET     projectSubHeaderOne = \"$projectSubTitle\" 
                        WHERE   projectID = \"1\"
                ";
                
                mysqli_query($serverConnection, $sql); 
            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["firstExcerptOne"] ) == FALSE
        ){
            $projectSubExcerpt = filter_var(ucfirst(trim ($_POST["firstExcerptOne"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubExcerpt) == FALSE){
                    
                // Sanitize the variable
                $projectSubExcerpt      = mysqli_real_escape_string($serverConnection, $projectSubExcerpt);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectSubExcerptOne = \"$projectSubExcerpt\" 
                        WHERE   projectID = \"1\"
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        }
//
// This is the second set of headers and excerpts
//
        if(
            empty($_POST["firstSubHeadingTwo"] ) == FALSE
        ){
            $projectSubTitle = filter_var(trim ($_POST["firstSubHeadingTwo"] ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubTitle) == FALSE){

                // Sanitize the variable
                $projectSubTitle      = mysqli_real_escape_string($serverConnection, $projectSubTitle);

                $sql = "UPDATE  projects
                        SET     projectSubHeaderTwo = \"$projectSubTitle\" 
                        WHERE   projectID = \"1\"
                ";
                
                mysqli_query($serverConnection, $sql); 
            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["firstExcerptTwo"] ) == FALSE
        ){
            $projectSubExcerpt = filter_var(ucfirst(trim ($_POST["firstExcerptTwo"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubExcerpt) == FALSE){
                    
                // Sanitize the variable
                $projectSubExcerpt      = mysqli_real_escape_string($serverConnection, $projectSubExcerpt);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectSubExcerptTwo = \"$projectSubExcerpt\" 
                        WHERE   projectID = \"1\"
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        }
//
// This is the third set of headers and excerpts
//
        if(
            empty($_POST["firstSubHeadingThree"] ) == FALSE
        ){
            $projectSubTitle = filter_var(trim ($_POST["firstSubHeadingThree"] ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubTitle) == FALSE){

                // Sanitize the variable
                $projectSubTitle      = mysqli_real_escape_string($serverConnection, $projectSubTitle);

                $sql = "UPDATE  projects
                        SET     projectSubHeaderThree = \"$projectSubTitle\" 
                        WHERE   projectID = \"1\"
                ";
                
                mysqli_query($serverConnection, $sql); 
            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["firstExcerptThree"] ) == FALSE
        ){
            $projectSubExcerpt = filter_var(ucfirst(trim ($_POST["firstExcerptThree"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubExcerpt) == FALSE){
                    
                // Sanitize the variable
                $projectSubExcerpt      = mysqli_real_escape_string($serverConnection, $projectSubExcerpt);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectSubExcerptThree = \"$projectSubExcerpt\" 
                        WHERE   projectID = \"1\"
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        } 

//
// This is the fourth set of headers and excerpts
//
        if(
            empty($_POST["firstSubHeadingFour"] ) == FALSE
        ){
            $projectSubTitle = filter_var(trim ($_POST["firstSubHeadingFour"] ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubTitle) == FALSE){

                // Sanitize the variable
                $projectSubTitle      = mysqli_real_escape_string($serverConnection, $projectSubTitle);

                $sql = "UPDATE  projects
                        SET     projectSubHeaderFour = \"$projectSubTitle\" 
                        WHERE   projectID = \"1\"
                ";
                
                mysqli_query($serverConnection, $sql); 
            }
        }

        // Then, check the paragraph content has been changed
        if(
            empty($_POST["firstExcerptFour"] ) == FALSE
        ){
            $projectSubExcerpt = filter_var(ucfirst(trim ($_POST["firstExcerptFour"] ) ), FILTER_SANITIZE_STRING);

            if(ctype_space($projectSubExcerpt) == FALSE){
                    
                // Sanitize the variable
                $projectSubExcerpt      = mysqli_real_escape_string($serverConnection, $projectSubExcerpt);

                // And push the data upto the projects database
                $sql = "UPDATE  projects
                        SET     projectSubExcerptFour = \"$projectSubExcerpt\" 
                        WHERE   projectID = \"1\"
                    ";

                mysqli_query($serverConnection, $sql); 
            }
        }

        // And finally, close the server connection, and direct the user to the appropriate page
        $serverConnection->close();
        header("location: https://www.shanewalders.com/projectProfiles/$pageName.php");
        die();
    }
}