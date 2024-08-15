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
$sql = "DELETE FROM usuarios WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: admin_usuarios.php");
} else {
    echo "Error al eliminar usuario: " . $conn->error;
}

$conn->close();
?>
