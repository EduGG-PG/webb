<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sazonarte";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM usuarios WHERE id=$id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<link rel="stylesheet" href="./assets/css/style.css">
    <meta charset="UTF-8">
    <title>Detalles del Usuario</title>
</head>
<body>

<h1>Detalles del Usuario</h1>

<ul>
    <li><strong>Nombre:</strong> <?php echo $user['nombre']; ?></li>
    <li><strong>Apellido:</strong> <?php echo $user['apellido']; ?></li>
    <li><strong>Dirección:</strong> <?php echo $user['direccion']; ?></li>
    <li><strong>Teléfono:</strong> <?php echo $user['telefono']; ?></li>
    <li><strong>Correo:</strong> <?php echo $user['correo']; ?></li>
    <li><strong>Fecha de Registro:</strong> <?php echo $user['fecha_registro']; ?></li>
    <li><strong>Sexo:</strong> <?php echo $user['sexo']; ?></li>
    <li><strong>Edad:</strong> <?php echo $user['edad']; ?></li>
</ul>

<button onclick="location.href='admin_usuarios.php'">Regresar a Pantalla Inicial</button>

</body>
</html>
