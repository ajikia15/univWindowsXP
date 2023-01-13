const startMenu = document.getElementById("startMenu");
const start = document.getElementById("start");
start.addEventListener("click", function () {
    if (startMenu.style.display === "grid") {
        startMenu.style.display = "none";
    } else {
        startMenu.style.display = "grid";
    }
});
function openTab(url) {
    var x = document.getElementById("window");
    if (x.style.display !== "grid") {
        x.style.display = "grid";
    }
    var iframe = document.getElementById('iframeId');
    iframe.src = url;
}
function exitTab() {
    document.getElementById("window").style.display = "none";
    var c = document.getElementById("window");
}
function maximizeTab() {
    var c = document.getElementById("window");
    c.style.margin = 1 + 'px'; // maximize
    c.style.top = 0 + '%';
    c.style.left = 0 + '%';
    c.style.right = 0 + '%';
    c.style.bottom = 4.5 + 'vh';
}
function minimizeTab() {
    var c = document.getElementById("window");

    c.style.margin = 0;
    c.style.top = 15 + '%'; // minimize
    c.style.left = 25 + '%';
    c.style.right = 25 + '%';
    c.style.bottom = 25 + '%';
}