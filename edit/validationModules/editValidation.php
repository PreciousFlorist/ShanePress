<?php

// The purpose of this page is to pull all of the data from the 
// page editors wihtin the admin, and to store this infomration
// into the mysqli database.


session_start();
require("../../modules/databaseConnection.php"); 

if($_SESSION["permission"] !== "admin" 
&& $_SESSION["permission"] !== "visitor" 
&& !isset($_SESSION["timer"]) ) {

    session_unset($_SESSION["timer"]);
    session_unset($_SESSION["permission"]);
    session_destroy();   
    
    header("location: ../index.php");
    die();

}

/*--------------------
# Modules
--------------------*/

    require_once("modules/frontEndNavigation.php");

/*--------------------
# Major Pages
--------------------*/

    require_once("majorPages/homePageEdit.php");
    require_once("majorPages/aboutPageEdit.php");
    require_once("majorPages/workPageEdit.php");
    require_once("majorPages/contactPageEdit.php");

/*--------------------
# Backend
--------------------*/

    require_once("backend/adminIndexPageEdit.php");

/*--------------------
# Projects
--------------------*/

    require_once("projects/majorProjectOne.php"); 
    require_once("projects/majorProjectTwo.php");
    require_once("projects/minorProjectOne.php");
    require_once("projects/minorProjectTwo.php");

// In case a user accesses this page without processing any changes to the websites content

    header("location: https://www.shanewalders.com");
    die();