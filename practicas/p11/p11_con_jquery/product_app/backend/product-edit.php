<?php
// Desactivar cualquier error visible para evitar interferencias con el formato JSON
error_reporting(0);
ini_set('display_errors', 0);

// Configurar la cabecera para devolver JSON
header('Content-Type: application/json');

// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');

// Para depuración, escribir los datos enviados en un archivo
file_put_contents('debug.txt', $producto . PHP_EOL, FILE_APPEND);

// Inicializar la respuesta predeterminada
$data = array(
    'status'  => 'error',
    'message' => 'Hubo un problema al editar el producto'
);

if(!empty($producto)) {
    // Convertir el string del JSON a objeto PHP
    $jsonOBJ = json_decode($producto);

    // Verificar si el ID del producto está presente y no es vacío
    if(isset($jsonOBJ->ID) && !empty($jsonOBJ->ID)) {
        include_once __DIR__.'/database.php'; // Asegúrate de que esto esté bien configurado

        $id = $conexion->real_escape_string($jsonOBJ->ID);
        $nombre = $conexion->real_escape_string($jsonOBJ->nombre);
        $marca = $conexion->real_escape_string($jsonOBJ->marca);
        $modelo = $conexion->real_escape_string($jsonOBJ->modelo);
        $precio = floatval($jsonOBJ->precio);
        $detalles = $conexion->real_escape_string($jsonOBJ->detalles);
        $unidades = intval($jsonOBJ->unidades);
        $imagen = $conexion->real_escape_string($jsonOBJ->imagen);

        // Consulta SQL para actualizar el producto
        $sql = "UPDATE productos 
                SET nombre = '$nombre', 
                    marca = '$marca', 
                    modelo = '$modelo', 
                    precio = $precio, 
                    detalles = '$detalles', 
                    unidades = $unidades, 
                    imagen = '$imagen' 
                WHERE ID = $id";

        // Ejecutar la consulta y manejar errores
        if($conexion->query($sql)) {
            $data['status'] = "success";
            $data['message'] = "Producto modificado exitosamente";
        } else {
            $data['message'] = "ERROR: No se pudo ejecutar $sql. " . $conexion->error;
        }

        // Cerrar la conexión
        $conexion->close();
    } else {
        $data['message'] = "El ID del producto es inválido";
    }
} else {
    $data['message'] = "No se recibieron datos del producto";
}

// Enviar la respuesta como JSON
echo json_encode($data, JSON_PRETTY_PRINT);