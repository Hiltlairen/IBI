<?php
// Configuración de la base de datos
$servername = "b1lyb5y6anbt4mdo2tph-mysql.services.clever-cloud.com";
    $username = "ulrxh3qf0me5gxji";
    $password = "n0XGQx4pc0qZdQlGcQBw";
    $dbname = "b1lyb5y6anbt4mdo2tph";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$correo = $_POST['email'];
$contrasena = $_POST['password'];

// Preparar y ejecutar la consulta
$sql = "SELECT contrasena FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$stmt->bind_result($hash);
$stmt->fetch();
$stmt->close();

// Verificar la contraseña
if (password_verify($contrasena, $hash)) {
    // La contraseña es correcta, iniciar sesión

    // Aquí puedes iniciar la sesión del usuario, por ejemplo:
    // session_start();
    // $_SESSION['usuario'] = $correo;
    // Redirigir a la página principal
    header("Location: ../page/control/panelFocos.html");
} else {
    // La contraseña es incorrecta
    echo "Correo o contraseña incorrectos.";
}

$conn->close();
?>
