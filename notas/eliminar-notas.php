<?php
// /dashboard/delete_grade.php
session_start();
include('../includes/conection.php');

if (isset($_GET['id'])) {
    $id_nota = $_GET['id'];

    // Eliminar la nota de la base de datos
    $query = "DELETE FROM notas WHERE id_notas = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_nota);

    if ($stmt->execute()) {
        // Redirigir a la lista de notas después de eliminar
        header("Location: ver-notas.php");
        exit();
    } else {
        echo "Error al eliminar la nota. Por favor, inténtelo de nuevo.";
    }

    $stmt->close();
}

$conn->close();
?>
