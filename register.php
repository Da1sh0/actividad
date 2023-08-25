<?php
require_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['contrasena']) || empty($_POST['telefono']) || empty($_FILES['imagen']['tmp_name'])) {
        echo "Por favor llenar los campos correspondientes";
    } else {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];
        $passencript = password_hash($contrasena, PASSWORD_DEFAULT, ['cost' => 6]);
        $telefono = $_POST['telefono'];

        $imagen = $_FILES['imagen'];
        $imagen_data = addslashes(file_get_contents($imagen['tmp_name']));
        $imagen_tipo = $imagen['type'];

        $query = "INSERT INTO usuarios (nombre, correo, contrasena, telefono, imagen, imagen_tipo) VALUES('$nombre', '$correo', '$passencript', '$telefono', '$imagen_data', '$imagen_tipo')";
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
    <link rel="stylesheet" href="css/stylesRegister.css">
    <link rel="icon" href="svg/icon.svg">
    <title>Crud de Diiego</title>
</head>
<body>
    <center>
        <form method="POST" enctype="multipart/form-data">
            <h1>Registro</h1>
            <label for="nombre">Nombre Completo:</label>
            <input type="text" name="nombre" required><br>
            <label for="correo">Correo:</label>
            <input type="email" name="correo" required><br>
            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" required><br>
            <label for="telefono">Teléfono:</label>
            <input type="number" name="telefono" required><br>
            <label>Foto:</label>
            <input type="file" name="imagen" accept=".jpg, .jpeg, .png, .webp, .gif" required><br><br>
            <center>
                <input type="submit" name="guardar" value="Guardar">
                <button><a href="login.php">Iniciar Sesion</a></button>
                <button><a href="index.html">Volver</a></button>
            </center>
        </form>
    </center>
</body>
</html>
