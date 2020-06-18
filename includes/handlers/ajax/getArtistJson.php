<?php
    include('../../config.php');
    if(isset($_POST['artistId'])){
        $artistId = $_POST['artistId'];
        $artistQuery = "SELECT * FROM artists WHERE id = '$artistId'";
        $resultArtistQuery = mysqli_query($conn, $artistQuery);
        $resultArray = mysqli_fetch_array($resultArtistQuery);
        $artistJsonList = json_encode($resultArray);
        echo $artistJsonList;
    }
?>