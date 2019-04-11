<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shane Walders - Edit Home</title>
    <?php
        require_once('../modules/headerFiles.php');
    ?>
</head>
<body>
    <?php 
        require_once('../modules/backendHamburgerMenu.php');
        require_once("../backend/backendTimer.php");    
    ?>

    <div class="contentBody editBackend editProjects">
        <div class="wrapper"> 

                <h1>Edit the Home Page</h1>

                <?php require("../modules/formattingHelpAccordion.php"); ?>
                <form target="_blank" method="POST" action="validationModules/editValidation.php" class="formGroup">
                <!-- Title -->
                    <div>

                        <label for="homeTitle" class="formTitle">Title:</label>
                        <input type="text" id="homeTitle" name="homeTitle" value="<?php 

                            $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                            if (!$serverConnection->connect_error) {

                                $sql = "SELECT  title
                                        FROM    majorPages
                                        WHERE   pageName = \"Home\"
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data
                                $titlePlaceholder   = $retrievedArray['title'];

                                $sql = "SELECT  paragraph
                                        FROM    majorPages
                                        WHERE   pageName = \"Home\"
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data
                                $paragraphPlaceholder   = $retrievedArray['paragraph'];

                                echo $titlePlaceholder;
                                $serverConnection->close();
                            }

                        ?>">

                        <label for="homeParagraph" class="formTitle">Paragraph:</label>
                        <textarea type="textarea" id="homeParagraph" name="homeParagraph"><?php 

                            echo $paragraphPlaceholder;

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