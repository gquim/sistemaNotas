<?php
// /dashboard/view_courses.php
session_start();
if (!isset($_SESSION['id_profesor'])) {
    header("Location: /index.php");
    exit();
}

include('../includes/conection.php');

// Consultar la lista de cursos
$query = "SELECT cursos.id_curso, cursos.nombre, cursos.descripcion, profesores.nombre AS nombre_profesor, profesores.apellido AS apellido_profesor
          FROM cursos
          JOIN profesores ON cursos.id_profesor = profesores.id_profesor";
$result = $conn->query($query);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Cursos</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <h2>Lista de Cursos</h2>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Nombre del Curso</th>
            <th>Descripción</th>
            <th>Profesor Asignado</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_curso'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "<td>" . $row['nombre_profesor'] . " " . $row['apellido_profesor'] . "</td>";
                echo "<td>";
                echo "<a href='eliminar-curso.php?id=" . $row['id_curso'] . "' class='btn btn-danger' onclick=\"return confirm('¿Estás seguro de que deseas eliminar este curso?');\">Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay cursos registrados</td></tr>";
        }
        ?>
    </table>
    <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            if ($msg == 'success') {
                echo "<h6 class='text-success'>El curso se ha eliminado correctamente.</h6>";
            } elseif ($msg == 'notfound') {
                echo "<h6 class='text-warning'>El curso no se encontró.</h6>";
            } elseif ($msg == 'foreignkey') {
                echo "<h6 class='text-danger'>No se puede eliminar el curso.</h6>";
            } elseif ($msg == 'error') {
                echo "<h6 class='text danger'>No se pudo completar la acción de eliminar. Por favor, inténtelo de nuevo.</h6>";
            }
        }
    ?>

    <br>
    <a href="crear-curso.php" class="btn btn-primary">Crear Nuevo Curso</a>
    <br><br>
    <a href="/../dashboard/dashboard.php" class="btn btn-secondary">Volver al Dashboard</a>
</body>
</html>

<?php
$conn->close();
?>
