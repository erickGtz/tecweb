<?php

namespace TECWEB\BACKEND\MYAPI;

use TECWEB\BACKEND\MYAPI\DataBase;
require_once __DIR__ . '/DataBase.php';

class Products extends DataBase
{
  private $data;

  public function __construct($db, $user = 'root', $pass = 'fk1322')
  {
    $this->data = array();
    parent::__construct($user, $pass, $db);
  }

  public function singleByName($name)
  {
    // SE REALIZA LA QUERY DE BÚSQUEDA
    $sql = "SELECT * FROM productos WHERE nombre = '$name'";
    $result = $this->conexion->query($sql);

    // COMPROBAR SI SE ENCONTRÓ UN PRODUCTO
    if ($result && $row = $result->fetch_assoc()) {
      $this->data = array(
        'ID' => $row['ID'],
        'nombre' => $row['nombre'],
        'marca' => $row['marca'],
        'precio' => $row['precio'],
        'unidades' => $row['unidades'],
        'modelo' => $row['modelo'],
        'detalles' => $row['detalles'],
        'imagen' => $row['imagen']
      );
    } else {
      // Si no se encuentra el producto, devolvemos un mensaje de error
      $data = array('error' => 'Producto no encontrado');
    }

    // Asignar el JSON a $this->data en lugar de imprimirlo directamente
    $this->data = json_encode($this->data, JSON_PRETTY_PRINT);

    // LIBERAR EL RESULTADO Y CERRAR LA CONEXIÓN
    $this->conexion->close();
  }

  public function getData(): string{
    return json_encode($this->data);
  }


  public function list()
  {

    // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
    if ($result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0")) {
      // SE OBTIENEN LOS RESULTADOS
      $rows = $result->fetch_all(MYSQLI_ASSOC);

      if (!is_null($rows)) {
        // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
        foreach ($rows as $num => $row) {
          foreach ($row as $key => $value) {
            $this->data[$num][$key] = $value;
          }
        }
      }
      $result->free();
    } else {
      die('Query Error: ' . mysqli_error($this->conexion));
    }
    $this->conexion->close();
  }
}
