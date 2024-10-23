<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();

    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_POST['id']) ) {
        $id = $_POST['id'];

        // SE REALIZA LA QUERY DE BÚSQUEDA
        $sql = "SELECT * FROM productos WHERE ID = $id";
        $result = $conexion->query($sql);

        // COMPROBAR SI SE ENCONTRÓ UN PRODUCTO
        if ($result) {
            $row = $result->fetch_assoc();
            $data = array(
                'ID' => $row['ID'],
                'nombre' => $row['nombre'],
                'precio' => $row['precio'],
                'unidades' => $row['unidades'],
                'modelo' => $row['modelo'],
                'detalles' => $row['detalles'],
                'imagen' => $row['imagen']
            );
        } else {
            // Si no se encuentra el producto, devolvemos un mensaje de error
            $data = array('error' => 'Producto no encontrado');
        }

        // LIBERAR EL RESULTADO
        $result->free();
        
        // CERRAR LA CONEXIÓN
        $conexion->close();
    } else {
        // Si no se recibe un ID, devolvemos un mensaje de error
        $data = array('error' => 'ID no proporcionado');
    }

    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>
