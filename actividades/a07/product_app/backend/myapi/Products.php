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
      $sql = "SELECT * FROM productos WHERE nombre = $name";
      $result = $this->conexion->query($sql);

      // COMPROBAR SI SE ENCONTRÓ UN PRODUCTO
      if ($result) {
        $row = $result->fetch_assoc();
        $data = array(
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
      // LIBERAR EL RESULTADO

      // CERRAR LA CONEXIÓN
      $this->conexion->close();
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
  }

  public function getData(): string{
    return $this->data[0];
  }

}
?>