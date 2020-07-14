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
    <div class="centerSection">
        <div class="artistInfo">
            <h1 class="artistName">
                <?php
                    echo $artist->getName();
                ?>
            </h1>
            <div class="headerButtons">
                <button class="button green">PLAY SONGS FROM THIS ARTIST</button>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="tracklistContainer">
    <ul class="tracklist">
        <?php
            $songIdArray = $artist->getSongIds();
            $i = 1;
            foreach($songIdArray as $songId){
                $artistSong = new Song($conn, $songId);
                $artistArtist = $artistSong->getArtist();
                echo "<li class='tracklistRow'>
                    <div class='trackCount'>
                        <img src='assets/images/icons/play-white.png' alt='Play' class='play' onclick='setTrack(\"" . $artistSong->getId() . "\", tempPlaylist, true)'>
                        <span class='trackNumber'>$i</span>
                    </div>

                    <div class='trackInfo'>
                        <span class='trackName'>".$artistSong->getTitle()."</span>
                        <span class='artistName'>".$artistArtist->getName()."</span>
                    </div>
                    
                    <div class='trackOptions'>
                        <img src='assets/images/icons/more.png' alt='More Info' class='optionsButton'>
                    </div>

                    <div class='trackDuration'>
                        <span class='duration'>".$artistSong->getDuration()."</span>
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