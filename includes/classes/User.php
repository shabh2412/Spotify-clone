<?php
    class User {
        private $conn;
        private $username;
        public function __construct($conn, $username){
            $this->conn = $conn;
            $this->username = $username;
        }
        public function getUsername()
        {
            return $this->username;
        }
        public function getFirstAndLastName()
        {
            $query = mysqli_query($this->conn, "SELECT concat(firstName, ' ', lastName) AS name FROM users WHERE username = '$this->username'");
            $row = mysqli_fetch_array($query);
            return $row['name'];
        }
    }
?>