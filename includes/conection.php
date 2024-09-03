<?php
// /includes/db_connection.php

$servername ="127.0.0.1:3310";
$username = "root";
$password = "";
$dbname = "dbsistema";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);
echo"";
// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
