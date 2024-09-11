<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Practica 4</title>
  </head>

  <body>

    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>

    <p>$_myvar: Valida, debido a que comienza con un guión bajo.</p>
    <p>$_7var: Valida, debido a que comienza con un guión bajo.</p>
    <p>myvar: Invalida, debido a que no comienza con el signo de dolar ($).</p>
    <p>$myvar: Valida, debido a que comienza con letras.</p>
    <p>$var7: Valida, debido a que comienza con letras.</p>
    <p>$_element1: Valida, debido a que comienza con un guión bajo.</p>
    <p>$house*5: Invalida, debido a que tiene el caracter de asterisco. Php toma este caracter como un operador.</p><br>

    <h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>

    <p>$a = “ManejadorSQL”; $b = 'MySQL’; $c = &$a;</p>

    <?php
    $a = "ManejadorSQL";
    $b = 'MySQL';
    $c = &$a;
    ?>

    <p>a. Ahora muestra el contenido de cada variable</p>
    <?php
    echo $a . '<br>';
    echo $b . '<br>';
    echo $c . '<br>';
    ?>

    <p>b. Agrega al código actual las siguientes asignaciones:</p>
    <p>$a = “PHP server”; $b = &$a;</p>
    <?php
    $a = "PHP server";
    $b = &$a;
    ?>

    <p>c. Vuelve a mostrar el contenido de cada uno</p>
    <?php
    echo $a . '<br>';
    echo $b . '<br>';
    echo $c . '<br>';
    ?>

    <p>d. Describe en y muestra en la página obtenida qué ocurrió en el segundo bloque de asignaciones:</p>
    <p>Lo que sucede en la segunda asignacion es que se cambia el valor de la variable a por una nueva cadena,
      y que la variable b ahora guarda la dirección de la variable, así como la variable c. Por lo que compartiran el
      valor que tenga la variable a.
      Esto lo vemos al momento de imprimir las tres variables, dan el mismo resultado. </p>

    <h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación,
      verificar la evolución del tipo de estas variables (imprime todos los componentes del arreglo):</p>

    <?php
    $a = "PHP5";
    echo '$a: ' . $a . ' (Type: ' . gettype($a) . ')<br>';

    $z[] = &$a;

    foreach ($z as $valor) {
      echo '$z: ' . $valor . ' (Type: ' . gettype($valor) . ')<br>';
    }

    $b = "5a version de PHP";
    echo '$b: ' . $b . ' (Type: ' . gettype($b) . ')<br>';
    $c = $b * 10;
    echo '$c: ' . $c . ' (Type: ' . gettype($c) . ')<br>';

    $a .= $b;
    echo '$a: ' . $a . ' (Type: ' . gettype($a) . ')<br>';

    $b *= $c;
    echo '$b: ' . $b . ' (Type: ' . gettype($b) . ')<br>';

    $z[0] = "MySQL";
    foreach ($z as $valor) {
      echo '$z: ' . $valor . ' (Type: ' . gettype($valor) . ')<br>';
    }
    ?>


    <h2>Ejercicio 4</h2>
    <p>Imprimiremos las variables usando la matriz GLOBALS:</p>

    <?php
    $a = "PHP5";
    echo '$a: ' . $GLOBALS['a'] . ' (Type: ' . gettype($GLOBALS['a']) . ')<br>';

    foreach ($GLOBALS['z'] as $valor) {
      echo '$z: ' . $valor . ' (Type: ' . gettype($valor) . ')<br>';
    }

    $b = "5a version de PHP";
    echo '$b: ' . $GLOBALS['b'] . ' (Type: ' . gettype($GLOBALS['b']) . ')<br>';

    $c = $GLOBALS['b'] * 10;
    echo '$c: ' . $c . ' (Type: ' . gettype($c) . ')<br>';

    $GLOBALS['a'] .= $GLOBALS['b'];
    echo '$a: ' . $GLOBALS['a'] . ' (Type: ' . gettype($GLOBALS['a']) . ')<br>';

    $GLOBALS['b'] *= $c;
    echo '$b: ' . $GLOBALS['b'] . ' (Type: ' . gettype($GLOBALS['b']) . ')<br>';

    foreach ($GLOBALS['z'] as $valor) {
      echo '$z: ' . $valor . ' (Type: ' . gettype($valor) . ')<br>';
    }
    ?>


    <h2>Ejercicio 5</h2>
    <p>Dar el valor de las variables $a, $b, $c al final del siguiente script:</p>
    <p>$a = “7 personas”; $b = (integer) $a; $a = “9E3”; $c = (double) $a;</p>

    <?php
    $a = "7 personas";

    echo $a . '<br>';

    $b = (integer) $a;

    echo $b . '<br>';

    $a = "9E3";

    echo $a . '<br>';

    $c = (double) $a;

    echo $c . '<br>';

    ?>

    <h2>Ejercicio 6</h2>
    <p>Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas usando la función
      var_dump(<datos>):</p>
    <p>$a = “0”; $b = “TRUE”; $c = FALSE; $d = ($a OR $b); $e = ($a AND $c); $f = ($a XOR $b);</p>

    <?php
    $a = "0";
    $b = "TRUE";
    $c = FALSE;
    $d = ($a or $b);
    $e = ($a and $c);
    $f = ($a XOR $b);

    var_dump($a);
    echo '<br>';
    var_dump($b);
    echo '<br>';
    var_dump($c);
    echo '<br>';
    var_dump($d);
    echo '<br>';
    var_dump($e);
    echo '<br>';
    var_dump($f);
    echo '<br>';

    ?>

    <p>Después investiga una función de PHP que permita transformar el valor booleano de $c y $e en uno que se pueda
      mostrar con un echo:</p>
    <?php

    echo '$c: ' . ($c ? 'true' : 'false') . '<br>';
    echo '$e: ' . ($e ? 'true' : 'false') . '<br>';

    ?>

    <h2>Ejercicio 7</h2>
    <p>Usando la variable predefinida $_SERVER, determina lo siguiente:</p>
    <p>a. La versión de Apache y PHP, b. El nombre del sistema operativo (servidor), c. El idioma del navegador
      (cliente)</p>

    <?php
    echo "Versión de PHP: " . phpversion() . "<br>";
    echo "Versión del servidor: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
    echo "Idioma del navegador: " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "<br>";
    ?>

  </body>

</html>