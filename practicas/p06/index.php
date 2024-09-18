<?php
include_once 'funciones.php';
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Práctica 4</title>
    </head>

    <body>
        <h2>Ejercicio 1</h2>
        <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>

        <?php
            if (isset($_GET['numero'])) {
                $num = intval($_GET['numero']);
                echo multiplo5y7($num) . '<br>';
            } else{
                echo '<p> No esta la variable numero en la URL. </p>';
            }
        ?>

    </body>

</html>