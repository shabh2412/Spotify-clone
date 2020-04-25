<?php
    class Account {
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
        }
        private function validateUsername($userName){
            if(strlen($userName) > 25 || strlen($userName) < 5){
                array_push($this->errorArray, "Your username must be between 5 and 25 characters");
                return;
            } 
            //TODO : check if username exists
        }
        private function validateName($name){
    
        }
        private function validateEmail($em1 , $em2){
    
        }
        private function validatePassword($pwd1, $pwd2){
    
        }
    }
?>