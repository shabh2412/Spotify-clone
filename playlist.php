<?php include("includes/includedFiles.php");

    if(isset($_GET['id'])){
        $playlistId = $_GET['id'];
        echo "<script>console.log('$playlistId')</script>";
    } else {
        header("location:index.php");
        
    }

    $playlist = new Playlist($conn, $playlistId);

    $owner = new User($conn,$playlist->getOwner());

?>

<div class="entityInfo">
    <div class="leftSection">
        <img src="assets/images/icons/playlist.png" alt="">
    </div>
    <div class="rightSection">
        <h2>
            <?php
                echo $playlist->getName();
            ?>
        </h2>
        <span>By <?php echo $playlist->getOwner();?></span>
        <p> <?php echo $playlist->getNumberOfSongs();?> Songs</p>
        <button class="button">DELETE PLAYLIST</button>
        <button class="button">PLAY SONGS</button>
    </div>
</div>

<div class="tracklistContainer">
    <ul class="tracklist">
        <?php
            $songIdArray = array();//$album->getSongIds();
            $i = 1;
            foreach($songIdArray as $songId){
                $albumSong = new Song($conn, $songId);
                $albumArtist = $albumSong->getArtist();
                echo "<li class='tracklistRow'>
                    <div class='trackCount'>
                        <img src='assets/images/icons/play-white.png' alt='Play' class='play' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
                        <span class='trackNumber'>$i</span>
                    </div>

                    <div class='trackInfo'>
                        <span class='trackName'>".$albumSong->getTitle()."</span>
                        <span class='artistName'>".$albumArtist->getName()."</span>
                    </div>
                    
                    <div class='trackOptions'>
                        <img src='assets/images/icons/more.png' alt='More Info' class='optionsButton'>
                    </div>

                    <div class='trackDuration'>
                        <span class='duration'>".$albumSong->getDuration()."</span>
                    </div>

                </li>";
            $i = $i + 1;
            }
        ?>
        <script>
            var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
            tempPlaylist = JSON.parse(tempSongIds);
            // console.log("The Id's -> ",tempPlaylist);  //For testing the playlist
        </script>
    </ul>
</div>