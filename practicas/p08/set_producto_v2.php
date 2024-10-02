<?php
$nombre = isset($_POST['nombre'])? $_POST['nombre'] : 'nombre_producto';
$marca  = isset($_POST['marca'])? $_POST['marca'] : 'marca_producto';
$modelo = isset($_POST['modelo'])? $_POST['modelo'] : 'modelo_producto';
$precio = isset($_POST['precio'])? $_POST['precio'] : 'precio_producto';
$detalles = isset($_POST['detalles'])? $_POST['detalles'] : 'detalles_producto';
$unidades = isset($_POST['unidades'])? $_POST['unidades'] : 'unidades_producto';
$imagen   = isset($_POST['img'])? $_POST['img'] : 'imagen_producto';


/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', 'fk1322', 'marketzone');	

/** comprobar la conexión */
if ($link->connect_errno) 
{
    die('Falló la conexión: '.$link->connect_error.'<br/>');
    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
}

/**$sql = "SELECT * FROM productos WHERE nombre = {$nombre}, marca = VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";

/** Crear una tabla que no devuelve un conjunto de resultados */
$sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";
if ( $link->query($sql) ) 
{
    echo 'Producto insertado con ID: '.$link->insert_id;
}
else
{
	echo 'El Producto no pudo ser insertado =(';
}

$link->close();
