<?php

$autos = array(
  "CUE1983" => array(
    "Auto" => array(
      "marca" => "NISSAN",
      "modelo" => "2018",
      "tipo" => "Camioneta"
    ),
    "Propietario" => array(
      "nombre" => "Marcos Gonzales",
      "ciudad" => "Cuevano, Gua.",
      "direccion" => "La Quinta, Cuevano."
    )
  ),
  "ABC1234" => array(
    "Auto" => array(
      "marca" => "TOYOTA",
      "modelo" => "2017",
      "tipo" => "Deportivo"
    ),
    "Propietario" => array(
      "nombre" => "Luisa Martinez",
      "ciudad" => "León, Gto.",
      "direccion" => "Calle Palma 123"
    )
  ),
  "XYZ5678" => array(
    "Auto" => array(
      "marca" => "HONDA",
      "modelo" => "2020",
      "tipo" => "Mini"
    ),
    "Propietario" => array(
      "nombre" => "Carlos Rodriguez",
      "ciudad" => "Guadalajara, Jal.",
      "direccion" => "Av. Vallarta 567"
    )
  ),
  "JKL9101" => array(
    "Auto" => array(
      "marca" => "FORD",
      "modelo" => "2019",
      "tipo" => "Camioneta"
    ),
    "Propietario" => array(
      "nombre" => "Ana Pérez",
      "ciudad" => "Monterrey, NL",
      "direccion" => "Calle 5 de Mayo 120"
    )
  ),
  "QWE1234" => array(
    "Auto" => array(
      "marca" => "CHEVROLET",
      "modelo" => "2015",
      "tipo" => "Deportivo"
    ),
    "Propietario" => array(
      "nombre" => "Juan Fernandez",
      "ciudad" => "Querétaro, Qro.",
      "direccion" => "Colonia Centro, Querétaro"
    )
  ),
  "TYU4567" => array(
    "Auto" => array(
      "marca" => "MAZDA",
      "modelo" => "2021",
      "tipo" => "Deportivo"
    ),
    "Propietario" => array(
      "nombre" => "Lorena Ruiz",
      "ciudad" => "Toluca, EdoMex.",
      "direccion" => "Av. Hidalgo 43"
    )
  ),
  "FGH7890" => array(
    "Auto" => array(
      "marca" => "BMW",
      "modelo" => "2022",
      "tipo" => "Camioneta"
    ),
    "Propietario" => array(
      "nombre" => "Pedro Gutiérrez",
      "ciudad" => "Puebla, Pue.",
      "direccion" => "Calle Estrella 55"
    )
  ),
  "RTY1234" => array(
    "Auto" => array(
      "marca" => "VOLKSWAGEN",
      "modelo" => "2014",
      "tipo" => "Camioneta"
    ),
    "Propietario" => array(
      "nombre" => "Sofia Ramirez",
      "ciudad" => "San Luis Potosí, SLP.",
      "direccion" => "Col. Roma, San Luis"
    )
  ),
  "BNM3456" => array(
    "Auto" => array(
      "marca" => "TESLA",
      "modelo" => "2023",
      "tipo" => "Mini"
    ),
    "Propietario" => array(
      "nombre" => "Raúl Hernández",
      "ciudad" => "Ciudad de México, CDMX",
      "direccion" => "Av. Insurgentes 908"
    )
  ),
  "UJI6789" => array(
    "Auto" => array(
      "marca" => "MERCEDES",
      "modelo" => "2019",
      "tipo" => "Camioneta"
    ),
    "Propietario" => array(
      "nombre" => "Marta Flores",
      "ciudad" => "Veracruz, Ver.",
      "direccion" => "Callejón Reforma 78"
    )
  ),
  "ZXC8901" => array(
    "Auto" => array(
      "marca" => "AUDI",
      "modelo" => "2016",
      "tipo" => "Deportivo"
    ),
    "Propietario" => array(
      "nombre" => "Guillermo Ríos",
      "ciudad" => "Zacatecas, Zac.",
      "direccion" => "Centro Histórico 67"
    )
  ),
  "VBN0123" => array(
    "Auto" => array(
      "marca" => "KIA",
      "modelo" => "2020",
      "tipo" => "Camioneta"
    ),
    "Propietario" => array(
      "nombre" => "Roberto Salinas",
      "ciudad" => "Morelia, Mich.",
      "direccion" => "Calle Magnolia 102"
    )
  ),
  "POI3456" => array(
    "Auto" => array(
      "marca" => "HYUNDAI",
      "modelo" => "2021",
      "tipo" => "Mini"
    ),
    "Propietario" => array(
      "nombre" => "Julia Santana",
      "ciudad" => "Chihuahua, Chih.",
      "direccion" => "Av. Universidad 900"
    )
  ),
  "WER5678" => array(
    "Auto" => array(
      "marca" => "FIAT",
      "modelo" => "2018",
      "tipo" => "Mini"
    ),
    "Propietario" => array(
      "nombre" => "Diego Montoya",
      "ciudad" => "Tijuana, BC",
      "direccion" => "Calle Revolución 34"
    )
  ),
  "DFG8901" => array(
    "Auto" => array(
      "marca" => "PEUGEOT",
      "modelo" => "2017",
      "tipo" => "Deportivo"
    ),
    "Propietario" => array(
      "nombre" => "Rosa López",
      "ciudad" => "Aguascalientes, Ags.",
      "direccion" => "Blvd. San Marcos 85"
    )
  )
);

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
echo "<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='es'>";
echo "<head>";
echo "<meta http-equiv='Content-Type' content='application/xhtml+xml; charset=UTF-8' />";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0' />";
echo "<title>Resultado</title>";
echo "</head>";
echo "<body>";

if (isset($_POST['mostrar_todos'])) {

  echo "<h2>Todos los Autos:</h2>";

  foreach ($autos as $matricula => $datos) {
    echo "<h3>Matrícula: $matricula</h3>";
    echo "Marca: " . $datos['Auto']['marca'] . "<br>";
    echo "Modelo: " . $datos['Auto']['modelo'] . "<br>";
    echo "Tipo: " . $datos['Auto']['tipo'] . "<br>";
    echo "Propietario: " . $datos['Propietario']['nombre'] . "<br>";
    echo "Ciudad: " . $datos['Propietario']['ciudad'] . "<br>";
    echo "Dirección: " . $datos['Propietario']['direccion'] . "<br><br>";
  }
} else if (isset($_POST['matricula'])) {

  $matricula = $_POST['matricula'];



  if (isset($autos[$matricula])) {

    echo "<h2>Datos de matricula: $matricula </h2>";

    $auto = $autos[$matricula];
    echo "Matrícula encontrada: $matricula <br>";
    echo "Marca: " . $auto['Auto']['marca'] . "<br>";
    echo "Modelo: " . $auto['Auto']['modelo'] . "<br>";
    echo "Tipo: " . $auto['Auto']['tipo'] . "<br>";
    echo "Propietario: " . $auto['Propietario']['nombre'] . "<br>";
    echo "Ciudad: " . $auto['Propietario']['ciudad'] . "<br>";
    echo "Dirección: " . $auto['Propietario']['direccion'] . "<br>";



  } else {
    echo "<h2>Matrícula no encontrada</h2>";
  }

}


echo "</body>";
echo "</html>";
