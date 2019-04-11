<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shane Walders - Work</title>
    <?php
        require_once('modules/headerFiles.php');
    ?>
</head>
<body>
    <?php 
        require_once('modules/hamburgerMenu.php');
    ?>
    <div class="contentBody workPage">
        <div class="wrapper">
            <div class="intro"><?php 

                if(isset($_COOKIE["workTitle"]) ){

                    $temporaryTitle = $_COOKIE["workTitle"];
                    $temporaryTitle = str_replace($markdown, $markup, $temporaryTitle);

                    echo $temporaryTitle;

                } else{
                    $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);
                    if (!$serverConnection->connect_error) {
                        $sql = "SELECT  title
                                FROM    majorPages
                                WHERE   pageName = \"Work\"
                            ";

                        // Connect the query to the server
                        $requestedData      = mysqli_query($serverConnection, $sql);
                        // Convert the retrieved array into a variable
                        $retrievedArray     = mysqli_fetch_array($requestedData);
                        // Collect the relevent data
                        $titleContent       = $retrievedArray['title'];
                        // Apply the markup stylings to the the database text
                        $titleContent       = str_replace($markdown, $markup, $titleContent);

                        echo $titleContent;

                        $sql = "SELECT  paragraph
                                FROM    majorPages
                                WHERE   pageName = \"Work\"
                            ";

                        // Connect the query to the server
                        $requestedData      = mysqli_query($serverConnection, $sql);
                        // Convert the retrieved array into a variable
                        $retrievedArray     = mysqli_fetch_array($requestedData);
                        // Collect the relevent data
                        $excerptContent       = $retrievedArray['paragraph'];
                        // Apply the markup stylings to the the database text
                        $excerptContent       = str_replace($markdown, $markup, $excerptContent);

                        $serverConnection->close();
                    }
                }

            ?></div>
            <div class="paragraphContent"><?php 

                if(isset($_COOKIE["workExcerpt"]) ){

                    $temporaryExcerpt = $_COOKIE["workExcerpt"];
                    $temporaryExcerpt = str_replace($markdown, $markup, $temporaryExcerpt);

                    echo $temporaryExcerpt;
                } else{

                    echo $excerptContent;

                }

            ?></div>
            <div class="projects">
                <!-- Search and Social Geeks -->
                <?php
                    require_once("completedProjectCards/majorProjectOne.php");
                ?>
                <!-- Portfolio -->
                <?php
                    require_once("completedProjectCards/portfolioCard.php");
                ?>
                <!-- Compass -->
                <?php
                    require_once("completedProjectCards/compassCard.php");
                ?>
                <!-- Newsletter -->
                <?php
                    require_once("completedProjectCards/newsletterCard.php");
                ?>
            </div>
        </div>
    </div>
    <?php 
        require_once('modules/footer.php');   
        require_once('modules/javascriptFiles.php');  
    ?>
</body>
</html>