<?php
// /dashboard/delete_course.php
session_start();
if (!isset($_SESSION['id_profesor'])) {
    header("Location: /index.php");
    exit();
}

include('../includes/conection.php');

if (isset($_GET['id'])) {
    $curso_id = $_GET['id'];

    // Eliminar el curso de la base de datos
    $query = "DELETE FROM cursos WHERE id_curso = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $curso_id);

    try {
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Redirigir a la lista de cursos después de eliminar
            header("Location: ver-cursos.php?msg=success");
        } else {
            // Si no se eliminó ninguna fila, mostrar mensaje de error
            header("Location: ver-cursos.php?msg=notfound");
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1451) { // Código de error específico para restricción de clave foránea
            header("Location: ver-cursos.php?msg=foreignkey");
        } else {
            header("Location: ver-cursos.php?msg=error");
        }
    }

    $stmt->close();
}

$conn->close();
?>
