
<?php 
    session_start();
    require("../modules/databaseConnection.php"); 

    // Reset variables (before information is processed)
    $inputUsername                               = "";
    $inputPassword                               = "";
    
// Check to see if form data has been set
if(
    isset($_POST["username"    ])      == TRUE
&&  isset($_POST["password"    ])      == TRUE
){ 

    // Apply relevent data to their associated variables
    $inputUsername                      = filter_var(trim($_POST["username"]), FILTER_SANITIZE_STRING);
    $inputPassword                      = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

    // Connect to the database
    $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

    if (!$serverConnection->connect_error) {

        // Sanitize the username for mySQL interactions
        $inputUsername      = mysqli_real_escape_string($serverConnection, $inputUsername);

        $sql = "SELECT  userEmail
                FROM    backendUsers
                WHERE   userEmail = \"$inputUsername\";
            ";

        // Connect the query to the server
        $requestedData      = mysqli_query($serverConnection, $sql);
        // Convert the retrieved array into a variable
        $retrievedArray     = mysqli_fetch_array($requestedData);
        // This will query the request, and determine whether or not the sql request was processed
        $result             = mysqli_query($serverConnection, $sql);
        // This will determine the number of rows that the query returned. Since there are no duplicate usernames, this should result in either a 1 or 0
        $retrievedRows      = mysqli_num_rows($result);

        if ($retrievedRows == 1) {

                    $sql = "SELECT  userPassword 
                            FROM    backendUsers
                            WHERE   userEmail = \"$inputUsername\"
                        ";

                        // Connect the query to the server, in order to check for the valid password
                        $requestedData          = mysqli_query($serverConnection, $sql);
                        // Convert the retrieved array into a variable
                        $retrievedArray         = mysqli_fetch_array($requestedData);
                        // Collect the relevent data
                        $retrievedPassword      = $retrievedArray['userPassword'];
                        // Finally, we verify the input password to see if it matches the one stored in our database
                        $passwordValidation     = password_verify($inputPassword, $retrievedPassword);

                    // If the passwords don't match, we'll send the users back to the admin
                    if ($passwordValidation == false){

                        $serverConnection->close();
                        header("location: https://www.shanewalders.com/admin.php");
                        die();

                    // If the passwords do match, we will determine the users permissions
                    } elseif ($passwordValidation == true){

                            $sql = "SELECT  permission
                                    FROM    backendUsers
                                    WHERE   userEmail = \"$inputUsername\"
                                ";

                            $result = mysqli_query($serverConnection, $sql);
                            $row    = mysqli_fetch_assoc($result);

                            // Here we will validate the permissions of the user, and determine whether or not to provide them with visitor or administrator priviliges
                            if ($row["permission"] == "visitor"){

                                $_SESSION["permission"] = $row["permission"];
                                $_SESSION["timer"]      = time();
                                $serverConnection->close();
                                header("location: https://www.shanewalders.com/backend/backendIndex.php");
                                die();

                            } elseif ($row["permission"] == "admin"){

                                $_SESSION["permission"] = $row["permission"];
                                $_SESSION["timer"]      = time();
                                $serverConnection->close();
                                header("location: https://www.shanewalders.com/backend/backendIndex.php");
                                die();

                            } else {

                                // Somethings gone wrong here... Each user should have their permissions set.
                                $serverConnection->close();
                                header("location: https://www.shanewalders.com");
                                die(); 
                            }

                    } else {

                        // Somethings gone wrong here, the password validation has provedn to be neither true nor false... This user should not be accessing the backend
                        $serverConnection->close();
                        header("location: https://www.shanewalders.com");
                        die();
                    }

            } else {

                // Either the user found multiple entereies within the database with the same username, or there were no enteries of this input username
                $serverConnection->close();
                header("location: https://www.shanewalders.com");
                die();

            }

    } else {
        echo "a sqli connection error has occurred";
        die();
        //There has been an error connecting to the server...
        $serverConnection->close();
        header("location: https://www.shanewalders.com");
    }

}elseif(
        // It appears that our user has bypassed a required field...
        isset($_POST["username"    ])   == FALSE
    ||  isset($_POST["password"    ])   == FALSE
    ){ 
    if( 
        // Missing username error
        empty($username)
    ||  preg_match($namePattern, $username) == FALSE

    ){
        $_SESSION['errorUsername'] = $errorUsername;
    }

    if( 
        // Missing password error
        empty($password)
    ||  preg_match($namePattern, $password) == FALSE

    ){
        $_SESSION['errorPassword'] = $errorPassword;
    }

    header("location: https://www.shanewalders.com/admin.php");
    die();        

} else{
    // It looks as though the user has skipped the form processing page... Lets send them back to the home page";
    header("location: https://www.shanewalders.com");
    die();
}

?>
