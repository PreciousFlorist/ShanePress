<!-- FontAwesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    
<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Raleway:400,400i,600,600i|" rel="stylesheet">

<!-- CSS Styles -->
    <link rel="stylesheet" href="https://shanewalders.com/styles/styles.css?v9">

<!-- Favicon -->
    <link rel="shortcut icon" href="https://shanewalders.com/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="https://shanewalders.com/images/favicon.ico" type="image/x-icon">
<!-- Connect to the database and include markup doccumentation -->
    <?php
        require("databaseConnection.php"); 
        require("markUpMarkDown.php");
    ?>
    <!-- Session Start -->
    <?php
        session_start();
    ?>
   