<?php
    class Account {
        private $emVal = '/^[a-zA-Z0-9_.-]+@[a-z.-]{3,16}\.[a-z]{2,5}/';
        private $pwdVal = '/(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])(?=.*[!?])[a-zA-Z0-9!?]{8,}/';
        private $errorArray;
        public function __construct(){
            $this -> errorArray = array();
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
                return true;
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
        private function validateUsername($userName){
            if(strlen($userName) > 25 || strlen($userName) < 5){
                array_push($this->errorArray, "Your username must be between 5 and 25 characters");
                return;
            } 
            //TODO : check if username exists
        }
        private function validateName($name){
            if(strlen($name) > 25 || strlen($name) < 2){
                array_push($this->errorArray, "Your First and Last Name must be between 2 and 25 characters");
                return;
            } 
    
        }
        private function validateEmail($em1 , $em2){
            if ($em1 != $em2) {
                array_push($this->errorArray, "Both the email need to match");
                return;
            } else{
                if(!preg_match($this->emVal, $em1)){
                    array_push($this->errorArray, "Email is invalid");
                    return;
                }
                // TODO : Check that email id hasn't already been used.
            }

        }
        private function validatePassword($pwd1, $pwd2){
            if($pwd1 != $pwd2) {
                array_push($this -> errorArray, "Both password need to match");
                return;
            } else {
                if (!preg_match($this -> pwdVal, $pwd1)) {
                    array_push( $this -> errorArray, "Password needs to consist of a lowercase, uppercase, numeric and a \"! or ?\"");
                }
            }
        }
    }
?>