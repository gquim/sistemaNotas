<?php
// /dashboard/create_schedule.php
session_start();
if (!isset($_SESSION['id_profesor'])) {
    header("Location: /index.php");
    exit();
}

include('../includes/conection.php');

// Consultar la lista de cursos que no tienen un horario asignado
$query = "SELECT cursos.id_curso, cursos.nombre 
    FROM cursos
    LEFT JOIN horarios ON cursos.id_curso = horarios.id_curso
    WHERE horarios.id_curso IS NULL
";
//hola que hace, perdiendo el tiempo o qué hahce
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Horario</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <h2>Crear Nuevo Horario para Cursos</h2>
    <form action="proceso-horarios.php" method="POST">
        <label for="curso_id" class="form-label">Curso:</label>
        <select name="curso_id" id="curso_id" required class="form-select">
            <option value="">Selecciona un curso</option>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id_curso'] . "'>" . $row['nombre'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay cursos disponibles</option>";
            }
            ?>
        </select>

        <label for="hora_inicio" class="form-label">Hora de Inicio:</label>
        <input type="time" name="hora_inicio" id="hora_inicio" required class="form-control">

        <label for="hora_fin" class="form-label">Hora de Finalización:</label>
        <input type="time" name="hora_fin" id="hora_fin" required class="form-control">

        <label for="modalidad" class="form-label">Modalidad:</label>
        <select name="modalidad" id="modalidad" required class="form-select">
            <option value="Presencial">Presencial</option>
            <option value="Virtual">Virtual</option>
        </select>

        <button type="submit" class="btn btn-success">Crear Horario</button>
    </form>

    <br>
    <a href="ver-horarios.php" class="btn btn-secondary">Volver a la Lista de Horarios</a>
</body>
</html>

<?php
$conn->close();
?>
