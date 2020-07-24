<?php
    class Playlist {
        private $conn;
        private $id;
        private $name;
        private $owner;
        public function __construct($conn, $data){
            if(!is_array($data)) {
                // data is an id {String}
                $query = mysqli_query($conn, "SELECT * FROM playlists WHERE id = '$data'");
                $data = mysqli_fetch_array($query);
            }
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
        public function getSongIds()
        {
            $query = "SELECT songId FROM playlistSongs WHERE playlistId = '$this->id' ORDER BY playlistOrder ASC";
            $queryResult = mysqli_query($this->conn, $query);
            $array = array();
            while($row = mysqli_fetch_array($queryResult)){
                array_push($array,$row['songId']);
            }
            return $array;
        }

        public static function getPlaylistDropdown($conn, $username){
            $dropdown = '<select class="item playlist">
                            <option value="">Add to Playlist</option>';
            $query = mysqli_query($conn,"SELECT name FROM playlists WHERE owner = '$username'");
            $arr = array();
            while($row = mysqli_fetch_array($query)){
                array_push($arr,$row['name']);
            }
            $i = 0;
            foreach ($arr as $pName) {
                echo "<option value='$i'>$pName</option>";
                $i++;
            }
            return $dropdown . "</select>";
        }
    }
?>