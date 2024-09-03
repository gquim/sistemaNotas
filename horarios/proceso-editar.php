<?php
// /dashboard/process_edit_schedule.php
session_start();
include('../includes/conection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_horario = $_POST['id_horario'];
    $curso_id = $_POST['curso_id'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $modalidad = $_POST['modalidad'];

    // Verificar que todos los campos estén completos
    if (!empty($curso_id) && !empty($hora_inicio) && !empty($hora_fin) && !empty($modalidad)) {
        // Actualizar el horario en la base de datos
        $query = "UPDATE horarios SET id_curso = ?, hora_inicio = ?, hora_fin = ?, modalidad = ? WHERE id_horario = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isssi", $curso_id, $hora_inicio, $hora_fin, $modalidad, $id_horario);

        if ($stmt->execute()) {
            // Redirigir a la lista de horarios después de la edición exitosa
            header("Location: ver-horarios.php");
            exit();
        } else {
            echo "Error al actualizar el horario. Por favor, inténtelo de nuevo.";
        }

        $stmt->close();
    } else {
        echo "Todos los campos son obligatorios.";
    }

    $conn->close();
}
?>
