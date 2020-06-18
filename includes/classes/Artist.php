<?php
    class Artist {
        private $conn;
        private $id;
        public function __construct($conn, $id){
            $this->conn = $conn;
            $this -> id = $id;
        }
        
        public function getName()
        {
            $artistQuery = "SELECT name FROM artists WHERE id = '$this->id'";
            $resultArtistQuery = mysqli_query($this -> conn, $artistQuery);
            $artist = mysqli_fetch_array($resultArtistQuery);
            return $artist['name'];
        }
    }
?>