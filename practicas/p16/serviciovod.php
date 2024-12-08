<?php
libxml_use_internal_errors(true);

// Cargar y validar el XML contra el XSD
$xmlPath = 'serviciovod.xml'; // Reemplaza con la ruta real de tu archivo XML
$xsdPath = 'serviciovod.xsd'; // Reemplaza con la ruta real de tu archivo XSD

$xml = new DOMDocument();
$xml->load($xmlPath);

if (!$xml->schemaValidate($xsdPath)) {
    // Si falla la validación, obtener y mostrar los errores
    $errors = libxml_get_errors();
    libxml_clear_errors();
    echo "<html><body><h1>Errores de validación:</h1><ul>";
    foreach ($errors as $error) {
        echo "<li>[Línea {$error->line}]: {$error->message}</li>";
    }
    echo "</ul></body></html>";
    exit;
}

// Si la validación es exitosa, procesar el XML
$xmlContent = simplexml_load_file($xmlPath);

echo "<!DOCTYPE html>";
echo "<html lang='es'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Catálogo VOD</title>";
echo "<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f5f3fc;
        color: #4b0082;
    }
    h1, h2 {
        color: #663399;
        text-align: center;
    }
    table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        border: 1px solid #4b0082;
    }
    th, td {
        border: 1px solid #4b0082;
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #4b0082;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #e8dff5;
    }
    img {
        display: block;
        margin: 20px auto;
        width: 200px;
        height: auto;
    }
</style>";
echo "</head>";
echo "<body>";
echo "<img src='logo.png' alt='Logotipo de la compañía'/>";
echo "<h1>Catálogo de Películas y Series</h1>";

// Mostrar tabla de películas
echo "<h2>Películas</h2>";
echo "<table>";
echo "<tr><th>Título</th><th>Duración</th><th>Género</th></tr>";

foreach ($xmlContent->contenido->peliculas->genero as $genero) {
    foreach ($genero->titulo as $titulo) {
        echo "<tr>";
        echo "<td>{$titulo}</td>";
        echo "<td>{$titulo['duracion']}</td>";
        echo "<td>{$genero['nombre']}</td>";
        echo "</tr>";
    }
}
echo "</table>";

// Mostrar tabla de series
echo "<h2>Series</h2>";
echo "<table>";
echo "<tr><th>Título</th><th>Duración</th><th>Género</th></tr>";

foreach ($xmlContent->contenido->series->genero as $genero) {
    foreach ($genero->titulo as $titulo) {
        echo "<tr>";
        echo "<td>{$titulo}</td>";
        echo "<td>{$titulo['duracion']}</td>";
        echo "<td>{$genero['nombre']}</td>";
        echo "</tr>";
    }
}
echo "</table>";

echo "</body>";
echo "</html>";
?>