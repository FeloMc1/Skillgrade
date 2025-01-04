<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    echo "Debe iniciar sesión para guardar su puntaje.";
    exit;
}

$user_id = $_SESSION['user_id'];
$score = isset($_POST['score']) ? intval($_POST['score']) : 0;

if ($score >= 0) {
    $stmt = $conn->prepare("INSERT INTO relajacion (user_id, score) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $score);

    if ($stmt->execute()) {
        echo "Puntaje guardado correctamente.";
    } else {
        echo "Error al guardar el puntaje: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Puntaje inválido.";
}

$conn->close();
?>
