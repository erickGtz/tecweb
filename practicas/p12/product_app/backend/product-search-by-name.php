<?php
    use TECWEB\MYAPI\Products;
    require_once __DIR__.'/myapi/Products.php';

    $productos = new Products('marketzone');
    $productos->searchByName( $_GET['name'] );
    echo $productos->getData();
?>