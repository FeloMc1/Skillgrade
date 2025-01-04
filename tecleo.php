<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $wpm = $_POST['wpm'];
    $accuracy = $_POST['accuracy'];

    $sql = "INSERT INTO tecleo (user_id, wpm, accuracy) VALUES ('$user_id', '$words_minute', '$accuracy')";
    if ($conn->query($sql) === TRUE) {
        echo "Resultado guardado correctamente.";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>


<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tecleo - SkillGrade 2.0</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/tecstyle.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container text-center my-5">
        <h2>Test de Tecleo</h2>
        <p class="tex1">Escribe las palabras antes de que lleguen hasta abajo</p>
        <a class="btn btn-success " href="lb_tecleo.php">Ver tabla de puntuaciones</a>
        <br>
        <!-- Selector de dificultad -->
        <div class="mb-3">
            <label for="difficultySelect" class="form-label">Selecciona la dificultad</label>
            <select class="form-select" id="difficultySelect">
                <option value="easy">Fácil</option>
                <option value="normal" selected>Normal</option>
                <option value="hard">Difícil</option>
            </select>
        </div>

        <!-- Área de juego donde caen las palabras -->
        <div id="gameArea"></div>

        <!-- Campo de entrada separado para que el jugador escriba -->
        <div class="input-group mt-3" style="width: 60%; margin: 0 auto;">
            <input type="text" id="userInput" class="form-control" placeholder="Escribe aquí..." autocomplete="off">
        </div>

        <button class="btn btn-primary mt-3" id="startGame">Comenzar</button>
        <br>
        <a href="index.html" class="btn btn-danger">Regresar</a>
        <div class="mt-3">
            <p>Puntaje: <span id="score">0</span></p>
        </div>
    </div>

    <form id="scoreForm" action="save_tecleo_score.php" method="POST" style="display: none;">
        <input type="hidden" name="score" id="scoreInput">
    </form>

    <script src="scripts/tecscript.js"></script>
</body>
</html>

