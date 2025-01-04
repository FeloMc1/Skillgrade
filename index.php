<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - SkillGrade 2.0</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<div id="stars"></div>
<div id="stars2"></div>
<div id="stars3"></div>
    <div class="container my-5">
        <h2>Bienvenido, <?php echo $_SESSION['username']; ?></h2>
        <a href="index.html" class="btn btn-success w-100">Continuar a SkillGrade</a>
        <a href="profile.php" class="btn btn-success w-100">Ver mi Perfil</a>
        <?php if (isset($_SESSION['user_id'])): ?>
        <?php endif; ?>
        <br>
        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>
</body>
</html>
