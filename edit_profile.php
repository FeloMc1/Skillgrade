<?php
session_start();
include 'db_config.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$message = "";

// Obtener la información actual del usuario
$query = "SELECT username, email, password FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Error en la consulta: " . $conn->error);
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

// Procesar los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_username = trim($_POST['username']);
    $new_email = trim($_POST['email']);
    $new_pass = trim(password_hash($_POST['password'], PASSWORD_DEFAULT));

    if (!empty($new_username) && !empty($new_email) && !empty($new_pass)) {
        $update_query = "UPDATE usuarios SET username = ?, email = ?, password = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_query);

        if (!$update_stmt) {
            die("Error al preparar la consulta de actualización: " . $conn->error);
        }

        $update_stmt->bind_param("sssi", $new_username, $new_email, $new_pass, $user_id);
        if ($update_stmt->execute()) {
            $message = "Perfil actualizado exitosamente.";
            // Actualizar los datos actuales para mostrarlos en la página
            $user['username'] = $new_username;
            $user['email'] = $new_email;
        } else {
            $message = "Error al actualizar el perfil: " . $conn->error;
        }

        $update_stmt->close();
    } else {
        $message = "Por favor, completa todos los campos.";
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style2.css">
    <style>
        .edit-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .edit-header {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div id="stars"></div>
<div id="stars2"></div>
<div id="stars3"></div>
    <div class="container">
        <div class="edit-container">
            <h2 class="text-center edit-header">Editar Perfil</h2>
            <?php if ($message): ?>
                <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
            <form method="POST" action="edit_profile.php">
                <div class="mb-3">
                    <label for="username" class="form-label">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
            </form>
            <div class="text-center mt-3">
                <a href="profile.php" class="btn btn-secondary">Volver al Perfil</a>
            </div>
        </div>
    </div>
</body>
</html>
