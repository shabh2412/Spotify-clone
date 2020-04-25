<?php
    class Account {
        public function __construct($userName,$firstName,$lastName,$email,$email_conf,$password,$password_conf)
        {
            $this -> validateUsername($userName);
            $this -> validateName($firstName);
            $this -> validateName($lastName);
            $this -> validateEmail($email,$email_conf);
            $this -> validatePassword($password, $password_conf);
        }
        private function validateUsername($username){
            echo "username function called";
        }
        private function validateName($name){
    
        }
        private function validateEmail($em1 , $em2){
    
        }
        private function validatePassword($pwd1, $pwd2){
    
        }
    }
?>