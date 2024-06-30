// ################################
// Stage slider

const btnNext = document.getElementById("stgNext"),
	btnPrev = document.getElementById("stgPrev"),
	pugContainer = document.querySelector(".pugination_btn"),
	sliderBlock = document.querySelector(".stage_stages"),
	sliderLine = document.querySelector(".stages_wraper");

let blockWidth = 0,
	stageItem = 0,
	stageItems = 0,
	pugBtnsItems = "";

function updateStages() {
	blockWidth = sliderBlock.clientWidth + 20;
	let lineLength = sliderLine.scrollWidth;
	stageItems = Math.round(lineLength / blockWidth);

	for (i = 1; i <= stageItems; i++) {
		pugBtnsItems += `
            <button class="pug_btn_item" data-stage="${i}"></button>
        `;
	}

	pugContainer.innerHTML = pugBtnsItems;
	pugBtnsItems = document.querySelectorAll(".pug_btn_item");

	// console.table(blockWidth, lineLength, stageItems);
	// return {stageItems, blockWidth};
}

function moveStageLine() {
	sliderLine.style.transform = `translateX(${-1 * (stageItem * blockWidth)}px)`;
	pugBtnsItems.forEach((btn) => {
		btn.classList.remove("btn_active");
		btn.disabled = false;
	});

	pugBtnsItems[stageItem].classList.add("btn_active");
	pugBtnsItems[stageItem].disabled = true;

	// let move = -1 * stageItem * blockWidth + "px";
	// console.log(stageItem, blockWidth, move);
}

function stageNext() {
	stageItem++;
	if (stageItem >= stageItems) {
		stageItem = 0;
	}
	moveStageLine();
}

function stagePrev() {
	stageItem--;
	if (stageItem < 0) {
		stageItem = stageItems - 1;
	}
	moveStageLine();
}

btnNext.addEventListener("click", stageNext);
btnPrev.addEventListener("click", stagePrev);
pugContainer.addEventListener("click", function (e) {
	stageItem = e.target.dataset.stage - 1;
	moveStageLine();

	// console.log(e.target);
	// console.log(e.currentTarget);
});

window.addEventListener("load", updateStages);
window.addEventListener("resize", updateStages);

