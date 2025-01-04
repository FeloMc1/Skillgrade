<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    echo "Debe iniciar sesión para guardar su puntaje.";
    exit;
}

$user_id = $_SESSION['user_id'];
$score = isset($_POST['score']) ? intval($_POST['score']) : 0;

if ($score > 0) {
    $stmt = $conn->prepare("INSERT INTO reflejos (user_id, score) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $score);

    if ($stmt->execute()) {
        echo "<p class='tex1 d-inline-flex'> Puntaje guardado correctamente.</p>";
    } else {
        echo "Error al guardar el puntaje: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Puntaje inválido.";
}

$conn->close();
?>

<a class="btn btn-success" href="index.html">Regresar al inicio</a>
<a class="btn btn-success " href="lb_reflejos.php">Ver tabla de puntuaciones</a>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style2.css">
</head>