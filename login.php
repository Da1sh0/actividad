<?php
require_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $query = "SELECT id, contrasena FROM usuarios WHERE correo = '$correo'";
    $resultado = $conexion->query($query);

    if ($resultado) {
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $contrasena_hash = $fila['contrasena'];
            
            if (password_verify($contrasena, $contrasena_hash)) {
                session_start();
                $_SESSION['usuario_id'] = $fila['id'];
                header("Location: users.php");
                exit();
            } else {
                $error = "Contraseña incorrecta";
            }
        } else {
            $error = "El usuario no existe";
        }
    } else {
        $error = "Error en la consulta";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="svg/icon.svg">
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="login-container">
        <center>
            <h1>Iniciar Sesión</h1>
            <form method="POST">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" placeholder="Direccion de correo" required><br>
                <label for="contrasena">Contraseña:</label>
                <input type="password" name="contrasena" placeholder="Contraseña" required><br>
                <center>
                    <input type="submit" name="iniciar_sesion" value="Iniciar Sesión">
                    <a href="register.php">No tengo una cuenta</a>
                    <a href="index.html">Volver</a>
                </center>
            </form>
                <?php if (isset($error)) { ?>
                <p><?php echo $error; ?></p>
            <?php } ?>
        </center>
    </div>
</body>
</html>
