<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shane Walders - Thank You</title>
    <?php
        require_once('modules/headerFiles.php');
    ?>
</head>
<body>
    <?php 
        require_once('modules/hamburgerMenu.php');   
    ?>

<div class="contentBody thankYouPage">
        <div class="wrapper">

    <?php
    // This is where we pull content from the precontact pages
        if(
    // Infromation from the precontent sessions
               isset($_SESSION['firstName'])
            && isset($_SESSION['lastName'])
            && isset($_SESSION['message'])             
            && isset($_SESSION['emailAddress'])

            && isset($_SESSION['thankYouImage'])
        
        ){
            // set the sessions into variables
            $firstName      = $_SESSION['firstName'];
            $lastName       = $_SESSION['lastName'];
            $usersEmail     = $_SESSION['emailAddress'];
            $image          = $_SESSION['thankYouImage'];

            $message        = $_SESSION["message"];

            $_SESSION["thankYouVerification"]     = "visited";

            ?>

             <div class="thankYou">
                <?php 
                    if(isset($_COOKIE["thankYouTitle"] ) ){

                        $temporaryTitle = $_COOKIE["thankYouTitle"];

                        $temporaryTitle = str_replace($markdown, $markup, $temporaryTitle);
                        // Then, if requested, inject the variable user data into the string
                        $temporaryTitle    = str_replace("*first name*",      "$firstName",  $temporaryTitle);
                        $temporaryTitle    = str_replace("*last name*",       "$lastName",   $temporaryTitle);
                        $temporaryTitle    = str_replace("*user email*",      "$usersEmail",  $temporaryTitle);
                        $temporaryTitle    = str_replace("*contact message*", "$message",    $temporaryTitle);

                        echo $temporaryTitle;

                    } else{
                        $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);
                        if (!$serverConnection->connect_error) {
                            $sql = "SELECT  title
                                    FROM    majorPages
                                    WHERE   pageName = \"ThankYou\"
                                ";

                            // Connect the query to the server
                            $requestedData  = mysqli_query($serverConnection, $sql);
                            // Convert the retrieved array into a variable
                            $retrievedArray = mysqli_fetch_array($requestedData);
                            // Collect the relevent data
                            $titleContent   = $retrievedArray['title'];
                            // Apply the markup stylings to the the database text

                            $titleContent    = str_replace($markdown, $markup, $titleContent);
                            $titleContent    = str_replace("*first name*",      "$firstName", $titleContent);
                            $titleContent    = str_replace("*last name*",       "$lastName",   $titleContent);
                            $titleContent    = str_replace("*user email*",      "$usersEmail",  $titleContent);
                            $titleContent    = str_replace("*contact message*", "$message",    $titleContent);

                            echo $titleContent;
                            $serverConnection->close();
                        }
                    }
                ?>
             </div>

            <div class="content">
                <div class="paragraphContent" id="referenceContent">
                    <?php 
                        if(isset($_COOKIE["thankYouExcerpt"] ) ){

                            $temporaryExcerpt = $_COOKIE["thankYouExcerpt"];

                            $temporaryExcerpt    = str_replace($markdown, $markup, $temporaryExcerpt);
                            // Then, if requested, inject the variable user data into the string
                            $temporaryExcerpt    = str_replace("*first name*",      "$firstName",  $temporaryExcerpt);
                            $temporaryExcerpt    = str_replace("*last name*",       "$lastName",   $temporaryExcerpt);
                            $temporaryExcerpt    = str_replace("*user email*",      "$usersEmail",  $temporaryExcerpt);
                            $temporaryExcerpt    = str_replace("*contact message*", "$message",    $temporaryExcerpt);
                            

                            echo $temporaryExcerpt;

                        } else{
                            $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);
                            if (!$serverConnection->connect_error) {
                                $sql = "SELECT  paragraph
                                        FROM    majorPages
                                        WHERE   pageName = \"ThankYou\"
                                    ";

                                // Connect the query to the server
                                $requestedData     = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray    = mysqli_fetch_array($requestedData);
                                // Collect the relevent data
                                $excerptContent    = $retrievedArray['paragraph'];
                                // Apply the markup stylings to the the database text

                                $excerptContent    = str_replace($markdown, $markup, $excerptContent);
                                $excerptContent    = str_replace("*first name*",      "$firstName", $excerptContent);
                                $excerptContent    = str_replace("*last name*",       "$lastName",   $excerptContent);
                                $excerptContent    = str_replace("*user email*",      "$usersEmail",  $excerptContent);
                                $excerptContent    = str_replace("*contact message*", "$message",    $excerptContent);

                                echo $excerptContent;
                                $serverConnection->close();
                            }
                        }
                    ?>
                </div>   
                <div class="echoImage" id="resizeImage">
                    <img src=images/frontEnd/isaac-van-amburgh-and-his-animals.jpg alt="An oil ainting by Edwin Landseer, titled 'Isaac Van Amburgh and His Animals'">
                </div>
            </div>

            <?php 


                $yourEmail = $email;
        
                $contactHeader      = "Form submission - shanewalders.com";
                $confirmationHeader = "Shane Walders: A Copy of your Form Submission";
        
                $contactMessage = $firstName . " " . $lastName . " has submitted your contact form! They wrote the following message:" . "\n\n" . $message;
        
                $confirmationMessage = "Hello, $firstName! Thank you for submitting my contact form. Here is a copy of the message that you sent: " . "\n\n" . $message;
        
                $sentFromUser = "From:" . $usersEmail;
                $sentFromYou = "From:" . $yourEmail;
        
                // Follow this formula: 
        
                    //Who is it sending to?
                    //Who was it sent from?
                    //What is the subject line? 
                    //What does the message say?
        
                mail($yourEmail,$contactHeader,$contactMessage,$sentFromUser);
                mail($usersEmail,$confirmationHeader,$confirmationMessage,$sentFromYou); 

                $serverConnection = mysqli_connect($serverIP, $username, $password, $databaseName);
                    if (!$serverConnection) {
                        echo "Error: Unable to connect to MySQL." . PHP_EOL;
                        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
                        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
                        exit;
                    }
                // Here we use mysqli_real_escape_string() to sanitize the variables for database processing. Otherwise, the data will not be processed.
                $firstName      = mysqli_real_escape_string($serverConnection, $firstName);
                $lastName       = mysqli_real_escape_string($serverConnection, $lastName);
                $usersEmail     = mysqli_real_escape_string($serverConnection, $usersEmail);
                $message        = mysqli_real_escape_string($serverConnection, $message);

                // Now, store the message and senders information into the database. This way, we may review our messages from within the backend admin center
                $formSubmission = "INSERT INTO formSubmissions (fName , lName, emailAddress, contactMessage) VALUES ( \"$firstName\", \"$lastName\", \"$usersEmail\", \"$message\");";

                $serverConnection->close();

            ?>

            <?php
        }else{
            header("location: precontact.php");
            die();
        }
        ?> 

    </div> <!-- End of wrapper -->
</div> <!-- End of thankYouPage -->
    <?php 
        require_once('modules/footer.php');   
        require_once('modules/javascriptFiles.php');  
    ?>
</body>
