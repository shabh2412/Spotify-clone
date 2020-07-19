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
        
        public function getSongIds()
        {
            $query = "SELECT id FROM Songs WHERE artist = '$this->id' ORDER BY plays DESC";
            $queryResult = mysqli_query($this->conn, $query);
            $array = array();
            while($row = mysqli_fetch_array($queryResult)){
                array_push($array,$row['id']);
            }
            return $array;
        }

        public function getId()
        {
            return $this->id;
        }
    }
?>