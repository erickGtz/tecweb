<?php
$nombre = 'Peluche Dr Simi';
$marca  = 'Farmacias Similares';
$modelo = 'Original Dr Simi';
$precio = 149.00;
$detalles = 'Peluche hipoalergénico del Dr Simi';
$unidades = 47;
$imagen   = 'img/peluche-dr-simi.png';

/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', 'fk1322', 'marketzone');	

/** comprobar la conexión */
if ($link->connect_errno) 
{
    die('Falló la conexión: '.$link->connect_error.'<br/>');
    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
}

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
?>