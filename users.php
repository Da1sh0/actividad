<?php
include "conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylesUsers.css">
    <link rel="icon" href="img/icon.svg">
    <title>Datos Guardados</title>
</head>
<body>
    <center>
        <h1>DATOS GUARDADOS</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
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
        <button><a href="register.php">Volver al registro</a></button>
        <button><a href="print.php">Imprimir</a></button>
        <button><a href="index.html">Volver</a></button>
    </center>
</body>
</html>