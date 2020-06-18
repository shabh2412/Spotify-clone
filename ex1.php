<?php include("includes/header.php");
class Album1 {
    private $conn;
    private $albumName = array();
    private $songNames = array();
    public function __construct($conn){
        $this->conn = $conn;
        $albumQuery = "SELECT albums.title AS Album_Name,songs.title AS Song_Name from albums,songs WHERE songs.album = albums.id ORDER BY `albums`.`id` ASC";
        $resultAlbumQuery = mysqli_query($this->conn, $albumQuery);
        $n = 0;
        while($album = mysqli_fetch_array($resultAlbumQuery)){
            if($n == 0){
                $x = $album['Album_Name'];
                $y = $album['Song_Name'];
                array_push($this->albumName, $x);
                array_push($this->songNames, $y);
                $n++;
            } else{
                if($x == $album['Album_Name']){
                    continue;
                } else{
                    $x = $album['Album_Name'];
                    array_push($this->albumName, $x);
                    array_push($this->songNames, $y);
                }
            }
        }
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    public function getSongs()
    {
        $query = "SELECT id FROM songs WHERE album = '$this->id' ORDER BY albumOrder ASC";
        $queryResult = mysqli_query($this->conn, $query);
        $array = array();
        while($row = mysqli_fetch_array($queryResult)){
            array_push($array,$row['id']);
        }
        return $array;
    }
    public function getNumberOfSongs()
    {
        $query = "SELECT * FROM songs WHERE album = '$this->id'";
        $queryResult = mysqli_query($this->conn, $query);
        return mysqli_num_rows($queryResult);
    }
}
new Album1($conn);
?>