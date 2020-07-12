<?php 
    include("includes/includedFiles.php");
?>

<h1 class="pageHeadingBig">You Might Also Like</h1>

<div class="gridViewContainer">
    <?php 
        $albumQuery = "SELECT * FROM albums ORDER BY RAND() LIMIT 10";
        $resultAlbumQuery = mysqli_query($conn, $albumQuery);
        while($row = mysqli_fetch_array($resultAlbumQuery)) {
            echo "
            <div class='gridViewItem'>
                <a href='album.php?id=".$row['id']."'>
                    <img src=".$row['artworkPath']." alt=''>
                    <div class='gridViewInfo'>
                        ".$row['title']."
                    </div>
                </a>
            </div>
            ";
        }
        ?>
</div>