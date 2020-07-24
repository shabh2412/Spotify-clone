<?php
    include("includes/includedFiles.php");
?>

<div class="playlistsContainer">
    <div class="gridViewContainer">
        <h2>PLAYLISTS</h2>
        <div class="buttonItems">
            <button class="button green" onclick="createPlaylist()">NEW PLAYLIST</button>
        </div>

        <?php
        $username = $userLoggedIn->getUsername();
        $playlistQuery = "SELECT * FROM playlists WHERE owner = '$username'";
        $resultPlaylistQuery = mysqli_query($conn, $playlistQuery);
        if(mysqli_num_rows($resultPlaylistQuery) == 0) {
            echo "<span class='noResults'> You don't have any playlists yet </span>";
        }
        while($row = mysqli_fetch_array($resultPlaylistQuery)) {

            $playlist = new Playlist($conn, $row);

            echo "
            <div class='gridViewItem'>

                <div class='playlistImage'>
                    <img src='assets/images/icons/playlist.png'>
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