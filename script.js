let words = document.querySelectorAll(".word");

words.forEach((word) => {
    let letters = word.textContent.split("");
    word.textContent = "";

    letters.forEach((letter) => {
        let span = document.createElement("span");
        span.textContent = letter;
        span.className = "letter";
        word.append(span);
    });
});

let currentWordIndex = 0;
let maxWordIndex = words.length - 1;

words[currentWordIndex].style.opacity = "1";

let changeText = () => {
    let currentWord = words[currentWordIndex];
    let nextWord = currentWordIndex === maxWordIndex ? words[0] : words[currentWordIndex + 1];

    Array.from(currentWord.children).forEach((letter, i) => {
        setTimeout(() => {
            letter.className = "letter out";
        },i* 80);
    });

    nextWord.style.opacity = "1";

    Array.from(nextWord.children).forEach((letter, i) => {
        letter.className = "letter behind";
        setTimeout(() => {
            letter.className = "letter in";
        }, 340 + i * 80);
    });

    currentWordIndex = currentWordIndex === maxWordIndex ? 0 : currentWordIndex + 1;
};

changeText();
setInterval(changeText, 3000);


function toggleMenu() {
    const menu = document.querySelector(".menu-links")
    const icon = document.querySelector(".hamburger-icon")
    menu.classList.toggle("open")
    icon.classList.toggle("open")
} 


// var icon= documnet.getElementById("icon");
// icon.onclick= function()
// {
//     document.body.classList.toggle("dark-theme");
//     if(document.body.classList.contains("dark-theme")){
//         icon.src="img/sun.png";
//     }else{
//         icon.src="img/moon.png";
//     }
// }
var icon = document.getElementById("icon");
icon.onclick = function() {
    document.body.classList.toggle("dark-theme");
    if (document.body.classList.contains("dark-theme")) {
        document.getElementById("icon").src = "img/sun.png";
    } else {
        document.getElementById("icon").src = "img/moon.png";
    }
}


// mix it up portfolio section
document.addEventListener('DOMContentLoaded', function() {
    var mixer = mixitup('.portfolio-gallery');
});