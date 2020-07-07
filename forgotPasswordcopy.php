<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    use PHPMailer\PHPMailer\SMTP;

    // Load Composer's autoloader
    // require 'vendor/autoload.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    $usrEmail = 'rishabhpanesar@gmail.com';
    $userName = 'Rishabh Panesar';
    
    $user = "opensongsmusify@gmail.com";
    
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = $user;                     // SMTP username
        $mail->Password   = 'S2yi8bGEp45FLQU';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom($user, 'Musify Support');
        $mail->addAddress($usrEmail, $userName);     // Add a recipient
        $mail->addReplyTo($user, 'Musify Support');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Reset Password';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo '<script>console.log(Message has been sent);</script>';
    } catch (Exception $e) {
        echo "<script>console.log(Message could not be sent. Mailer Error: {$mail->ErrorInfo});</script>";
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
                    <form id='loginForm' method="post">
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