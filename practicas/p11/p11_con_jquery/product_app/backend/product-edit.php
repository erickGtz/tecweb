<?php
    header('Content-Type: application/json');  // Asegura que la respuesta sea JSON
    include_once __DIR__.'/database.php';

    $producto = file_get_contents('php://input');
    $data = array(
        'status'  => 'error',
        'message' => 'Hubo un problema al editar el producto'
    );

    if (!empty($producto)) {
        $jsonOBJ = json_decode($producto);
        
        if (isset($jsonOBJ->ID) && !empty($jsonOBJ->ID)) {
            $id = $jsonOBJ->ID;
            $nombre = $conexion->real_escape_string($jsonOBJ->nombre);
            $marca = $conexion->real_escape_string($jsonOBJ->marca);
            $modelo = $conexion->real_escape_string($jsonOBJ->modelo);
            $precio = $jsonOBJ->precio;
            $detalles = $conexion->real_escape_string($jsonOBJ->detalles);
            $unidades = $jsonOBJ->unidades;
            $imagen = $conexion->real_escape_string($jsonOBJ->imagen);

            $sql = "UPDATE productos SET nombre = '$nombre', marca = '$marca', modelo = '$modelo', 
                    precio = $precio, detalles = '$detalles', unidades = $unidades, imagen = '$imagen' 
                    WHERE ID = $id";

            if ($conexion->query($sql)) {
                $data['status'] = "success";
                $data['message'] = "Producto modificado exitosamente";
            } else {
                $data['message'] = "ERROR: No se pudo ejecutar $sql. " . mysqli_error($conexion);
            }
        } else {
            $data['message'] = "El ID del producto es inválido";
        }

        $conexion->close();
    } else {
        $data['message'] = "No se recibieron datos del producto";
    }

    echo json_encode($data, JSON_PRETTY_PRINT);
?>
