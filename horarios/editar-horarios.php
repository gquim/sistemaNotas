<?php
// /dashboard/edit_schedule.php
session_start();
if (!isset($_SESSION['id_profesor'])) {
    header("Location: /index.php");
    exit();
}

include('../includes/conection.php');

if (isset($_GET['id'])) {
    $id_horario = $_GET['id'];

    // Obtener los datos actuales del horario
    $query = "SELECT * FROM horarios WHERE id_horario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_horario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $horario = $result->fetch_assoc();
    } else {
        echo "Horario no encontrado.";
        exit();
    }
} else {
    header("Location: ver-horarios.php");
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
    <title>Editar Horario</title>
    <link rel="stylesheet" href="/css/styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <h2>Editar Horario</h2>
    <form action="proceso-editar.php" method="POST">
        <input type="hidden" name="id_horario" value="<?php echo $horario['id_horario']; ?>">

        <label for="curso_id" class="form-label">Curso:</label>
        <select name="curso_id" id="curso_id" class="form-control">
            <option value="">Selecciona un curso</option>
            <?php
            if ($courses_result->num_rows > 0) {
                while ($row = $courses_result->fetch_assoc()) {
                    $selected = $row['id_curso'] == $horario['id_curso'] ? 'selected' : '';
                    echo "<option value='" . $row['id_curso'] . "' $selected>" . $row['nombre'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay cursos disponibles</option>";
            }
            ?>
        </select>

        <label for="hora_inicio" class="form-label">Hora de Inicio:</label>
        <input type="time" name="hora_inicio" id="hora_inicio" value="<?php echo $horario['hora_inicio']; ?>" required class="form-control">

        <label for="hora_fin" class="form-label">Hora de Finalización:</label>
        <input type="time" name="hora_fin" id="hora_fin" value="<?php echo $horario['hora_fin']; ?>" required class="form-control">

        <label for="modalidad" class="form-label">Modalidad:</label>
        <select name="modalidad" id="modalidad" required class="form-select">
            <option value="Presencial" <?php echo $horario['modalidad'] == 'Presencial' ? 'selected' : ''; ?>>Presencial</option>
            <option value="Virtual" <?php echo $horario['modalidad'] == 'Virtual' ? 'selected' : ''; ?>>Virtual</option>
        </select>

        <button type="submit" class="btn btn-success">Guardar Cambios</button>
    </form>

    <br>
    <a href="ver-horarios.php" class="btn btn-secondary">Volver a la Lista de Horarios</a>
</body>
</html>

<?php
$conn->close();
?>
