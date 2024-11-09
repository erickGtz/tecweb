<?php
include_once __DIR__.'/database.php';

// Prepara la respuesta
$data = array(
    'status'  => 'error',
    'message' => 'Ya existe un producto con ese nombre'
);

// Lee el JSON del cuerpo de la solicitud
$json = file_get_contents('php://input');
$jsonOBJ = json_decode($json);

if (isset($jsonOBJ->nombre)) {
    // Realiza la consulta para verificar si el producto ya existe
    $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
    $result = $conexion->query($sql);

    if ($result->num_rows == 0) {
        // Establece el juego de caracteres y realiza la inserción
        $conexion->set_charset("utf8");
        $sql = "INSERT INTO productos (ID, nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) VALUES 
                (NULL, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', 
                {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->img}', 0)";
                
        if ($conexion->query($sql)) {
            $data['status'] = "success";
            $data['message'] = "Producto agregado";
        } else {
            $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
        }
    }
    $result->free();
    $conexion->close();
}

// Envía la respuesta como JSON
echo json_encode($data, JSON_PRETTY_PRINT);
?>
