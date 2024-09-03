<?php
// /dashboard/create_course.php
session_start();
if (!isset($_SESSION['id_profesor'])) {
    header("Location: /index.php");
    exit();
}

include('../includes/conection.php');

// Consultar la lista de profesores que no están asignados a ningún curso
$query = "
    SELECT id_profesor, nombre, apellido 
    FROM profesores
    WHERE id_profesor NOT IN (
        SELECT id_profesor 
        FROM cursos
        WHERE id_profesor IS NOT NULL
    )
";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Curso</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <h2>Crear Nuevo Curso</h2>
    <form action="proceso-curso.php" method="POST">
        <div>
            <label for="nombre_curso" class="form-label">Nombre del Curso:</label>
            <input type="text" name="nombre_curso" id="nombre_curso" required class="form-control">
        </div class="form-floating">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="descripcion" required class="form-control"></textarea>
        <div>
            <label for="profesor_id">Profesor:</label>
            <select name="profesor_id" id="profesor_id" required class="form-select">
                <option value="">Selecciona un profesor</option>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id_profesor'] . "'>" . $row['nombre'] . " " . $row['apellido'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay profesores disponibles</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Crear Curso</button>
    </form>

    <br>
    <a href="../dashboard/dashboard.php" class="btn btn-secondary">Volver al Dashboard</a>
</body>
</html>

<?php
$conn->close();
?>
