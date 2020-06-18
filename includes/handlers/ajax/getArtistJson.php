<?php
    include("../../config.php");
    if(isset($_POST['artistId'])){
        $artistId = $_POST['artistId'];
        $artistQuery = "SELECT * FROM artists WHERE id = '$artistId'";
        $artistQueryResult = mysqli_query($conn, $artistQuery);
        $resultArray = mysqli_fetch_array($artistQueryResult);
        echo json_encode($resultArray);
    }
?>