<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    
    // SE VERIFICA HABER RECIBIDO LOS PARÁMETROS 'search' Y 'cat'
    if( isset($_POST['search']) && isset($_POST['cat']) ) {
        $search = $_POST['search'];
        $cat = $_POST['cat'];

        // SE REALIZA LA QUERY DE BÚSQUEDA USANDO LIKE
        $query = "SELECT * FROM productos WHERE $cat LIKE '%{$search}%' AND WHERE eliminado = 0";
        if ( $result = $conexion->query($query) ) {
            // SE OBTIENEN LOS RESULTADOS Y SE AGREGAN AL ARRAY DE RESPUESTA
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $producto = array();
                foreach($row as $key => $value) {
                    $producto[$key] = utf8_encode($value);
                }
                $data[] = $producto;  // Se añaden múltiples productos
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
        $conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>
