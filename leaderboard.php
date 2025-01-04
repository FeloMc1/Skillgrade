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

// Títulos personalizados para cada tipo de puntaje
$titles = [
    "precis" => "Precisión",
    "juegos_mentales" => "Juegos Mentales",
    "reflejos" => "Reflejos",
    "tecleo" => "Tecleo",
    "visualizacion" => "Visualización",
];

// Consultas para obtener puntajes personales
$sql_personal = [
    "precis" => "SELECT score, date FROM precis WHERE user_id = ? ORDER BY score DESC",
    "juegos_mentales" => "SELECT score, date FROM juegos_mentales WHERE user_id = ? ORDER BY score DESC",
    "reflejos" => "SELECT score, date FROM reflejos WHERE user_id = ? ORDER BY score DESC",
    "tecleo" => "SELECT score, created_at AS date FROM tecleo WHERE user_id = ? ORDER BY score DESC",
    "visualizacion" => "SELECT score, date FROM visualizacion WHERE user_id = ? ORDER BY score DESC",
];

// Consultas para obtener puntajes generales
$sql_global = [
    "precis" => "SELECT usuarios.username, precis.score, precis.date 
                FROM precis 
                JOIN usuarios ON precis.user_id = usuarios.id 
                ORDER BY precis.score DESC, precis.date ASC LIMIT 10",
    "juegos_mentales" => "SELECT usuarios.username, juegos_mentales.score, juegos_mentales.date 
                        FROM juegos_mentales 
                        JOIN usuarios ON juegos_mentales.user_id = usuarios.id 
                        ORDER BY juegos_mentales.score DESC LIMIT 10",
    "reflejos" => "SELECT usuarios.username, reflejos.score, reflejos.date 
                FROM reflejos 
                JOIN usuarios ON reflejos.user_id = usuarios.id 
                ORDER BY reflejos.score DESC LIMIT 10",
    "tecleo" => "SELECT usuarios.username, tecleo.score, tecleo.created_at AS date 
                FROM tecleo 
                JOIN usuarios ON tecleo.user_id = usuarios.id 
                ORDER BY tecleo.score DESC LIMIT 10",
    "visualizacion" => "SELECT usuarios.username, visualizacion.score, visualizacion.date 
                        FROM visualizacion 
                        JOIN usuarios ON visualizacion.user_id = usuarios.id 
                        ORDER BY visualizacion.score DESC LIMIT 10",
];

// Preparar y ejecutar consultas para puntajes personales
$personal_scores = [];
foreach ($sql_personal as $key => $query) {
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $personal_scores[$key] = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// Ejecutar consultas para puntajes generales
$global_scores = [];
foreach ($sql_global as $key => $query) {
    $result = $conn->query($query);
    $global_scores[$key] = $result->fetch_all(MYSQLI_ASSOC);
}

// Calcular la posición del usuario en el ranking global por cada categoría
$user_positions = [];
foreach ($personal_scores as $key => $scores) {
    $user_position = 0;
    if (!empty($scores)) {
        // Obtener el puntaje más alto del usuario
        $user_score = $scores[0]['score'];
        
        // Verificar en qué posición se encuentra el puntaje del usuario en el ranking global
        $global_scores_list = $global_scores[$key];
        foreach ($global_scores_list as $index => $score) {
            if ($score['score'] > $user_score) {
                $user_position++;
            } else {
                break;  // Si encontramos el puntaje, el usuario está en esta posición
            }
        }
    }
    $user_positions[$key] = $user_position + 1; // La posición empieza desde 1
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puntajes - SkillGrade 2.0</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<div id="stars"></div>
<div id="stars2"></div>
<div id="stars3"></div>
    <div class="container my-5">
        <h2 class="text-center">Puntajes</h2>
        <p class="tex1 text-center">Bienvenido, <strong><?php echo htmlspecialchars($username); ?></strong></p>

        <div class="row">
            <!-- Puntajes Personales -->
            <div class="col-md-6">
                <h4 class="text-center">Mis Puntajes</h4>
                <?php foreach ($personal_scores as $key => $scores): ?>
                    <h5 class="mt-3 title"><?php echo isset($titles[$key]) ? $titles[$key] : ucfirst($key); ?></h5>
                    <p class="title"><strong>Tu posición: <?php echo isset($user_positions[$key]) ? $user_positions[$key] : 'N/A'; ?></strong></p>
                    <table class="table table-bordered border-primary">
                        <thead>
                            <tr class="table-primary">
                                <th>Puntaje</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($scores)): ?>
                                <?php foreach ($scores as $score): ?>
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
                <?php endforeach; ?>
            </div>

            <!-- Puntajes Generales -->
            <div class="col-md-6">
                <h4 class="text-center">Puntajes Generales</h4>
                <?php foreach ($global_scores as $key => $scores): ?>
                    <h5 class="mt-3 title"><?php echo isset($titles[$key]) ? $titles[$key] : ucfirst($key); ?></h5>
                    <table class="table table-bordered border-primary">
                        <thead>
                            <tr class="table-primary">
                                <th>#</th>
                                <th>Usuario</th>
                                <th>Puntaje</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($scores)): ?>
                                <?php foreach ($scores as $index => $score): ?>
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
                <?php endforeach; ?>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="index.html" class="btn btn-primary">Volver al inicio</a>
            <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    </div>
</body>
</html>
