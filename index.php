<?php

    include("includes/config.php");
    if(isset($_SESSION['userLoggedIn'])){
        $userName = $_SESSION['userLoggedIn'];
    }   else{
        header('location: register.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome To Spotify Clone</title>
</head>
<body>
    
</body>
</html>