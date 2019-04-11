<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once("modules/headerFiles.php");
    ?>
</head>
<body>

    <div class="contentBody validationPage">
        <div class="wrapper">

            <?php 
            // Errors
                // First Name
                $incorrectFirstNameError                =  "Your first name is required...";
                $invalidFirstNameError                  =  "No numbers or special characters...";
                // Last Name
                $incorrectLastNameError                 =  "Your last name is required...";
                $invalidLastNameError                   =  "No numbers or special characters...";
                // Email Address
                $incorrectEmailError                    =  "An email address is required...";
                $invalidEmailError                      =  "Please provide a valid email address...";
                // Message
                $incorrectMessageError                  =  "A message is required...";

            // Reset variables (before information is processed)
                $firstName                              = "";
                $lastName                               = "";
                $emailAddress                           = "";
                $message                                = "";
            
            // Regex verification patterns
                $emailPattern  = "/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/";
                $namePattern   = "/^[A-Za-z]+$/";
                
            // Check to see if form data has been set
                    if(
                       isset($_GET["firstName"   ])    == TRUE
                    && isset($_GET["lastName"    ])    == TRUE
                    && isset($_GET["emailAddress"])    == TRUE
                    && isset($_GET["message"     ])    == TRUE
                    ){ 
                        
                    // Apply relevent data to their associated variables
                        $firstName                      = filter_var(ucfirst(strtolower(trim ($_GET["firstName"]))), FILTER_SANITIZE_STRING);
                        $lastName                       = filter_var(ucfirst(strtolower(trim ( $_GET["lastName"]))), FILTER_SANITIZE_STRING);
                        $emailAddress                   = filter_var(strtolower(trim ($_GET["emailAddress"])), FILTER_SANITIZE_EMAIL);
                        $message                        = filter_var(trim ($_GET["message"]), FILTER_SANITIZE_STRING);

                        if(
                        // Check to ensure that the users information is validatied by the regex pattern, and that their input wasn't reduced to whitespace from the trim()
                              ctype_space($message)                         == FALSE
                           && ctype_space($firstName)                       == FALSE
                           && ctype_space($lastName)                        == FALSE
                           && ctype_space($emailAddress)                    == FALSE

                        // Check to ensure that the input data matches the regex pattern
                           && preg_match($namePattern, $firstName)          == TRUE
                           && preg_match($namePattern, $lastName)           == TRUE
                           && preg_match($emailPattern, $emailAddress)      == TRUE
                         ){
                        // Thank the user for their message, using their provided first name
                        $_SESSION["firstName"]   = $firstName;
                        $_SESSION["lastName"]   = $lastName;          
                        // Record the users message
                        $_SESSION["message"]    = $message;
                        // Reiterate the email address back to the user
                        $_SESSION["emailAddress"]    = $emailAddress;

                        $_SESSION["thankYouImage"]     = validationSuccessImage;

                        header("location: thank-you.php");
                        die();
            ?>

            
                <?php

                    }else{
                // If the users input feild is empty after trim(), or does not match the regex
                        
                //First name errors
                        if( 
                            empty($firstName)
                        ||  preg_match($namePattern, $firstName) == FALSE
                        ){
                            if(empty($firstName)){
                                $_SESSION["incorrectFirstNameError"] = $incorrectFirstNameError;
                            }else{
                                $_SESSION["invalidFirstNameError"] = $invalidFirstNameError;
                            }
                        }

                    // Last name errors
                        if( 
                            empty($lastName)
                        ||  preg_match($namePattern, $lastName) == FALSE
                        ){
                            if(empty($lastName)){
                                $_SESSION["incorrectLastNameError"] = $incorrectLastNameError;
                            }else{
                                $_SESSION["invalidLastNameError"] = $invalidLastNameError;
                            }
                        }

                    // Email address errors
                        if( 
                            empty($emailAddress)
                        ||  preg_match($emailPattern, $emailAddress) == FALSE
                            ){
                            if(empty($emailAddress)){
                                $_SESSION["incorrectEmailError"] = $incorrectEmailError;
                            }else{
                                $_SESSION["invalidEmailError"] = $invalidEmailError;
                            }
                        }

                    // Message error
                        if( empty($message) 
                        ||  !isset($_GET["message"])){
                            $_SESSION["messageError"]   = $incorrectMessageError;
                        }

                        $_SESSION["errorHeader"]    = "Oh No...";
                        $_SESSION["errorContent"]   =  "Please ensure that all form fields have been input correctly!";
                        $_SESSION["errorImage"]     = validationFirstErrorImage;

                    // Unset the previous precontact sessions
                        unset($_SESSION['contactHeader']);
                        unset($_SESSION['contactContent']);
                        unset($_SESSION['contactImage']);
                        unset($_SESSION['precontact']); 

                        header("location: precontact.php");
                        die();
                    }
                            
                ?>
                        
           <?php
            
            }else{
                // It looks as though the user has skipped the form processing page... Lets send them back to the precontact page

                    header("location: precontact.php");
                    die();
                }
            ?>
            </div> <!-- End of wrapper -->
    </div> <!-- End of validationPage -->
</body>