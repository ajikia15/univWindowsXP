// DATA STRUCTURES PROTOTYPE #2

const music = [
    {
        bandName: "Cannibal Corpse",
        songName: "Skull full of maggots",
        songDuration: "2:06",
        imgLink: "/media/cc-eaten.jpg",
        songLink: './music/cc.mp3',
        color: "rgb(158, 3, 3)"
    },
    {
        bandName: "Brodequin",
        songName: "Spinning In Agony",
        songDuration: "2:35",
        imgLink: '/media/brodequin.webp',
        songLink: "./music/brodeq.mp3",
        color: "#848383"
    },
    {
        bandName: "ჩიხლაძეები",
        songName: "კართან მოდგა შემოდგომა",
        songDuration: "2:49",
        imgLink: '/media/kartanmodga.jpg',
        songLink: "./music/chikh.mp3",
        color: "#4fa970"
    },
    {
        bandName: "Napalm Death",
        songName: "You Suffer",
        songDuration: "0:02",
        imgLink: '/media/napalm.jpg',
        songLink: "./music/napalm.mp3",
        color: "rgb(178, 178, 4)"
    },
    {
        bandName: "ABBA",
        songName: "Take A Chance On Me",
        songDuration: "3:58",
        imgLink: '/media/abba.webp',
        songLink: "./music/abba.mp3",
        color: "#446795"
    },
    {
        bandName: "Aqua",
        songName: "Barbie Girl",
        songDuration: "3:18",
        imgLink: '/media/barb.webp',
        songLink: "./music/barb.mp3",
        color: "#025EAB"
    },
    {
        bandName: "ივერია",
        songName: "გზა დაგვილოცე",
        songDuration: "3:18",
        imgLink: '/media/gzadagviloce.webp',
        songLink: "./music/gzadagviloce.mp3",
        color: "#797B87"
    },
    {
        bandName: "Cypis",
        songName: "Gdzie jest biały węgorz?",
        songDuration: "4:04",
        imgLink: '/media/pcow.jpg',
        songLink: "./music/pcow.mp3",
        color: "#FFFDFF"
    },
    {
        bandName: "ჯანსუღ კახიძე",
        songName: "საარშიყო",
        songDuration: "2:01",
        imgLink: '/media/jansug.jpg',
        songLink: "./music/jansug.mp3",
        color: "#FE0000"
    },
    {
        bandName: "The Beatles",
        songName: "Hey Jude",
        songDuration: "4:43",
        imgLink: '/media/abbey.webp',
        songLink: "./music/heyjude.mp3",
        color: "#5C504A"
    },
    {
        bandName: "System Of A Down",
        songName: "Lonely Day",
        songDuration: "2:53",
        imgLink: '/media/soad.jpg',
        songLink: "./music/soad.mp3",
        color: "#714B2A"
    },
    {
        bandName: "შუქი მოვიდა",
        songName: "რატომ წახვედი",
        songDuration: "5:07",
        imgLink: '/media/shuqimovida.jpg',
        songLink: "./music/shuqimovida.mp3",
        color: "#F7F0C8"
    },
    {
        bandName: "ივერია",
        songName: "ზესტაფონო",
        songDuration: "1:38",
        imgLink: '/media/zestafono.webp',
        songLink: "./music/zestafono.mp3",
        color: "#51670E"
    },
    {
        bandName: "დაგდაგანი",
        songName: "თენგიზი",
        songDuration: "4:40",
        imgLink: '/media/tengizi.jpg',
        songLink: "./music/tengizi.mp3",
        color: "#7D7D7D"
    }
];
//  TO ACCESS console.log(music[0].bandName); 
// GRADIENT ANIMATION

const gradiable = document.getElementById("gradiable");
const children1 = document.querySelectorAll('.play-button');

let musicLength = document.getElementById('length');
const playPause = document.getElementById('playPause');

const audioElement = new Audio();
const bar = document.querySelector('progress-bar')
for (let child1 of children1) {
    child1.addEventListener('click', function () {

        var grandParent = this.parentNode.parentNode;
        let j = grandParent.id;
        var pic = document.querySelector('.music-player-pic');
        var names = document.querySelector('.music-player-names');
        document.documentElement.style.setProperty('--from-grad', `${music[j].color}`);
        gradiable.style.backgroundPosition = '50% 0';

        names.innerHTML = '<p>' + music[j].songName + '</p>' + '<p>' + music[j].bandName + '</p>';
        pic.innerHTML = '<img src=".' + music[j].imgLink + '">';

        document.documentElement.style.setProperty('--mus-len', `${music[j].songDuration}`);
        musicLength.innerHTML = music[j].songDuration;

        playPause.innerHTML = '<ion-icon name="pause-circle"></ion-icon>'

        audioElement.src = music[j].songLink;
        audioElement.play();


        // if (audioElement.paused) {
        //     bar.classList.add('playing');
        // } else {
        //     bar.classList.remove('playing');
        // }
    });

}
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
// display the info on button click