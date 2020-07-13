<?php
    include("includes/includedFiles.php");

    if(isset($_GET['id'])){
        $artistId = $_GET['id'];

    } else {
        header("location:index.php");
    }
    $artist = new Artist($conn,$artistId);
?>

<div class="entityInfo">
    
</div>