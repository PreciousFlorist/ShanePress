<div class="workCard">
    <a href="projectProfiles/newsletterSubscription.php" class="projectTitle">
        <div class="workImage minorImage">
            <img class="newsletterImage" src="../images/newsletter/newsletter-subscription-form.png" alt="">
            <div class="cardContent">
                <p><?php 
                    
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
                        
                        $projectTitle   = str_replace($markdown, $markup, $projectTitle);
                        echo $projectTitle;

                        $sql = "SELECT  `projectSymbolSVGOne`,
                                        `projectSymbolSVGTwo`,
                                        `projectSymbolSVGThree`
                            
                                FROM    `projects`
                                WHERE   `projectID`= 4
                            ";

                        // Connect the query to the server
                        $requestedData      = mysqli_query($serverConnection, $sql);
                        // Convert the retrieved array into a variable
                        $retrievedArray     = mysqli_fetch_array($requestedData);

                        $serverConnection->close();
                    }

                ?></p>
                <ul class="tools"><?php 
        
                        foreach($retrievedArray as $i => $projectSymbolSVG){
                            // This loop will repeat all content twice, so I have added a catch 
                            // "antiDuplicateCatch" to weed out any duplicates that may arise.
                            if(isset($projectSymbolSVG) && $projectSymbolSVG !== $antiDuplicateCatch){

                                $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
                                $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");

                                $projectSymbolSVG   = str_replace($svgMarkUp, $svgMarkdown, $projectSymbolSVG);
                                $svg                = html_entity_decode($projectSymbolSVG);

                                echo "<li>" . $svg . "</li>";

                                $antiDuplicateCatch   = str_replace($svgMarkdown, $svgMarkUp, $projectSymbolSVG);
                            }
                        }
                        
                ?>
            </div>
        </div>
    </a>
</div>
