<?php
include "conexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id = '$id'");
    $data = mysqli_fetch_assoc($query);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $contrasena_actual = $_POST['contrasena_actual'];
        $nueva_contrasena = $_POST['nueva_contrasena'];
        $confirmar_contrasena = $_POST['confirmar_contrasena'];
    
        $query = "SELECT contrasena FROM usuarios WHERE id = '$id'";
        $resultado = $conexion->query($query);
    
        if ($resultado) {
            $fila = $resultado->fetch_assoc();
            $contrasena_hash = $fila['contrasena'];
            
            if (password_verify($contrasena_actual, $contrasena_hash)) {
                if ($nueva_contrasena === $confirmar_contrasena) {
                    $nueva_contrasena_hash = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
                    $update_query = "UPDATE usuarios SET contrasena = '$nueva_contrasena_hash' WHERE id = '$id'";
                    $conexion->query($update_query);
                    $exito = "Contraseña actualizada exitosamente.";
                } else {
                    $error = "Las contraseñas no coinciden.";
                }
            } else {
                $error = "Contraseña actual incorrecta.";
            }
        } else {
            $error = "Error en la consulta.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/edit.css">
    <link rel="icon" href="svg/icon.svg">
    <title>Editar Datos</title>
</head>
<body>
    <div class="container">
        <div class="edit-container">
            <center>
                <h1>EDITAR DATOS</h1>
                <form action="update.php" method="POST">
                    
                    <label for="nombre">ID:</label>
                    <input type="text" name="id" value="<?php echo $data['id']; ?>" readonly><br>
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" value="<?php echo $data['nombre']; ?>"><br>
                    <label for="correo">Correo:</label>
                    <input type="email" name="correo" value="<?php echo $data['correo']; ?>"><br>
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" name="telefono" value="<?php echo $data['telefono']; ?>"><br>
                    
                    <button type="submit">Guardar Cambios</button>
                </form>
            </center>
        </div>
        <div class="password-container">
            <center>
                <h1>Cambiar Contraseña</h1>
                <form method="POST">
                    <label for="contrasena_actual">Contraseña Actual:</label>
                    <input type="password" name="contrasena_actual" placeholder="Contraseña actual" required><br>
                    <label for="nueva_contrasena">Nueva Contraseña:</label>
                    <input type="password" name="nueva_contrasena" placeholder="Nueva contraseña" required><br>
                    <label for="confirmar_contrasena">Confirmar Nueva Contraseña:</label>
                    <input type="password" name="confirmar_contrasena" placeholder="Confirmar nueva contraseña" required><br>
                    <center>
                        <input type="submit" name="cambiar_contrasena" value="Cambiar Contraseña">
                        <a href="users.php">Volver</a>
                    </center>
                </form>
                <?php if (isset($exito)) { ?>
                    <p style="color: green;"><?php echo $exito; ?></p>
                <?php } elseif (isset($error)) { ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php } ?>
            </center>
        </div>
    </div>
</body>
</html>
