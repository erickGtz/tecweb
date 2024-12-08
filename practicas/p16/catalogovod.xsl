<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/strict.dtd"/>
    <xsl:template match="/">
        <html>
            <head>
                <title>Catálogo VOD</title>
                <style>
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
                </style>
            </head>
            <body>
                <!-- Logotipo al inicio de la página -->
                <img src="logo.png" alt="Logotipo de la compañía"/>
                
                <!-- Título de la página -->
                <h1>Catálogo de Películas y Series</h1>
                
                <!-- Tabla de Películas -->
                <h2>Películas</h2>
                <table>
                    <tr>
                        <th>Título</th>
                        <th>Duración</th>
                        <th>Género</th>
                    </tr>
                    <xsl:for-each select="CatalogoVOD/contenido/peliculas/genero">
                        <xsl:for-each select="titulo">
                            <tr>
                                <td><xsl:value-of select="."/></td>
                                <td><xsl:value-of select="@duracion"/></td>
                                <td><xsl:value-of select="../@nombre"/></td>
                            </tr>
                        </xsl:for-each>
                    </xsl:for-each>
                </table>
                
                <!-- Tabla de Series -->
                <h2>Series</h2>
                <table>
                    <tr>
                        <th>Título</th>
                        <th>Duración</th>
                        <th>Género</th>
                    </tr>
                    <xsl:for-each select="CatalogoVOD/contenido/series/genero">
                        <xsl:for-each select="titulo">
                            <tr>
                                <td><xsl:value-of select="."/></td>
                                <td><xsl:value-of select="@duracion"/></td>
                                <td><xsl:value-of select="../@nombre"/></td>
                            </tr>
                        </xsl:for-each>
                    </xsl:for-each>
                </table>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
