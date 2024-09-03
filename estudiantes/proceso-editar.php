<?php
// /dashboard/process_edit_student.php
session_start();
include('../includes/conection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_estudiante = $_POST['id_estudiante'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $correo_electronico = $_POST['correo_electronico'];
    $direccion = $_POST['direccion'];

    // Verificar que todos los campos estén completos
    if (!empty($nombre) && !empty($apellido) && !empty($fecha_nacimiento) && !empty($correo_electronico) && !empty($direccion)) {
        // Actualizar el estudiante en la base de datos
        $query = "UPDATE estudiante SET nombre = ?, apellido = ?, fecha_nacimiento = ?, correo_electronico = ?, direccion = ? WHERE id_estudiante = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssi", $nombre, $apellido, $fecha_nacimiento, $correo_electronico, $direccion, $id_estudiante);

        if ($stmt->execute()) {
            // Redirigir a la lista de estudiantes después de la edición exitosa
            header("Location: ver-estudiantes.php");
            exit();
        } else {
            echo "Error al actualizar el estudiante. Por favor, inténtelo de nuevo.";
        }

        $stmt->close();
    } else {
        echo "Todos los campos son obligatorios.";
    }

    $conn->close();
}
?>
