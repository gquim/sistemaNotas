<?php
// /login.php
session_start();
include('includes/conection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo_electronico = $_POST['correo_electronico'];
    $password = $_POST['password'];

    // Verificar si el usuario existe
    $query = "SELECT * FROM profesores WHERE correo_electronico = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $correo_electronico);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $row['pass'])) {
            // Iniciar sesión y redirigir al dashboard
            $_SESSION['id_profesor'] = $row['id_profesor'];
            header("Location: dashboard/dashboard.php");
            exit();
        } else {
            // Contraseña incorrecta
            header("Location: index.php?msg=wrongpassword");
            exit();
        }
    } else {
        // Correo electrónico no encontrado
        header("Location: index.php?msg=usernotfound");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
