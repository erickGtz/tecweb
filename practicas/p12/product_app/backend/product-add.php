<?php
    use TECWEB\MYAPI\CREATE\Create;
    require_once __DIR__.'/vendor/autoload.php';

    $productos = new Create('marketzone');
    $productos->add( $_POST );
    echo $productos->getData();
?>