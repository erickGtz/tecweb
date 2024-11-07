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

  public function getData(): string
  {
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

  public function single($id)
  {
    $sql = "SELECT * FROM productos WHERE ID = $id";
    $result = $this->conexion->query($sql);

    // COMPROBAR SI SE ENCONTRÓ UN PRODUCTO
    if ($result) {
      $row = $result->fetch_assoc();
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
      $this->data = array('error' => 'Producto no encontrado');
    }
    // LIBERAR EL RESULTADO
    $result->free();
    // CERRAR LA CONEXIÓN
    $this->conexion->close();
  }

  public function search($search)
  {
    // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
    $sql = "SELECT * FROM productos WHERE (ID = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
    if ($result = $this->conexion->query($sql)) {
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

  public function add($producto)
  {
    $data = array(
      'status' => 'error',
      'message' => 'Ya existe un producto con ese nombre'
    );

    if (!empty($producto)) {
      // SE TRANSFORMA EL STRING DEL JSON A OBJETO
      $jsonOBJ = json_decode($producto);

      // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
      $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
      $result = $this->conexion->query($sql);

      if ($result->num_rows == 0) {
        $this->conexion->set_charset("utf8");
        $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";
        if ($this->conexion->query($sql)) {
          $this->data['status'] = "success";
          $this->data['message'] = "Producto agregado";
        } else {
          $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
        }
      }

      $result->free();
      // Cierra la conexion
      $this->conexion->close();
    }
  }
}
