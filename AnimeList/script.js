window.addEventListener('load', start);

const $$ = document.querySelectorAll.bind(document);
var starList = [];
var selectedIndex = -1;

function start() {
    starList = Array.from($$('.fa-star'));

    starList.forEach((star, index) => {
        star.addEventListener('mouseover', (event) => mouseOver(index));
        star.addEventListener('mouseout', (event) => mouseOut());
        star.addEventListener('click', (event) => click(index));
    });
}

function mouseOver(index) {
    changeView(index);
}

function mouseOut() {
    changeView(selectedIndex);
}

function click(index) {
    if (index === selectedIndex) {
        selectedIndex = -1;
    } else {
        selectedIndex = index;
    }
    
    changeView(selectedIndex);
}

function changeView(index) {
    starList.forEach(star => {
        star.classList.remove('on');
        star.classList.add('off');
    });

    for (let i = 0; i <= index; i++) {
        starList[i].classList.remove('off');
        starList[i].classList.add('on');
    }
}
