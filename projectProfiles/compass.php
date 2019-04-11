<?php
    require_once('../modules/headerFiles.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shane Walders - <?php 
            
            $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

            if (!$serverConnection->connect_error) {
    
    
                $sql = "SELECT  projectTitle
                        FROM    projects
                        WHERE   projectID = \"1\"
                    ";
    
            // Connect the query to the server
                $requestedData      = mysqli_query($serverConnection, $sql);
            // Convert the retrieved array into a variable
                $retrievedArray     = mysqli_fetch_array($requestedData, MYSQLI_ASSOC);
            // Collect the relevent data
                $projectTitle   = $retrievedArray['projectTitle'];
    
                echo $projectTitle;
                $serverConnection->close();
            }

    ?></title>
</head>
<body>

    <?php 
        require_once('../modules/hamburgerMenu.php');   
    ?>

    <div class="projectBody searchAndSocialGeeks">
        <div class="projectCard">
            <div class="intro"><h1><?php 
            
            $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

            if (!$serverConnection->connect_error) {
    
    
                $sql = "SELECT  projectTitle
                        FROM    projects
                        WHERE   projectID = 1
                    ";
    
            // Connect the query to the server
                $requestedData      = mysqli_query($serverConnection, $sql);
            // Convert the retrieved array into a variable
                $retrievedArray     = mysqli_fetch_array($requestedData, MYSQLI_ASSOC);
            // Collect the relevent data
                $projectTitle   = $retrievedArray['projectTitle'];
                
                $projectTitle   = str_replace($markdown, $markup, $projectTitle);
                echo $projectTitle;
                $serverConnection->close();
            }

            ?></h1></div>
            <div><?php 

                $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                if (!$serverConnection->connect_error) {

                    $sql = "SELECT  projectIntroParagraph
                            FROM    projects
                            WHERE   projectID = 1
                        ";

                // Connect the query to the server
                    $requestedData      = mysqli_query($serverConnection, $sql);
                // Convert the retrieved array into a variable
                    $retrievedArray     = mysqli_fetch_array($requestedData, MYSQLI_ASSOC);
                // Collect the relevent data
                    $projectIntroParagraph   = $retrievedArray['projectIntroParagraph'];
                    $projectIntroParagraph   = str_replace($markdown, $markup, $projectIntroParagraph);

                    echo $projectIntroParagraph;
                    $serverConnection->close();
                }

            ?></div>
            <div class="heroImage completedImage">
                <img class="centerImage" src="../images/sasg/sasg-whiteboard.JPG" alt="">
            </div>

            <ul class="tools">
                <?php 
                    $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                    if (!$serverConnection->connect_error) {


                        $sql = "SELECT  `projectSymbolSVGOne`,
                                        `projectSymbolSVGTwo`,
                                        `projectSymbolSVGThree`,
                                        `projectSymbolSVGFour`,
                                        `projectSymbolSVGFive`
                               
                                FROM    `projects`
                                WHERE   `projectID`= 3
                            ";

                        // Connect the query to the server
                        $requestedData      = mysqli_query($serverConnection, $sql);
                        // Convert the retrieved array into a variable
                        $retrievedArray     = mysqli_fetch_array($requestedData, MYSQLI_ASSOC);
                        // Collect the relevent data

                        foreach($retrievedArray as $i => $projectSymbolSVG){
                            if(isset($projectSymbolSVG)){

                                $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
                                $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");

                                $projectSymbolSVG   = str_replace($svgMarkUp, $svgMarkdown, $projectSymbolSVG);
                                $svg                = html_entity_decode($projectSymbolSVG);

                                echo "<li>" . $svg . "</li>";

                            }
                        }
                    }
                        
                    $serverConnection->close();      
                ?>

            </ul>


            <div class="subHeroImage completedImage">
                <img class="centerImage" src="../images/sasg/sasg-media-wireframe.png" alt="">
            </div>

            <div class="design">
            <?php 
                    $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                    if (!$serverConnection->connect_error) {

                        $sql = "SELECT  `projectSubHeaderOne`,
                                        `projectSubExcerptOne`
                               
                                FROM    `projects`
                                WHERE   `projectID`= 3
                            ";

                        // Connect the query to the server
                        $requestedData      = mysqli_query($serverConnection, $sql);
                        // Convert the retrieved array into a variable
                        $retrievedArray     = mysqli_fetch_array($requestedData, MYSQLI_ASSOC);
                        // Collect the relevent data

                        foreach($retrievedArray as $projectExcerpt){
                            if(isset($projectExcerpt) ){

                                $projectExcerpt     = str_replace($markdown, $markup, $projectExcerpt);
                                $projectExcerpt     = html_entity_decode($projectExcerpt);

                                echo $projectExcerpt;

                            }
                        }
                    }
                        
                    $serverConnection->close();      
                ?> 
                
                               
                <div class="minorCards">
                    <div class="galleryImage completedImage">
                        <img  class="centerImage" src="../images/sasg/sasg-header-php.png" alt="">
                    </div>
                </div>
            </div>
            
            <div class="development">
            <?php 
                    $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                    if (!$serverConnection->connect_error) {

                        $sql = "SELECT  `projectSubHeaderTwo`,
                                        `projectSubExcerptTwo`
                               
                                FROM    `projects`
                                WHERE   `projectID`= 3
                            ";

                        // Connect the query to the server
                        $requestedData      = mysqli_query($serverConnection, $sql);
                        // Convert the retrieved array into a variable
                        $retrievedArray     = mysqli_fetch_array($requestedData, MYSQLI_ASSOC);

                        foreach($retrievedArray as $projectExcerpt){

                            if(isset($projectExcerpt) ){

                                $projectExcerpt     = str_replace($markdown, $markup, $projectExcerpt);
                                $projectExcerpt     = html_entity_decode($projectExcerpt);

                                echo $projectExcerpt;

                            }
                        }
                    }
                        
                    $serverConnection->close();      
                ?>
                <div class="minorCards">
                    <div class="galleryImage completedImage">
                        <img class="centerLeftImage" src="../images/sasg/sasg-sass.png" alt="">
                    </div>
                </div>
            </div>

            <div class="launch">
            <?php 
                    $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                    if (!$serverConnection->connect_error) {

                        $sql = "SELECT  `projectSubHeaderThree`,
                                        `projectSubExcerptThree`
                               
                                FROM    `projects`
                                WHERE   `projectID`= 3
                            ";

                        // Connect the query to the server
                        $requestedData      = mysqli_query($serverConnection, $sql);
                        // Convert the retrieved array into a variable
                        $retrievedArray     = mysqli_fetch_array($requestedData, MYSQLI_ASSOC);
                        // Collect the relevent data

                        foreach($retrievedArray as $projectExcerpt){
                            if(isset($projectExcerpt) ){
                                $projectExcerpt     = str_replace($markdown, $markup, $projectExcerpt);
                                $projectExcerpt     = html_entity_decode($projectExcerpt);

                                echo $projectExcerpt;
                            }
                        }
                    }
                        
                    $serverConnection->close();      
                ?>                
                <div class="minorCards">
                    <div class="galleryImage completedImage">
                        <img class="centerImage" src="../images/sasg/sasg-footer.png" alt="">
                    </div>
                </div>
            </div>

            <?php 
                    $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                    if (!$serverConnection->connect_error) {

                        $sql = "SELECT  `projectSubHeaderFour`,
                                        `projectSubExcerptFour`
                               
                                FROM    `projects`
                                WHERE   `projectID`= 3
                            ";

                        // Connect the query to the server
                        $requestedData      = mysqli_query($serverConnection, $sql);
                        // Convert the retrieved array into a variable
                        $retrievedArray     = mysqli_fetch_array($requestedData, MYSQLI_ASSOC);
                        // Collect the relevent data

                        foreach($retrievedArray as $projectExcerpt){
                            if(isset($projectExcerpt) ){

                                $projectExcerpt     = str_replace($markdown, $markup, $projectExcerpt);
                                $projectExcerpt     = html_entity_decode($projectExcerpt);

                                echo $projectExcerpt;

                            }
                        }
                    }
                        
                    $serverConnection->close();      
                ?>
        </div>

    </div>

    <?php 
        require_once('../modules/footer.php');   
        require_once('../modules/javascriptFiles.php');  
    ?>

</body>
</html>

