<?php
session_start();
include 'db_config.php'; // Conexión a la base de datos

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirigir si no está autenticado
    exit();
}

// Obtener el ID y nombre del usuario autenticado
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Consultas para obtener puntajes personales y generales de "visualización"
$sql_personal = "SELECT score, date FROM visualizacion WHERE user_id = ? ORDER BY score DESC";
$sql_global = "SELECT usuarios.username, visualizacion.score, visualizacion.date 
               FROM visualizacion 
               JOIN usuarios ON visualizacion.user_id = usuarios.id 
               ORDER BY visualizacion.score DESC, visualizacion.date ASC LIMIT 10";

// Consultar puntajes personales
$stmt = $conn->prepare($sql_personal);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$personal_scores = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Consultar puntajes generales
$result = $conn->query($sql_global);
$global_scores = $result->fetch_all(MYSQLI_ASSOC);

// Calcular la posición del usuario en el ranking global
$user_position = 0;
if (!empty($personal_scores)) {
    $user_score = $personal_scores[0]['score'];
    foreach ($global_scores as $index => $score) {
        if ($score['score'] > $user_score) {
            $user_position++;
        } else {
            break;
        }
    }
}
$user_position = $user_position + 1; // La posición empieza desde 1

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puntajes de Visualizacion - SkillGrade 2.0</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center">Puntajes de Visualizacion</h2>
        <p class="text-center tex1">Bienvenido, <strong><?php echo htmlspecialchars($username); ?></strong></p>
        <p class="text-center title"><strong>Tu posición: <?php echo $user_position; ?></strong></p>

        <div class="row">
            <!-- Puntajes Personales -->
            <div class="col-md-6">
                <h4 class="text-center">Mis Puntajes</h4>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Puntaje</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($personal_scores)): ?>
                            <?php foreach ($personal_scores as $score): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($score['score']); ?></td>
                                    <td><?php echo htmlspecialchars($score['date']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="2" class="text-center">Sin registros</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Puntajes Generales -->
            <div class="col-md-6">
                <h4 class="text-center">Puntajes Generales</h4>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Puntaje</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($global_scores)): ?>
                            <?php foreach ($global_scores as $index => $score): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($score['username']); ?></td>
                                    <td><?php echo htmlspecialchars($score['score']); ?></td>
                                    <td><?php echo htmlspecialchars($score['date']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center">Sin registros</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="index.html" class="btn btn-primary">Volver al inicio</a>
            <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    </div>
</body>
</html>
