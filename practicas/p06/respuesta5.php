<?php

if (isset($_POST['edad']) && isset($_POST['sexo'])) {
    $edad = intval($_POST['edad']);
    $sexo = $_POST['sexo'];

    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
    echo "<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='es'>";
    echo "<head>";
    echo "<meta http-equiv='Content-Type' content='application/xhtml+xml; charset=UTF-8' />";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0' />";
    echo "<title>Resultado</title>";
    echo "</head>";
    echo "<body>";

    if ($sexo === 'femenino' && $edad >= 18 && $edad <= 35) {
        echo "<h3>Bienvenida, usted está en el rango de edad permitido.</h3>";
    } else {
        echo "<h3>Lo siento, usted no cumple con los requisitos.</h3>";
    }

    echo "</body>";
    echo "</html>";
}

