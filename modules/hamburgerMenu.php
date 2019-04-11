<div class="navWrapper">
    <nav>

        <h1 class="nameTitle">
            <a href="https://shanewalders.com/index.php">
            
            <?php 
                            
                $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                if (!$serverConnection->connect_error) {

                    $sql = "SELECT `linkValue` 
                            FROM `navigation` 
                            WHERE `type`= \"home\" 
                        ";

                    // Connect the query to the server
                    $requestedData      = mysqli_query($serverConnection, $sql);
                    // Convert the retrieved array into a variable
                    $retrievedArray     = mysqli_fetch_array($requestedData);
                    // Collect the relevent data

                    $retrievedArray = $retrievedArray['linkValue'];

                    $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
                    $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");

                    $retrievedArray = str_replace($svgMarkdown, $svgMarkUp, $retrievedArray);
                    $retrievedArray   = str_replace($markdown, $markup, $retrievedArray);
                    $retrievedArray = html_entity_decode($retrievedArray);

                    echo $retrievedArray;
                }
            ?> 
            
            <span class="screen-reader-text">A link to the websites home page</span></a>
        </h1>

        <div class="hamburger" onclick="hamburgerCross(this)">
            <button class="fas fa-plus"><span class="screen-reader-text">This is a drop down menu button</span></button>

            <div class="navOverlay">
                <div class="navWrapper">

                    <ul class="general">

                        <?php 
                            
                            $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                            if (!$serverConnection->connect_error) {

                                $sql = "SELECT `linkValue` 
                                        FROM `navigation` 
                                        WHERE `type`= \"linkOne\" 
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data

                                $retrievedArray = $retrievedArray['linkValue'];

                                $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
                                $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");

                                $retrievedArray = str_replace($svgMarkdown, $svgMarkUp, $retrievedArray);
                                $retrievedArray   = str_replace($markdown, $markup, $retrievedArray);
                                $retrievedArray = html_entity_decode($retrievedArray);

                                echo "<li>" . $retrievedArray . "</li>";

                                $sql = "SELECT `linkValue` 
                                        FROM `navigation` 
                                        WHERE `type`= \"linkTwo\" 
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data

                                $retrievedArray = $retrievedArray['linkValue'];

                                $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
                                $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");

                                $retrievedArray = str_replace($svgMarkdown, $svgMarkUp, $retrievedArray);
                                $retrievedArray   = str_replace($markdown, $markup, $retrievedArray);
                                $retrievedArray = html_entity_decode($retrievedArray);

                                echo "<li>" . $retrievedArray . "</li>";
                                        $sql = "SELECT `linkValue` 
                                                FROM `navigation` 
                                                WHERE `type`= \"linkThree\" 
                                            ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data

                                $retrievedArray = $retrievedArray['linkValue'];

                                $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
                                $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");

                                $retrievedArray = str_replace($svgMarkdown, $svgMarkUp, $retrievedArray);
                                $retrievedArray   = str_replace($markdown, $markup, $retrievedArray);
                                $retrievedArray = html_entity_decode($retrievedArray);

                                echo "<li>" . $retrievedArray . "</li>";

                            } 
                        ?>
                    </ul>

                    <ul class="social">
                    <?php 
                            
                            $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                            if (!$serverConnection->connect_error) {

                                $sql = "SELECT `linkValue` 
                                        FROM `navigation` 
                                        WHERE `type`= \"socialMediaOne\" 
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data

                                $retrievedArray = $retrievedArray['linkValue'];



                                $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
                                $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");

                                $retrievedArray   = str_replace($svgMarkUp, $svgMarkdown, $retrievedArray);
                                $retrievedArray   = str_replace($markdown, $markup, $retrievedArray);

                                $firstIcon   = html_entity_decode($retrievedArray);


                                echo "<li>" . $firstIcon . "</li>";

                                $sql = "SELECT `linkValue` 
                                        FROM `navigation` 
                                        WHERE `type`= \"socialMediaTwo\" 
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data

                                $retrievedArray = $retrievedArray['linkValue'];



                                $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
                                $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");

                                $retrievedArray   = str_replace($svgMarkUp, $svgMarkdown, $retrievedArray);
                                $retrievedArray   = str_replace($markdown, $markup, $retrievedArray);

                                $secondIcon   = html_entity_decode($retrievedArray);


                                echo "<li>" . $secondIcon . "</li>";

                                $sql = "SELECT `linkValue` 
                                        FROM `navigation` 
                                        WHERE `type`= \"socialMediaThree\" 
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data

                                $retrievedArray = $retrievedArray['linkValue'];



                                $svgMarkdown    = array("<svg", "><path", "/></svg>", "<i class=", "></i>");
                                $svgMarkUp      = array("$%10%$", "#1$1#", "$%01%$", "&*#", "#*&");

                                $retrievedArray   = str_replace($svgMarkUp, $svgMarkdown, $retrievedArray);
                                $retrievedArray   = str_replace($markdown, $markup, $retrievedArray);

                                $thirdIcon   = html_entity_decode($retrievedArray);


                                echo "<li>" . $thirdIcon . "</li>";

                            } 
                        ?>
                    </ul>

                    <ul class="contact">
                        <li>
                            <a href="mailto:<?php 

                        $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);
                        if (!$serverConnection->connect_error) {
                            $sql = "SELECT linkValue 
                                    FROM navigation 
                                    WHERE type = \"email\";
                            ";

                            // Connect the query to the server
                            $requestedData  = mysqli_query($serverConnection, $sql);
                            // Convert the retrieved array into a variable
                            $retrievedArray = mysqli_fetch_array($requestedData);
                            // Collect the relevent data
                            $email   = $retrievedArray['linkValue'];
                            // Apply the markup stylings to the the database text
                            $email   = str_replace($markdown, $markup, $email);

                            echo $email;
                            $serverConnection->close();
                        }

                ?>"><?php echo $email; 
                $serverConnection->close();  ?></a>
                        <li>
                    </ul>

                </div> 
            </div>
        </div> 
    </nav>
</div>
