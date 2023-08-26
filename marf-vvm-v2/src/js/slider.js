const slider = document.querySelector(".gallerie_container");
const imgLine = document.querySelector(".container_line");
const imgs = document.querySelectorAll(".image_container");
const btnBack = document.getElementById("btn-back");
const btnNext = document.getElementById("btn-forward");

let index = 0;
let slideWidth = imgs[index].clientWidth;
let step = 1;

window.addEventListener("resize", function () {
	slideWidth = imgs[index].clientWidth;
});

if (window.matchMedia('(min-width: 1024px)').matches) {
	step = 3;
}

function moveImgLine(index) {
	imgLine.style.transform = `translateX(${-1 * index * slideWidth}px)`;
}

function goToNext() {
	index++;
	if (index > imgs.length - step) {
		index = 0;
	}
	moveImgLine(index);
}

function goToBack() {
	index--;
	if (index < 0) {
		index = imgs.length - step;
	}
	moveImgLine(index);
}

// console.log(index);
// console.log(slideWidth);
// console.log(imgs.length);
// console.log(step);

btnNext.addEventListener("click", goToNext);
btnBack.addEventListener("click", goToBack);