<?php
    class Song {
        private $conn;
        private $id;
        private $mysqliData;
        private $title;
        private $artistId;
        private $genre;
        private $duration;
        private $albumId;
        private $path;
        public function __construct($conn, $id){
            $this->conn = $conn;
            $this->id = $id;
            $albumQuery = "SELECT * FROM songs WHERE id = '$this->id'";
            $resultAlbumQuery = mysqli_query($this->conn, $albumQuery);
            $this->mysqliData = mysqli_fetch_array($resultAlbumQuery);
            $this->title = $this->mysqliData['title'];
            $this->artistId = $this->mysqliData['artist'];
            $this->albumId = $this->mysqliData['album'];
            $this->genre = $this->mysqliData['genre'];
            $this->duration = $this->mysqliData['duration'];
            $this->path = $this->mysqliData['path'];
        }
        
        public function getTitle()
        {
            return $this->title;
        }
        public function getArtist()
        {
            return new Artist($this->conn, $this->artistId);
        }
        public function getAlbum()
        {
            return new Album($this->conn, $this->albumId);
        }
        public function getPath()
        {
            return $this->path;
        }
        public function getMysqliData()
        {
            return $this->mysqliData;
        }
        public function getGenre()
        {
            return $this->genre;
        }
    }
?>