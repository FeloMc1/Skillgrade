<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juegos Mentales - SkillGrade 2.0</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/jmstyle.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container text-center">
        <h2>Juegos Mentales</h2>
        <a class="btn btn-success " href="lb_juegosmentales.php">Ver tabla de puntuaciones</a>
        <div>
            <label for="difficultySelect">Selecciona dificultad:</label>
            <select id="difficultySelect" class="form-select w-50 mx-auto mb-3">
                <option value="1" selected>Fácil</option>
                <option value="2">Medio</option>
                <option value="3">Difícil</option>
                <option value="4">Muy Difícil</option>
            </select>
        </div>
        <!-- Botón para comenzar -->
        <button class="btn btn-success mb-3" id="startGame">Comenzar</button>
        <a href="index.html" class="btn btn-danger mb-2">Regresar</a>
        <p id="mathChallenge" class="tex1">¿Cuánto es 7 + 8?</p>
        <p>Tiempo restante: <span id="timer">30</span> segundos</p>
        <input type="text" id="answer" class="form-control" placeholder="Escribe tu respuesta">
        <button class="btn btn-primary mt-3" id="submitAnswer">Enviar Respuesta</button>
        <p id="feedback"></p>
    </div>
    
    <form id="scoreForm" action="save_jm_score.php" method="POST" style="display: none;">
        <input type="hidden" name="score" id="scoreInput">
    </form>

    <script src="scripts/jmscript.js"></script>
</body>
</html>
