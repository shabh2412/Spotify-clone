<?php
    class Account {
        private $conn;
        private $emVal = '/^[a-zA-Z0-9_.-]+@[a-z.-]{3,16}\.[a-z]{2,5}/';
        private $pwdVal = '/(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])(?=.*[!?])[a-zA-Z0-9!?]{8,}/';
        private $errorArray;
        public function __construct($conn){
            $this->conn = $conn;
            $this -> errorArray = array();
        }
        
        public function login($userName, $password)
        {
            $password = md5($password);
            $loginQuery = "SELECT * FROM users WHERE  username = '$userName' AND password = '$password'";
            $loginResult = mysqli_query($this->conn, $loginQuery);
            if(mysqli_num_rows($loginResult) == 1){
                return true;
            } else {
                array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }


        
        public function register($userName,$firstName,$lastName,$email,$email_conf,$password,$password_conf)
        {
            $this -> validateUsername($userName);
            $this -> validateName($firstName);
            $this -> validateName($lastName);
            $this -> validateEmail($email,$email_conf);
            $this -> validatePassword($password, $password_conf);
            if (empty( $this -> errorArray )  ==  true) {
                //Insert into DB
                return $this -> insertUserDetails($userName, $firstName, $lastName, $email, $password);
            } else {
                return false;
            }
        }
        public function getError($error) {
            if (!in_array($error, $this->errorArray)) {
                $error = "";
            }
            return "<span class = 'errorMessage'>$error</span>";
        }
        
        private function insertUserDetails($userName, $firstName, $lastName, $email, $password) {
            $encryptedPassWord = md5($password);
            $profilePic = "assets/images/profile-pics/basic-prof-pic.png";
            $date = date("Y-m-d");
            $sql = "INSERT INTO users (id, username, firstName, lastName, email, password, signupDate, profilePic) VALUES (NULL, '$userName', '$firstName', '$lastName', '$email', '$encryptedPassWord', '$date', '$profilePic')";
            $result = mysqli_query($this->conn, $sql);
            return $result;
        }


        private function validateUsername($userName){
            if(strlen($userName) > 25 || strlen($userName) < 5){
                array_push($this->errorArray, Constants::$usernameCharacterLength);
                return;
            } 
            //TODO : check if username exists
            $checkUserNameQuery = "SELECT username FROM users WHERE username = '$userName'";
            $userNameResult =  mysqli_query($this->conn,$checkUserNameQuery);
            if (mysqli_num_rows($userNameResult) != 0) {
                array_push($this->errorArray, Constants::$usernameTaken);
                return;
            }
        }
        private function validateName($name){
            if(strlen($name) > 25 || strlen($name) < 2){
                array_push($this->errorArray, Constants::$nameCharacterLength);
                return;
            } 
            
        }
        private function validateEmail($em1 , $em2){
            if ($em1 != $em2) {
                array_push($this->errorArray, Constants::$emailDoNotMatch);
                return;
            } else{
                if(!preg_match($this->emVal, $em1)){
                    array_push($this->errorArray, Constants::$emailInvalid);
                    return;
                }
                // TODO : Check that email id hasn't already been used.
                $checkEmailQuery = "SELECT email FROM users WHERE email = '$em1'";
                $emailResult =  mysqli_query($this->conn,$checkEmailQuery);
                if (mysqli_num_rows($emailResult) != 0) {
                    array_push($this->errorArray, Constants::$emailExists);
                    return;
                }
            }
            
        }
        private function validatePassword($pwd1, $pwd2){
            if($pwd1 != $pwd2) {
                array_push($this -> errorArray, Constants::$passwordsDoNotMatch);
                return;
            } else {
                if(strlen($pwd1) < 8){
                    array_push($this -> errorArray, Constants::$passwordTooShort);
                }
                if (!preg_match($this -> pwdVal, $pwd1)) {
                    array_push( $this -> errorArray, Constants::$passwordTooSimple);
                    return;
                }
            }
        }
    }
?>