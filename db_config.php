<?php
$dsn = "DATABASE_URL=postgresql://postgres:Asqw1234@db.bisegwtmrqzfsmqpuqpb.supabase.co:5432/postgres";
$username = "864492c6-c0f7-499d-ab8e-815d1610cdc4";
$password = "Felomeza13";

try {
    $conn = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "Conexión exitosa";
} catch (PDOException $e) {
    echo "Conexión fallida: " . $e->getMessage();
}
?>
