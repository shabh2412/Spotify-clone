<?php
    include("includes/config.php");
    if(isset($_SESSION['userLoggedIn'])){
        $userName = $_SESSION['userLoggedIn'];
        if(time() - $_SESSION['loginTime'] > 3600) {
            session_destroy();
            header('location: register.php');
        }
        
    }   else{
        session_destroy();
        header('location: register.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome To Muscify</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
    <div id="mainContainer">
        <div id="topContainer">

            <?php include("includes/navBarContainer.php")?>

            <div id="mainViewContainer">

                <div id="mainContent">