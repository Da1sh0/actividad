<?php
require_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['contrasena']) || empty($_POST['telefono']) || 
    empty($_FILES['imagen']['tmp_name'])) {
        echo "Por favor llenar los campos correspondientes";
    } else {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];
        $passencript = password_hash($contrasena, PASSWORD_DEFAULT, ['cost' => 6]);
        $telefono = $_POST['telefono'];

        $query = "INSERT INTO usuarios (nombre, correo, contrasena, telefono, imagen, imagen_tipo) 
        VALUES('$nombre', '$correo', '$passencript', '$telefono', '$imagen_data', '$imagen_tipo')";
        $resultado = $conexion->query($query);

        if ($resultado) {
            echo "Se han guardado sus datos satisfactoriamente";
        } else {
            echo "Sus datos no han sido guardados correctamente";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <link rel="icon" href="svg/icon.svg">
    <title>Crud de Diiego</title>
</head>
<body>
    <div class="register-form">
        <h1>Registro</h1>
        <form method="POST" enctype="multipart/form-data">

            <label for="nombre">Nombre Completo:</label>
            <input type="text" name="nombre" placeholder="Nombre Completo" required>
            <label for="correo">Correo:</label>
            <input type="email" name="correo" placeholder="Direccion de correo" required>
            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" placeholder="Constraseña" required>
            <label for="telefono">Teléfono:</label>
            <input type="tel" name="telefono" placeholder="Numero telefonico" required>
            <label for="imagen">Foto:</label>
            <input type="file" name="imagen" accept=".jpg, .jpeg, .png, .webp, .gif" required>

            <button type="submit">Guardar</button>
            <a href="login.php">Iniciar Sesión</a>
            <a href="index.html">Volver</a>
        </form>
    </div>
</body>
</html>
