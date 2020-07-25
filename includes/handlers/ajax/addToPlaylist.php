<?php
    include("../../config.php");
    if(isset($_POST['playlistId']) && isset($_POST['songId'])){
        $playlistId = $_POST['playlistId'];
        $songId = $_POST['songId'];
        $orderId = mysqli_query($conn, "SELECT max(playlistOrder) + 1 AS playlistOrder FROM playlistSongs WHERE playlistId = '$playlistId'");
        $row = mysqli_fetch_array($orderId);
        $order = $row['playlistOrder'];
        $query = mysqli_query($conn, "INSERT INTO playlistSongs VALUES ('', '$songId', '$playlistId', '$order')");
        
    } else {
        echo "Oops, Something Went Wrong!";
        echo "Playlist ID or Song ID was not passed into this addToPlaylist.php!";
    }
?>