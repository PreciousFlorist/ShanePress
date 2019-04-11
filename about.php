<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shane Walders - About</title>
    <?php
        require_once('modules/headerFiles.php');
    ?>
</head>
<body>
    <?php 
        require_once('modules/hamburgerMenu.php');
    ?>
    <div class="contentBody aboutPage">
        <div class="wrapper">
            <div class="intro"><?php 
            
                if(isset($_COOKIE["aboutTitle"] ) ){

                    $temporaryTitle = $_COOKIE["aboutTitle"];
                    $temporaryTitle = str_replace($markdown, $markup, $temporaryTitle);

                    echo $temporaryTitle;

                } else{
                    $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);
                    if (!$serverConnection->connect_error) {
                        $sql = "SELECT  title
                                FROM    majorPages
                                WHERE   pageName = \"About\"
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
                                WHERE   pageName = \"About\"
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
        <!-- About Image -->
            <div class="content" id="aboutContent">
                <div class="aboutImage">
                    <img class="bottomCenterImage" src="images/frontEnd/witches-flight.gif" alt="Francesco Goyas famous oil painting 'Witches Flight'">
                </div>
                <div class="paragraphContent" >
        <!-- About Paragraph -->
                    <?php 

                        if($_COOKIE["aboutParagraph"]){
                                                            
                            $temporaryParagraph = $_COOKIE["aboutParagraph"];
                            $temporaryParagraph = str_replace($markdown, $markup, $temporaryParagraph);
        
                            echo $temporaryParagraph;

                        } else{

                            echo $paragraphContent;
                            
                        }
                    ?>
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