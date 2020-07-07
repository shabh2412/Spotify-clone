<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    use PHPMailer\PHPMailer\SMTP;

    require "includes/config.php";

    if(isset($_POST['loginUsername']) && isset($_POST['loginEmail']) ){
        // Load Composer's autoloader
        // require 'vendor/autoload.php';

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        
        $usrEmail = $_POST['loginEmail'];
        $userName = $_POST['loginUsername'];

        $code = uniqid(true);
        $query = "INSERT INTO resetPasswords(code, username, email) VALUES ('$code', '$userName', '$usrEmail')";
        $execQuery = mysqli_query($conn, $query);
        if(!$execQuery) {
            exit("ERROR");
        }

        $user = "opensongsmusify@gmail.com";
        
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
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
            $url = "http://".$_SERVER["HTTP_POST"] . dirname($_SERVER["PHP_SELF"] . "/resetPassword.php?code=$code");
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Reset Password';
            $mail->Body    = "<!doctype html>
            <html>
              <head>
                <meta name='viewport' content='width=device-width' />
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                <title>Simple Transactional Email</title>
                <style>
                  /* -------------------------------------
                      GLOBAL RESETS
                  ------------------------------------- */
                  
                  /*All the styling goes here*/
                  
                  img {
                    border: none;
                    -ms-interpolation-mode: bicubic;
                    max-width: 100%; 
                  }
            
                  body {
                    background-color: #f6f6f6;
                    font-family: sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-size: 14px;
                    line-height: 1.4;
                    margin: 0;
                    padding: 0;
                    -ms-text-size-adjust: 100%;
                    -webkit-text-size-adjust: 100%; 
                  }
            
                  table {
                    border-collapse: separate;
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                    width: 100%; }
                    table td {
                      font-family: sans-serif;
                      font-size: 14px;
                      vertical-align: top; 
                  }
            
                  /* -------------------------------------
                      BODY & CONTAINER
                  ------------------------------------- */
            
                  .body {
                    background-color: #f6f6f6;
                    width: 100%; 
                  }
            
                  /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
                  .container {
                    display: block;
                    margin: 0 auto !important;
                    /* makes it centered */
                    max-width: 580px;
                    padding: 10px;
                    width: 580px; 
                  }
            
                  /* This should also be a block element, so that it will fill 100% of the .container */
                  .content {
                    box-sizing: border-box;
                    display: block;
                    margin: 0 auto;
                    max-width: 580px;
                    padding: 10px; 
                  }
            
                  /* -------------------------------------
                      HEADER, FOOTER, MAIN
                  ------------------------------------- */
                  .main {
                    background: #ffffff;
                    border-radius: 3px;
                    width: 100%; 
                  }
            
                  .wrapper {
                    box-sizing: border-box;
                    padding: 20px; 
                  }
            
                  .content-block {
                    padding-bottom: 10px;
                    padding-top: 10px;
                  }
            
                  .footer {
                    clear: both;
                    margin-top: 10px;
                    text-align: center;
                    width: 100%; 
                  }
                    .footer td,
                    .footer p,
                    .footer span,
                    .footer a {
                      color: #999999;
                      font-size: 12px;
                      text-align: center; 
                  }
            
                  /* -------------------------------------
                      TYPOGRAPHY
                  ------------------------------------- */
                  h1,
                  h2,
                  h3,
                  h4 {
                    color: #000000;
                    font-family: sans-serif;
                    font-weight: 400;
                    line-height: 1.4;
                    margin: 0;
                    margin-bottom: 30px; 
                  }
            
                  h1 {
                    font-size: 35px;
                    font-weight: 300;
                    text-align: center;
                    text-transform: capitalize; 
                  }
            
                  p,
                  ul,
                  ol {
                    font-family: sans-serif;
                    font-size: 14px;
                    font-weight: normal;
                    margin: 0;
                    margin-bottom: 15px; 
                  }
                    p li,
                    ul li,
                    ol li {
                      list-style-position: inside;
                      margin-left: 5px; 
                  }
            
                  a {
                    color: #3498db;
                    text-decoration: underline; 
                  }
            
                  /* -------------------------------------
                      BUTTONS
                  ------------------------------------- */
                  .btn {
                    box-sizing: border-box;
                    width: 100%; }
                    .btn > tbody > tr > td {
                      padding-bottom: 15px; }
                    .btn table {
                      width: auto; 
                  }
                    .btn table td {
                      background-color: #ffffff;
                      border-radius: 5px;
                      text-align: center; 
                  }
                    .btn a {
                      background-color: #ffffff;
                      border: solid 1px #3498db;
                      border-radius: 5px;
                      box-sizing: border-box;
                      color: #3498db;
                      cursor: pointer;
                      display: inline-block;
                      font-size: 14px;
                      font-weight: bold;
                      margin: 0;
                      padding: 12px 25px;
                      text-decoration: none;
                      text-transform: capitalize; 
                  }
            
                  .btn-primary table td {
                    background-color: #3498db; 
                  }
            
                  .btn-primary a {
                    background-color: #3498db;
                    border-color: #3498db;
                    color: #ffffff; 
                  }
            
                  /* -------------------------------------
                      OTHER STYLES THAT MIGHT BE USEFUL
                  ------------------------------------- */
                  .last {
                    margin-bottom: 0; 
                  }
            
                  .first {
                    margin-top: 0; 
                  }
            
                  .align-center {
                    text-align: center; 
                  }
            
                  .align-right {
                    text-align: right; 
                  }
            
                  .align-left {
                    text-align: left; 
                  }
            
                  .clear {
                    clear: both; 
                  }
            
                  .mt0 {
                    margin-top: 0; 
                  }
            
                  .mb0 {
                    margin-bottom: 0; 
                  }
            
                  .preheader {
                    color: transparent;
                    display: none;
                    height: 0;
                    max-height: 0;
                    max-width: 0;
                    opacity: 0;
                    overflow: hidden;
                    mso-hide: all;
                    visibility: hidden;
                    width: 0; 
                  }
            
                  .powered-by a {
                    text-decoration: none; 
                  }
            
                  hr {
                    border: 0;
                    border-bottom: 1px solid #f6f6f6;
                    margin: 20px 0; 
                  }
            
                  /* -------------------------------------
                      RESPONSIVE AND MOBILE FRIENDLY STYLES
                  ------------------------------------- */
                  @media only screen and (max-width: 620px) {
                    table[class=body] h1 {
                      font-size: 28px !important;
                      margin-bottom: 10px !important; 
                    }
                    table[class=body] p,
                    table[class=body] ul,
                    table[class=body] ol,
                    table[class=body] td,
                    table[class=body] span,
                    table[class=body] a {
                      font-size: 16px !important; 
                    }
                    table[class=body] .wrapper,
                    table[class=body] .article {
                      padding: 10px !important; 
                    }
                    table[class=body] .content {
                      padding: 0 !important; 
                    }
                    table[class=body] .container {
                      padding: 0 !important;
                      width: 100% !important; 
                    }
                    table[class=body] .main {
                      border-left-width: 0 !important;
                      border-radius: 0 !important;
                      border-right-width: 0 !important; 
                    }
                    table[class=body] .btn table {
                      width: 100% !important; 
                    }
                    table[class=body] .btn a {
                      width: 100% !important; 
                    }
                    table[class=body] .img-responsive {
                      height: auto !important;
                      max-width: 100% !important;
                      width: auto !important; 
                    }
                  }
            
                  /* -------------------------------------
                      PRESERVE THESE STYLES IN THE HEAD
                  ------------------------------------- */
                  @media all {
                    .ExternalClass {
                      width: 100%; 
                    }
                    .ExternalClass,
                    .ExternalClass p,
                    .ExternalClass span,
                    .ExternalClass font,
                    .ExternalClass td,
                    .ExternalClass div {
                      line-height: 100%; 
                    }
                    .apple-link a {
                      color: inherit !important;
                      font-family: inherit !important;
                      font-size: inherit !important;
                      font-weight: inherit !important;
                      line-height: inherit !important;
                      text-decoration: none !important; 
                    }
                    #MessageViewBody a {
                      color: inherit;
                      text-decoration: none;
                      font-size: inherit;
                      font-family: inherit;
                      font-weight: inherit;
                      line-height: inherit;
                    }
                    .btn-primary table td:hover {
                      background-color: #34495e !important; 
                    }
                    .btn-primary a:hover {
                      background-color: #34495e !important;
                      border-color: #34495e !important; 
                    } 
                  }
            
                </style>
              </head>
              <body class=''>
                <span class='preheader'>Important! Password Reset Request at Musify</span>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body'>
                  <tr>
                    <td>&nbsp;</td>
                    <td class='container'>
                      <div class='content'>
            
                        <!-- START CENTERED WHITE CONTAINER -->
                        <table role='presentation' class='main'>
            
                          <!-- START MAIN CONTENT AREA -->
                          <tr>
                            <td class='wrapper'>
                              <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                                <tr>
                                  <td>
                                    <p>Hi there $userName!</p>
                                    <p>You have requested for a password reset. Here is your link:</p>
                                    <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary'>
                                      <tbody>
                                        <tr>
                                          <td align='left'>
                                            <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                                              <tbody>
                                                <tr>
                                                  <td> <a href= $url target='_blank'>Click Here to Reset Your Password</a> </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    <p>Thank you for reaching out to us to reset your password! We hope you are having a great time at Musify</p>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
            
                        <!-- END MAIN CONTENT AREA -->
                        </table>
                        <!-- END CENTERED WHITE CONTAINER -->
            
                        <!-- START FOOTER -->
                        <div class='footer'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td class='content-block'>
                                <span class='apple-link'>Musify Inc, 3 Abbey Road, San Francisco CA 94102</span>
                                <br> Don't like these emails? <a href='http://i.imgur.com/CScmqnj.gif'>Unsubscribe</a>.
                              </td>
                            </tr>
                            <tr>
                              <td class='content-block powered-by'>
                                Powered by <a href='http://htmlemail.io'>GitHub</a>.
                              </td>
                            </tr>
                          </table>
                        </div>
                        <!-- END FOOTER -->
            
                      </div>
                    </td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              </body>
            </html>";
            $mail->AltBody = 'Hi!'.$userName.', you have requested for a password reset! Here\'s your link: $code';
            
            $mail->send();
            echo "<script>alert($url);</script>";
            echo '<script>console.log("Message has been sent");</script>';
            echo "Mail Has been sent to $usrEmail!";
            exit();
        } catch (Exception $e) {
            echo "<script>console.log('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
        }   
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