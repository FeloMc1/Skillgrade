const circle = document.getElementById('circle');
const gameArea = document.getElementById('gameArea');
const difficultySelect = document.getElementById('difficulty'); // Selector de dificultad
let attempts = 0;
let timerInterval;
let startTime;
let circleClicked = false;
let clickTimeout;

// Función para iniciar el juego
function startGame() {
    attempts = 0;
    document.getElementById('attempts').textContent = attempts;
    document.getElementById('timer').textContent = '0';
    circleClicked = false;
    showCircle(); // Muestra el círculo
    startTimer(); // Inicia el temporizador
}

// Función para obtener el tiempo límite basado en la dificultad
function getClickTimeLimit() {
    const difficulty = difficultySelect.value;
    if (difficulty === 'easy') return 2000; // 2 segundos para fácil
    if (difficulty === 'medium') return 1000; // 1 segundo para medio
    if (difficulty === 'hard') return 500; // 1/2 segundo para difícil
}

// Función para mostrar el círculo en una posición aleatoria
function showCircle() {
    circleClicked = false; // Restablece la bandera de clic

    // Asegurarse de que el ancho y la altura del contenedor y el círculo se calculan correctamente
    const gameAreaWidth = gameArea.clientWidth;
    const gameAreaHeight = gameArea.clientHeight;
    const circleWidth = circle.offsetWidth;
    const circleHeight = circle.offsetHeight;

    // Calcula una posición aleatoria que mantenga el círculo dentro de los bordes
    const maxX = gameAreaWidth - circleWidth;
    const maxY = gameAreaHeight - circleHeight;
    const x = Math.random() * maxX;
    const y = Math.random() * maxY;

    // Asignar la posición calculada
    circle.style.left = x + 'px';
    circle.style.top = y + 'px';
    circle.style.display = 'block'; // Muestra el círculo

    // Configura un temporizador para que el círculo desaparezca si no se hace clic
    clearTimeout(clickTimeout); // Limpia cualquier temporizador anterior
    clickTimeout = setTimeout(() => {
        if (!circleClicked) { // Si no se hizo clic
            endGame(); // Termina el juego
        }
    }, getClickTimeLimit()); // Tiempo límite según dificultad
}



// Evento al hacer clic en el círculo
circle.addEventListener('click', () => {
    attempts++;
    document.getElementById('attempts').textContent = attempts;
    circleClicked = true; // Cambia la bandera a verdadero
    circle.style.display = 'none'; // Oculta el círculo cuando se hace clic
    showCircle(); // Muestra un nuevo círculo
});

// Función para iniciar el temporizador
function startTimer() {
    startTime = Date.now();
    timerInterval = setInterval(() => {
        const elapsedTime = Math.floor((Date.now() - startTime) / 1000);
        document.getElementById('timer').textContent = elapsedTime;

        if (elapsedTime >= 30) { // Límite de 30 segundos
            endGame(); // Termina el juego
        }
    }, 1000);
}

// Función para terminar el juego
function endGame() {
    clearInterval(timerInterval);
    clearTimeout(clickTimeout); // Limpia el temporizador de clic
    circle.style.display = 'none'; // Asegurarse de ocultar el círculo
    saveScore(attempts); // Guarda el puntaje al final
    alert("Juego terminado. Intentos totales: " + attempts);
}

// Función para guardar el puntaje
function saveScore(score) {
    document.getElementById('scoreInput').value = score;
    document.getElementById('scoreForm').submit();
}

// Evento al hacer clic en el botón de comenzar
document.getElementById('startGame').addEventListener('click', startGame);
