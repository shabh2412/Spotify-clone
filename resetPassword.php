<?php
    include('includes/config.php');
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
                            <label for="loginUsername">Username</label>
                            <input type="text" name="loginUsername" id="loginUsername" placeholder="Ex: johnDoe" required>
                        </p>
                        <p>
                            <label for="loginEmail">Your E-Mail ID</label>
                            <input type="email" name="loginEmail" id="loginEmail" placeholder="johndoe@example.com" required>
                        </p>
                        <button type="submit" value='Reset Pwd' name="loginButton">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
    echo "<script>
                $(document).ready(function() {
                    $('#loginForm').show();
                });
            </script>";
?>