<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
  <?php
  $data = array();
    /** SE CREA EL OBJETO DE CONEXION */
    @$link = new mysqli('localhost', 'root', 'fk1322', 'marketzone');
    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */

    $link->set_charset("utf8");

    /** comprobar la conexión */
    if ($link->connect_errno) {
      die('Falló la conexión: ' . $link->connect_error . '<br/>');
      //exit();
    }

    /** Crear una tabla que no devuelve un conjunto de resultados */
    if ($result = $link->query("SELECT * FROM productos WHERE eliminado = 0")) {
      /** Se extraen las tuplas obtenidas de la consulta */
      $row = $result->fetch_all(MYSQLI_ASSOC);

      /** Se crea un arreglo con la estructura deseada */
      foreach ($row as $num => $registro) {            // Se recorren tuplas
        foreach ($registro as $key => $value) {      // Se recorren campos
          $data[$num][$key] = $value;
        }
      }

      /** útil para liberar memoria asociada a un resultado con demasiada información */
      $result->free();
    }

    $link->close();
  
  ?>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  </head>

  <body>
    <h3>PRODUCTOS</h3>

    <br />

    <?php if (isset($data)): ?>

      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Marca</th>
            <th scope="col">Modelo</th>
            <th scope="col">Precio</th>
            <th scope="col">Unidades</th>
            <th scope="col">Detalles</th>
            <th scope="col">Imagen</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($data as $index => $productos) {
            echo "<tr>";
            echo "<th scope='row'> " . $productos['ID'] . "</th>";
            echo "<td>" . $productos['nombre'] . "</td>";
            echo "<td>" . $productos['marca'] . "</td>";
            echo "<td>" . $productos['modelo'] . "</td>";
            echo "<td>" . $productos['precio'] . "</td>";
            echo "<td>" . $productos['unidades'] . "</td>";
            echo "<td>" . htmlspecialchars($productos['detalles'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo '<td><img src="' . $productos['imagen'] . '" /></td>';
            echo "</tr>";
          }
          ?>
          </tr>
        </tbody>
      </table>

    <?php elseif (!empty($data)): ?>

      <script>
        alert('Algo salio mal, verifique la variable "tope".');
      </script>

    <?php endif; ?>
  </body>

</html>