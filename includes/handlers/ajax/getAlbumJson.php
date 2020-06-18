<?php
    include('../../config.php');
    if(isset($_POST['albumId'])){
        $albumId = $_POST['albumId'];
        $albumQuery = "SELECT * FROM albums WHERE id = '$albumId'";
        $resultAlbumQuery = mysqli_query($conn, $albumQuery);
        $resultArray = mysqli_fetch_array($resultAlbumQuery);
        $albumJsonList = json_encode($resultArray);
        echo $albumJsonList;
    }
?>