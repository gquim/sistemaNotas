<?php
// /dashboard/view_professors.php
session_start();
if (!isset($_SESSION['id_profesor'])) {
    header("Location: /index.php");
    exit();
}

include('../includes/conection.php');

// Consultar la lista de profesores
$query = "SELECT * FROM profesores";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Profesores</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <h2>Lista de Profesores</h2>

    <table class="table table-hover">
        <tr>
            <!-- <th>ID</th> -->
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo Electrónico</th>
            <th>Teléfono</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                //echo "<td>" . $row['id_profesor'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['apellido'] . "</td>";
                echo "<td>" . $row['correo_electronico'] . "</td>";
                echo "<td>" . $row['telefono'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay profesores registrados</td></tr>";
        }
        ?>
    </table>

    <br>
    <a href="/../profesores/registro.php" class="btn btn-primary">Crear Nuevo Profesor</a>
    <br><br>
    <a href="../dashboard/dashboard.php" class="btn btn-secondary">Volver al Dashboard</a>
</body>
</html>

<?php
$conn->close();
?>
