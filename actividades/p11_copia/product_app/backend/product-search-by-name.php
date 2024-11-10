<?php
    include_once __DIR__.'/database.php';

    $response = ['exists' => false];
    if (isset($_GET['name'])) {
        $name = $conexion->real_escape_string($_GET['name']);
        $sql = "SELECT nombre FROM productos WHERE nombre = '{$name}' AND eliminado = 0";
        if ($result = $conexion->query($sql)) {
            $response['exists'] = $result->num_rows > 0;
            $result->free();
        } else {
            die('Query Error: ' . mysqli_error($conexion));
        }
        $conexion->close();
    }
    echo json_encode($response, JSON_PRETTY_PRINT);
?>
