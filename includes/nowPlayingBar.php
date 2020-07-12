<?php 
// PHP Code for selecting 10 songs at Random. 
    $songQuery = "SELECT id FROM Songs ORDER BY plays DESC LIMIT 10";
    // $songQuery = "SELECT id FROM Songs ORDER BY RAND() LIMIT 10";
    // $songQuery = "SELECT id from Songs where album = 7";
    $songQueryResult = mysqli_query($conn, $songQuery);
    $resultArray = array();
    $i=0;
    while($row = mysqli_fetch_array($songQueryResult)){
        array_push($resultArray, $row['id']);
    }
    $jsonArray = json_encode($resultArray);
    // echo "<script>console.log($jsonArray+' Hello')</script>"
?>

<script>
    $(document).ready(function (){
        var newPlaylist = <?php echo $jsonArray;?>;
        audioElement = new Audio();
        setTrack(newPlaylist[0],newPlaylist, false);
        updateVolumeProgressBar(audioElement.audio);

        $("#nowPlayingBar").on("mousedown touchstart mousemove touchmove", function(e){
            e.preventDefault();
        });
        
        $('.playbackBar .progressBar').mousedown(function() {
            mousedown = true;
        });
        $('.playbackBar .progressBar').mousemove(function(e) {
            if(mousedown == true){
                // set time of song depending on the position of mouse
                timeFromOffset(e, this);
            }
        });
        $('.playbackBar .progressBar').mouseup(function(e) {
            timeFromOffset(e, this);
            mousedown = false;
        });
        $('.volumeBar .progressBar').mousedown(function() {
            mousedown = true;
        });
        $('.volumeBar .progressBar').mousemove(function(e) {
            if(mousedown == true){
                var percentage = e.offsetX / $(this).width();
                if(percentage>=0 && percentage<=1){
                    audioElement.audio.volume = percentage;
                }
            }
        });
        $('.volumeBar .progressBar').mouseup(function(e) {
            var percentage = e.offsetX / $(this).width();
            if(percentage>=0 && percentage<=1){
                audioElement.audio.volume = percentage;
            }
            mousedown = false;
        });

    });

    function timeFromOffset(mouse, progressBar){
        var percentage = (mouse.offsetX / $(progressBar).width());
        var seconds = audioElement.audio.duration * (percentage);
        audioElement.setTime(seconds);

    }

    function prevSong() {
        if(audioElement.audio.currentTime >= 3 || currentIndex == 0){
            audioElement.setTime(0);
        } 
        else{
            if(repeat == true) {
                audioElement.setTime(0);
                playSong();
            }
            else{
                currentIndex = currentIndex - 1;
            }
        }
        var trackToPlay = currentPlaylist[currentIndex];
        setTrack(trackToPlay, currentPlaylist, true);
    }

    function nextSong() {
        if(repeat == true) {
            audioElement.setTime(0);
            playSong();
            return;
        }
        if(currentIndex == currentPlaylist.length - 1){
            currentIndex = 0;
        }
        else{
            currentIndex = currentIndex + 1;
        }
        var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
        setTrack(trackToPlay, currentPlaylist, true);
    }
    
    function setRepeat() {
        repeat = !repeat;
        var imageName = repeat ? "repeat-active.png" : "repeat.png";
        $(".controlButton.repeat img").attr("src","assets/images/icons/"+imageName);
    }
    function setMute() {
        audioElement.audio.muted = !audioElement.audio.muted;
        var imageName = audioElement.audio.muted ? "volume-mute.png" : "volume.png";
        $(".controlButton.volume img").attr("src","assets/images/icons/"+imageName);
    }
    function setShuffle() {
        shuffle = !shuffle;
        var imageName = shuffle ? "shuffle-active.png" : "shuffle.png";
        $(".controlButton.shuffle img").attr("src","assets/images/icons/"+imageName);
        // console.log(currentPlaylist);
        // console.log(shufflePlaylist);
        if(shuffle) {
            // randomize playlist
            shuffleArray(shufflePlaylist);
            currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
            
        } else {
            // go back to normal playlist
            currentIndex = currentlyPlaylist.indexOf(audioElement.currentlyPlaying.id);
        }
    }

    function shuffleArray(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
    return a;
}
    
    function setTrack(trackId, newPlaylist, play){

        if(newPlaylist != currentPlaylist) {
            currentPlaylist = newPlaylist;
            shufflePlaylist = currentPlaylist.slice();
            shuffleArray(shufflePlaylist);
        }
        
        if (shuffle == true) {
            currentIndex = shufflePlaylist.indexOf(trackId);
        }
        else {
            currentIndex = currentPlaylist.indexOf(trackId);
        }
        pauseSong();
        // audioElement.setTrack("assets/music/NiceToMeetYa-Official.mp3");
        // ajax code below
        $.post("includes/handlers/ajax/getSongJson.php", {songId : trackId}, function(data) {
            // creating a JSON object, we will parse the data in to a json object
            track = JSON.parse(data);
            $(".trackInfo .trackName span").text(track.title);

            $.post("includes/handlers/ajax/getArtistJson.php", {artistId : track.artist}, function(data) {
                var artist = JSON.parse(data);
                // console.log(artist);
                $(".artistName span").text(artist.name);
            });
            $.post("includes/handlers/ajax/getAlbumJson.php", {albumId : track.album}, function(data) {
                var album = JSON.parse(data);
                // console.log(album);  // for testing purpose
                $("#nowPlayingLeft .content .albumLink img").attr("src",album.artworkPath);
            });

            audioElement.setTrack(track);
        });
        if(play){
            audioElement.play();
        }
        
    }

    function playSong() {
        if(audioElement.audio.currentTime == 0){
            // console.log("Update Count");
            $.post("includes/handlers/ajax/updatePlayCount.php", {songId : audioElement.currentlyPlaying.id});
        } else{
            console.log("Don't Update");
        }
        $(".controlButton.play").hide();
        $(".controlButton.pause").show();
        audioElement.play()
    }

    function pauseSong() {
        $(".controlButton.play").show();
        $(".controlButton.pause").hide();
        audioElement.pause()
    }

