<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reset Password</title>
        <link rel="stylesheet" href="assets/css/register.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
    </head>
    <body>
        <?php
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;

            require 'PHPMailer/src/Exception.php';
            require 'PHPMailer/src/PHPMailer.php';
            require 'PHPMailer/src/SMTP.php';
        ?>
        <div id="background">
            <div id="loginContainer">
                <div id="inputContainer">
                    <form id='loginForm'></form>
                </div>
            </div>
        </div>
    <?php
        echo "<script>
                    $(document).ready(function() {
                        $('#loginForm').show();
                    });
                </script>";
    ?>
    </body>
</html>

