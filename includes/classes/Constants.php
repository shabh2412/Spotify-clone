<?php class Constants {
    
    // password err msgs
    public static $passwordsDoNotMatch = "Both password need to match";
    public static $passwordTooShort = "Password needs to be of at least 8 digits!";
    public static $passwordTooSimple = "Password needs to consist of a lowercase, uppercase, numeric and a \"! or ?\"";


    // email err msgs
    public static $emailInvalid = "Email is invalid";
    public static $emailDoNotMatch = "Both the email need to match";
    public static $emailExists = "This email is already in use";
    

    // username err msgs
    public static $nameCharacterLength = "Your First and Last Name must be between 2 and 25 characters";
    public static $usernameCharacterLength = "Your username must be between 5 and 25 characters";
    public static $usernameTaken = "Username already exists";
    
    
    
    public static $loginFailed = "Your username or password was incorrect";
}


?>