<?php
include "conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $query = "DELETE FROM usuarios WHERE id = '$id'";
    $result = mysqli_query($conexion, $query);

    if ($result) {
        header("Location: users.php"); // Redirigir después de la eliminación
        exit();
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($conexion);
    }
}
?>
