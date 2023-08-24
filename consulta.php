<?php
include "conexion.php";
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="img/icon.svg">
    <title>DATOS GUARDADOS</title>
</head>
<body>
    <center>
        <h1>DATOS GUARDADOS</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th>Telefono</th>
                <th>Imagen</th>
            </tr>
            <?php
            $query = mysqli_query($conexion, "SELECT * FROM usuarios");
            $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($data = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $data['id'] ?></td>
                        <td><?php echo $data['nombre'] ?></td>
                        <td><?php echo $data['correo'] ?></td>
                        <td><?php echo $data['contrasena'] ?></td> 
                        <td><?php echo $data['telefono'] ?></td>
                        <td>
                            <img height="50px" src="data:<?php echo $data['imagen_tipo']; ?>;base64,<?php echo base64_encode($data['imagen']); ?>" alt="Imagen">
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <button><a href="index.php">Volver al registro</a></button>
    </center>
</body>
</html>
