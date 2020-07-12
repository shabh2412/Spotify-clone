<?php
    include("includes/config.php");
    include("includes/classes/Artist.php");
    include("includes/classes/Album.php");
    include("includes/classes/Song.php");
    if(isset($_SESSION['userLoggedIn'])){
        $userName = $_SESSION['userLoggedIn'];
        echo "<script>userLoggedIn = '$userName';<script/>";
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
    <title>Welcome To Musify</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>
<body>
    <!-- <script>
        var audioElement = new Audio(); 
        audioElement.setTrack('assets/music/NiceToMeetYa-Official.mp3');
        audioElement.audio.play();
    </script> -->



    <div id="mainContainer">
        <div id="topContainer">

            <?php include("includes/navBarContainer.php")?>

            <div id="mainViewContainer">

                <div id="mainContent">