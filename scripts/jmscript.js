let score = 0;
let difficulty = 1;  // Nivel de dificultad inicial (Fácil por defecto)
let timeLeft = 30;
let correctAnswer;
const timerElement = document.getElementById('timer');
const feedbackElement = document.getElementById('feedback');
const mathChallengeElement = document.getElementById('mathChallenge');
const answerInputElement = document.getElementById('answer');
const difficultySelect = document.getElementById('difficultySelect');
const startButton = document.getElementById('startGame');

// Función para generar una pregunta aleatoria según el nivel de dificultad
function generateQuestion() {
    let num1, num2;
    let operator;
    
    // Definir el tipo de operación basada en la dificultad
    if (difficulty === 1) { // Fácil (solo sumas)
        operator = '+';
        num1 = Math.floor(Math.random() * 10) + 1;
        num2 = Math.floor(Math.random() * 10) + 1;
    } else if (difficulty === 2) { // Medio (suma y resta)
        operator = Math.random() > 0.5 ? '+' : '-';
        num1 = Math.floor(Math.random() * 20) + 1;
        num2 = Math.floor(Math.random() * 20) + 1;
    } else if (difficulty === 3) { // Difícil (suma, resta y multiplicación)
        operator = ['+', '-', '*'][Math.floor(Math.random() * 3)];
        num1 = Math.floor(Math.random() * 50) + 1;
        num2 = Math.floor(Math.random() * 50) + 1;
    } else { // Muy Difícil (incluye división)
        operator = ['+', '-', '*', '/'][Math.floor(Math.random() * 4)];
        num1 = Math.floor(Math.random() * 100) + 1;
        num2 = Math.floor(Math.random() * 100) + 1;
    }

    // Generar la pregunta
    mathChallengeElement.textContent = `¿Cuánto es ${num1} ${operator} ${num2}?`;
    
    // Evaluar la respuesta correcta
    if (operator === '+') {
        return num1 + num2;
    } else if (operator === '-') {
        return num1 - num2;
    } else if (operator === '*') {
        return num1 * num2;
    } else if (operator === '/') {
        // Asegurarse de que la división sea exacta
        return num1 % num2 === 0 ? num1 / num2 : Math.round(num1 / num2);
    }
}

// Función para iniciar el temporizador
function startTimer() {
    const timer = setInterval(() => {
        timeLeft--;
        timerElement.textContent = timeLeft;
        if (timeLeft <= 0) {
            clearInterval(timer);
            feedbackElement.textContent = "Tiempo agotado.";
            saveScore(score);
        }
    }, 1000);
}

// Función para guardar la puntuación
function saveScore(score) {
    document.getElementById('scoreInput').value = score;
    document.getElementById('scoreForm').submit();
}

// Manejo del evento de enviar respuesta
document.getElementById('submitAnswer').addEventListener('click', () => {
    const answer = parseInt(answerInputElement.value);
    if (answer === correctAnswer) {
        // Incremento de puntuación según dificultad
        score += difficulty * (timeLeft > 10 ? 3 : 1);
        feedbackElement.textContent = "¡Correcto!";

        correctAnswer = generateQuestion();
    } else {
        feedbackElement.textContent = "Incorrecto. Intenta de nuevo.";
    }

    // Limpiar el input
    answerInputElement.value = '';
});

// Cambiar la dificultad cuando el usuario la selecciona
difficultySelect.addEventListener('change', () => {
    difficulty = parseInt(difficultySelect.value);
    feedbackElement.textContent = '';
    timerElement.textContent = '30'; // Restablecer el tiempo
});

// Iniciar el reto cuando el usuario haga clic en "Comenzar"
startButton.addEventListener('click', () => {
    // Restablecer puntaje y tiempo
    score = 0;
    timeLeft = 30;
    feedbackElement.textContent = '';
    
    // Iniciar el juego
    correctAnswer = generateQuestion();
    startTimer();
});
