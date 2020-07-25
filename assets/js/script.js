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
var fromTopTen = false;

$(document).click(function(click){
    target = $(click.target);
    if(!target.hasClass("item") && !target.hasClass("optionsButton")) {
        hideOptionsMenu();
    }
})

$(window).scroll(function() {
    hideOptionsMenu();
});

$(document).on("change", "select.playlist", function(){
    var playlistId = $(this).val();
    var songId = $(this).prev(".songId").val();

    console.log("playlistId : " + playlistId);
    console.log("songId : " + songId);
});

// Below code is responsible for changing pages dynamically

function openPage(url) {
    if(timer != null) {
        clearTimeout(timer);
    }
    if(url.indexOf("?") == -1){
        url = url + "?";
    }
    var encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
    $("#mainContent").load(encodedUrl);
    $("body").scrollTop(0);
    history.pushState(null, null, url);
}

function createPlaylist(){
    var popup = prompt("Please enter a name for your playlist");
    if(popup!=""){
        $.post("includes/handlers/ajax/createPlaylist.php",{name: popup, username: userLoggedIn})
        .done(function(error){
            if(error != "") {
                alert(error);
                return;
            }
            openPage('yourMusic.php');
        });
    } else {
        return;
    }
}
// code to show optionsMenu
function showOptionsMenu(button) {
    var songId = $(button).prevAll(".songId").val(); //takes value from the ancestor element which has the class of songId
    var menu = $(".optionsMenu");
    var menuWidth = menu.width();
    menu.find(".songId").val(songId);
    var scrollTop = $(window).scrollTop(); // distance from top of window to top of your document
    var elementOffset = $(button).offset().top; //distance from the top of the document
    var top = elementOffset - scrollTop;
    var left = $(button).position().left - menuWidth;
    menu.css({
        "top": top + "px",
        "left":left +"px",
        "display": "inline"
    });
}

function hideOptionsMenu() {
    var menu = $(".optionsMenu");
    if(menu.css("display") != "none"){
        menu.css("display", "none");
    }
}

function deletePlaylist(playlistId) {
    var prompt = confirm("Do you want to delete your playlist?");
    if (prompt) {
        $.post("includes/handlers/ajax/deletePlaylist.php",{playlistId: playlistId})
        .done(function(error){
            if(error != "") {
                alert(error);
                return;
            }
            openPage('yourMusic.php');
        });
    } else {
        console.log("DON'T DELETE");
    }
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