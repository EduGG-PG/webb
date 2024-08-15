<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sazonarte";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $sexo = $_POST['sexo'];
    $edad = $_POST['edad'];

    $sql = "INSERT INTO usuarios (nombre, apellido, direccion, telefono, correo, sexo, edad)
            VALUES ('$nombre', '$apellido', '$direccion', '$telefono', '$correo', '$sexo', $edad)";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario registrado exitosamente.";
        header("Location: admin_usuarios.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dar de Alta Usuario</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>

<h1>Dar de Alta Usuario</h1>

<form method="POST" action="alta_usuario.php">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required><br><br>
    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" required><br><br>
    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" required><br><br>
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" required><br><br>
    <label for="correo">Correo:</label>
    <input type="email" name="correo" required><br><br>
    <label for="sexo">Sexo:</label>
    <select name="sexo" required><br>
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
    </select><br><br>
    <label for="edad">Edad:</label>
    <input type="number" name="edad" required><br><br>

    <button type="submit">Registrar Usuario</button>
    <button type="button" onclick="location.href='admin_usuarios.php'">Regresar a Pantalla Inicial</button>
</form>

</body>
</html>
