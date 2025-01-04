const words = ['rápido', 'teclado', 'prueba', 'juego', 'velocidad', 'habilidad', 'fuerza', 'precisión'];
const gameArea = document.getElementById('gameArea');
const userInput = document.getElementById('userInput');
const scoreDisplay = document.getElementById('score');
const difficultySelect = document.getElementById('difficultySelect');
let score = 0;
let activeWords = [];
let gameInterval;  // Para detener el intervalo de palabras generadas

let difficultySettings = {
    easy: {
        spawnInterval: 2000,  // Palabras aparecen cada 2 segundos
        fallSpeed: 3,  // Palabras caen lentamente
    },
    normal: {
        spawnInterval: 1500,  // Palabras aparecen cada 1.5 segundos
        fallSpeed: 5,  // Velocidad normal
    },
    hard: {
        spawnInterval: 1000,  // Palabras aparecen cada 1 segundo
        fallSpeed: 7,  // Palabras caen rápidamente
    }
};

function startGame() {
    const difficulty = difficultySelect.value;
    const settings = difficultySettings[difficulty];

    userInput.value = '';
    score = 0;
    scoreDisplay.textContent = score;
    activeWords = [];
    gameArea.innerHTML = ''; // Limpiar el área de juego

    spawnWords(settings);
}

function spawnWords(settings) {
    // Generar palabras a intervalos ajustados según la dificultad
    gameInterval = setInterval(() => {
        if (activeWords.length >= 10) {
            clearInterval(gameInterval);
            endGame();
            return;
        }

        let randomWord = words[Math.floor(Math.random() * words.length)];
        let wordElement = document.createElement('div');
        wordElement.className = 'word';  // Clase para estilo y tamaño fijo
        wordElement.textContent = randomWord;

        // Posiciona la palabra en la parte superior del área de juego
        wordElement.style.top = '0%'; // Comienza en la parte superior
        wordElement.style.left = Math.random() * 90 + '%'; // Distribución aleatoria en el ancho

        gameArea.appendChild(wordElement);
        activeWords.push({
            element: wordElement,
            fullWord: randomWord,
            currentWord: randomWord,  // Esta propiedad mantiene la palabra original
            topPosition: 0,  // Inicia en la parte superior
        });

        // Mover la palabra con la velocidad de caída según la dificultad
        moveWord(wordElement, settings.fallSpeed);

        // Remover palabra si llega al fondo (100% de la altura del área de juego)
        let checkInterval = setInterval(() => {
            if (parseFloat(wordElement.style.top) >= 100) {
                gameArea.removeChild(wordElement);
                activeWords = activeWords.filter(word => word.element !== wordElement);
                clearInterval(checkInterval); // Detener el chequeo de posición
                endGame();  // Fin del juego cuando la palabra llega al fondo
            }
        }, 100);
    }, settings.spawnInterval); // Nueva palabra con intervalos según la dificultad
}

function moveWord(wordElement, fallSpeed) {
    let wordObj = activeWords.find(word => word.element === wordElement);
    let movementInterval = setInterval(() => {
        if (parseFloat(wordElement.style.top) < 100) {
            wordElement.style.top = (parseFloat(wordElement.style.top) + fallSpeed * 0.1) + '%'; // Movimiento hacia abajo
        } else {
            clearInterval(movementInterval); // Detener el movimiento cuando llegue al final
        }
    }, 30); // 30ms por cada movimiento
}

userInput.addEventListener('input', () => {
    let input = userInput.value.trim().toLowerCase();

    // Recorremos las palabras activas
    for (let i = 0; i < activeWords.length; i++) {
        let wordObj = activeWords[i];

        // Si la palabra coincide con la entrada del usuario
        if (wordObj.fullWord.toLowerCase().startsWith(input)) {
            // Cortamos la palabra por lo que el jugador ha escrito
            wordObj.currentWord = wordObj.fullWord.slice(input.length);

            // Actualizamos el contenido de la palabra en la pantalla
            wordObj.element.textContent = wordObj.currentWord;

            // Si la palabra está completamente escrita, la eliminamos
            if (wordObj.currentWord === '') {
                gameArea.removeChild(wordObj.element);
                activeWords = activeWords.filter(word => word.element !== wordObj.element);
                score++;
                scoreDisplay.textContent = score;
                userInput.value = ''; // Limpiamos el campo de entrada
                break;
            }
        }
    }
});

function endGame() {
    alert('¡Juego terminado! Puntaje final: ' + score);
    saveScore(score);  // Guardar el puntaje
    resetGame();
}

function resetGame() {
    userInput.value = '';
    activeWords.forEach(wordObj => gameArea.removeChild(wordObj.element));
    activeWords = [];
    clearInterval(gameInterval); // Detener el intervalo de palabras
}

// Enviar el puntaje al servidor mediante un formulario
function saveScore(score) {
    document.getElementById('scoreInput').value = score;
    document.getElementById('scoreForm').submit();
}

document.getElementById('startGame').addEventListener('click', startGame);
