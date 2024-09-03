<?php
// /includes/db_connection.php

$DB_HOST=$_ENV["DB_HOST"];
$DB_USER=$_ENV["DB_USER"];
$DB_PASSWORD=["DB_PASSWORD"];
$DB_NAME=["DB_NAME"];
$DB_PORT=["DB_PORT"];

// Crear la conexión
$conn = mysqli_connect("DB_HOST","DB_USER","DB_PASSWORD","DB_NAME","DB_PORT");
echo"";
// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
