<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualización - SkillGrade 2.0</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/visstyle.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container text-center">
        <h2>Prueba de Visualización de Colores</h2>
        <p class="tex1">Memoriza el color que se mostrará. Luego selecciona el color correcto.</p>
        <a class="btn btn-success " href="lb_visualizacion.php">Ver tabla de puntuaciones</a>
        <br>
        <div>
            <label for="difficulty">Dificultad:</label>
            <select id="difficulty" class="form-select w-50 mx-auto mb-3">
                <option value="easy">Fácil</option>
                <option value="medium">Medio</option>
                <option value="hard">Difícil</option>
            </select>
        </div>
        
        <p class="title">Tiempo restante: <span id="timeLeft">30</span> segundos</p>
        <p class="title">Intentos: <span id="attempts">0</span></p>
        
        <div id="gameArea" style="height: 200px; position: relative; border: 1px solid black;">
            <div id="colorBox"></div>
        </div>
        
        <button class="btn btn-primary mt-3" id="startGame">Comenzar</button>
        <br>
        <a href="index.html" class="btn btn-danger">Regresar</a>
        
        <div id="colorOptions"></div> <!-- Opciones de colores -->
    </div>

    <form id="scoreForm" action="save_visualizacion_score.php" method="POST" style="display: none;">
        <input type="hidden" name="score" id="scoreInput">
    </form>
    
    <script src="scripts/visscript.js"></script>
</body>
</html>
