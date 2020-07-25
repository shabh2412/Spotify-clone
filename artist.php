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
    <div class="centerSection borderBottom">
        <div class="artistInfo">
            <h1 class="artistName">
                <?php
                    echo $artist->getName();
                ?>
            </h1>
            <div class="headerButtons">
                <button class="button green" onclick="playFirstSong()">PLAY SONGS FROM THIS ARTIST</button>
            </div>
        </div>
    </div>
</div>
<div class="tracklistContainer borderBottom">
    <h2>Trending Songs of this Artist</h2>
    <ul class="tracklist">
        <?php
            $songIdArray = $artist->getSongIds();
            $i = 1;
            foreach($songIdArray as $songId){
                if($i > 5){
                    break;
                }
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
                        <input type='hidden' class='songId' value= '". $artistSong->getId()."'>
                        <img src='assets/images/icons/more.png' alt='More Info' class='optionsButton' role='link' onclick='showOptionsMenu(this)'>
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

<div class="gridViewContainer">
    <h2>Albums</h2>
    <?php 
        $albumQuery = "SELECT * FROM albums WHERE artist = '$artistId'";
        $resultAlbumQuery = mysqli_query($conn, $albumQuery);
        while($row = mysqli_fetch_array($resultAlbumQuery)) {
            echo "
            <div class='gridViewItem'>
                <span role='link' tabindex='0' onclick='openPage(\"album.php?id=".$row['id']."\")'>
                    <img src=".$row['artworkPath']." alt=''>
                    <div class='gridViewInfo'>
                        ".$row['title']."
                    </div>
                </span>
            </div>
            ";
        }
        ?>
</div>

<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <?php echo Playlist::getPlaylistDropdown($conn,$userLoggedIn->getUsername())?>
</nav>