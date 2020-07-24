<?php
    include("../../config.php");

    if(isset($_POST['playlistId'])){
        $playlistId = $_POST['playlistId'];
        $playlistQuery = mysqli_query($conn, "DELETE FROM playlists WHERE id ='$playlistId'");
        $songsQuery = mysqli_query($conn, "DELETE FROM playlistSongs WHERE playlistId = '$playlistId'");
    } else {
        echo "Oops, Something Went Wrong!";
        echo "Playlist ID was not passed into this file!";
    }

?>