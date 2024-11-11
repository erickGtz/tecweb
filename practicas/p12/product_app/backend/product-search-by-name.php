<?php
    use TECWEB\MYAPI\READ\Read;
    require_once __DIR__.'/vendor/autoload.php';

    $productos = new Read('marketzone');
    $productos->searchByName( $_GET['name'] );
    echo $productos->getData();
?>