<?php
// /dashboard/view_grades.php
session_start();
if (!isset($_SESSION['id_profesor'])) {
    header("Location: /index.php");
    exit();
}

include('../includes/conection.php');

// Consultar la lista de notas
$query = "SELECT notas.id_notas, estudiante.nombre AS nombre_estudiante, estudiante.apellido AS apellido_estudiante,
          cursos.nombre, notas.tipo_evaluacion, notas.calificacion, notas.fecha_evaluacion
          FROM notas
          JOIN estudiante ON notas.id_estudiante = estudiante.id_estudiante
          JOIN cursos ON notas.id_curso = cursos.id_curso";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Notas</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <h2>Lista de Notas</h2>

    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Estudiante</th>
            <th>Curso</th>
            <th>Tipo de Evaluación</th>
            <th>Calificación</th>
            <th>Fecha de Evaluación</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_notas'] . "</td>";
                echo "<td>" . $row['nombre_estudiante'] . " " . $row['apellido_estudiante'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['tipo_evaluacion'] . "</td>";
                echo "<td>" . $row['calificacion'] . "</td>";
                echo "<td>" . $row['fecha_evaluacion'] . "</td>";
                echo "<td>";
                echo "<a href='editar-notas.php?id=" . $row['id_notas'] . "' class='btn btn-warning'>Editar</a> ";
                echo "<a href='eliminar-notas.php?id=" . $row['id_notas'] . "' class='btn btn-danger' onclick=\"return confirm('¿Estás seguro de que deseas eliminar esta nota?');\">Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No hay notas registradas</td></tr>";
        }
        ?>
    </table>

    <br>
    <a href="agregar-nota.php" class="btn btn-primary">Agregar Nota</a>
    <br><br>
    <a href="/../dashboard/dashboard.php" class="btn btn-secondary">Volver al Dashboard</a>
</body>
</html>

<?php
$conn->close();
?>
