<?php
// /dashboard/add_grade.php
session_start();
if (!isset($_SESSION['id_profesor'])) {
    header("Location: /index.php");
    exit();
}

include('../includes/conection.php');

// Consultar la lista de estudiantes para el menú desplegable
$query = "SELECT id_estudiante, nombre, apellido FROM estudiante";
$students_result = $conn->query($query);

// Consultar la lista de cursos para el menú desplegable
$query = "SELECT id_curso, nombre FROM cursos";
$courses_result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nota</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <h2>Agregar Nueva Nota</h2>
    <form action="proceso-agregar.php" method="POST">
        <div class="mb-3">
            <label for="id_estudiante" class="form-label">Estudiante:</label>
            <select name="id_estudiante" id="id_estudiante" required class="form-select">
                <option value="">Selecciona un estudiante</option>
                <?php
                if ($students_result->num_rows > 0) {
                    while ($row = $students_result->fetch_assoc()) {
                        echo "<option value='" . $row['id_estudiante'] . "'>" . $row['nombre'] . " " . $row['apellido'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay estudiantes disponibles</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="curso_id" class="form-label">Curso:</label>
            <select name="curso_id" id="curso_id" required class="form-select">
                <option value="">Selecciona un curso</option>
                <?php
                if ($courses_result->num_rows > 0) {
                    while ($row = $courses_result->fetch_assoc()) {
                        echo "<option value='" . $row['id_curso'] . "'>" . $row['nombre'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay cursos disponibles</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="tipo_evaluacion" class="form-label">Tipo de Evaluación:</label>
            <input type="text" name="tipo_evaluacion" id="tipo_evaluacion" required class="form-control">
        </div>
        <div class="mb-3">
            <label for="calificacion" class="form-label">Calificación:</label>
            <input type="text" name="calificacion" id="calificacion" required class="form-control">
        </div>
        <div class="mb-3">
            <label for="fecha_evaluacion" class="form-label">Fecha de Evaluación:</label>
            <input type="date" name="fecha_evaluacion" id="fecha_evaluacion" required class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Agregar Nota</button>
    </form>
    <br>
    <a href="ver-notas.php" class="btn btn-secondary">Volver a la Lista de Notas</a>
</body>
</html>

<?php
$conn->close();
?>
