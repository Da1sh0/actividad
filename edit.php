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
    <link rel="stylesheet" href="css/stylesEdit.css">
    <link rel="icon" href="svg/icon.svg">
    <title>Editar Datos</title>
</head>
<body>
    <center>
        <h1>EDITAR DATOS</h1>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $data['nombre']; ?>"><br>
            <label for="correo">Correo:</label>
            <input type="email" name="correo" value="<?php echo $data['correo']; ?>"><br>
            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" value="<?php echo $data['contrasena']; ?>"><br>
            <label for="telefono">Teléfono:</label>
            <input type="tel" name="telefono" value="<?php echo $data['telefono']; ?>"><br>
            <button type="submit">Guardar Cambios</button>
        </form>
    </center>
</body>
</html>
