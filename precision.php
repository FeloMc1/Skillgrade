<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Precisión - SkillGrade 2.0</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/precistyle.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container text-center">
        <h2>Entrenamiento de Precisión</h2>
        <p class="tex1">Haz clic en el centro del objetivo verde para obtener la mayor puntuación.</p>
        <a class="btn btn-success " href="lb_precision.php">Ver tabla de puntuaciones</a>
        <br>
        <label for="difficulty">Selecciona la dificultad:</label>
<select id="difficulty" class="form-select w-50 mx-auto mb-3">
    <option value="easy">Fácil</option>
    <option value="medium">Medio</option>
    <option value="hard">Difícil</option>
</select>
        <div id="gameArea">
            <div id="target"></div>
        </div>
        <button class="btn btn-primary mt-3" id="startGame">Comenzar</button>
        <br>
        <a href="index.html" class="btn btn-danger">Regresar</a>
        <p>Intentos: <span id="attempts">0</span></p>
        <p>Tiempo: <span id="timer">0</span> segundos</p>
        <p>Puntaje: <span id="score">0</span> puntos</p>
    </div>
    
    <form id="scoreForm" action="save_precision_score.php" method="POST" style="display: none;">
        <input type="hidden" name="score" id="scoreInput">
    </form>
    
    <script src="scripts/preciscript.js"></script>
</body>
</html>
