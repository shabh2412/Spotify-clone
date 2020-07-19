var currentPlaylist = Array();
var shufflePlaylist = Array();
var tempPlaylist = Array();
var audioElement;
var mousedown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;
var timer;

// Below code is responsible for changing pages dynamically

function openPage(url) {
    if(timer != null) {
        clearTimeout(timer);
        console.log("Timer Stopped");
    }
    if(url.indexOf("?") == -1){
        url = url + "?";
    }
    var encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
    $("#mainContent").load(encodedUrl);
    $("body").scrollTop(0);
    history.pushState(null, null, url);
}

function formatTime(seconds){
    var time = Math.round(seconds);
    var minutes = Math.floor(time/60); //rounds down
    var seconds = time - (minutes * 60);
    if(seconds<10){
        seconds = "0" + seconds;
    }
    return minutes + ":" + seconds;
}

function updateProgressBar(audio){
    $(".progressTime.current").text(formatTime(audio.currentTime));
    $(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime));
    var progress = (audio.currentTime / audio.duration)*100;
    // console.log(progress);
    $(".playbackBar .progressBar .progress").css("width",progress+"%");
}

function updateVolumeProgressBar(audio){
    var volume = audio.volume *100;
    // console.log(volume);
    $(".volumeBar .progress").css("width",volume+"%");

}

function playFirstSong(){
    setTrack(tempPlaylist[0], tempPlaylist, true);
}



function Audio() {

    this.currentlyPlaying;
    this.audio = document.createElement('audio');

    this.audio.addEventListener("ended", function(){
        nextSong();
    });

    this.audio.addEventListener("canplay", function(){
        var duration = formatTime(this.duration)
        $(".progressTime.remaining").text(duration);
    });

    this.audio.addEventListener("timeupdate", function(){
        if(this.duration){
            updateProgressBar(this);
        }
    });

    this.audio.addEventListener("volumechange",function(){
        updateVolumeProgressBar(this);
    });

    this.setTrack = function (track) {
        this.currentlyPlaying = track;
        this.audio.src = track.path;
    }

    this.play = function() {
        this.audio.play();
    }
    this.pause = function() {
        this.audio.pause();
    }

    this.setTime = function(seconds){
        this.audio.currentTime = seconds;
    }

}