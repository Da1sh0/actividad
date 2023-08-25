<?php
include "conexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id = '$id'");
    $data = mysqli_fetch_assoc($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="svg/icon.svg" type="image/x-icon">
    <title>Eliminar</title>
</head>
<body>
    <center>
        <h1>ELIMINAR REGISTRO</h1>
        <p>¿Estás seguro de que deseas eliminar este registro?</p>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Telefono</th>
                <!-- ... más encabezados si es necesario ... -->
            </tr>
            <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['nombre']; ?></td>
                <td><?php echo $data['correo']; ?></td>
                <td><?php echo $data['telefono']; ?></td>
                <!-- ... más celdas si es necesario ... -->
            </tr>
        </table>
        <form action="delete_process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <button type="submit">Eliminar</button>
            <a href="users.php">Cancelar</a>
        </form>
    </center>
</body>
</html>
