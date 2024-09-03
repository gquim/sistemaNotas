<?php
// /dashboard/dashboard.php
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
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h2>Bienvenido al Dashboard</h2>

    <nav class="navbar navbar-expand-lg bg-body-tertiary nav justify-content-center">
        <div class="container-md">
        <a class="navbar-brand" href="/../estudiantes/ver-estudiantes.php">Estudiantes</a>
        </div>
        <div class="container-md">
            <a class="navbar-brand" href="/../profesores/ver-profesor.php">Profesores</a>
        </div>
        <div class="container-md">
            <a class="navbar-brand" href="/../cursos/ver-cursos.php">Cursos</a>
        </div>
        <div class="container-md">
            <a class="navbar-brand" href="/../horarios/ver-horarios.php">Horarios</a>
        </div>
        <div class="container-md">
            <a class="navbar-brand" href="/../notas/ver-notas.php">Notas</a>
        </div>
        <div class="container-md">
            <a href="/logout.php" class="navbar-brand" style="color: red;">Cerrar Sesión</a>
        </div>
    </nav>
   


    <!-- Aquí puedes agregar más funcionalidades -->
</body>
</html>
