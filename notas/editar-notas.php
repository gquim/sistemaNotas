<?php
// /dashboard/edit_grade.php
session_start();
if (!isset($_SESSION['id_profesor'])) {
    header("Location: /index.php");
    exit();
}

include('../includes/conection.php');

if (isset($_GET['id'])) {
    $id_nota = $_GET['id'];

    // Obtener los datos actuales de la nota
    $query = "SELECT * FROM notas WHERE id_notas = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_nota);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $nota = $result->fetch_assoc();
    } else {
        echo "Nota no encontrada.";
        exit();
    }
} else {
    header("Location: ver-notas.php");
    exit();
}

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
    <title>Editar Nota</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h2>Editar Nota</h2>
    <form action="proceso-editar.php" method="POST">
            <input type="hidden" name="id_nota" value="<?php echo $nota['id_notas']; ?>">

            <label for="id_estudiante" class="form-label">Estudiante:</label>
            <select name="id_estudiante" id="id_estudiante" required class="form-select">
                <option value="">Selecciona un estudiante</option>
                <?php
                if ($students_result->num_rows > 0) {
                    while ($row = $students_result->fetch_assoc()) {
                        $selected = $row['id_estudiante'] == $nota['id_estudiante'] ? 'selected' : '';
                        echo "<option value='" . $row['id_estudiante'] . "' $selected>" . $row['nombre'] . " " . $row['apellido'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay estudiantes disponibles</option>";
                }
                ?>
            </select>

            <label for="curso_id" class="form-label">Curso:</label>
            <select name="curso_id" id="curso_id" required class="form-select">
                <option value="">Selecciona un curso</option>
                <?php
                if ($courses_result->num_rows > 0) {
                    while ($row = $courses_result->fetch_assoc()) {
                        $selected = $row['id_curso'] == $nota['id_curso'] ? 'selected' : '';
                        echo "<option value='" . $row['id_curso'] . "' $selected>" . $row['nombre'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay cursos disponibles</option>";
                }
                ?>
            </select>

            <label for="tipo_evaluacion" class="form-label">Tipo de Evaluación:</label>
            <input type="text" name="tipo_evaluacion" id="tipo_evaluacion" value="<?php echo $nota['tipo_evaluacion']; ?>" required class="form-control">

            <label for="calificacion" class="form-label">Calificación:</label>
            <input type="text" name="calificacion" id="calificacion" value="<?php echo $nota['calificacion']; ?>" required class="form-control">

            <label for="fecha_evaluacion" class="form-label">Fecha de Evaluación:</label>
            <input type="date" name="fecha_evaluacion" id="fecha_evaluacion" value="<?php echo $nota['fecha_evaluacion']; ?>" required class="form-control">

        <button type="submit" class="btn btn-success">Guardar Cambios</button>
    </form>

    <br>
    <a href="ver-notas.php" class="btn btn-secondary">Volver a la Lista de Notas</a>
</body>
</html>

<?php
$conn->close();
?>
