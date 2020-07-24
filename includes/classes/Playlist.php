<?php
    class Playlist {
        private $conn;
        private $id;
        private $name;
        private $owner;
        public function __construct($conn, $data){
            $this->conn = $conn;
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->owner = $data['owner'];
        }
        public function getName()
        {
            return $this->name;
        }
        public function getOwner()
        {
            return $this->owner;
        }
        public function getId()
        {
            return $this->id;
        }
        public function getNumberOfSongs(){
            $query = mysqli_query($this->conn, "SELECT songId FROM playlistSongs WHERE playlistId = '$this->id'");
            return mysqli_num_rows($query);
        }
    }
?>