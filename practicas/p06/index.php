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
        } else {
            echo '<p> No esta la variable numero en la URL. </p>';
        }
        ?>

        <h2>Ejercicio 2</h2>
        <p>Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una secuencia compuesta
            por
            impar, par, impar.
        </p>

        <?php
        genRepit();
        ?>

        <h3>Ejercicio 3</h3>
        <p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente, pero que además sea
            múltiplo de un número dado. </p>

        <form action="index.php" method="GET">
            Número: <input type="text" name="numero_2"><br>
            <input type="submit" name="submit" value="Encontrar Múltiplo">
        </form>

        <?php
        if (isset($_GET['submit']) && isset($_GET['numero_2'])) {
            $divisor = intval($_GET['numero_2']);
            encontrarMultiploWhile($divisor);
            encontrarMultiploDoWhile($divisor);
        }
        ?>

    </body>

</html>