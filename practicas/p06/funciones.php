<?php
function multiplo5y7($num)
{
  $num = $_GET['numero'];
  if ($num % 5 == 0 && $num % 7 == 0) {
    echo '<h3>R= El número ' . $num . ' SÍ es múltiplo de 5 y 7.</h3>';
  } else {
    echo '<h3>R= El número ' . $num . ' NO es múltiplo de 5 y 7.</h3>';
  }
}

function genRepit()
{
  $i = 0;
  $matriz = [];
  $bandera = false;

  do {
    $num1 = random_int(0, 999);
    $num2 = random_int(0, 999);
    $num3 = random_int(0, 999);

    $matriz[$i][0] = $num1;
    $matriz[$i][1] = $num2;
    $matriz[$i][2] = $num3;

    if ($num1 % 2 != 0 && $num2 % 2 == 0 && $num3 % 2 != 0) {
      $bandera = true;
    } else {
      $i++;
    }
  } while (!$bandera);

  $totalNumeros = ($i + 1) * 3;
  $iteraciones = $i + 1;

  echo "<h3>Matriz de números generados:</h3>";
  for ($j = 0; $j < count($matriz); $j++) {
    echo $matriz[$j][0] . ", " . $matriz[$j][1] . ", " . $matriz[$j][2] . "<br>";
  }

  echo "<p>$totalNumeros números obtenidos en $iteraciones iteraciones</p>";
}

function encontrarMultiploWhile($divisor) {
    $i = 0; 
    $num = random_int(1, 999);

    while ($num % $divisor != 0) {
        $num = random_int(1, 999);
        $i++; 
    }
    $i++;

    echo "<p> Numero: $divisor. Primer número múltiplo encontrado usando while: $num , Iteraciones realizadas con while: $i </p>";
}

function encontrarMultiploDoWhile($divisor) {
    $i = 0; 
    do {
        $num = random_int(1, 999); 
        $i++; 
    } while ($num % $divisor != 0);

    echo "<p> Numero: $divisor. Primer número múltiplo encontrado usando do-while: $num , Iteraciones realizadas con do-while: $i </p>";
}


