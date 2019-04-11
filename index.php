<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shane Walders</title>
    <?php
        require_once('modules/headerFiles.php');
    ?>
</head>
<body>

    <?php 
        require_once('modules/hamburgerMenu.php');
    ?>

    <div class="contentBody landingPage">
        <div class="wrapper">
            <!-- Home Title -->
            
                <div class="intro"><?php 
                    if(isset($_COOKIE["homeTitle"] ) ){
                        
                        $temporaryTitle = $_COOKIE["homeTitle"];
                        $temporaryTitle = str_replace($markdown, $markup, $temporaryTitle);

                        echo $temporaryTitle;

                    } else{
                        $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);
                        if (!$serverConnection->connect_error) {
                            $sql = "SELECT  title
                                    FROM    majorPages
                                    WHERE   pageName = \"Home\"
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

                            $sql = "SELECT  paragraph
                                    FROM    majorPages
                                    WHERE   pageName = \"Home\"
                                ";

                            // Connect the query to the server
                            $requestedData      = mysqli_query($serverConnection, $sql);
                            // Convert the retrieved array into a variable
                            $retrievedArray     = mysqli_fetch_array($requestedData);
                            // Collect the relevent data
                            $paragraphContent   = $retrievedArray['paragraph'];
                            // Apply the markup stylings to the the database text
                            $paragraphContent   = str_replace($markdown, $markup, $paragraphContent);

                            $serverConnection->close();
                        }
                    }
                ?></div>
                <div class="content" id="landingContent">
                    <div class="paragraphContent">
                        <!-- Home Paragraph -->
                            <?php 
                                if($_COOKIE["homeParagraph"]){
                                    
                                    $temporaryParagraph = $_COOKIE["homeParagraph"];
                                    $temporaryParagraph = str_replace($markdown, $markup, $temporaryParagraph);

                                    echo $temporaryParagraph;

                                } else{

                                    echo $paragraphContent; 
                                    
                                }
                            ?>
                    </div>

                    <div class="profileImage" id="resizeImage">
                        <img class="bottomCenterImage" src="images/frontEnd/shane-walders-childhood.jpg" alt="A photo of the young Shane Walders (Approximately 7 years old)">
                    </div>
                </div>
        </div>
    </div>


    <?php 
        require_once('modules/footer.php');   
        require_once('modules/javascriptFiles.php');  
    ?>

</body>
</html>


