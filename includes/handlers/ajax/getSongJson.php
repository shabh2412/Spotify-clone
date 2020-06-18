<?php
    include('../../config.php');
    if(isset($_POST['songId'])){
        $songId = $_POST['songId'];
        $songQuery = "SELECT * FROM songs WHERE id = '$songId'";
        $resultSongQuery = mysqli_query($conn, $songQuery);
        $resultArray = mysqli_fetch_array($resultSongQuery);
        $songJsonList = json_encode($resultArray);
        echo $songJsonList;
    }

?>