<?php
// /dashboard/delete_student.php
session_start();
include('../includes/conection.php');

if (isset($_GET['id'])) {
    $id_estudiante = $_GET['id'];

    // Eliminar el estudiante de la base de datos
    $query = "DELETE FROM estudiante WHERE id_estudiante = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_estudiante);

    try {
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Redirigir a la lista de estudiantes después de eliminar
            header("Location: ver-estudiantes.php?msg=success");
        } else {
            // Si no se eliminó ninguna fila, mostrar mensaje de error
            header("Location: ver-estudiantes.php?msg=notfound");
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1451) { // Código de error específico para restricción de clave foránea
            header("Location: ver-estudiantes.php?msg=foreignkey");
        } else {
            header("Location: ver-estudiantes.php?msg=error");
        }
    }

    $stmt->close();
}

$conn->close();
?>
