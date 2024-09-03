<?php
// /dashboard/delete_schedule.php
session_start();
include('../includes/conection.php');

if (isset($_GET['id'])) {
    $id_horario = $_GET['id'];

    // Eliminar el horario de la base de datos
    $query = "DELETE FROM horarios WHERE id_horario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_horario);

    if ($stmt->execute()) {
        // Redirigir a la lista de horarios después de eliminar
        header("Location: ver-horarios.php");
        exit();
    } else {
        echo "Error al eliminar el horario. Por favor, inténtelo de nuevo.";
    }

    $stmt->close();
}

$conn->close();
?>
