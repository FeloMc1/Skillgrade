<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $score = $_POST['score'];

    $sql = "INSERT INTO reflejos (user_id, score) VALUES ('$user_id', '$score')";
    if ($conn->query($sql) === TRUE) {
        echo "Resultado guardado correctamente.";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="styles/refstyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reflejos - SkillGrade 2.0</title>
</head>
<body>
    <div class="container text-center">
        <h2>Entrenamiento de Reflejos</h2>
        <p class="tex1">Haz clic en el círculo rojo tan rápido como puedas.</p>
        <a class="btn btn-success " href="lb_reflejos.php">Ver tabla de puntuaciones</a>
    <br>
    <!-- Selector de dificultad -->
    <label for="difficulty">Selecciona la dificultad:</label>
    <select id="difficulty" class="form-select w-auto mx-auto mb-3">
        <option value="easy">Fácil</option>
        <option value="medium" selected>Medio</option>
        <option value="hard">Difícil</option>
    </select>
    
    <div id="gameArea">
        <div id="circle">.</div>
    </div>
    <button class="btn btn-primary mt-3" id="startGame">Comenzar</button>
    <br>
    <a href="index.html" class="btn btn-danger">Regresar</a>
    <p>Intentos: <span id="attempts">0</span></p>
    <p>Tiempo: <span id="timer">0</span> segundos</p>
</div>
<form id="scoreForm" action="save_reflejos_score.php" method="POST" style="display: none;">
    <input type="hidden" name="score" id="scoreInput">
</form>
<script src="scripts/refscript.js"></script>
</body>
</html>
