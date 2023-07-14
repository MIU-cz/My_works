const game = () => {
  const bird = document.querySelector(".bird");
  const gameDisplay = document.querySelector(".game-container");
  const ground = document.querySelector(".ground");
  const gameOverAlert = document.querySelector(".gameOverAlert");
  const scoreSign = document.querySelector(".score-sign");

  let birdLeft = 220;
  let birdBottom = 100;
  let gravity = 2;
  let isGameOver = false;
  let gap = 430;
  let score = 0;

  const startGame = () => {
    birdBottom -= gravity;
    bird.style.bottom = birdBottom + "px";
    bird.style.left = birdLeft + "px";
  };
  let gameTimerId = setInterval(startGame, 20);

  const control = (e) => {
    if (e.keyCode === 32) {
      jump();
    }
  };

  const jump = () => {
    if (birdBottom < 500) {
      birdBottom += 60;
      bird.style.WebkitTransitionDuration = ".1s";
      bird.style.webkitTransform = birdBottom + "px";
    }
  };

  document.addEventListener("click", jump);
  document.addEventListener("keyup", control);

  const generateObstacle = () => {
    let obstacleLeft = 500;
    let randomHeight = Math.random() * 150;
    let obstacleBottom = randomHeight;
    const obstacle = document.createElement("div");
    const topObstacle = document.createElement("div");
    obstacle.classList.add("obstacle");
    topObstacle.classList.add("topObstacle");
    gameDisplay.appendChild(obstacle);
    gameDisplay.appendChild(topObstacle);
    obstacle.style.left = obstacleLeft + "px";
    topObstacle.style.left = obstacleLeft + "px";
    obstacle.style.bottom = obstacleBottom + "px";
    topObstacle.style.bottom = obstacleBottom + gap + "px";

    const moveObstacle = () => {
      if (!isGameOver) {
        obstacleLeft -= 3;
        obstacle.style.left = obstacleLeft + "px";
        topObstacle.style.left = obstacleLeft + "px";
      }

      if (obstacleLeft === 200) {
        score += 1;
      }

      if (obstacleLeft === -55) {
        clearInterval(TimerId);
        gameDisplay.removeChild(obstacle);
        gameDisplay.removeChild(topObstacle);
      }
      if (
        (obstacleLeft > 200 &&
          obstacleLeft < 280 &&
          birdLeft === 220 &&
          (birdBottom < obstacleBottom + 150 ||
            birdBottom > obstacleBottom + gap - 200)) ||
        birdBottom === 0
      ) {
        gameOver();
      }
    };
    let TimerId = setInterval(moveObstacle, 20);
    setTimeout(generateObstacle, 2000);
  };

  generateObstacle();

  const crashed = () => {
    bird.style.WebkitTransitionDuration = ".5s";
    bird.style.webkitTransform = "rotate(50deg)";
    bird.animate(
      {
        bottom: 0,
      },
      5000
    );
  };

  const gameOver = () => {
    crashed();
    clearInterval(gameTimerId);
    isGameOver = true;
    document.removeEventListener("keyup", control);
    document.removeEventListener("click", jump);
    gameOverAlert.style.display = "flex";
    const reload = () => {
      window.location.reload();
    };
    setTimeout(() => {
      document.addEventListener("keyup", reload);
      document.addEventListener("click", reload);
      scoreSign.style.display = "flex";
      scoreSign.innerHTML = "SCORE: " + score;
    }, 1000);
  };
};

let isGameRunning = false;
const startSign = document.querySelector(".start-sign");

const runGame = (e) => {
  if ((e.keyCode === 32 || e.type === "click") && !isGameRunning) {
    isGameRunning = true;
    startSign.style.display = "none";
    game();
  }
};

document.addEventListener("click", runGame);
document.addEventListener("keyup", runGame);
