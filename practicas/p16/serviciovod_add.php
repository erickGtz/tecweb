<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $xmlFile = 'serviciovod.xml';
    $newXmlFile = 'serviciovod_updated.xml';

    // Cargar el XML
    $xml = new DOMDocument();
    $xml->load($xmlFile);

    // Agregar nuevo perfil
    $usuario = $_POST['usuario'];
    $idioma = $_POST['idioma'];
    $perfil = $xml->createElement('perfil');
    $perfil->setAttribute('usuario', $usuario);
    $perfil->setAttribute('idioma', $idioma);
    $xml->getElementsByTagName('perfiles')->item(0)->appendChild($perfil);

    // Agregar nuevo género de películas
    $generoPeliculas = $_POST['genero_peliculas'];
    $tituloPelicula1 = $_POST['titulo_pelicula1'];
    $duracionPelicula1 = $_POST['duracion_pelicula1'];
    $tituloPelicula2 = $_POST['titulo_pelicula2'];
    $duracionPelicula2 = $_POST['duracion_pelicula2'];

    $genero = $xml->createElement('genero');
    $genero->setAttribute('nombre', $generoPeliculas);
    $titulo1 = $xml->createElement('titulo', $tituloPelicula1);
    $titulo1->setAttribute('duracion', $duracionPelicula1);
    $titulo2 = $xml->createElement('titulo', $tituloPelicula2);
    $titulo2->setAttribute('duracion', $duracionPelicula2);
    $genero->appendChild($titulo1);
    $genero->appendChild($titulo2);
    $xml->getElementsByTagName('peliculas')->item(0)->appendChild($genero);

    // Agregar nuevo género de series
    $generoSeries = $_POST['genero_series'];
    $tituloSerie1 = $_POST['titulo_serie1'];
    $duracionSerie1 = $_POST['duracion_serie1'];
    $tituloSerie2 = $_POST['titulo_serie2'];
    $duracionSerie2 = $_POST['duracion_serie2'];

    $genero = $xml->createElement('genero');
    $genero->setAttribute('nombre', $generoSeries);
    $titulo1 = $xml->createElement('titulo', $tituloSerie1);
    $titulo1->setAttribute('duracion', $duracionSerie1);
    $titulo2 = $xml->createElement('titulo', $tituloSerie2);
    $titulo2->setAttribute('duracion', $duracionSerie2);
    $genero->appendChild($titulo1);
    $genero->appendChild($titulo2);
    $xml->getElementsByTagName('series')->item(0)->appendChild($genero);

    // Guardar el XML actualizado
    $xml->save($newXmlFile);

    // Mostrar un hipervínculo para descargar el nuevo XML
    echo '<h1>Catálogo VOD Actualizado</h1>';
    echo '<p>El catálogo ha sido actualizado exitosamente. <a href="' . $newXmlFile . '">Descargar nuevo XML</a></p>';
}
?>