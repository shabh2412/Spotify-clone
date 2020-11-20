<?php
    include("../../config.php");
    if(isset($_POST['playlistId']) && isset($_POST['songId']) ){
        $playlistId = $_POST['playlistId'];
        $songId = $_POST['songId'];
        $query = mysqli_query($conn, "DELETE FROM playlistSongs WHERE playlistId = '$playlistId' AND songId = '$songId'");
    } else {
        echo "Oops, Something Went Wrong!";
        echo "Playlist ID or SongId was not passed into removeFromPlaylist.php file!";
    }
?>