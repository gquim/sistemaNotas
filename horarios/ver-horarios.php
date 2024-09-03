<?php
// /dashboard/view_schedules.php
session_start();
if (!isset($_SESSION['id_profesor'])) {
    header("Location: /index.php");
    exit();
}

include('../includes/conection.php');

// Consultar la lista de horarios
$query = "SELECT horarios.id_horario, cursos.nombre, horarios.hora_inicio, horarios.hora_fin, horarios.modalidad
          FROM horarios
          JOIN cursos ON horarios.id_curso = cursos.id_curso";
$result = $conn->query($query);


if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    if ($msg == 'success') {
        echo "<h6 class='text-success'>El curso ha sido eliminado correctamente.</h6>";
    } elseif ($msg == 'notfound') {
        echo "<h6 class='text-warning'>El curso no se encontró o ya fue eliminado.</h6>";
    } elseif ($msg == 'foreignkey') {
        echo "<h6 class='text-danger'>No se puede eliminar el curso porque está en uso en otro lugar.</h6>";
    } elseif ($msg == 'error') {
        echo "<h6 class='text-danger'>No se pudo completar la acción de eliminar. Por favor, inténtelo de nuevo.</h6>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Horarios</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <h2>Lista de Horarios</h2>

    <table class="table">
        <tr>
            <th>ID Horario</th>
            <th>Curso</th>
            <th>Hora de Inicio</th>
            <th>Hora de Fin</th>
            <th>Modalidad</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_horario'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['hora_inicio'] . "</td>";
                echo "<td>" . $row['hora_fin'] . "</td>";
                echo "<td>" . $row['modalidad'] . "</td>";
                echo "<td>";
                echo "<a href='editar-horarios.php?id=" . $row['id_horario'] . "' class='btn btn-warning'>Editar</a> ";
                echo "<a href='eliminar-horarios.php?id=" . $row['id_horario'] . "' class='btn btn-danger' onclick=\"return confirm('¿Estás seguro de que deseas eliminar este horario?');\">Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay horarios registrados</td></tr>";
        }
        ?>
    </table>

    <br>
    <a href="crear-horarios.php" class="action-button btn btn-primary">Crear Nuevo Horario</a>
    <br><br>
    <a href="/../dashboard/dashboard.php" class="btn btn-secondary">Volver al Dashboard</a>
</body>
</html>

<?php
$conn->close();
?>
