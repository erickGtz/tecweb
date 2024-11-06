<?php
    use TECWEB\BACKEND\MYAPI\Products;
    require_once __DIR__.'/database.php';

    $producto = new Products('marketzone');
    $producto->singleByName($_POST['name']);
    echo $producto->getData();

?>
