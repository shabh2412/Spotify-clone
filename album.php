<?php include("includes/header.php");

    if(isset($_GET['id'])){
        $albumId = $_GET['id'];

    } else {
        header("location:index.php");
    }

    $albumQuery = "SELECT * FROM albums WHERE id = '$albumId'";
    $resultAlbumQuery = mysqli_query($conn, $albumQuery);
    $album = mysqli_fetch_array($resultAlbumQuery);

    $artist = new Artist($conn, $album['artist']);


    echo $album['title']."<br>";
    echo $artist -> getName();

?>






<?php include("includes/footer.php")?>