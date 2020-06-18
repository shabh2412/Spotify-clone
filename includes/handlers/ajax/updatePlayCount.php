<?php
    include('../../config.php');
    if(isset($_POST['songId'])){
        $songId = $_POST['songId'];
        $Query = "UPDATE Songs SET plays = plays + 1 WHERE id = '$songId'";
        $updateCount = mysqli_query($conn, $Query);
    }
?>