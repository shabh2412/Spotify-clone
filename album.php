<?php include("includes/header.php");

    if(isset($_GET['id'])){
        $albumId = $_GET['id'];

    } else {
        header("location:index.php");
    }

    $albumQuery = "SELECT * FROM albums WHERE id = '$albumId'";
    $resultAlbumQuery = mysqli_query($conn, $albumQuery);
    $album = mysqli_fetch_array($resultAlbumQuery);
    $artistId = $album['artist'];
    $artistQuery = "SELECT * FROM artists WHERE id = '$artistId'";
    $resultArtistQuery = mysqli_query($conn, $artistQuery);
    $artist = mysqli_fetch_array($resultArtistQuery);
    echo $album['title']."<br>";
    echo $artist['name'];

?>






<?php include("includes/footer.php")?>