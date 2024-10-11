<?php
$link = mysqli_connect("localhost", "root", "fk1322", "marketzone");

if ($link === false) {
  die("ERROR: No pudo conectarse con la base de datos. " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['marca']) && isset($_POST['modelo']) && isset($_POST['precio']) && isset($_POST['unidades']) && isset($_POST['detalles']) && isset($_POST['img'])) {

    $id = mysqli_real_escape_string($link, $_POST['id']);
    $nombre = mysqli_real_escape_string($link, $_POST['nombre']);
    $marca = mysqli_real_escape_string($link, $_POST['marca']);
    $modelo = mysqli_real_escape_string($link, $_POST['modelo']);
    $precio = mysqli_real_escape_string($link, $_POST['precio']);
    $unidades = mysqli_real_escape_string($link, $_POST['unidades']);
    $detalles = mysqli_real_escape_string($link, $_POST['detalles']);
    $imagen = mysqli_real_escape_string($link, $_POST['img']);

    $sql = "UPDATE productos SET 
                    nombre='$nombre', 
                    marca='$marca', 
                    modelo='$modelo', 
                    precio='$precio', 
                    unidades='$unidades', 
                    detalles='$detalles', 
                    imagen='$imagen' 
                WHERE ID='$id'";

    if (mysqli_query($link, $sql)) {
      echo "Producto actualizado exitosamente.";
    } else {
      echo "ERROR: No se pudo ejecutar la actualización. " . mysqli_error($link);
    }
  } else {
    echo "Faltan datos en el formulario.";
  }
}

// Cierra la conexión
mysqli_close($link);
?>