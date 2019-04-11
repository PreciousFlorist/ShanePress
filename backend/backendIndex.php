<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shane Walders - Admin Index</title>
    <?php
        require_once('../modules/headerFiles.php');
    ?>
</head>
<body>

    <?php 
        require_once('../modules/backendHamburgerMenu.php');
        require_once("backendTimer.php");   
    ?>
       
    <div class="contentBody backendIndex">
        <div class="wrapper">
            <div class="homeTitle">
            <!-- Welcome to the admin, -->
            
            <?php 
                    if(isset($_COOKIE["adminIndexTitle"] ) ){

                        $temporaryTitle = $_COOKIE["adminIndexTitle"];
                        $temporaryTitle = str_replace($markdown, $markup, $temporaryTitle);

                        echo $temporaryTitle;

                    } else{
                        $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);
                        if (!$serverConnection->connect_error) {
                            $sql = "SELECT  title
                                    FROM    majorPages
                                    WHERE   pageName = \"AdminIndex\"
                                ";

                            // Connect the query to the server
                            $requestedData  = mysqli_query($serverConnection, $sql);
                            // Convert the retrieved array into a variable
                            $retrievedArray = mysqli_fetch_array($requestedData);
                            // Collect the relevent data
                            $titleContent   = $retrievedArray['title'];
                            // Apply the markup stylings to the the database text
                            $titleContent   = str_replace($markdown, $markup, $titleContent);

                            echo $titleContent;
                            $serverConnection->close();
                        }
                    }
                ?>
            </div>
            <div class="content">
                <div class="paragraphContent">
                    <?php 
                        if(isset($_COOKIE["adminIndexParagraph"] ) ){

                            $temporaryParagraph = $_COOKIE["adminIndexParagraph"];
                            $temporaryParagraph = str_replace($markdown, $markup, $temporaryParagraph);

                            echo $temporaryParagraph;

                        } else{
                            $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);
                            if (!$serverConnection->connect_error) {
                                $sql = "SELECT  paragraph
                                        FROM    majorPages
                                        WHERE   pageName = \"AdminIndex\"
                                    ";

                                // Connect the query to the server
                                $requestedData  = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray = mysqli_fetch_array($requestedData);
                                // Collect the relevent data
                                $paragraphContent   = $retrievedArray['paragraph'];
                                // Apply the markup stylings to the the database text
                                $paragraphContent   = str_replace($markdown, $markup, $paragraphContent);

                                echo $paragraphContent;
                                $serverConnection->close();
                            }
                        }
                    ?>
                </div>

                <div class="backendImage">
                    <img src="../images/backEnd/the-unicorn-in-captivity.jpg" alt="">
                </div>

            <div>
        </div>
    </div>
    
    <?php  
        require_once('../modules/javascriptFiles.php');  
    ?>

</body>
</html>

