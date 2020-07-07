<?php
    include('includes/config.php');
    include('includes/classes/Account.php');
    include('includes/classes/Constants.php');
    $account = new Account($conn);
    include('includes/handlers/register-handler.php');
    include('includes/handlers/login-handler.php');
    function getInputValue($name) {
        if(isset($_POST[$name])){
            echo $_POST[$name];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Muscify</title>
    <link rel="stylesheet" href="assets/css/register.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 

    <script src="assets/js/register.js"></script>
</head>
<body>
    
    <?php
        if(isset($_POST['registerButton'])) {
            echo "<script>
                    $(document).ready(function() {
                        $('#loginForm').hide();
                        $('#registerForm').show();
                    });
                </script>";
        } else {
            echo "<script>
                    $(document).ready(function() {
                        $('#loginForm').show();
                        $('#registerForm').hide();
                    });
                </script>";
        }
    ?>

    
    


    <div id="background">
        <div id="loginContainer">

            <div id="inputContainer">
                <form action="register.php" id="loginForm" method="POST">
                    <h2>Login To Your Account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$loginFailed); ?>
                        <label for="loginUsername">Username</label>
                        <input type="text" name="loginUsername" id="loginUsername" placeholder="Ex: johnDoe" required value="<?php getInputValue('loginUsername');?>">
                    </p>
                    <p>
                        <label for="loginPassword">Password</label>
                        <input type="password" name="loginPassword" id="loginPassword" placeholder="*****" required>
                    </p>
                    <button type="submit" name="loginButton">Login</button>

                    <div class="hasAccountText">
                        <span id="hideLogin">Don't have an account yet? Signup Here</span>
                        <br>
                        <span id="hideLogin"> <a href="forgotPassword.php">Forgot Password?</a></span>
                    </div>
                    
                </form>
                
                <form action="register.php" id="registerForm" method="POST">
                    <h2>Create Your Free Account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$usernameCharacterLength); ?>
                        <?php echo $account->getError( Constants::$usernameTaken); ?>
                        <label for="Username">Username</label>
                        <input type="text" name="Username" id="Username" placeholder="Ex: johnDoe" value = "<?php getInputValue('Username')?>" required>
                    </p>
                    <p>
                        <?php echo $account->getError( Constants::$nameCharacterLength); ?>
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstName" id="firstName" placeholder="Ex: John" value = "<?php getInputValue('firstName')?>" required>
                    </p>
                    <p>
                        <?php echo $account->getError( Constants::$nameCharacterLength); ?>
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastName" id="lastName" placeholder="Ex: Doe"  value = "<?php getInputValue('lastName')?>" required>
                    </p>
                    <p>
                        <?php echo $account->getError( Constants::$emailDoNotMatch); ?>
                        <?php echo $account->getError( Constants::$emailInvalid); ?>
                        <?php echo $account->getError( Constants::$emailExists); ?>
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" placeholder="Ex: johnDoe@example.com" value = "<?php getInputValue('email')?>"  required>
                    </p>
                    <p>
                        <label for="email_conf">Confirm E-mail</label>
                        <input type="email" name="email_conf" id="email_conf" placeholder="Ex: johnDoe@example.com" value = "<?php getInputValue('email_conf')?>"  required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$passwordTooShort); ?>
                        <?php echo $account->getError(Constants::$passwordTooSimple); ?>
                        <label for="Password">Password</label>
                        <input type="password" name="Password" id="Password" placeholder= "Your Password" required>
                        <p></p>
                        <span>Must contain Upper and lowercase, $ or !, and a Numeric Character. Min Length: 8 characters</span>
                    </p>
                    <p>
                        <label for="Password-conf">Confirm Password</label>
                        <input type="password" name="Password-conf" id="Password-conf" placeholder="Re-enter Password" required>
                    </p>
                    <button type="submit" name="registerButton">Sign Up</button>
                    <div class="hasAccountText">
                        <span id="hideRegister">Already have an account? Log in Here</span>
                    </div>
                </form>
            </div>
            <div id="loginText">
                <h1>Listen to great music, right now!</h1>
                <h2>All great content at one place</h2>
                <ul>
                    <li>Discover your kind of music</li>
                    <li>Create your playlist</li>
                    <li>Follow your favourite artists</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>