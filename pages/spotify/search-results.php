    <script src="https://cdn.tailwindcss.com"></script>

<?php
session_start();
require_once '../../db_connection.php';
   if ($_SESSION['username'] == 'Guest') {
       echo '<div class="bg-black w-full text-white h-full grid place-items-center font-bold text-2xl">GO BACK AND LOGIN FIRST</div>';
       exit; // Stop executing the rest of the code
   }
if (isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];

    $query = "SELECT t.*, a.album_name FROM tracks t
              INNER JOIN albums a ON t.album_id = a.album_id
              WHERE t.track_name LIKE :searchTerm";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
    $stmt->execute();

    $tracks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Display the search results
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify</title>

    <link rel="stylesheet" href="./media/style.css">
    <link rel="stylesheet" href="./media/resp.css">
</head>

<body>
    <div class="main">
        <div class="left-navigation-fixed">
            <div class="left-navigation-inner">
                <div class="main-nav">
                    <div class="main-nav-item">
                        <ion-icon name="ellipsis-horizontal-circle"></ion-icon>
                        <h4></h4>
                    </div>
                    <a class="main-nav-item" href="spotify.php">
                        <ion-icon name="home-outline"></ion-icon>
                        <h4>Home</h4>
                    </a>
                        <form action="search-results.php" method="GET" class="main-nav-item">
                            <ion-icon name="search-outline" onclick="toggleSearch()"></ion-icon>
                            <h4 id="searchText" onclick="toggleSearch()">Search</h4>
                            <input type="text" id="searchInput" name="searchTerm" style="display: none; background-color:black; outline:none; border-radius:4px;" required>
                        </form>


                    <div class="main-nav-item">
                        <ion-icon name="bookmarks-outline"></ion-icon>
                        <h4>Your Library</h3>
                    </div>
                    <div class="main-nav-item">
                        <ion-icon name="add-circle-outline"></ion-icon>
                        <h4>Create a Playlist</h4>
                    </div>
                    <div class="main-nav-item">
                        <ion-icon name="heart-circle-outline"></ion-icon>
                        <h4>Liked Songs</h4>
                    </div>
                </div>
                <div class="playlists">
                    <div class="playlists-inner">
                        <div class="playlists-item">
                            <p>Funeral Doom Metal Mix</p>
                        </div>
                        <div class="playlists-item">
                            <p>New York Death Metal</p>
                        </div>
                        <div class="playlists-item">
                            <p>Black Metal Classics</p>
                        </div>
                        <div class="playlists-item">
                            <p>The Sound Of Grindcore</p>
                        </div>
                        <div class="playlists-item">
                            <p>Brutal Death Metal</p>
                        </div>
                        <div class="playlists-item">
                            <p>ქართული ჰანგები</p>
                        </div>
                        <div class="playlists-item">
                            <p>Poser Classics</p>
                        </div>
                        <div class="playlists-item">
                            <p>Avto Songs</p>
                        </div>
                        <div class="playlists-item">
                            <p>ტყუპექსანდრე Favourites</p>
                        </div>
                        <div class="playlists-item">
                            <p>Best Of 2022</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-music" id="gradiable">
            <div class="title">
                <h1>Results</h1>
            </div>
            <div class="big-album-list" style="margin-bottom: 100px;">
               <?php foreach ($tracks as $track): ?>
                    <?php
                        $trackPath = "./music/{$track['track_id']}.mp3";
                    ?>
                    <div class="big-album">
                        <div class="big-album-pic">
                            <img src="./media/<?php echo $track['album_id']; ?>.jpg" alt="">
                            <button class="play-button" onclick="playTrack('<?php echo $trackPath; ?>', <?php echo $track['track_id']; ?>, '<?php echo $track['track_name']; ?>', '<?php echo $track['album_name']; ?>', '<?php echo $track['album_id']; ?>')">
                                <ion-icon name="play"></ion-icon>
                            </button>
                        </div>
                        <div class="big-album-text">
                            <div class="big-album-text-inner">
                                <p><?php echo $track['track_name']; ?></p>
                            </div>
                            <div class="big-album-text-inner">
                                <p><?php echo $track['album_name']; ?></p>
                            </div>
                        </div>
                    </div>
                    <audio id="audio_<?php echo $track['track_id']; ?>" src="<?php echo $trackPath; ?>"></audio>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    </div>
    <div class="music-player-fixed">
        <div class="music-player-inner">
            <div class="music-player-info">
                <div class="music-player-pic">
                    <img id="currentTrackImage" src="" alt="">
                </div>
                <div class="music-player-names">
                    <p id="currentTrackName"></p>
                    <p id="currentAlbumName"></p>
                </div>
            </div>
            <div class="music-controls">
                <div class="music-buttons">
                    <div class="music-buttons-inner">
                        <div class="music-button" id="previous">
                            <ion-icon name="play-skip-back"></ion-icon>
                        </div>
                        <div class="music-button" id="playPause">
                            <ion-icon name="play-circle"></ion-icon>
                        </div>
                        <div class="music-button" id="next">
                            <ion-icon name="play-skip-forward"></ion-icon>
                        </div>
                    </div>
                </div>
                <div class="music-bar-containter">
                    <div>
                        <p class="time" id="current">0:00</p>
                    </div>
                    <div class="">
                        <input type="range" min="0" max="100" value="0" class="progress-bar-container" id="slider">
                    </div>
                    <div>
                        <p class="time" id="length">0:00</p>
                    </div>
                </div>
            </div>
            <div class="music-misc">
                <div>
                    <ion-icon name="document-text-outline"></ion-icon>
                </div>
                <div>
                    <ion-icon name="musical-note-outline"></ion-icon>
                </div>
                <div>
                    <ion-icon name="volume-low-outline"></ion-icon>
                    <input type="range" min="0" max="100" value="100" class="slider" id="vol">
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="app.js"></script> -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
<script>
function toggleSearch() {
  var searchText = document.getElementById("searchText");
  var searchInput = document.getElementById("searchInput");

  if (searchText.style.display === "none") {
    searchText.style.display = "block";
    searchInput.style.display = "none";
  } else {
    searchText.style.display = "none";
    searchInput.style.display = "block";
    searchInput.focus(); // Optionally focus the input field after displaying it
  }
}

