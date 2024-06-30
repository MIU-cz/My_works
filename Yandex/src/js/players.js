const playersCards = document.querySelector(".players_cards_wraper");
const playerCard = {
	mainFoto: "src/img/main/img-player.png",
	mainDescription: "Чемпион мира по шахматам",
	specDescription: "Гроссмейстер",
	player: [
		{ id: "hoze", name: "Хозе-Рауль Капабланка" },
		{ id: "emmanuil", name: "Эммануил Ласкер" },
		{ id: "alex", name: "Александр Алехин" },
		{ id: "aron", name: "Арон Нимцович" },
		{ id: "rihard", name: "Рихард Рети" },
		{ id: "ostap", name: "Остап Бендер" },
	],
};

const addPlayers = () => {
	let cardsHTML = "",
		dsc = playerCard.mainDescription;

	for (let player of playerCard.player) {
		if (player.id == "ostap") {
			dsc = playerCard.specDescription;
		}
		cardsHTML += `
            <div class="player_card" id="${player.id}">
                <figure class="card_img">
                    <img src="${playerCard.mainFoto}" alt="player foto"
                        onmouseover="this.src='src/img/players/img-player-${player.id}.png'"
                        onmouseout="this.src='${playerCard.mainFoto}'">
                </figure>
                <h3 class="card_name txt_player_name">${player.name}</h3>
                <p class="card_dsc txt_player_description">${dsc}</p>
                <a href="#${player.id}" class="card_btn txt_player_btn">Подробнее</a>
            </div>
        `;
	}

	playersCards.innerHTML = cardsHTML;
};

// window.addEventListener("load", addPlayers);
addPlayers();

// ============================
// ### Slider
const card = document.querySelector(".player_card"),
	cards = document.querySelectorAll(".player_card"),
	playersCol = cards.length,
	playerPrev = document.getElementById("playerPrev"),
	playerNext = document.getElementById("playerNext"),
	cardNum = document.querySelector(".card_num"),
	cardNumOf = document.querySelector(".txt_player_pag-from");

let playersOnPage = 0,
	playerItem = 0;

function updatePlayers() {
	playersOnPage = Math.round(playersCards.clientWidth / card.clientWidth);
	// playerItem = playersOnPage;
	cardNum.textContent = playersOnPage + playerItem;
	cardNumOf.textContent = " / " + playersCol;

    // console.log(playerItem);
	// console.log(card.clientWidth);
}

function PlayersMove() {
	playersCards.style.transform = `translateX(${-1 * (card.clientWidth * playerItem)}px)`;
    cardNum.textContent = playersOnPage + playerItem;

	// console.log(playerItem);
	// console.log(card.clientWidth);
}

function PlayerNext() {
	playerItem += playersOnPage;
	if (playerItem >= playersCol) {
		playerItem = 0;
	}
	PlayersMove();
}

function PlayerPrev() {
	playerItem -= playersOnPage;
	if (playerItem < 0) {
		playerItem = playersCol - playersOnPage;
	}
	PlayersMove();
}

playerNext.addEventListener("click", PlayerNext);
playerPrev.addEventListener("click", PlayerPrev);
setInterval(PlayerNext, 4500);

window.addEventListener("load", updatePlayers);
window.addEventListener("resize", function () {
    updatePlayers();
    PlayersMove();
});

// ===> debug
// console.log(playersCards);
// console.log(playersCards.clientWidth);
// console.log(playersCards.scrollWidth);
// console.log(card);
// console.log(card.clientWidth);
// console.log(cards);
// console.log(playersCol);
// console.log("- - -");
