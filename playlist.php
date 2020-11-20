<?php include("includes/includedFiles.php");

    if(isset($_GET['id'])){
        $playlistId = $_GET['id'];

    } else {
        header("location:index.php");
    }

    $playlist = new Playlist($conn, $playlistId);
    $owner = new User($conn, $playlist->getOwner());

?>

<div class="entityInfo">
    <div class="leftSection">
        <div class="playlistImage">
            <img src="assets/images/icons/playlist.png" alt="">
        </div>
    </div>
    <div class="rightSection">
        <h2>
            <?php
                echo $playlist->getName();
            ?>
        </h2>
        <p>By <?php echo $playlist->getOwner();?></p>
        <p><?php echo $playlist->getNumberOfSongs();?> Songs</p>
        <button class="button" onclick="deletePlaylist(<?php echo $playlistId; ?>);">DELETE PLAYLIST</button>
        <button class="button green">PLAY</button>
    </div>
</div>

<div class="tracklistContainer">
    <ul class="tracklist">
        <?php
            $songIdArray = $playlist->getSongIds();
            $i = 1;
            foreach($songIdArray as $songId){
                $playlistSong = new Song($conn, $songId);
                $songArtist = $playlistSong->getArtist();
                echo "<li class='tracklistRow'>
                    <div class='trackCount'>
                        <img src='assets/images/icons/play-white.png' alt='Play' class='play' onclick='setTrack(\"" . $playlistSong->getId() . "\", tempPlaylist, true)'>
                        <span class='trackNumber'>$i</span>
                    </div>

                    <div class='trackInfo'>
                        <span class='trackName'>".$playlistSong->getTitle()."</span>
                        <span class='artistName'>".$songArtist->getName()."</span>
                    </div>
                    
                    <div class='trackOptions'>
                        <input type='hidden' class='songId' value= '". $playlistSong->getId()."'>
                        <img src='assets/images/icons/more.png' alt='More Info' class='optionsButton' role='link' onclick='showOptionsMenu(this)'>
                    </div>

                    <div class='trackDuration'>
                        <span class='duration'>".$playlistSong->getDuration()."</span>
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

<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <?php echo Playlist::getPlaylistDropdown($conn,$userLoggedIn->getUsername())?>
    <div class="item" onclick="removeFromPlaylist(this, '<?php echo $playlistId?>');">Remove From Playlist</div>
</nav>