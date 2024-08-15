<?php

$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "sazonarte";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$sql = "SELECT id, nombre, apellido, direccion, telefono, correo FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
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
</head>
<body>

<h1><a href="admin_usuarios.php">Lista de usuarios</a></h1>

<!-- Formulario para buscar cliente por ID -->
<form id="buscar-form" method="GET" action="admin_usuarios.php">
    <label for="id">Buscar Usuario por ID:</label>
    <input type="number" name="id" id="id" required>
    <button class="nav-toggle-btn" type="submit">Buscar</button><br>
</form>


<button onclick="location.href='alta_usuario.php'">Dar de alta un nuevo cliente</button><br><br>
<button onclick="location.href='../index.html'">Pagina principal</button><br><br>


<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($_GET['id'])): ?>
            <?php
            $id = intval($_GET['id']);
            $sql = "SELECT id, nombre, apellido, direccion, telefono, correo FROM usuarios WHERE id=$id";
            $result = $conn->query($sql);
            ?>
        <?php endif; ?>

        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["nombre"]; ?></td>
                    <td><?php echo $row["apellido"]; ?></td>
                    <td><?php echo $row["direccion"]; ?></td>
                    <td><?php echo $row["telefono"]; ?></td>
                    <td><?php echo $row["correo"]; ?></td>
                    <td class="action-buttons">
                        <button onclick="location.href='ver_usuario.php?id=<?php echo $row['id']; ?>'">Visualizar Usuario</button>
                        <button onclick="location.href='modificar_usuario.php?id=<?php echo $row['id']; ?>'">Modificar</button>
                        <button onclick="if(confirm('¿Estás seguro de eliminar este usuario?')) location.href='eliminar_usuario.php?id=<?php echo $row['id']; ?>'">Eliminar</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No hay usuarios registrados o no se encontraron resultados.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>

<?php
$conn->close();
?>
