<?php
// /dashboard/process_create_schedule.php
session_start();
include('../includes/conection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curso_id = $_POST['curso_id'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $modalidad = $_POST['modalidad'];

    // Verificar que el curso no tenga un horario asignado
    $query = "SELECT * FROM horarios WHERE id_curso = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $curso_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Este curso ya tiene un horario asignado.";
    } else {
        // Insertar el horario en la base de datos
        $query = "INSERT INTO horarios (id_curso, hora_inicio, hora_fin, modalidad) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isss", $curso_id, $hora_inicio, $hora_fin, $modalidad);

        if ($stmt->execute()) {
            // Redirigir al dashboard después de la inserción exitosa
            header("Location: ver-horarios.php");
            exit();
        } else {
            echo "Error al crear el horario. Por favor, inténtelo de nuevo.";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
