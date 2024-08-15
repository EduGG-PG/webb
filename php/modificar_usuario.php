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
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $sexo = $_POST['sexo'];
    $edad = $_POST['edad'];

    $sql = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', direccion='$direccion', telefono='$telefono', 
            correo='$correo', sexo='$sexo', edad='$edad' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario modificado exitosamente.";
        header("Location: admin_usuarios.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM usuarios WHERE id=$id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<link rel="stylesheet" href="./assets/css/style.css">
    <meta charset="UTF-8">
    <title>Modificar Usuario</title>
</head>
<body>
<style>
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #333;
            color: white;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        .action-buttons button {
            background-color: green;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        #buscar-form {
            margin-bottom: 20px;
        }
        #buscar-form input {
            padding: 5px;
            margin-right: 10px;
        }
        #alta-form {
            margin-top: 20px;
        }
        #alta-form input, #alta-form button {
            padding: 10px;
            margin: 5px;
        }
    </style>

<h1>Modificar Usuario</h1>

<form method="POST" action="modificar_usuario.php">
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $user['nombre']; ?>" required><br><br>
    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" value="<?php echo $user['apellido']; ?>" required><br><br>
    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" value="<?php echo $user['direccion']; ?>" required><br><br>
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" value="<?php echo $user['telefono']; ?>" required><br><br>
    <label for="correo">Correo:</label>
    <input type="email" name="correo" value="<?php echo $user['correo']; ?>" required><br><br>
    <label for="sexo">Sexo:</label>
    <select name="sexo" required>
        <option value="Masculino" <?php echo $user['sexo'] == 'Masculino' ? 'selected' : ''; ?>>Masculino</option>
        <option value="Femenino" <?php echo $user['sexo'] == 'Femenino' ? 'selected' : ''; ?>>Femenino</option>
    </select><br><br>
    <label for="edad">Edad:</label>
    <input type="number" name="edad" value="<?php echo $user['edad']; ?>" required><br><br>

    <button type="submit">Guardar Cambios</button>
    <button type="button" onclick="location.href='admin_usuarios.php'">Regresar a Pantalla Inicial</button>
</form>

</body>
</html>
