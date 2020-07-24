<?php
    include("includes/includedFiles.php");
?>

<div class="playlistsContainer">
    <div class="gridViewContainer">
        <h2>Playlists</h2>
        <div class="buttonItems">
            <button class="button green" onclick="createPlaylist();">NEW PLAYLIST</button>
        </div>
        <?php 
            $username = $userLoggedIn->getUsername();
            $playlistsQuery = "SELECT * FROM playlists WHERE owner = '$username'";
            $resultplaylistsQuery = mysqli_query($conn, $playlistsQuery);
            if(mysqli_num_rows($resultplaylistsQuery) == 0) {
                echo "<span class='noResults'>You don't have any playlist yet</span>";
            }
            while($row = mysqli_fetch_array($resultplaylistsQuery)) {
                $playlist = new Playlist($conn,$row);
                echo "
                <div class='gridViewItem'>
                    <div class='playlistImage'>
                        <img src='assets/images/icons/playlist.png' alt='playlist-icon' class=''>
                    </div>
                    <div class='gridViewInfo'>
                        ".$playlist->getName()."
                    </div>
                </div>
                ";
            }
        ?>
    </div>
</div>