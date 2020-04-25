<?php
    if(isset($_POST['registerButton'])){
        // Register Button was pressed
        $userName = purifyUsername($_POST['Username']);
        $firstName = purifyInput($_POST['firstName']);
        $lastName = purifyInput($_POST['lastName']);
        $email = purifyInput($_POST['email']);
        $email_conf = purifyInput($_POST['email_conf']);
        $password = purifyPassword($_POST['Password']);
        $password_conf = purifyPassword($_POST['Password-conf']);
        
        validateUsername($userName);
        validateName($firstName);
        validateName($lastName);
        validateEmail($email,$email_conf);
        validatePassword($password, $password_conf);
    }
    function validateUsername($username){

    }
    function validateName($name){

    }
    function validateEmail($em1 , $em2){

    }
    function validatePassword($pwd1, $pwd2){

    }
    function purifyUsername($x)
    {
        $x = strip_tags($x);
        $x = str_replace(' ',"", $x);
        $x = stripslashes($x);
        $x = strtolower($x);
        return $x;
    }
    function purifyPassword($x){
        $x = stripslashes($x);
        $x = strip_tags($x);
        return $x;
    }
    function purifyInput($x){
        $x = strip_tags($x);
        $x = str_replace(' ',"", $x);
        $x = stripslashes($x);
        $x = strtolower($x);
        $x = ucfirst($x);
        return $x;
    }
?>
