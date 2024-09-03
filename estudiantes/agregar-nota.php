<?php
// /dashboard/add_note.php
session_start();
if (!isset($_SESSION['id_profesor'])) {
    header("Location: /index.php");
    exit();
}

include('../includes/conection.php');

if (isset($_GET['id'])) {
    $id_estudiante = $_GET['id'];

    // Obtener el nombre del estudiante
    $query = "SELECT nombre, apellido FROM estudiante WHERE id_estudiante = ?";
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
</head>
<body>
    <h2>Agregar Nota para <?php echo $estudiante['nombre'] . " " . $estudiante['apellido']; ?></h2>
    <form action="proceso-agregar.php" method="POST">
        <input type="hidden" name="id_estudiante" value="<?php echo $id_estudiante; ?>">

        <label for="curso_id">Curso:</label>
        <select name="curso_id" id="curso_id" required>
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

        <label for="tipo_evaluacion">Tipo de Evaluación:</label>
        <input type="text" name="tipo_evaluacion" id="tipo_evaluacion" required>

        <label for="calificacion">Calificación:</label>
        <input type="text" name="calificacion" id="calificacion" required>

        <label for="fecha_evaluacion">Fecha de Evaluación:</label>
        <input type="date" name="fecha_evaluacion" id="fecha_evaluacion" required>

        <button type="submit">Agregar Nota</button>
    </form>

    <br>
    <a href="ver-estudiantes.php">Volver a la Lista de Estudiantes</a>
</body>
</html>

<?php
$conn->close();
?>