var currentlyPlaying = null;
var isPlaying = false;
const playPause = document.getElementById('playPause');
const audioElement = new Audio();
function playTrack(trackPath, trackId, trackName, albumName, albumId) {
    audioElement.src = trackPath;
  const trackImage = document.getElementById('currentTrackImage');
  const trackNameElement = document.getElementById('currentTrackName');
  const albumNameElement = document.getElementById('currentAlbumName');

  if (audioElement.paused) {
    playPause.innerHTML = '<ion-icon name="pause-circle"></ion-icon>';
    audioElement.play();
  } else {
    playPause.innerHTML = '<ion-icon name="play-circle"></ion-icon>';
    audioElement.pause();
    return;
  }
  // Update the currently playing track information
  trackImage.src = `./media/${albumId}.jpg`;
  trackNameElement.innerText = trackName;
  albumNameElement.innerText = albumName;

  // Pause the audio and clear the currently playing track information
  audioElement.addEventListener('ended', function() {
    audioElement.pause();
    audioElement.currentTime = 0;
    playPause.innerHTML = '<ion-icon name="play-circle"></ion-icon>';
    trackImage.src = "";
    trackNameElement.innerText = "";
    albumNameElement.innerText = "";
  });
}

// Attach the click event listener to each play button
playPause.addEventListener('click', function () {
    if (audioElement.paused) {
        playPause.innerHTML = '<ion-icon name="pause-circle"></ion-icon>'
        audioElement.play();
    }
    else {
        playPause.innerHTML = '<ion-icon name="play-circle"></ion-icon>'
        audioElement.pause();
    }
});
let range = document.getElementById("vol");
range.addEventListener("input", function () {
    audioElement.volume = range.value / 100;
});
let slider = document.getElementById("slider");

slider.addEventListener("input", function () {
    audioElement.currentTime = slider.value / 100 * audioElement.duration;
});

audioElement.addEventListener("timeupdate", function () {
    slider.value = audioElement.currentTime / audioElement.duration * 100;
});
</script>