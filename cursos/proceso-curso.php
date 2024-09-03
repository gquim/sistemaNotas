<?php
// /dashboard/process_create_course.php
session_start();
include('../includes/conection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_curso = $_POST['nombre_curso'];
    $descripcion = $_POST['descripcion'];
    $profesor_id = $_POST['profesor_id'];

    // Verificar que todos los campos estén completos
    if (!empty($nombre_curso) && !empty($descripcion) && !empty($profesor_id)) {
        // Insertar el curso en la base de datos
        $query = "INSERT INTO cursos (nombre, descripcion, id_profesor) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $nombre_curso, $descripcion, $profesor_id);

        if ($stmt->execute()) {
            // Redirigir al dashboard después de la inserción exitosa
            header("Location: ../dashboard/dashboard.php");
            exit();
        } else {
            echo "Error al crear el curso. Por favor, inténtelo de nuevo.";
        }

        $stmt->close();
    } else {
        echo "Todos los campos son obligatorios.";
    }

    $conn->close();
}
?>
