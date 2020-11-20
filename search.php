<?php
    include("includes/includedFiles.php");
    if(isset($_GET['term'])) {
        $term = urldecode($_GET['term']);
    } else {
        $term = "";
    }
?>

<div class="searchContainer">
    <h4>
        Search for an Artist, Album, or a Song
    </h4>
    <input type="text" class="searchInput" value="<?php echo $term;?>" placeholder="Start Typing..." onfocus="var val=this.value; this.value=''; this.value= val;">
</div>

<script>
    $(".searchInput").focus();
    $(function(){
        $(".searchInput").keyup(function () {
            clearTimeout(timer);
            timer = setTimeout(function() {
                var val = $(".searchInput").val();
                openPage("search.php?term=" + val);
            }, 2000); //wait 2 sec and execute the code.
        });
    });
</script>

<?php
// if nothing is search don't display any result
    if($term==""){
        exit();
    }
?>
<div class="tracklistContainer borderBottom">
    <h2>Songs</h2>
    <ul class="tracklist">
        <?php
            $songsQuery = mysqli_query($conn, "SELECT id FROM Songs WHERE title LIKE '$term%' LIMIT 10");
            if(mysqli_num_rows($songsQuery) == 0) {
                echo "<span class='noResults'> No Songs found matching \"". $term ."\"</span>" ; 
            }
            $songIdArray = array();
            $i = 1;
            while($row = mysqli_fetch_array($songsQuery)){
                if($i > 15){
                    break;
                }
                array_push($songIdArray, $row['id']);
                $artistSong = new Song($conn, $row['id']);
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

<div class="artistsContainer borderBottom">
            <h2>Artists</h2>
            <?php
                $artistQuery = mysqli_query($conn, "SELECT id FROM artists WHERE name LIKE '$term%' LIMIT 10");
                if(mysqli_num_rows($artistQuery) == 0) {
                    echo "<span class='noResults'> No Artist found matching \"". $term ."\"</span>";
                }
                while($row = mysqli_fetch_array($artistQuery)) {
                    $artistFound = new Artist($conn, $row['id']);
                    echo 
                    "<div class='searchResultRow'>
                        <div class='artistName'>
                            <span role='link' tabIndex='0', onclick='openPage(\"artist.php?id=".$artistFound->getId()."\")'>".
                            $artistFound->getName()
                            ."</span>
                        </div>
                    </div>";
                }
            ?>
</div>

<div class="gridViewContainer">
    <h2>Albums</h2>
    <?php 
        $albumQuery = "SELECT * FROM albums WHERE title LIKE '$term%' LIMIT 10";
        $resultAlbumQuery = mysqli_query($conn, $albumQuery);
        if(mysqli_num_rows($resultAlbumQuery) == 0) {
            echo "<span class='noResults'> No Album found matching \"". $term ."\"</span>";
        }
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