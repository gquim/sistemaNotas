<?php
// /register.php
session_start();
include('../includes/conection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $password = $_POST['password'];

    // Verificar si el correo electrónico ya está registrado
    $query = "SELECT * FROM profesores WHERE correo_electronico = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Si el correo ya está registrado
        echo "Ya existe una cuenta con este correo electrónico.";
    } else {
        // Hash de la contraseña
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insertar nuevo profesor en la base de datos
        $query = "INSERT INTO profesores (nombre, apellido, correo_electronico, telefono, pass) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $nombre, $apellido, $email, $telefono, $password_hash);

        if ($stmt->execute()) {
            // Registro exitoso, iniciar sesión y redirigir al dashboard
            $_SESSION['id_profesor'] = $stmt->insert_id; // Obtener el ID del nuevo profesor
            header("Location: /dashboard/dashboard.php");
            exit();
        } else {
            echo "Error en el registro. Por favor, inténtelo de nuevo.";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
