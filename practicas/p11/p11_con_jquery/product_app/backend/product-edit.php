<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    $data = array(
        'status'  => 'error',
        'message' => 'Hubo un problema al editar el producto'
    );

    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JSON A OBJETO
        $jsonOBJ = json_decode($producto);

        // VERIFICAR QUE EL ID DEL PRODUCTO NO ESTÉ VACÍO
        if(isset($jsonOBJ->ID) && !empty($jsonOBJ->ID)) {
            $id = $jsonOBJ->ID;
            $nombre = $conexion->real_escape_string($jsonOBJ->nombre);
            $marca = $conexion->real_escape_string($jsonOBJ->marca);
            $modelo = $conexion->real_escape_string($jsonOBJ->modelo);
            $precio = $jsonOBJ->precio;
            $detalles = $conexion->real_escape_string($jsonOBJ->detalles);
            $unidades = $jsonOBJ->unidades;
            $imagen = $conexion->real_escape_string($jsonOBJ->imagen);

            // CONSULTA SQL PARA ACTUALIZAR EL PRODUCTO
            $sql = "UPDATE productos 
                    SET nombre = '$nombre', 
                        marca = '$marca', 
                        modelo = '$modelo', 
                        precio = $precio, 
                        detalles = '$detalles', 
                        unidades = $unidades, 
                        imagen = '$imagen' 
                    WHERE ID = $id";

            // EJECUTAR LA CONSULTA Y MANEJAR ERRORES
            if($conexion->query($sql)) {
                $data['status'] = "success";
                $data['message'] = "Producto modificado exitosamente";
            } else {
                $data['message'] = "ERROR: No se pudo ejecutar $sql. " . mysqli_error($conexion);
            }
        } else {
            $data['message'] = "El ID del producto es inválido";
        }

        // Cierra la conexión
        $conexion->close();
    } else {
        $data['message'] = "No se recibieron datos del producto";
    }

    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>
