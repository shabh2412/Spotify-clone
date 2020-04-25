<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Songtify</title>
</head>
<body>
    <div id="input-container">
        <form action="register.php" id="loginForm" method="POST">
            <h2>Login To Your Account</h2>
            <p>
                <label for="loginUsername">Username</label>
                <input type="text" name="loginUsername" id="loginUsername" placeholder="Ex: johnDoe" required>
            </p>
            <p>
                <label for="loginPassword">Password</label>
                <input type="password" name="loginPassword" id="loginPassword" placeholder="*****" required>
            </p>
            <button type="submit" name="loginButton">Login</button>
        </form>

        <form action="register.php" id="registerForm" method="POST">
            <h2>Create Your Free Account</h2>
            <p>
                <label for="Username">Username</label>
                <input type="text" name="Username" id="Username" placeholder="Ex: johnDoe" required>
            </p>
            <p>
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" id="firstName" placeholder="Ex: John" required>
            </p>
            <p>
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" id="lastName" placeholder="Ex: Doe" required>
            </p>
            <p>
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="Ex: johnDoe@example.com" required>
            </p>
            <p>
                <label for="email_conf">Confirm E-mail</label>
                <input type="email" name="email_conf" id="email_conf" placeholder="Ex: johnDoe@example.com" required>
            </p>
            <p>
                <label for="Password">Password</label>
                <input type="password" name="Password" id="Password" placeholder= "Your Password" required>
            </p>
            <p>
                <label for="Password-conf">Confirm Password</label>
                <input type="password" name="Password-conf" id="Password-conf" placeholder="Re-enter Password" required>
            </p>
            <button type="submit" name="registerButton">Sign Up</button>
        </form>
    </div>
</body>
</html>