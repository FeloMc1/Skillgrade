const target = document.getElementById('target');
const gameArea = document.getElementById('gameArea');
let attempts = 0;
let score = 0;
let timerInterval;
let startTime;
let targetSize = 50; // Tamaño predeterminado del objetivo
let timeLimit = 30; // Tiempo límite predeterminado en segundos

// Función para iniciar el juego
function startGame() {
    const difficulty = document.getElementById('difficulty').value;
    setDifficulty(difficulty);

    attempts = 0;
    score = 0;
    document.getElementById('attempts').textContent = attempts;
    document.getElementById('score').textContent = score;
    document.getElementById('timer').textContent = '0';
    target.style.width = `${targetSize}px`;
    target.style.height = `${targetSize}px`;
    showTarget();
    startTimer();
}

// Función para ajustar la dificultad
function setDifficulty(difficulty) {
    switch(difficulty) {
        case 'easy':
            targetSize = 70;
            timeLimit = 40;
            break;
        case 'medium':
            targetSize = 50;
            timeLimit = 30;
            break;
        case 'hard':
            targetSize = 30;
            timeLimit = 20;
            break;
    }
}

// Función para mostrar el objetivo en una posición aleatoria
function showTarget() {
    const maxX = gameArea.clientWidth - target.offsetWidth;
    const maxY = gameArea.clientHeight - target.offsetHeight;
    const x = Math.random() * maxX;
    const y = Math.random() * maxY;
    target.style.left = x + 'px';
    target.style.top = y + 'px';
    target.style.display = 'block';
}

// Evento al hacer clic en el objetivo
target.addEventListener('click', (event) => {
    attempts++;
    document.getElementById('attempts').textContent = attempts;

    const targetRect = target.getBoundingClientRect();
    const targetCenterX = targetRect.left + targetRect.width / 2;
    const targetCenterY = targetRect.top + targetRect.height / 2;
    const clickX = event.clientX;
    const clickY = event.clientY;

    const distance = Math.sqrt(Math.pow(clickX - targetCenterX, 2) + Math.pow(clickY - targetCenterY, 2));
    const maxDistance = target.offsetWidth / 2;
    const precisionScore = Math.max(0, Math.floor((1 - distance / maxDistance) * 100));

    score += precisionScore;
    document.getElementById('score').textContent = score;
    showTarget();
});

// Función para iniciar el temporizador
function startTimer() {
    startTime = Date.now();
    timerInterval = setInterval(() => {
        const elapsedTime = Math.floor((Date.now() - startTime) / 1000);
        document.getElementById('timer').textContent = elapsedTime;

        if (elapsedTime >= timeLimit) {
            endGame();
        }
    }, 1000);
}

// Función para finalizar el juego y guardar el puntaje
function endGame() {
    clearInterval(timerInterval);
    target.style.display = 'none';
    saveScore(score);
    alert("Tiempo terminado. Puntaje total: " + score);
}

// Función para guardar el puntaje
function saveScore(score) {
    document.getElementById('scoreInput').value = score;
    document.getElementById('scoreForm').submit();
}

// Evento al hacer clic en el botón de comenzar
document.getElementById('startGame').addEventListener('click', startGame);
