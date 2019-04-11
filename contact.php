<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shane Walders - Contact</title>
    <?php
        require_once('modules/headerFiles.php');
    ?>
</head>
<body>
    <?php 
        require_once('modules/hamburgerMenu.php');   
    ?>

    <div class="contentBody contactPage">
        <div class="wrapper">

    <?php
    // If the user has already submit the contact form, route them back to the "Thank-You" page
        if(isset($_SESSION["thankYouVerification"])
        && $_SESSION["thankYouVerification"] == "visited"  ){
       
            header("location: thank-you.php");
            die();

        }

    // If the user is not visiting this page from the "Precontact" page, route them back to the Precontact page
        elseif(empty($_SESSION["precontact"])
        || $_SESSION["precontact"] !== "visited"  ){
       
            header("location: precontact.php");
            die();

        }
    // This is where we pull content from the precontact pages
        elseif(

        // Infromation from the precontent sessions
              isset($_SESSION['contactHeader'])
           && isset($_SESSION['contactContent'])
           && isset($_SESSION['contactImage'])
        
        ){

        // Set the sessions to variables
            $contactHeader  = $_SESSION['contactHeader'];
            $contactContent = $_SESSION['contactContent'];
            $contactImage   = $_SESSION['contactImage'];

                    ?> <div class="intro">
                        <?php 
                                $contactTitle = $_SESSION["contactHeader"];
                                $contactTitle = str_replace($markdown, $markup, $contactTitle);

                                echo $contactTitle;

                        ?>
                    </div>
 
                    <div class="paragraphContent" id="contactParagraph">
                        <?php
                                $contactContent = $_SESSION["contactContent"];
                                $contactContent = str_replace($markdown, $markup, $contactContent);

                                echo $contactContent;
                        ?> 
                    </div>
            
                    <div class="content">
                        <div class="contactImage" id="resizeImage">
                            <?php echo $contactImage; ?>
                        </div>
            <?php

        // Unset all sessions
            unset($_SESSION['contactHeader']);
            unset($_SESSION['contactContent']);
            unset($_SESSION['contactImage']);
            unset($_SESSION['precontact']); 
        }


        // This is where we pull content from the error pages
            if(

        // Infromation from the error sessions
               isset($_SESSION['errorHeader'])
            && isset($_SESSION['errorContent'])
            && isset($_SESSION['errorImage'])  
            ){

                if(
                   isset($_SESSION['incorrectFirstNameError'])
                || isset($_SESSION['invalidFirstNameError'])

                || isset($_SESSION['incorrectLastNameError'])
                || isset($_SESSION['invalidLastNameError'])

                || isset($_SESSION["incorrectEmailError"])
                || isset($_SESSION['invalidEmailError'])

                || isset($_SESSION['messageError'])
                ){

            // First name error placeholders
                if(isset($_SESSION["incorrectFirstNameError"]) ){
                    $incorrectFirstNamePlaceholder  = $_SESSION['incorrectFirstNameError'];
                    }
                    if(isset($_SESSION["invalidFirstNameError"]) ){
                    $invalidFirstNamePlaceholder    = $_SESSION['invalidFirstNameError'];
                    }

            // Last name error placeholders
                if(isset($_SESSION["incorrectLastNameError"]) ){
                    $incorrectLastNamePlaceholder   = $_SESSION['incorrectLastNameError'];
                    } 
                if(isset($_SESSION["invalidLastNameError"]) ){
                    $invalidLastNamePlaceholder     = $_SESSION['invalidLastNameError'];
                    }

            // Email error placeholders 
                if(isset($_SESSION["incorrectEmailError"]) ){
                    $incorrectEmailPlaceholder      = $_SESSION['incorrectEmailError'];
                    } 
                if(isset($_SESSION["invalidEmailError"]) ){
                    $invalidEmailPlaceholder        = $_SESSION['invalidEmailError'];
                    }
                    
            // Message error placeholder 
                if(isset($_SESSION["messageError"]) ){
                    $incorrectMessagePlaceholder    = $_SESSION["messageError"];
                    }

                $errorClass = "errorPlaceholder";
                }

                    $errorHeader    = $_SESSION['errorHeader'];
                    $errorContent   = $_SESSION['errorContent'];
                    $errorImage     = $_SESSION['errorImage']; 

                    if (
                    $errorHeader        == $_SESSION['errorHeader']
                    && $errorContent    == $_SESSION['errorContent']
                    && $errorImage      == $_SESSION['errorImage']
                    ){

                        unset($_SESSION['contactHeader']);
                        unset($_SESSION['contactContent']);
                        unset($_SESSION['contactImage']);

                    }

            // Unset all sessions

                unset($_SESSION['errorHeader']);
                unset($_SESSION['errorContent']);
                unset($_SESSION['errorImage']) ;
            }

            $firstNamePlaceholder   = "Enter your first name here...";
            $lastNamePlaceholder    = "Enter your last name here...";
            $emailPlaceholder       = "Enter your email address here...";
            $messagePlaceholder     = "Input your message here...";
        ?>

            <form method="GET" action="validation.php">
                <div class="formGroup">
                <!-- First Name -->
                    <label for="firstName" class="formTitle firstName">First Name:</label>
                    <input type="text" name="firstName" id="firstName"
                    <?php 
                        if(
                            isset($_SESSION["incorrectFirstNameError"])
                            || isset($_SESSION["invalidFirstNameError"])   
                        ){
                            echo "class=\"$errorClass\"";
                            echo "placeholder=\"";

                            if(isset($_SESSION["incorrectFirstNameError"])){
                                echo "$incorrectFirstNamePlaceholder\"";
                            }elseif(isset($_SESSION["invalidFirstNameError"])){
                                echo "$invalidFirstNamePlaceholder\"";
                            }
                                
                        }else{
                            echo "\" placeholder=\"$firstNamePlaceholder\"";
                        }

                    ?> required="">

                <!-- Last Name -->
                    <label for="lastName" class="formTitle">Last Name:</label>
                    <input type="text" name="lastName" id="lastName"
                    <?php 
                        if(
                        isset($_SESSION["incorrectLastNameError"])
                        || isset($_SESSION["invalidLastNameError"]) 
                        ){
                            echo "class=\"$errorClass\"";
                            echo "placeholder=\"";

                                if(isset($_SESSION["incorrectLastNameError"])){
                                    echo "$incorrectLastNamePlaceholder\"";
                                }elseif(isset($_SESSION["invalidLastNameError"])){
                                    echo "$invalidLastNamePlaceholder\"";
                                }
                        }else{
                            echo "\" placeholder=\"$lastNamePlaceholder\"";
                        }

                    ?> required="">

                <!-- Email Address -->
                    <label for="emailAddress" class="formTitle">Email address</label>
                    <input type="email" name="emailAddress" id="emailAddress" 
                    <?php 
                    if(
                       isset($_SESSION["incorrectEmailError"])
                    || isset($_SESSION["invalidEmailError"]) 
                    ){
                        echo "class=\"$errorClass\"";
                        echo "placeholder=\"";

                            if(isset($_SESSION["incorrectEmailError"])){
                                echo "$incorrectEmailPlaceholder\"";
                            }elseif(isset($_SESSION["invalidEmailError"])){
                                echo "$invalidEmailPlaceholder\"";
                            }
                    }else{
                        echo "\" placeholder=\"$emailPlaceholder\"";
                    }?> required="">

                <!-- Message -->
                    <label for="message" class="formTitle">Message:</label>
                    <textarea type="textarea" name="message" id="message" <?php 
                    if(
                       isset($_SESSION["incorrectMessageError"]))
                    {
                        echo "$errorClass=\" ";
                        echo "placeholder=\" ";
                        if(isset($_SESSION["incorrectMessageError"])){
                            echo "$incorrectMessagePlaceholder ";
                        }
                    }else{
                        echo "\" placeholder=\"$messagePlaceholder\"";
                    }?> required=""></textarea>
                </div>
                <button type="submit">Submit</button>
            </form>
                </div> <!-- End of the content div -->
        </div>
    </div>
    <?php 
        require_once('modules/footer.php');   
        require_once('modules/javascriptFiles.php');  
    ?>
</body>

<?php
// Clearing all the error placeholders
    unset($_SESSION['incorrectFirstNameError']);
    unset($_SESSION['invalidFirstNameError']);
    unset($_SESSION['incorrectLastNameError']);
    unset($_SESSION['invalidLastNameError']);
    unset($_SESSION['incorrectEmailError']);
    unset($_SESSION['invalidEmailError']);
    unset($_SESSION['messageError']);
?>