</script>

<div id="nowPlayingBarContainer">
    <div id="nowPlayingBar">
        <div id="nowPlayingLeft" >
            <div class="content">
                <span class="albumLink">
                    <img src="" alt="" class="albumArtwork">
                </span>

                <div class="trackInfo">
                    <span class="trackName">
                        <span></span>
                    </span>

                    <span class="artistName">
                        <span></span>
                    </span>
                </div>
            </div>
        </div>
        <div id="nowPlayingCenter" >
            <div class="content playerControls">
                <div class="buttons">
                    <button class="controlButton shuffle" title="Shuffle Button">
                        <img src="assets/images/icons/shuffle.png" alt="Shuffle" onclick="setShuffle()">
                    </button>

                    <button class="controlButton previous" title="Previous Button" onclick="prevSong()">
                        <img src="assets/images/icons/previous.png" alt="Previous">
                    </button>

                    <button class="controlButton play" title="Play Button" onclick="playSong()">
                        <img src="assets/images/icons/play.png" alt="Play">
                    </button>

                    <button class="controlButton pause" title="Pause Button" style="display: none;" onclick="pauseSong()">
                        <img src="assets/images/icons/pause.png" alt="Pause">
                    </button>

                    <button class="controlButton next" onclick="nextSong()" title="Next Button">
                        <img src="assets/images/icons/next.png" alt="Next">
                    </button>

                    <button class="controlButton repeat" title="repeat Button" onclick="setRepeat()">
                        <img src="assets/images/icons/repeat.png" alt="Repeat">
                    </button>
                </div>
                <div class="playbackBar">
                    <span class="progressTime current">0.00</span>
                    <div class="progressBar">
                        <div class="progressBarBg">
                            <div class="progress"></div>
                        </div>
                    </div>

                    <span class="progressTime remaining">0.00</span>
                </div>
            </div>
        </div>
        <div id="nowPlayingRight" >
            <div class="volumeBar">
                <button class="controlButton volume" title="Volume Button" onclick="setMute()">
                    <img src="assets/images/icons/volume.png" alt="Volume">
                </button>
                
                <div class="progressBar">
                    <div class="progressBarBg">
                        <div class="progress"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>