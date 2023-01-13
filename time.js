window.onload = function currentTime() {
    let date = new Date();
    let hh = date.getHours();
    let mm = date.getMinutes();
    let ss = date.getSeconds();
    let time = hh + ":" + mm + ":" + ss;
    document.getElementById("clock").innerText = time;
    let t = setTimeout(function () { currentTime() }, 1000);
}