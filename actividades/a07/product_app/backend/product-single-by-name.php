<?php
    use TECWEB\BACKEND\MYAPI\Products;
    require_once __DIR__.'/myapi/Products.php';

    $producto = new Products('marketzone');
    $producto->singleByName($_POST['search']);
    echo $producto->getData();

?>