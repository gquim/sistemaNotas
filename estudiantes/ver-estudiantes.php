<?php
// /dashboard/view_students.php
session_start();
if (!isset($_SESSION['id_profesor'])) {
    header("Location: /index.php");
    exit();
}

include('../includes/conection.php');

// Consultar la lista de estudiantes
$query = "SELECT * FROM estudiante";
$result = $conn->query($query);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Estudiantes</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <h2>Lista de Estudiantes</h2>

    <table class="table table-hover">
        <tr>
            <!-- <th>ID</th> -->
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Fecha de Nacimiento</th>
            <th>Correo Electrónico</th>
            <th>Dirección</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                //echo "<td>" . $row['id_estudiante'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['apellido'] . "</td>";
                echo "<td>" . $row['fecha_nacimiento'] . "</td>";
                echo "<td>" . $row['correo_electronico'] . "</td>";
                echo "<td>" . $row['direccion'] . "</td>";
                echo "<td>";
                echo "<a href='editar-estudiante.php?id=" . $row['id_estudiante'] . "' class='action-button edit-button btn btn-warning'>Editar</a>  ";
                echo "<a href='eliminar-estudiante.php?id=" . $row['id_estudiante'] . "' class='action-button delete-button btn btn-danger' onclick=\"return confirm('¿Estás seguro de que deseas eliminar este estudiante?');\">Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No hay estudiantes registrados</td></tr>";
        }
        ?>
    </table>
    <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            if ($msg == 'success') {
                echo "<h6 class='text-success';'>El estudiante ha sido eliminado correctamente.</h6>";
            } elseif ($msg == 'notfound') {
                echo "<h6 class='text-warning'>El estudiante no se encontró o ya fue eliminado.</h6>";
            } elseif ($msg == 'foreignkey') {
                echo "<h6 class='text-danger'>Hay notas activas del estudiante.</h6>";
            } elseif ($msg == 'error') {
                echo "<h6 class='text-danger'>No se pudo completar la acción de eliminar. Por favor, inténtelo de nuevo.</h6>";
            }
        }
    ?>
    <br>
    <a href="crear-estudiante.php" class="action-button btn btn-primary">Crear Nuevo Estudiante</a>
    <br><br>
    <a href="/../dashboard/dashboard.php" class="btn btn-secondary">Volver al Dashboard</a>
</body>
</html>

<?php
$conn->close();
?>
