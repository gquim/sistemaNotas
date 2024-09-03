<?php
// /dashboard/edit_student.php
session_start();
if (!isset($_SESSION['id_profesor'])) {
    header("Location: /index.php");
    exit();
}

include('../includes/conection.php');

if (isset($_GET['id'])) {
    $id_estudiante = $_GET['id'];

    // Obtener los datos actuales del estudiante
    $query = "SELECT * FROM estudiante WHERE id_estudiante = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_estudiante);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $estudiante = $result->fetch_assoc();
    } else {
        echo "Estudiante no encontrado.";
        exit();
    }
} else {
    header("Location: ver-estudiantes.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudiante</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <h2>Editar Estudiante</h2>
    <form action="proceso-editar.php" method="POST">
            <input type="hidden" name="id_estudiante" value="<?php echo $estudiante['id_estudiante']; ?>">
        <div>
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $estudiante['nombre']; ?>" required class="form-control">
        </div>
        <div>
            <label for="apellido" class="form-label">Apellido:</label>
            <input type="text" name="apellido" id="apellido" value="<?php echo $estudiante['apellido']; ?>" required class="form-control">
        </div>
        <div>
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $estudiante['fecha_nacimiento']; ?>" required class="form-control">
        </div>
        <div>
            <label for="correo_electronico" class="form-label">Correo Electrónico:</label>
            <input type="email" name="correo_electronico" id="correo_electronico" value="<?php echo $estudiante['correo_electronico']; ?>" required class="form-control">
        </div>
        <div>
            <label for="direccion" class="form-label">Dirección:</label>
            <input type="text" name="direccion" id="direccion" value="<?php echo $estudiante['direccion']; ?>" required class="form-control">
        </div><br>
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
    </form>
    <br>
    <a href="ver-estudiantes.php" class="btn btn-secondary">Volver a la Lista de Estudiantes</a>
</body>
</html>

<?php
$conn->close();
?>
