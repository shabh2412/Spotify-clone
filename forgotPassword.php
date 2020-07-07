<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    if(isset($_POST['loginEmail']) && isset($_POST['loginUsername']) ){
        $sendTo = $_POST['loginEmail'];
        $userName = $_POST['loginUsername'];
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'opensongsmusify@gmail.com';                     // SMTP username
            $mail->Password   = 'S2yi8bGEp45FLQU';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('support@musifysongs.com', 'Musify Support');
            $mail->addAddress($sendTo, 'Rishabh Panesar');     // Add a recipient
            // $mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('opensongsmusify@gmail.com', 'Musify Support');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Password Reset';
            $mail->Body    = 'Hi '.$userName.'!,<br> <b>This is a mail regarding password reset!</b> HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo '<script>alert("Message has been sent")</script>';
            echo "Mail Sent Successfully! <br><a href='register.php'>Login Now</a>";
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }    
    // function getInputValue($name) {
    //     if(isset($_POST[$name])){
    //         echo $_POST[$name];
    //     }
    // }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="assets/css/register.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
    </head>
    <body>
        <div id="background">
            <div id="loginContainer">
                <div id="inputContainer">
                    <form id="loginForm" method="POST">
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
    <?php
        echo "<script>
                    $(document).ready(function() {
                        $('#loginForm').show();
                    });
                </script>";
    ?>
    </body>
</html>
