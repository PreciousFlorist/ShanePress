<?php
    require_once('../modules/headerFiles.php');
    if( $_SESSION["permission"] == "visitor"){
        header("location: https://www.shanewalders.com/backend/backendIndex.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shane Walders - Edit <?php 

        $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

        if (!$serverConnection->connect_error) {


            $sql = "SELECT  projectTitle
                    FROM    projects
                    WHERE   projectID = 4
                ";

            // Connect the query to the server
            $requestedData      = mysqli_query($serverConnection, $sql);
            // Convert the retrieved array into a variable
            $retrievedArray     = mysqli_fetch_array($requestedData);
            // Collect the relevent data
            $projectTitle   = $retrievedArray['projectTitle'];

            echo $projectTitle;
            $serverConnection->close();
        }

        ?></title>

</head>
<body>
    <?php 
        require_once('../modules/backendHamburgerMenu.php');
        require_once("../backend/backendTimer.php");    
    ?>

    <div class="contentBody editBackend editProjects">
        <div class="wrapper"> 

                <h1><?php 

                    $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                    if (!$serverConnection->connect_error) {


                        $sql = "SELECT  projectTitle
                                FROM    projects
                                WHERE   projectID = 4
                            ";

                        // Connect the query to the server
                        $requestedData      = mysqli_query($serverConnection, $sql);
                        // Convert the retrieved array into a variable
                        $retrievedArray     = mysqli_fetch_array($requestedData);
                        // Collect the relevent data
                        $projectTitle   = $retrievedArray['projectTitle'];

                        echo $projectTitle;

                        $sql = "SELECT  projectIntroParagraph
                                FROM    projects
                                WHERE   projectID = 4
                            ";

                        // Connect the query to the server
                        $requestedData      = mysqli_query($serverConnection, $sql);
                        // Convert the retrieved array into a variable
                        $retrievedArray     = mysqli_fetch_array($requestedData);
                        // Collect the relevent data
                        $projectIntroParagraph   = $retrievedArray['projectIntroParagraph'];

                        $serverConnection->close();
                    }

                ?></h1>

                <?php require("../modules/formattingHelpAccordion.php"); ?>
                <form target="_blank" method="POST" action="validationModules/editValidation.php" class="formGroup">
                <!-- Title -->
                    <div>
                        <label for="aboutTitle" class="formTitle aboutTitle">Project Title:</label>
                        <input type="text" name="fourthProjectTitle" value="<?php 

                            echo $projectTitle;

                        ?>">

                            <label for="aboutParagraph" class="formTitle">Introductory Paragraph:</label>
                            <textarea type="textarea" name="fourthProjectIntroParagraph"><?php 

                                echo $projectIntroParagraph;

                            ?></textarea>
                    </div>
                    
                    <button type="button" class="accordion">SVG Icons</button>

                    <div class="panel">
                        <label class="formTitle"> <?php 

                            $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                            if (!$serverConnection->connect_error) {


                                $sql = "SELECT  projectSymbolSVGOne
                                        FROM    projects
                                        WHERE   projectID = 4
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data
                                $projectSymbolSVG   = $retrievedArray['projectSymbolSVGOne'];
                                
                                $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
                                $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");
                                $projectSymbolSVG   = str_replace($svgMarkUp, $svgMarkdown, $projectSymbolSVG);

 
                                $labelSVG = html_entity_decode($projectSymbolSVG);
                                
                                if( isset($labelSVG)
                                && ctype_space($labelSVG) == FALSE
                                && !empty($labelSVG)){

                                   echo $labelSVG;
                                   unset($labelSVG);

                               } else{
                                   echo "First SVG:";
                               }

                                $serverConnection->close();

                            }

                        ?> </label>

                            <div class="svgAlign">
                                <input type="text" class="svg" name="fourthSVGOne" value="<?php 

                                    if(isset($projectSymbolSVG) ){
                                        echo $projectSymbolSVG;
                                        unset($projectSymbolSVG);
                                    }

                                ?>"> <button class="svgDelete" name="deleteFourthSVGOne">Remove SVG</button>
                            </div>

                            <label class="formTitle"><?php 

                                $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                                if (!$serverConnection->connect_error) {


                                    $sql = "SELECT  projectSymbolSVGTwo
                                            FROM    projects
                                            WHERE   projectID = 4
                                        ";

                                    // Connect the query to the server
                                    $requestedData      = mysqli_query($serverConnection, $sql);
                                    // Convert the retrieved array into a variable
                                    $retrievedArray     = mysqli_fetch_array($requestedData);
                                    // Collect the relevent data
                                    $projectSymbolSVG   = $retrievedArray['projectSymbolSVGTwo'];
                                    
                                    $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
                                    $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");
                                    $projectSymbolSVG   = str_replace($svgMarkUp, $svgMarkdown, $projectSymbolSVG);


                                    $labelSVG = html_entity_decode($projectSymbolSVG);
                                    
                                    if( isset($labelSVG)
                                     && ctype_space($labelSVG) == FALSE
                                     && !empty($labelSVG)){

                                        echo $labelSVG;
                                        unset($labelSVG);

                                    } else{
                                        echo "Fourth SVG:";
                                    }

                                    $serverConnection->close();

                                }

                            ?></label>
                            <div class="svgAlign">
                                <input type="text" class="svg" name="fourthSVGTwo" value="<?php 

                                    if(isset($projectSymbolSVG) ){
                                        echo $projectSymbolSVG;
                                        unset($projectSymbolSVG);
                                    }

                                ?>"> <button class="svgDelete" name="deleteFourthSVGTwo">Remove SVG</button>
                            </div>

                            <label class="formTitle"><?php 

                                $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                                if (!$serverConnection->connect_error) {


                                    $sql = "SELECT  projectSymbolSVGThree
                                            FROM    projects
                                            WHERE   projectID = 4
                                        ";

                                    // Connect the query to the server
                                    $requestedData      = mysqli_query($serverConnection, $sql);
                                    // Convert the retrieved array into a variable
                                    $retrievedArray     = mysqli_fetch_array($requestedData);
                                    // Collect the relevent data
                                    $projectSymbolSVG   = $retrievedArray['projectSymbolSVGThree'];
                                    
                                    $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
                                    $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");
                                    $projectSymbolSVG   = str_replace($svgMarkUp, $svgMarkdown, $projectSymbolSVG);


                                    $labelSVG = html_entity_decode($projectSymbolSVG);
                                    
                                    if( isset($labelSVG)
                                     && ctype_space($labelSVG) == FALSE
                                     && !empty($labelSVG)){

                                        echo $labelSVG;
                                        unset($labelSVG);

                                    } else{
                                        echo "Fourth SVG:";
                                    }

                                    $serverConnection->close();

                                }

                            ?></label>

                            <div class="svgAlign">
                                <input type="text" class="svg" name="fourthSVGThree" value="<?php 

                                    if(isset($projectSymbolSVG) ){
                                        echo $projectSymbolSVG;
                                        unset($projectSymbolSVG);
                                    }

                                ?>"> <button class="svgDelete" name="deleteFourthSVGThree">Remove SVG</button>
                            </div>

                            <label class="formTitle"><?php 

                                $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                                if (!$serverConnection->connect_error) {


                                    $sql = "SELECT  projectSymbolSVGFour
                                            FROM    projects
                                            WHERE   projectID = 4
                                        ";

                                    // Connect the query to the server
                                    $requestedData      = mysqli_query($serverConnection, $sql);
                                    // Convert the retrieved array into a variable
                                    $retrievedArray     = mysqli_fetch_array($requestedData);
                                    // Collect the relevent data
                                    $projectSymbolSVG   = $retrievedArray['projectSymbolSVGFour'];
                                    
                                    $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
                                    $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");
                                    $projectSymbolSVG   = str_replace($svgMarkUp, $svgMarkdown, $projectSymbolSVG);


                                    $labelSVG = html_entity_decode($projectSymbolSVG);

                                    if( isset($labelSVG)
                                     && ctype_space($labelSVG) == FALSE
                                     && !empty($labelSVG)){

                                        echo $labelSVG;
                                        unset($labelSVG);

                                    } else{
                                        echo "Fourth SVG:";
                                    }

                                    echo $labelSVG;
                                    $serverConnection->close();

                                }

                            ?></label>
                            <div class="svgAlign">
                                <input type="text" class="svg" name="fourthSVGFour" value="<?php 

                                    if(isset($projectSymbolSVG) ){
                                        echo $projectSymbolSVG;
                                        unset($projectSymbolSVG);
                                    }

                                ?>"> <button class="svgDelete" name="deleteFourthSVGFour">Remove SVG</button>
                            </div>

                            <label class="formTitle"><?php 

                                $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                                if (!$serverConnection->connect_error) {


                                    $sql = "SELECT  projectSymbolSVGFive
                                            FROM    projects
                                            WHERE   projectID = 4
                                        ";

                                    // Connect the query to the server
                                    $requestedData      = mysqli_query($serverConnection, $sql);
                                    // Convert the retrieved array into a variable
                                    $retrievedArray     = mysqli_fetch_array($requestedData);
                                    // Collect the relevent data
                                    $projectSymbolSVG   = $retrievedArray['projectSymbolSVGFive'];
                                    
                                    $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
                                    $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");
                                    $projectSymbolSVG   = str_replace($svgMarkUp, $svgMarkdown, $projectSymbolSVG);


                                    $labelSVG = html_entity_decode($projectSymbolSVG);
                                    
                                    if( isset($labelSVG)
                                    && ctype_space($labelSVG) == FALSE
                                    && !empty($labelSVG)){

                                        echo $labelSVG;
                                        unset($labelSVG);

                                    } else{
                                        echo "Fifth SVG:";
                                    }

                                    $serverConnection->close();

                                }

                            ?></label>

                            <div class="svgAlign">
                                <input type="text" class="svg" name="fourthSVGFive" value="<?php 

                                    $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                                    if (!$serverConnection->connect_error) {


                                        $sql = "SELECT  projectSymbolSVGFive
                                                FROM    projects
                                                WHERE   projectID = 4
                                            ";

                                        // Connect the query to the server
                                        $requestedData      = mysqli_query($serverConnection, $sql);
                                        // Convert the retrieved array into a variable
                                        $retrievedArray     = mysqli_fetch_array($requestedData);
                                        // Collect the relevent data
                                        $projectSymbolSVG   = $retrievedArray['projectSymbolSVGFive'];
                                        
                                        $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
                                        $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");
                                        $projectSymbolSVG   = str_replace($svgMarkUp, $svgMarkdown, $projectSymbolSVG);

                                        echo $projectSymbolSVG;

                                        $serverConnection->close();
                                    }

                                ?>"> <button class="svgDelete" name="deleteFourthSVGFive">Remove SVG</button>

                            </div>
         
                    </div>

                    <button type="button" class="accordion">Process</button>
                    <div class="panel">

                            <label for="aboutParagraph" class="formTitle">First Sub Heading:</label>
                            <input type="text" name="fourthSubHeadingOne" value="<?php 

                                $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                                if (!$serverConnection->connect_error) {


                                    $sql = "SELECT  projectSubHeaderOne
                                            FROM    projects
                                            WHERE   projectID = 4
                                        ";

                                    // Connect the query to the server
                                    $requestedData      = mysqli_query($serverConnection, $sql);
                                    // Convert the retrieved array into a variable
                                    $retrievedArray     = mysqli_fetch_array($requestedData);
                                    // Collect the relevent data
                                    $subHeading   = $retrievedArray['projectSubHeaderOne'];

                                    $sql = "SELECT  projectSubExcerptOne
                                            FROM    projects
                                            WHERE   projectID = 4
                                        ";

                                    // Connect the query to the server
                                    $requestedData      = mysqli_query($serverConnection, $sql);
                                    // Convert the retrieved array into a variable
                                    $retrievedArray     = mysqli_fetch_array($requestedData);
                                    // Collect the relevent data
                                    $projectSubExcerpt   = $retrievedArray['projectSubExcerptOne'];

                                    echo $subHeading;
                                    unset($subHeading);
                                    
                                    $serverConnection->close();
                                }

                            ?>"> 

                            <label for="aboutParagraph" class="formTitle">Excerpt:</label>
                            <textarea type="textarea" name="fourthExcerptOne"><?php 

                                echo $projectSubExcerpt;
                                unset($projectSubExcerpt);

                            ?></textarea>

                            <label for="aboutParagraph" class="formTitle">Second Sub Heading:</label>
                            <input type="text" name="fourthSubHeadingTwo" value="<?php 

                                $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                                if (!$serverConnection->connect_error) {


                                    $sql = "SELECT  projectSubHeaderTwo
                                            FROM    projects
                                            WHERE   projectID = 4
                                        ";

                                    // Connect the query to the server
                                    $requestedData      = mysqli_query($serverConnection, $sql);
                                    // Convert the retrieved array into a variable
                                    $retrievedArray     = mysqli_fetch_array($requestedData);
                                    // Collect the relevent data
                                    $subHeading   = $retrievedArray['projectSubHeaderTwo'];

                                    $sql = "SELECT  projectSubExcerptTwo
                                            FROM    projects
                                            WHERE   projectID = 4
                                        ";

                                    // Connect the query to the server
                                    $requestedData      = mysqli_query($serverConnection, $sql);
                                    // Convert the retrieved array into a variable
                                    $retrievedArray     = mysqli_fetch_array($requestedData);
                                    // Collect the relevent data
                                    $projectSubExcerpt   = $retrievedArray['projectSubExcerptTwo'];

                                    echo $subHeading;
                                    unset($subHeading);
                                    
                                    $serverConnection->close();
                                }

                            ?>">

                            <label for="aboutParagraph" class="formTitle">Excerpt:</label>
                            <textarea type="textarea" name="fourthExcerptTwo"><?php 

                                echo $projectSubExcerpt;
                                unset($projectSubExcerpt);

                            ?></textarea>

                            <label for="aboutParagraph" class="formTitle">Third Sub Heading:</label>
                            <input type="text" name="fourthSubHeadingThree" value="<?php 

                                $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                                if (!$serverConnection->connect_error) {


                                    $sql = "SELECT  projectSubHeaderThree
                                            FROM    projects
                                            WHERE   projectID = 4
                                        ";

                                    // Connect the query to the server
                                    $requestedData      = mysqli_query($serverConnection, $sql);
                                    // Convert the retrieved array into a variable
                                    $retrievedArray     = mysqli_fetch_array($requestedData);
                                    // Collect the relevent data
                                    $subHeading   = $retrievedArray['projectSubHeaderThree'];

                                    $sql = "SELECT  projectSubExcerptThree
                                            FROM    projects
                                            WHERE   projectID = 4
                                        ";

                                    // Connect the query to the server
                                    $requestedData      = mysqli_query($serverConnection, $sql);
                                    // Convert the retrieved array into a variable
                                    $retrievedArray     = mysqli_fetch_array($requestedData);
                                    // Collect the relevent data
                                    $projectSubExcerpt   = $retrievedArray['projectSubExcerptThree'];

                                    echo $subHeading;
                                    unset($subHeading);
                                    
                                    $serverConnection->close();
                                }

                            ?>">

                            <label for="aboutParagraph" class="formTitle">Excerpt:</label>
                            <textarea type="textarea" name="fourthExcerptThree"><?php 

                                echo $projectSubExcerpt;
                                unset($projectSubExcerpt);

                            ?></textarea>

                            <label for="aboutParagraph" class="formTitle">Fourth Sub Heading:</label>
                            <input type="text" name="fourthSubHeadingFour" value="<?php 

                                $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                                if (!$serverConnection->connect_error) {


                                    $sql = "SELECT  projectSubHeaderFour
                                            FROM    projects
                                            WHERE   projectID = 4
                                        ";

                                    // Connect the query to the server
                                    $requestedData      = mysqli_query($serverConnection, $sql);
                                    // Convert the retrieved array into a variable
                                    $retrievedArray     = mysqli_fetch_array($requestedData);
                                    // Collect the relevent data
                                    $subHeading   = $retrievedArray['projectSubHeaderFour'];

                                    $sql = "SELECT  projectSubExcerptFour
                                            FROM    projects
                                            WHERE   projectID = 4
                                        ";

                                    // Connect the query to the server
                                    $requestedData      = mysqli_query($serverConnection, $sql);
                                    // Convert the retrieved array into a variable
                                    $retrievedArray     = mysqli_fetch_array($requestedData);
                                    // Collect the relevent data
                                    $projectSubExcerpt   = $retrievedArray['projectSubExcerptFour'];

                                    echo $subHeading;
                                    unset($subHeading);
                                    
                                    $serverConnection->close();
                                }

                            ?>">

                            <label for="aboutParagraph" class="formTitle">Excerpt:</label>
                            <textarea type="textarea" name="fourthExcerptFour" ><?php 

                                echo $projectSubExcerpt;
                                unset($projectSubExcerpt);

                            ?></textarea>

                        </div>
                    <div class="submit">
                        <button class="updateProject" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php 
        require_once('../modules/javascriptFiles.php');  
    ?>
</body>