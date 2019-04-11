<div class="backEndNavWrapper">
    <nav>
        <div class="hamburger" onclick="hamburgerCross(this)">
            <button class="fas fa-plus"><span class="screen-reader-text">This is a drop down menu button</span></button>

            <div class="navOverlay">
                <div class="navWrapper">

                    <button class="accordion">Major Pages</button>
                    <ul class="panel">
                        <li><a href="../edit/home.php">Home</a></li>
                        <li><a href="../edit/about.php">About</a></li>
                        <li><a href="../edit/work.php">Work</a></li>
                        <li><a href="../edit/contact.php">Contact</a></li>
                        <li><a href="../edit/adminIndex.php">Admin Panel</a></li>
                    </ul>

                    <button class="accordion">Specific Projects</button>
                    <ul class="panel">

                        <li>
                            <?php $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                                $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);
                                $sql = "SELECT  projectTitle
                                        FROM    projects
                                        WHERE   projectID = 1
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data
                                $projectTitle   = $retrievedArray['projectTitle'];

                                if($_SESSION["permission"] == "admin"){
                                    if (!$serverConnection->connect_error) {

                                        echo "<a href=\"../edit/majorProjectFirst.php\">$projectTitle</a>";
                                        $serverConnection->close();
                                    }
                                }else{
                                    echo "<a href=\"#\" onclick=\"Alert.render()\">$projectTitle</a>";
                                }

                            ?>
                        </li>

                        <li>
                            <?php $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                                $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);
                                $sql = "SELECT  projectTitle
                                        FROM    projects
                                        WHERE   projectID = 2
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data
                                $projectTitle   = $retrievedArray['projectTitle'];

                                if($_SESSION["permission"] == "admin"){
                                    if (!$serverConnection->connect_error) {

                                        echo "<a href=\"../edit/majorProjectSecond.php\">$projectTitle</a>";
                                        $serverConnection->close();
                                    }
                                }else{
                                    echo "<a href=\"#\" onclick=\"Alert.render()\">$projectTitle</a>";
                                }

                            ?>
                        </li>

                        <li>
                            <?php 
                            
                                $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);
                                $sql = "SELECT  projectTitle
                                        FROM    projects
                                        WHERE   projectID = 3
                                    ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data
                                $projectTitle   = $retrievedArray['projectTitle'];
                                if($_SESSION["permission"] == "admin"){
                                    if (!$serverConnection->connect_error) {

                                        echo "<a href=\"../edit/minorProjectFirst.php\">$projectTitle</a>";
                                        $serverConnection->close();
                                    }
                                }else{
                                    echo "<a href=\"#\" onclick=\"Alert.render()\">$projectTitle</a>";
                                }

                            ?>
                        </li>

                        <li>
                            <?php

                                $serverConnection = new mysqli($serverIP, $username, $password, $databaseName);

                                $sql = "SELECT  projectTitle
                                FROM    projects
                                WHERE   projectID = 4
                                ";

                                // Connect the query to the server
                                $requestedData      = mysqli_query($serverConnection, $sql);
                                // Convert the retrieved array into a variable
                                $retrievedArray     = mysqli_fetch_array($requestedData);
                                // Collect the relevent data
                                $projectTitle   = $retrievedArray['projectTitle'];

                                if($_SESSION["permission"] == "admin"){

                                    if (!$serverConnection->connect_error) {
                                        echo " <a href=\"../edit/minorProjectSecond.php\"> $projectTitle </a>";
                                        $serverConnection->close();
                                    }
                                } else{
                                    echo "<a href=\"#\" onclick=\"Alert.render()\">$projectTitle</a>";
                                }

                            ?>
                        </li>
                    </ul>

                    <button class="accordion">Navigation</button>
                    <ul class="panel">
                        <li>
                            <?php 
                                if($_SESSION["permission"] == "admin"){
                                    echo "<a href=\"../edit/frontendNavigation.php\">Frontend Navigation</a>";
                                }else{
                                    echo "<a href=\"#\" onclick=\"Alert.render()\">Frontend Navigation</a>";
                                    }
                            ?>
                        </li>

                        <li>
                            <?php 
                                if($_SESSION["permission"] == "admin"){
                                    echo "<a href=\"#\">Backend Navigation</a>";
                                }else{
                                    echo "<a href=\"#\" onclick=\"Alert.render()\">Backend Navigation</a>";
                                }
                            ?>
                        </li>
                    </ul>


                    <button class="accordion">Access</button>
                    <ul class="panel">
                        <li><a target="_blank" href="../index.php">Frontend</a></li>
                        <li><a href="../backend/backendIndex.php">Backend</a></li>
                        <li>
                            <?php 
                                if($_SESSION["permission"] == "admin"){
                                    echo "<a href=\"#\">Messages</a>";
                                }else{ 
                                    echo "<a href=\"#\" onclick=\"Alert.render()\">Messages</a>";
                                }
                            ?>
                        </li>
                    </ul>

                    <form method="GET" action="https://www.shanewalders.com/backend/signOut.php" class="formGroup">
                        <button>Sign Out</button>
                    </form>

                </div> 
            </div>
        </div>
    </nav>
</div>

<div class="dialogoverlay" id="dialogoverlay"></div>

<div class="dialogbox" id="dialogbox">
    <div class="alertWrapper">
        <div class="dialogboxhead" id="dialogboxhead"></div>
        <div class="dialogboxbody" id="dialogboxbody"></div>
        <div class="dialogboxfoot" id="dialogboxfoot"></div>
    </div>
</div>



