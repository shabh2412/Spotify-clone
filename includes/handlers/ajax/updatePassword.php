<?php
    include("../../config.php");
    if(!isset($_POST['username'])){
        echo "Error, could not set username";
        exit();
    }
    if(!isset($_POST['oldPassword']) || !isset($_POST['newPassword1']) || !isset($_POST['newPassword2'])){
        echo "Not all passwords have been set!";
        exit();
    }
    if($_POST['oldPassword'] =="" || $_POST['newPassword1'] == "" || $_POST['newPassword2'] == ""){
        echo "Please fill in all fields!";
        exit();
    }
    // code to protect from XSS-Attacks
    function purifyPassword($x){
        $x = stripslashes($x);
        $x = strip_tags($x);
        return $x;
    }
    function purifyUsername($x){
        $x = strip_tags($x);
        $x = str_replace(' ',"", $x);
        $x = stripslashes($x);
        $x = strtolower($x);
        return $x;
    }
    $username = purifyUsername($_POST['username']);
    $oldPassword = purifyPassword($_POST['oldPassword']);
    $newPassword1 = purifyPassword($_POST['newPassword1']);
    $newPassword2 = purifyPassword($_POST['newPassword2']);
    
    if($newPassword1 == $oldPassword) {
        echo "Sorry, Old Password and New Password cannot be the same!";
        exit();
    }
    
    $oldMd5 = md5($oldPassword);
    $passwordCheck = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$oldMd5'");
    if(mysqli_num_rows($passwordCheck) != 1){
        echo "You have entered an Incorrect Password! Please try to reset the password using forgot password button on the login page";
        exit();
    }
    if($newPassword1 != $newPassword2){
        echo "Your new passwords do not match";
        exit();
    }
    $pVal = '/(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])(?=.*[!?])[a-zA-Z0-9!?]{8,}/';
    if(!preg_match($pVal, $newPassword1)) {
        echo "Password is too simple... Please include a lowercase, uppercase, ? or !, and a numeric character";
        exit();
    }
    if(strlen($newPassword1)<8 || strlen($newPassword1) > 30){
        echo "Your password must be between 8 & 30 characters!";
        exit();
    }
    $newMd5 = md5($newPassword1);
    $query = mysqli_query($conn, "UPDATE users SET password = '$newMd5' WHERE username = '$username'");
    echo "Update Successful!";
?>