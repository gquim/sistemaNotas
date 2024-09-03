<?php
// /dashboard/process_edit_grade.php
session_start();
include('../includes/conection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_nota = $_POST['id_nota'];
    $id_estudiante = $_POST['id_estudiante'];
    $curso_id = $_POST['curso_id'];
    $tipo_evaluacion = $_POST['tipo_evaluacion'];
    $calificacion = $_POST['calificacion'];
    $fecha_evaluacion = $_POST['fecha_evaluacion'];

    // Verificar que todos los campos estén completos
    if (!empty($id_estudiante) && !empty($curso_id) && !empty($tipo_evaluacion) && !empty($calificacion) && !empty($fecha_evaluacion)) {
        // Actualizar la nota en la base de datos
        $query = "UPDATE notas SET id_estudiante = ?, id_curso = ?, tipo_evaluacion = ?, calificacion = ?, fecha_evaluacion = ? WHERE id_notas = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iisssi", $id_estudiante, $curso_id, $tipo_evaluacion, $calificacion, $fecha_evaluacion, $id_nota);

        if ($stmt->execute()) {
            // Redirigir a la lista de notas después de la edición exitosa
            header("Location: ver-notas.php");
            exit();
        } else {
            echo "Error al actualizar la nota. Por favor, inténtelo de nuevo.";
        }

        $stmt->close();
    } else {
        echo "Todos los campos son obligatorios.";
    }

    $conn->close();
}
?>
