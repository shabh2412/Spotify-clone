<?php include("includes/header.php");?>

<h1 class="pageHeadingBig">You Might Also Like</h1>

<div class="gridViewContainer">
    <?php 
        $albumQuery = "SELECT * FROM albums";
        $resultAlbumQuery = mysqli_query($conn, $albumQuery);
        while($row = mysqli_fetch_array($resultAlbumQuery)) {
            echo $row['title']."<br>";
        }
    ?>
</div>



<?php include("includes/footer.php")?>