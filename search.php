<?php
include "conexion.php";

$output = '';

if(isset($_POST['query'])){
    $search = mysqli_real_escape_string($conexion, $_POST['query']);
    $query = "SELECT * FROM usuarios WHERE nombre LIKE '%$search%'";
    $result = mysqli_query($conexion, $query);

    if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_array($result)){
            $output .= '
                <tr>
                    <td>'.$data['id'].'</td>
                    <td>'.$data['nombre'].'</td>
                    <td>'.$data['correo'].'</td>
                    <td>'.$data['telefono'].'</td>
                    <td><img height="50px" src="data:'.$data['imagen_tipo'].';base64,'.base64_encode($data['imagen']).'" alt="Imagen"></td>
                    <td><a href="edit.php?id='.$data['id'].'">Editar</a></td>
                    <td><a href="delete.php?id='.$data['id'].'">Eliminar</a></td>
                </tr>';
        }
    } else {
        $output = '<tr><td colspan="7">No se encontraron resultados</td></tr>';
    }

    echo $output;
}
?>
