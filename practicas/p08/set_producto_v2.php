<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

</html>

<?php
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : 'nombre_producto';
$marca = isset($_POST['marca']) ? $_POST['marca'] : 'marca_producto';
$modelo = isset($_POST['modelo']) ? $_POST['modelo'] : 'modelo_producto';
$precio = isset($_POST['precio']) ? $_POST['precio'] : 'precio_producto';
$detalles = isset($_POST['detalles']) ? $_POST['detalles'] : 'detalles_producto';
$unidades = isset($_POST['unidades']) ? $_POST['unidades'] : 'unidades_producto';
$imagen = isset($_POST['img']) ? $_POST['img'] : 'imagen_producto';


/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', 'fk1322', 'marketzone');

/** comprobar la conexión */
if ($link->connect_errno) {
    die('Falló la conexión: ' . $link->connect_error . '<br/>');
    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
}

?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
</head>

<body>

    <?php
        $sql_check = "SELECT * FROM productos WHERE nombre = '$nombre' AND marca = '$marca' AND modelo = '$modelo'";
        $result = $link->query($sql_check);

        if ($result->num_rows > 0) {
            echo '<p>Error: Ya existe un producto con el mismo nombre, marca y modelo.</p>';
        } else {
            /*$sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";*/
            $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen)VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";
            if ($link->query($sql)) {

                echo '<h1>Producto</h1>';
                echo '<p>Nombre: ' . $nombre . '</p>';
                echo '<p>Marca: ' . $marca . '</p>';
                echo '<p>Modelo: ' . $modelo . '</p>';
                echo '<p>Precio: ' . $precio . '</p>';
                echo '<p>Detalles: ' . $detalles . '</p>';
                echo '<p>Unidades: ' . $unidades . '</p>';
                echo '<p>Imagen: </p>';
                echo '<img src="' . $imagen . '" alt="' . $imagen . '"/>';

            } else {
                echo '<p>El Producto no pudo ser insertado =(</p>';
            }
        }
        $link->close();
    ?>

</body>

</html>