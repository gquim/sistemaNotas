<?php
// /index.php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body class="bg-dark">
    <h2 class="text-light">Inicio de Sesión</h2>

    <?php
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        if ($msg == 'wrongpassword') {
            echo "<p class='text-danger''>Contraseña incorrecta. Por favor, inténtelo de nuevo.</p>";
        } elseif ($msg == 'usernotfound') {
            echo "<p class='text-warning''>Correo electrónico no encontrado. Verifique sus datos o regístrese.</p>";
        }
    }
    ?>

    <form action="login.php" method="POST">
        <label for="correo_electronico" class="form-label text-light">Correo Electrónico:</label>
        <input type="email" name="correo_electronico" id="correo_electronico" required class="form-control">

        <label for="password" class="form-label text-light">Contraseña:</label>
        <input type="password" name="password" id="password" required class="form-control">

        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    </form>

    <br>
    <a href="register.php" class="btn btn-info">Registrarse</a>
</body>
</html>

