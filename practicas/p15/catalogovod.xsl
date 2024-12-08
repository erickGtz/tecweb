<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    exclude-result-prefixes="xs"
    version="2.0">
    <xsl:template match="/">
        <html>
            <head>
                <title>VOD</title>
                <style>
                    body {
                    font-family: Arial, sans-serif;
                    background-color: #f0f0f0;
                    color: #333333;
                    margin: 0;
                    padding: 20px;
                    }
                    
                    h1 {
                    color: #91007b;
                    text-align: center;
                    }
                    
                    h3 {
                    color: #91007b;
                    }
                    
                    table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                    margin-bottom: 20px;
                    }
                    
                    th {
                    background-color: #91007b;
                    color: white;
                    padding: 10px;
                    text-align: left;
                    }
                    
                    td {
                    background-color: #ffffff;
                    padding: 8px;
                    border: 1px solid #ddd;
                    }
                    
                    tr:nth-child(even) td {
                    background-color: #f9f9f9;
                    }
                    
                    img {
                    display: block;
                    margin: 0px auto;
                    width: 200px;
                    height: auto;
                    }
                    
                    h2 {
                    color: #91007b;
                    text-align: center;
                    }
                    
                    .titulo {
                    padding-top: 35px;
                    background-color: #91007b;
                    height: 70px;
                    text-align: center;
                    }
                    
                    .titulo h1 {
                    color: #f0f0f0;
                    margin-top: auto;
                    }
                    
                </style>
            </head>
            <body>
                <div class="titulo">
                    <h1>Video On Demand</h1>
                </div>
                
                <img src="logo.png" alt="Logo VOD"/>
                
                <h3>Información de la Cuenta</h3>
                <p><strong>Correo:</strong> 
                    <xsl:value-of select="CatalogoVOD/cuenta/@correo"/>
                </p>
                <h3>Perfiles:</h3>
                <ul>
                    <xsl:for-each select="CatalogoVOD/cuenta/perfiles/perfil">
                        <li>
                            <xsl:value-of select="@usuario"/> 
                            (<xsl:value-of select="@idioma"/>)
                        </li>
                    </xsl:for-each>
                </ul>
                
                <h2>Mi lista</h2>

                <table border="1" style="width:100%; text-align:left; border-collapse:collapse;">
                    <tr>
                        <th colspan="3">Películas</th>
                    </tr>
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
                
                <br />
                

                <table border="1" style="width:100%; text-align:left; border-collapse:collapse;">
                    <tr>
                        <th colspan="3">Series</th>
                    </tr>
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