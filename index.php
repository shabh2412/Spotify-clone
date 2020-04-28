<?php include("includes/header.php");?>

<h1 class="pageHeadingBig">You Might Also Like</h1>

<div class="gridViewContainer">
    <?php 
        $albumQuery = "SELECT * FROM albums ORDER BY RAND() LIMIT 10";
        $resultAlbumQuery = mysqli_query($conn, $albumQuery);
        while($row = mysqli_fetch_array($resultAlbumQuery)) {
            echo "
            <div class='gridViewItem'>
                <img src=".$row['artworkPath']." alt=''>
                <div class='gridViewInfo'>
                    ".$row['title']."
                </div>
            </div>
            ";
        }
        ?>
</div>



<?php include("includes/footer.php")?>