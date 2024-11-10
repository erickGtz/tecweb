<?php
namespace TECWEB\MYAPI;

use TECWEB\MYAPI\DataBase;
require_once __DIR__ . '../DataBase.php';

class Create extends DataBase
{
  public function __construct($db, $user = 'root', $pass = 'fk1322')
  {
    $this->data = array();
    parent::__construct($db, $user, $pass);
  }

  public function add($producto)
  {
    // Estructura de respuesta inicial
    $this->data = array(
      'status' => 'error',
      'message' => 'Ya existe un producto con ese nombre'
    );

    // Comprueba si el producto tiene un nombre
    if (isset($producto['nombre'])) {
      // Realiza la consulta para verificar si el producto ya existe
      $sql = "SELECT * FROM productos WHERE nombre = '{$producto['nombre']}' AND eliminado = 0";
      $result = $this->conexion->query($sql);

      if ($result->num_rows == 0) {
        // Inserta el nuevo producto si no existe
        $this->conexion->set_charset("utf8");
        $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) VALUES 
            ('{$producto['nombre']}', '{$producto['marca']}', '{$producto['modelo']}', 
            {$producto['precio']}, '{$producto['detalles']}', {$producto['unidades']}, '{$producto['img']}', 0)";

        if ($this->conexion->query($sql)) {
          $this->data['status'] = "success";
          $this->data['message'] = "Producto agregado";
        } else {
          $this->data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
        }
      }
      $result->free();
      $this->conexion->close();
    }
  }
}

?>