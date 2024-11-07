<?php
// Desactivar errores visibles
/*error_reporting(0);
ini_set('display_errors', 0);

// Configurar la cabecera para devolver JSON
header('Content-Type: application/json');

// Captura de salida para prevenir espacios en blanco u otro contenido
ob_start();

$producto = file_get_contents('php://input');
file_put_contents('debug.txt', $producto . PHP_EOL, FILE_APPEND); // Para depuración

$data = array(
    'status'  => 'error',
    'message' => 'Hubo un problema al editar el producto'
);

if(!empty($producto)) {
    $jsonOBJ = json_decode($producto);

    if(isset($jsonOBJ->ID) && !empty($jsonOBJ->ID)) {
        include_once __DIR__.'/database.php';

        $id = $conexion->real_escape_string($jsonOBJ->ID);
        $nombre = $conexion->real_escape_string($jsonOBJ->nombre);
        $marca = $conexion->real_escape_string($jsonOBJ->marca);
        $modelo = $conexion->real_escape_string($jsonOBJ->modelo);
        $precio = floatval($jsonOBJ->precio);
        $detalles = $conexion->real_escape_string($jsonOBJ->detalles);
        $unidades = intval($jsonOBJ->unidades);
        $imagen = $conexion->real_escape_string($jsonOBJ->imagen);

        $sql = "UPDATE productos 
                SET nombre = '$nombre', 
                    marca = '$marca', 
                    modelo = '$modelo', 
                    precio = $precio, 
                    detalles = '$detalles', 
                    unidades = $unidades, 
                    imagen = '$imagen' 
                WHERE ID = $id";

        if($conexion->query($sql)) {
            $data['status'] = "success";
            $data['message'] = "Producto modificado exitosamente";
        } else {
            $data['message'] = "ERROR: No se pudo ejecutar $sql. " . $conexion->error;
        }
    } else {
        $data['message'] = "El ID del producto es inválido";
    }
} else {
    $data['message'] = "No se recibieron datos del producto";
}

echo json_encode($data, JSON_PRETTY_PRINT);
ob_end_flush(); // Enviar la salida capturada*/
    use TECWEB\BACKEND\MYAPI\Products;
    require_once __DIR__.'/myapi/Products.php';

    $producto = new Products('marketzone');
    $producto->edit(file_get_contents('php://input'));
    echo $producto->getData();
?>