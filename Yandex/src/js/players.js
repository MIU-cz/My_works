const playersCards = document.querySelector(".players_cards_wraper");
const playerCard = {
    mainFoto: "src/img/main/img-player.png",
    mainDescription: "Чемпион мира по шахматам",
    specDescription: "Гроссмейстер",
    player: [
        {id: "hoze", name: "Хозе-Рауль Капабланка"},
        {id: "emmanuil", name: "Эммануил Ласкер"},
        {id: "alex", name: "Александр Алехин"},
        {id: "aron", name: "Арон Нимцович"},
        {id: "rihard", name: "Рихард Рети"},
        {id: "ostap", name: "Остап Бендер"} 
    ]
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

window.addEventListener("load", addPlayers);
