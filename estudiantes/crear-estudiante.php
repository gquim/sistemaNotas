<?php
// /dashboard/create_student.php
session_start();
if (!isset($_SESSION['id_profesor'])) {
    header("Location: /index.php");
    exit();
}



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Estudiante</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <h2>Crear Nuevo Estudiante</h2>
    <form action="proceso-estudiante.php" method="POST" class="row g-3">
        <div class="col-md-4">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required class="form-control">
        </div><br>
        <div class="col-md-4">
            <label for="apellido" class="form-label">Apellido:</label>
            <input type="text" name="apellido" id="apellido" required class="form-control">
        </div><br>
        <div class="col-md-2">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required class="form-control">
        </div class="col-md-6">
        <div class="col-md-6">
            <label for="correo_electronico" class="form-label">Correo Electrónico:</label>
            <input type="email" name="correo_electronico" id="correo_electronico" required class="form-control">
        </div>
        <div class="col-md-6"> 
            <label for="direccion" class="form-label">Dirección:</label>
            <input type="text" name="direccion" id="direccion" required class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Crear Estudiante</button>
    </form>

    <a href="/../dashboard/dashboard.php" class="btn btn-secondary">Volver al Dashboard</a>
</body>
</html>
