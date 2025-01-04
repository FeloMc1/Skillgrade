const colorBox = document.getElementById('colorBox');
const gameArea = document.getElementById('gameArea');
const colorOptions = document.getElementById('colorOptions');
let attempts = 0;
let correctColor;
let gameInterval;
let timeLeft = 30;
let correctColorDisplayTime = 2000;
let optionsToShow = 4;

const colors = ['red', 'blue', 'green', 'yellow', 'purple', 'orange', 'pink', 'cyan', 'lime'];

function startGame() {
    attempts = 0;
    timeLeft = 30;
    document.getElementById('attempts').textContent = attempts;
    document.getElementById('timeLeft').textContent = timeLeft;

    const difficulty = document.getElementById('difficulty').value;
    setDifficulty(difficulty);

    gameInterval = setInterval(updateTimer, 1000); // Actualiza el temporizador cada segundo
    showColor();
}

function setDifficulty(difficulty) {
    switch (difficulty) {
        case 'easy':
            correctColorDisplayTime = 1500;
            optionsToShow = 9;
            break;
        case 'medium':
            correctColorDisplayTime = 1000;
            optionsToShow = 9;
            break;
        case 'hard':
            correctColorDisplayTime = 500;
            optionsToShow = 9;
            break;
    }
}

function updateTimer() {
    timeLeft--;
    document.getElementById('timeLeft').textContent = timeLeft;

    if (timeLeft <= 0) {
        clearInterval(gameInterval);
        alert("Tiempo agotado. Fin del juego.");
        saveScore(attempts);
    }
}

function showColor() {
    correctColor = colors[Math.floor(Math.random() * colors.length)];
    colorBox.style.backgroundColor = correctColor;

    const maxX = gameArea.offsetWidth - colorBox.offsetWidth;
    const maxY = gameArea.offsetHeight - colorBox.offsetHeight;
    const x = Math.random() * maxX;
    const y = Math.random() * maxY;
    colorBox.style.left = `${x}px`;
    colorBox.style.top = `${y}px`;
    colorBox.style.display = 'block';

    setTimeout(() => {
        colorBox.style.display = 'none';
        showOptions();
    }, correctColorDisplayTime);
}

function showOptions() {
    colorOptions.innerHTML = '';

    const shuffledColors = shuffleArray([...colors]).slice(0, optionsToShow);
    shuffledColors.forEach(color => {
        const colorDiv = document.createElement('div');
        colorDiv.className = 'colorOption';
        colorDiv.style.backgroundColor = color;
        colorDiv.addEventListener('click', () => selectColor(color));
        colorOptions.appendChild(colorDiv);
    });
}

function selectColor(selectedColor) {
    attempts++;
    document.getElementById('attempts').textContent = attempts;

    if (selectedColor === correctColor) {
        showColor();
    } else {
        clearInterval(gameInterval);
        alert("Incorrecto. El juego ha terminado.");
        saveScore(attempts);
    }
}

function saveScore(score) {
    document.getElementById('scoreInput').value = score;
    document.getElementById('scoreForm').submit();
}

function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

document.getElementById('startGame').addEventListener('click', startGame);
