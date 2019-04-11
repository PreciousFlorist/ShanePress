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
    <title>Shane Walders - Edit Frontend Navigation</title>
</head>
<body>
    <?php 
        require_once('../modules/backendHamburgerMenu.php');
        require_once("../backend/backendTimer.php");    
    ?>

    <div class="contentBody editBackend editProjects">
        <div class="wrapper"> 

                <h1>Edit the Navigation Menu</h1>
                <?php require("../modules/formattingHelpAccordion.php"); ?>
                <form target="_blank" method="POST" action="validationModules/editValidation.php" class="formGroup">
                <!-- Title -->
                    <div class="navEditor">

                        <label for="firstLink" class="formTitle">First Link:</label>
                        <input type="text" id="firstLink" class="svg" name="firstLink" value="<?php 

                            $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                            if (!$serverConnection->connect_error) {

                                $sql = "SELECT `linkValue` 
                                        FROM `navigation` 
                                        WHERE `type`= \"home\"; 
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data
                                $titlePlaceholder   = $retrievedArray['linkValue'];

                                echo "$titlePlaceholder";
                                $serverConnection->close();
                            }

                        ?>">


                        <label for="secondLink" class="formTitle">Second Link:</label>
                        <input type="text" id="secondLink" class="svg" name="secondLink" value="<?php 

                            $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                            if (!$serverConnection->connect_error) {

                                $sql = "SELECT `linkValue` 
                                        FROM `navigation` 
                                        WHERE `type`= \"linkOne\"; 
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data
                                $titlePlaceholder   = $retrievedArray['linkValue'];

                                echo "$titlePlaceholder";
                                $serverConnection->close();
                            }

                        ?>">

                        <label for="thirdLink" class="formTitle">Third Link:</label>
                        <input type="text" id="thirdLink" class="svg" name="thirdLink" value="<?php 

                            $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                            if (!$serverConnection->connect_error) {

                                $sql = "SELECT `linkValue` 
                                        FROM `navigation` 
                                        WHERE `type`= \"linkTwo\"; 
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data
                                $titlePlaceholder   = $retrievedArray['linkValue'];

                                echo "$titlePlaceholder";
                                $serverConnection->close();
                            }

                        ?>">

                        <label for="fourthLink" class="formTitle">Fourth Link:</label>
                        <input type="text" id="fourthLink" class="svg" name="fourthLink" value="<?php 

                            $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                            if (!$serverConnection->connect_error) {

                                $sql = "SELECT `linkValue` 
                                        FROM `navigation` 
                                        WHERE `type`= \"linkThree\"; 
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data
                                $titlePlaceholder   = $retrievedArray['linkValue'];

                                echo "$titlePlaceholder";
                                $serverConnection->close();
                            }

                        ?>">

                        <label for="socialMediaOne" class="formTitle">Social Media Link:</label>
                        <input type="text" id="socialMediaOne" class="svg" name="socialMediaOne" value="<?php 

                            $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                            if (!$serverConnection->connect_error) {

                                $sql = "SELECT `linkValue` 
                                        FROM `navigation` 
                                        WHERE `type`= \"socialMediaOne\"; 
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data
                                $titlePlaceholder   = $retrievedArray['linkValue'];

                                echo "$titlePlaceholder";
                                $serverConnection->close();
                            }

                        ?>">

                        <label for="socialMediaTwo" class="formTitle">Social Media Link:</label>
                        <input type="text" id="socialMediaTwo" class="svg" name="socialMediaTwo" value="<?php 

                            $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                            if (!$serverConnection->connect_error) {

                                $sql = "SELECT `linkValue` 
                                        FROM `navigation` 
                                        WHERE `type`= \"socialMediaTwo\"; 
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data
                                $titlePlaceholder   = $retrievedArray['linkValue'];

                                echo "$titlePlaceholder";
                                $serverConnection->close();
                            }

                        ?>">

                        <label for="socialMediaThree" class="formTitle">Social Media Link:</label>
                        <input type="text" id="socialMediaThree" class="svg" name="socialMediaThree" value="<?php 

                            $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                            if (!$serverConnection->connect_error) {

                                $sql = "SELECT `linkValue` 
                                        FROM `navigation` 
                                        WHERE `type`= \"socialMediaThree\"; 
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data
                                $titlePlaceholder   = $retrievedArray['linkValue'];

                                echo "$titlePlaceholder";
                                $serverConnection->close();
                            }

                        ?>">

                        <label for="emailAddress" class="formTitle">Email Address:</label>
                        <input type="text" id="emailAddress" class="svg" name="emailAddress" value="<?php 

                            $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                            if (!$serverConnection->connect_error) {

                                $sql = "SELECT `linkValue` 
                                        FROM `navigation` 
                                        WHERE `type`= \"email\"; 
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data
                                $titlePlaceholder   = $retrievedArray['linkValue'];

                                echo "$titlePlaceholder";
                                $serverConnection->close();
                            }

                        ?>">
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