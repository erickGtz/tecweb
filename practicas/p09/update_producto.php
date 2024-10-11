<?php
 /* MySQL Conexion*/
 $link = mysqli_connect("localhost", "root", "fk1322", "marketzone");
 // Chequea coneccion
 if($link === false){
 die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
 }
 // Ejecuta la actualizacion del registro
 $sql = "UPDATE productos SET email='josem_nuevo@mail.com' WHERE id=3";
 if(mysqli_query($link, $sql)){
 echo "Registro actualizado.";
 } else {
 echo "ERROR: No se ejecuto $sql. " . mysqli_error($link);
 }
 // Cierra la conexion
 mysqli_close($link);
?>