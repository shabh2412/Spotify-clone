<?php
    include('includes/config.php');
    include('includes/classes/Account.php');
    if(!isset($_GET["code"])) {
        exit("Can't Find the requested page :(");
    } 
    $code = $_GET['code'];
    $query = "SELECT * FROM resetPasswords WHERE code = '$code'";
    $execQuery = mysqli_query($conn, $query);
    if(mysqli_num_rows($execQuery) == 0) {
        exit("Can't Find the requested page :(");        
    } 

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reset Password</title>
        <link rel="stylesheet" href="assets/css/register.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
    </head>
    <body>  
        <div id="background">
            <div id="loginContainer">
                <div id="inputContainer">
                    <form id='loginForm' style="display: block;" method="post">
                    <h2>Reset Your Password</h2>
                        <p>
                            <label for="password">New Password</label>
                            <input type="password" name="password" id="password" placeholder="Ex: New Password" required>
                            <input type="checkbox" onclick="Toggle()"> 
                            <b>Show Password</b> 
                        
                            <script> 
                            // Change the type of input to password or text 
                                function Toggle() { 
                                    var temp = document.getElementById("password"); 
                                    if (temp.type === "password") { 
                                        temp.type = "text"; 
                                    } 
                                    else { 
                                        temp.type = "password"; 
                                    } 
                                } 
                            </script> 
                        </p>
                        <button type="submit" value='Update Password Pwd' name="loginButton">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>