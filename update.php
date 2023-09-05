<?php
include "conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conexion, $_POST['id']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);

    $query = "UPDATE usuarios SET nombre = '$nombre', correo = '$correo' , telefono = '$telefono' WHERE id = '$id'";
    $result = mysqli_query($conexion, $query);

    if ($result) {
        header("Location: users.php"); // Redirigir después de la actualización
        exit();
    } else {
        echo "Error al actualizar los datos: " . mysqli_error($conexion);
    }
}
?>
