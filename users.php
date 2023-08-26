<?php
include "conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/users.css">
    <link rel="icon" href="svg/icon.svg">
    <title>Datos Guardados</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#search").keyup(function(){
                var searchText = $(this).val();
                $.ajax({
                    url: "search.php",
                    method: "POST",
                    data: {query: searchText},
                    success: function(data){
                        $("#table-data").html(data);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <center>
        <h1>DATOS GUARDADOS</h1>
        <input type="text" id="search" placeholder="Buscar por nombre...">
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Imagen</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
            <tbody id="table-data">
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
                            <td><a href="edit.php?id=<?php echo $data['id']; ?>">Editar</a></td>
                            <td><a href="delete.php?id=<?php echo $data['id']; ?>">Eliminar</a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <button><a href="register.php">Volver al registro</a></button>
        <button><a href="print.php">Imprimir</a></button>
        <button><a href="index.html">Volver</a></button>
    </center>
</body>
</html>
