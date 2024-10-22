<?php
include_once __DIR__.'/database.php';

// Obtener el contenido JSON enviado
$producto = file_get_contents('php://input');
if (!empty($producto)) {
    // Convertir JSON a objeto
    $jsonOBJ = json_decode($producto);
    $nombre = $jsonOBJ->nombre;

    // Verificar si ya existe un producto con el mismo nombre que no esté eliminado
    $query = "SELECT * FROM productos WHERE nombre = ? AND eliminado = 0";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Si existe un producto con el mismo nombre, no hacer la inserción
        echo '[SERVIDOR] Error: Ya existe un producto con ese nombre.';
    } else {
        // Si no existe, proceder a la inserción
        $query_insert = "INSERT INTO productos (nombre, precio, unidades, modelo, marca, detalles, imagen) 
                         VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conexion->prepare($query_insert);
        $stmt_insert->bind_param("sdissss", $jsonOBJ->nombre, $jsonOBJ->precio, $jsonOBJ->unidades, 
                                  $jsonOBJ->modelo, $jsonOBJ->marca, $jsonOBJ->detalles, $jsonOBJ->imagen);

        if ($stmt_insert->execute()) {
            echo '[SERVIDOR] Producto agregado exitosamente.';
        } else {
            echo '[SERVIDOR] Error: No se pudo agregar el producto.';
        }
    }
    $stmt->close();
    $conexion->close();
}
?>
