<?php
namespace TECWEB\MYAPI;

use TECWEB\MYAPI\DataBase;
require_once __DIR__ . '/DataBase.php';

class Products extends DataBase
{
    private $data;

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


    public function delete($id)
    {
        // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
        $this->data = array(
            'status' => 'error',
            'message' => 'La consulta falló'
        );
        // SE VERIFICA HABER RECIBIDO EL ID
        if (isset($id)) {
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            $sql = "UPDATE productos SET eliminado=1 WHERE ID = {$id}";
            if ($this->conexion->query($sql)) {
                $this->data['status'] = "success";
                $this->data['message'] = "Producto eliminado";
            } else {
                $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
    }

    public function edit($jsonOBJ)
    {
        // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
        $this->data = array(
            'status' => 'error',
            'message' => 'La consulta falló'
        );
        // SE VERIFICA HABER RECIBIDO EL ID
        if (isset($jsonOBJ->id)) {
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            $sql = "UPDATE productos SET nombre='{$jsonOBJ->nombre}', marca='{$jsonOBJ->marca}',";
            $sql .= "modelo='{$jsonOBJ->modelo}', precio={$jsonOBJ->precio}, detalles='{$jsonOBJ->detalles}',";
            $sql .= "unidades={$jsonOBJ->unidades}, imagen='{$jsonOBJ->img}' WHERE ID={$jsonOBJ->id}";
            $this->conexion->set_charset("utf8");
            if ($this->conexion->query($sql)) {
                $this->data['status'] = "success";
                $this->data['message'] = "Producto actualizado";
            } else {
                $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
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

    public function search($search)
    {
        // SE VERIFICA HABER RECIBIDO EL ID
        if (isset($search)) {
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
    }

    public function searchByName($name){
        $this->data = ['exists' => false];
    if (isset($name)) {

        $sql = "SELECT nombre FROM productos WHERE nombre = '{$name}' AND eliminado = 0";
        if ($result = $this->conexion->query($sql)) {
            $this->data['exists'] = $result->num_rows > 0;
            $result->free();
        } else {
            die('Query Error: ' . mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }
    }

    public function single($id)
    {
        if (isset($id)) {
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            if ($result = $this->conexion->query("SELECT * FROM productos WHERE ID = {$id}")) {
                // SE OBTIENEN LOS RESULTADOS
                $row = $result->fetch_assoc();

                if (!is_null($row)) {
                    // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                    foreach ($row as $key => $value) {
                        $this->data[$key] = $value;
                    }
                }
                $result->free();
            } else {
                die('Query Error: ' . mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }
    }

    public function getData()
    {
        // SE HACE LA CONVERSIÓN DE ARRAY A JSON
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }
}

//$productos = new Productos();
?>