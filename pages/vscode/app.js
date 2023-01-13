
// extension #1 THEMES

const themeApply = document.getElementById("themeApply");
const themeText = document.getElementById("themeText");
const themeImg = document.getElementById("themeImg");

const theme = () => {
    if (themeImg.src.match("./media/themeAfter.png")) {
        themeImg.src = './media/themeBefore.png';
        themeText.innerText = "The original VSCode look";
        themeApply.innerText = "Apply Theme!";
        themeApply.style.backgroundColor = "transparent";
        themeApply.style.border = "1px solid white";
    } else {
        themeImg.src = './media/themeAfter.png';
        themeText.innerText = "Modified VSCode look";
        themeApply.innerText = "Remove Theme";
        themeApply.style.backgroundColor = "var(--blue)";
        themeApply.style.border = "1px solid var(--blue)";
    }
};

themeApply.addEventListener("click", theme);

// extension #2 THEMES

const prettierApply = document.getElementById("prettierApply");
const prettierText = document.getElementById("prettierText");
const prettierImg = document.getElementById("prettierImg");

const prettier = () => {
    if (prettierImg.src.match("./media/prettierAfter.png")) {
        prettierImg.src = './media/prettierBefore.png';
        prettierText.innerText = "The original VSCode look";
        prettierApply.innerText = "Apply Extensions!";
        prettierApply.style.backgroundColor = "transparent";
        prettierApply.style.border = "1px solid white";
    } else {
        prettierImg.src = './media/prettierAfter.png';
        prettierText.innerText = "Text Formatter Installed  ";
        prettierApply.innerText = "Remove Extensions";
        prettierApply.style.backgroundColor = "var(--blue)";
        prettierApply.style.border = "1px solid var(--blue)";
    }
};

prettierApply.addEventListener("click", prettier);

