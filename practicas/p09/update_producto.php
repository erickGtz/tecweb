<?php
/* MySQL Conexion */
$link = mysqli_connect("localhost", "root", "fk1322", "marketzone");
// Chequea coneccion
if ($link === false) {
    die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
}

// Obtener los datos del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$precio = $_POST['precio'];
$detalles = $_POST['detalles'];
$unidades = $_POST['unidades'];
$imagen = $_POST['img'];

// Ejecuta la actualización del registro
$sql = "UPDATE productos SET nombre='$nombre', marca='$marca', modelo='$modelo', precio='$precio', detalles='$detalles', unidades='$unidades', imagen='$imagen' WHERE id='$id'";
if (mysqli_query($link, $sql)) {
    echo '<p>Registro actualizado correctamente.</p>';
} else {
    echo '<p>ERROR: No se ejecutó $sql. ' . mysqli_error($link) . '</p>';
}

mysqli_close($link);

echo '<br><br>';
echo '<a href="get_productos_vigentes_v2.php">Ver productos vigentes</a>';
echo ' | ';
echo '<a href="get_productos_xhtml_v2.php">Ver los productos por tope de unidades</a>';
?>
