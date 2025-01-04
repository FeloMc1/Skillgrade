// Obtener los elementos de los botones y el área de información
const breathingBtn = document.getElementById('breathing-btn');
const meditationBtn = document.getElementById('meditation-btn');
const stretchingBtn = document.getElementById('stretching-btn');
const exerciseInfo = document.getElementById('exercise-info');

// Funciones para mostrar la información del ejercicio seleccionado
function showBreathingExercise() {
exerciseInfo.innerHTML = `
    <h2>Ejercicio de Respiración</h2>
    <p>Siéntate en una posición cómoda. Cierra los ojos y respira profundamente. 
    Inhala por la nariz contando hasta 4, mantén la respiración por 4, y exhala lentamente por la boca contando hasta 4. 
    Repite este proceso por 5 minutos, enfocándote en tu respiración.</p>
`;
}

function showMeditationExercise() {
exerciseInfo.innerHTML = `
    <h2>Meditación Guiada</h2>
    <p>Encuentra un lugar tranquilo y siéntate en una posición cómoda. 
    Cierra los ojos y lleva tu atención a tu respiración. Si tu mente se distrae, suavemente redirige tu atención al flujo de tu respiración. 
    Haz esto por 10-15 minutos para calmar tu mente.</p>
`;
}

function showStretchingExercise() {
exerciseInfo.innerHTML = `
    <h2>Estiramientos Suaves</h2>
    <p>De pie, estira los brazos hacia arriba, alarga la espalda y respira profundamente. Luego, inclínate lentamente hacia adelante para estirar tus piernas. 
    Haz círculos con los hombros hacia atrás y hacia adelante. Mantén cada estiramiento durante al menos 15 segundos y repite varias veces.</p>
`;
}

// Asignar las funciones a los botones
breathingBtn.addEventListener('click', showBreathingExercise);
meditationBtn.addEventListener('click', showMeditationExercise);
stretchingBtn.addEventListener('click', showStretchingExercise);
