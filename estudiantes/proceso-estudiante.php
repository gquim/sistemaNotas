<?php
// /dashboard/process_create_student.php
session_start();
include('../includes/conection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $correo_electronico = $_POST['correo_electronico'];
    $direccion = $_POST['direccion'];

    // Verificar si el correo electrónico ya está registrado
    $query = "SELECT * FROM estudiante WHERE correo_electronico = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $correo_electronico);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Si el correo ya está registrado
        echo "Ya existe un estudiante con este correo electrónico.";
    } else {
        // Insertar nuevo estudiante en la base de datos
        $query = "INSERT INTO estudiante (nombre, apellido, fecha_nacimiento, correo_electronico, direccion) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $nombre, $apellido, $fecha_nacimiento, $correo_electronico, $direccion);

        if ($stmt->execute()) {
            // Redirigir al dashboard después de la inserción exitosa
            header("Location: /../dashboard/dashboard.php");
            exit();
        } else {
            echo "Error al crear el estudiante. Por favor, inténtelo de nuevo.";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
