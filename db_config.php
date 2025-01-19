<?php
$servername = "localhost:3306";
$username = "u992749838_DWSkillgrade";
$password = "DWSkillgrade24";
$dbname = "u992749838_DWSkillgrade";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
