<?php
    include("includes/includedFiles.php");
    $top10 = mysqli_query($conn,"SELECT id FROM Songs ORDER BY plays DESC LIMIT 10");
    if(mysqli_num_rows($top10)==0){
        echo "Some error occured";
    }
    // $queryResult = mysqli_query($this->conn, $query);
    $TopTenArray = array();
    while($row = mysqli_fetch_array($top10)){
        array_push($TopTenArray,$row['id']);
    }
?>
<script>
    fromTopTen = true;
</script>
<div class="entityInfo">
    <div class="centerSection borderBottom">
        <div class="artistInfo">
            <h1 class="artistName">
                <?php
                    echo "Top 10 Trending Songs";
                ?>
            </h1>
            <div class="headerButtons">
                <button class="button green" onclick="playFirstSong(); openPage('topTen.php')">PLAY</button>
            </div>
        </div>
    </div>
</div>

<div class="tracklistContainer">
    <ul class="tracklist">
        <?php
            $i = 1;
            foreach($TopTenArray as $songId){
                $albumSong = new Song($conn, $songId);
                $albumArtist = $albumSong->getArtist();
                echo "<li class='tracklistRow'>
                    <div class='trackCount'>
                        <img src='assets/images/icons/play-white.png' alt='Play' class='play' onclick='playAndReload(\"". $albumSong->getId() ."\", tempPlaylist); fromTopTen = true;'>
                        <span class='trackNumber'>$i</span>
                    </div>

                    <div class='trackInfo'>
                        <span class='trackName'>".$albumSong->getTitle()."</span>
                        <span class='artistName'>".$albumArtist->getName()."</span>
                    </div>
                    
                    <div class='trackOptions'>
                        <img src='assets/images/icons/more.png' alt='More Info' class='optionsButton'>
                    </div>

                    <div class='songPlays'>
                        <span class='plays'>".$albumSong->getPlays()." Plays</span>
                    </div>

                    <div class='trackDuration'>
                        <span class='duration'>".$albumSong->getDuration()."</span>
                    </div>

                </li>";
            $i = $i + 1;
            }
        ?>
        <script>
            var tempSongIds = '<?php echo json_encode($TopTenArray); ?>';
            tempPlaylist = JSON.parse(tempSongIds);
            // console.log("The Id's -> ",tempPlaylist);  //For testing the playlist
        </script>
    </ul>
</div>

<script>
    function playAndReload(songId, playlistName) {
        setTrack(songId, playlistName, 'true');
    }
</script>