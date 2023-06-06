<?php
   session_start();
   require_once './db_connection.php';
   $profilePictures = [
  1 => 'profile1.jpg',
  2 => 'profile2.jpg',
  3 => 'profile3.jpg',
  4 => 'profile4.jpg',
  5 => 'profile5.jpg',
  6 => 'profile6.jpg'
];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WinXP</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/57543b4ac4.js" crossorigin="anonymous"></script>
    <script defer src="./time.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="./favicon.png">
</head>

<body>
    <div class="pc1">
        <div class="pc">
            <div class="desktop p-3 text-white">
                <a class="prog flex flex-col items-center " id="minecraft" onclick="openTab('./pages/minecraft/minecraft.html')">
                    <div class="ico">
                        <img src="./media/icominecraft.png" alt="" class="">
                        <img src="./media/icoshortcut.png" alt="" class="arrow">
                        <!-- https://classic.minecraft.net/ -->
                    </div>
                    <p>Minecraft</p> 
                </a>
                <a class="prog flex flex-col items-center " id="prog" onclick="openTab('./pages/nvidia/nvidia.html')">
                    <div class="ico">
                        <img src="./media/iconvidia.png" alt="" class="">
                        <img src="./media/icoshortcut.png" alt="" class="arrow">
                    </div>
                    <p>Geforce Exper...
                    </p>
                </a>
                <!--TEMPORARY-->
                <div class="placeholder"></div>
                <a class="prog flex flex-col items-center " id="prog" onclick="openTab('./pages/chrome/chrome.html')">
                    <div class="ico">
                        <img src="./media/icochrome.png" alt="" class="">
                        <img src="./media/icoshortcut.png" alt="" class="arrow">
                    </div>
                    <p>Chrome</p>
                </a>
                <a class="prog flex flex-col items-center " id="prog" onclick="openTab('./pages/firefox/firefox.html')">
                    <div class="ico">
                        <img src="./media/icofirefox.png" alt="" class="">
                        <img src="./media/icoshortcut.png" alt="" class="arrow">
                    </div>
                    <p>Firefox</p>
                </a>
                <!--TEMPORARY-->
                <div class="placeholder"></div>
                <a class="prog flex flex-col items-center " id="prog" onclick="openTab('./pages/vscode/vscode.html')">
                    <div class="ico">
                        <img src="./media/code.png" alt="" class="">
                        <img src="./media/icoshortcut.png" alt="" class="arrow">
                    </div>
                    <p>VScode</p>
                </a>
                <a class="prog flex flex-col items-center" id="prog" onclick="openTab('./pages/spotify/spotify.php')">
                    <div class="ico">
                        <img src="./media/icospotify.png" alt="" class="">
                        <img src="./media/icoshortcut.png" alt="" class="arrow">
                    </div>
                    <p>Spotify</p>
                </a>
                <!--TEMPORARY-->
                <div class="placeholder"></div>


                <a class="prog flex flex-col items-center "  id="prog" onclick="openTab('./pages/word/word.html')">
                    <div class="ico">
                        <img src="./media/icoword.png" alt="" class="">
                        <img src="./media/icoshortcut.png" alt="" class="arrow">
                    </div>
                    <p>Word</p>
                </a>
                <!--TEMPORARY-->
                <div class="placeholder"></div>
                <!-- Placeholders -->
                <div class="prog1" id="placeholder">
                    <div class="ico">
                        <img src="./media/icoblank.png" alt="" class="">
                        <img src="./media/icoblank.png" alt="" class="arrow">
                    </div>
                </div>
                <div class>
                    <div class="ico">
                        <img src="./media/icoblank.png" alt="" class="">
                        <img src="./media/icoblank.png" alt="" class="arrow">
                    </div>
                </div>
                <div class="prog1" id="prog1"> <!--placeholder to put recyclying bin in the end-->
                    <div class="ico">
                        <img src="./media/icoblank.png" alt="" class="">
                        <img src="./media/icoblank.png" alt="" class="arrow">
                    </div>
                </div>
                <a class="prog flex flex-col items-center" id="prog" onclick="openTab('./')">
                    <div class="ico">
                        <img src="./media/icotrash.png" alt="" class="">
                        <img src="./media/icoshortcut.png" alt="" class="arrow">
                    </div>
                    <p class="">Recycling Bin</p>
                </a>
            </div>
            <!-- ONCLICK OPEN TAB AAAAAAAAAAAAAAAAAa-->
            <div class="window" id="window">
                <div class="w1">
                    <div class="windowContr">
                        <button id="minimize" onclick="minimizeTab()">-</button>
                        <button id="maximize" onclick="maximizeTab()">&#9634</button>
                        <button id="exit" onclick="exitTab()">X</button>
                    </div>
                    <div class="windowContent">
                        <iframe src="" frameborder="0" id="iframeId"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="startmenu" id="startMenu">
            <div class="startMenuTop">
                <img class="pfp" src="media/<?php echo $profilePictures[$_SESSION['profile_picture']]; ?>"> 
                <p id="name"><?php echo $_SESSION['username']; ?></p>
            </div>
            <div class="startMenuContent">
                <div class="startHalf">
                </div>
                <div class="startHalf2">
                    <a class="startHalfProg" href="https://www.facebook.com/jikiaaleksander">
                        <img src="./media/icofacebook.png" alt="">
                        <p>Facebook</p>
                    </a>
                    <a class="startHalfProg" href="https://www.instagram.com/jikiaaleksander/">
                        <img src="./media/instagram.png" alt="">
                        <p>Instagram</p>
                    </a>
                </div>
            </div>
            <a href="index.php" class="h-2/5 ml-auto mr-2 my-4 rounded-xl aspect-square flex flex-row">
                <img src="media/turnoff.png">
            </a>
        </div>
        <div class="taskbar">
            <div id="start">
                <img src="./media/xpicon.png" alt="">
                <p>Start</p>
            </div>
            <div class="wra">
                <i class="fa-solid fa-grip-lines-vertical fa-2xl"></i>
            </div>
            <div class="tabs">
                <div class="acttab">
                    <div class="">
                        <img src="./media/icofolder.png" alt="">
                    </div>
                    <div class="">
                        <p class="t">IBSU</p>
                    </div>
                </div>
                <div></div>
                <div></div>
                <div></div>
                <div class="time">
                    <div class="icons flex flex-row gap-x-3">
                        <img src="./media/icowifi.png" alt="">
                        <img src="./media/icospeaker.png" alt="">
                    </div>
                    <div id="clock" onload="currentTime()">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./uh.js"></script>
</body>

</html>