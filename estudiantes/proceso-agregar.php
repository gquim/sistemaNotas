<?php
// /dashboard/process_add_note.php
session_start();
include('../includes/conection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_estudiante = $_POST['id_estudiante'];
    $curso_id = $_POST['curso_id'];
    $tipo_evaluacion = $_POST['tipo_evaluacion'];
    $calificacion = $_POST['calificacion'];
    $fecha_evaluacion = $_POST['fecha_evaluacion'];

    // Verificar que todos los campos estén completos
    if (!empty($id_estudiante) && !empty($curso_id) && !empty($tipo_evaluacion) && !empty($calificacion) && !empty($fecha_evaluacion)) {
        // Insertar la nota en la base de datos
        $query = "INSERT INTO notas (id_estudiante, id_curso, tipo_evaluacion, calificacion, fecha_evaluacion) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iisss", $id_estudiante, $curso_id, $tipo_evaluacion, $calificacion, $fecha_evaluacion);

        if ($stmt->execute()) {
            // Redirigir a la lista de estudiantes después de la inserción exitosa
            header("Location: ver-estudiantes.php");
            exit();
        } else {
            echo "Error al agregar la nota. Por favor, inténtelo de nuevo.";
        }

        $stmt->close();
    } else {
        echo "Todos los campos son obligatorios.";
    }

    $conn->close();
}
?>
