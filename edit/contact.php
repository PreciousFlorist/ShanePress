<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shane Walders - Edit Work</title>
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
            <h1>Edit the Contact Page</h1>
            <?php require("../modules/formattingHelpAccordion.php"); ?>
            <form target="_blank" method="POST" action="validationModules/editValidation.php" class="formGroup">
            <!-- Title -->

                <label for="contactTitle" class="formTitle">Title:</label>
                <input type="text" id="contactTitle" name="contactTitle" value="<?php 

                    $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                    if (!$serverConnection->connect_error) {

                        $sql = "SELECT  title
                                FROM    majorPages
                                WHERE   pageName = \"Contact\"
                            ";

                        // Connect the query to the server
                        $requestedData      = mysqli_query($serverConnection, $sql);
                        // Convert the retrieved array into a variable
                        $retrievedArray     = mysqli_fetch_array($requestedData);
                        // Collect the relevent data
                        $titlePlaceholder   = $retrievedArray['title'];

                        $sql = "SELECT  paragraph
                                FROM    majorPages
                                WHERE   pageName = \"Contact\"
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

                <label for="contactExcerpt" class="formTitle">Paragraph:</label>
                <textarea type="textarea" id="contactExcerpt" name="contactExcerpt"><?php 

                    echo $paragraphPlaceholder;

                ?></textarea>

                <div class="secondHeader"><br/><br/><br/>
                    <h1>Edit the Thank You Page</h1>
                    <?php require("../modules/formattingHelpAccordion.php"); ?>
                </div>

                <label for="thankYouTitle" class="formTitle">Title:</label>
                <input type="text" id="thankYouTitle" name="thankYouTitle" value="<?php 

                    $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                    if (!$serverConnection->connect_error) {

                        $sql = "SELECT  title
                                FROM    majorPages
                                WHERE   pageName = \"ThankYou\"
                        ";


                        // Connect the query to the server
                        $requestedData      = mysqli_query($serverConnection, $sql);
                        // Convert the retrieved array into a variable
                        $retrievedArray     = mysqli_fetch_array($requestedData);
                        // Collect the relevent data
                        $titlePlaceholder   = $retrievedArray['title'];

                        $sql = "SELECT  paragraph
                                FROM    majorPages
                                WHERE   pageName = \"ThankYou\"
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

                <label for="thankYouExcerpt" class="formTitle">Paragraph:</label>
                <textarea type="textarea" id="thankYouExcerpt" name="thankYouExcerpt"><?php 

                    echo $paragraphPlaceholder;

                ?></textarea>
           
                <div class="submit">
                    <button class="updateProject" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
    <?php 
        require_once('../modules/javascriptFiles.php');  
    ?>
</body>
