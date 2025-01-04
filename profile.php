<?php
session_start();
include 'db_config.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Consultar información del usuario
$query = "SELECT username, email, password FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Error en la consulta: " . $conn->error); // Mostrar error si la consulta falla
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    echo "Error al cargar el perfil.";
    exit;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style2.css">
    <style>
        .profile-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .profile-header {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div id="stars"></div>
<div id="stars2"></div>
<div id="stars3"></div>
    <div class="container">
        <div class="profile-container">
            <h2 class="text-center profile-header">Perfil de Usuario</h2>
            <p class="tex1"><strong>Nombre de Usuario:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p class="tex1"><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <div class="text-center mt-4">
                <a href="index.html" class="btn btn-success">Ir al inicio</a>
                <a href="edit_profile.php" class="btn btn-primary">Editar Perfil</a>
                <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
            </div>
        </div>
    </div>
</body>
</html>
