<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Productos</title>
  </head>

  <body>
    <h1>Bazar de libros "Patricia e hijas"</h1>
    <h2>Registro de producto</h2>

    <script type="text/javascript">
      function validarEntradas() {
        var nombre = document.getElementById('form-nombre').value;
        var marca = document.getElementById('form-marcas').value;
        var modelo = document.getElementById('form-modelo').value;
        var precio = document.getElementById('form-precio').value;
        var detalles = document.getElementById('form-detalles').value;
        var unidades = document.getElementById('form-unidades').value;
        var rutaImg = 'img/' + document.getElementById('form-img').value;

        precio = parseFloat(precio);
        unidades = parseInt(unidades);

        var validado = 1;

        if (nombre == '') {
          alert('Nombre requerido');
          validado = 0;
        }

        if (nombre.length > 100) {
          alert('Nombre debe ser menor o igual a 100 caracteres');
          validado = 0;
        }

        if (marca == '') {
          alert('Por favor selecciona una marca.');
          validado = 0;
        }

        if (modelo == '') {
          alert('Modelo requerido.');
          validado = 0;
        }

        if (modelo.length > 26) {
          alert('Modelo debe ser menor o igual a 25 caracteres.');
          validado = 0;
        }

        if (isNaN(precio)) {
          alert('Precio requerido.');
          validado = 0;
        }

        if (precio <= 99.99) {
          alert('Precio debe ser mayor a 99.99.');
          validado = 0;
        }

        if (detalles.length > 251) {
          alert('Los detalles deben ser menores o igual a 250 caracteres');
          validado = 0;
        }

        if (isNaN(unidades)) {
          alert('Unidades requeridas.');
          validado = 0;
        }

        if (unidades < 0) {
          alert('Las unidades deben ser mayores o igual a 0');
          validado = 0;
        }

        if (rutaImg == '') {
          rutaImg = 'default.png';
        }

        if (validado == 1) {
          alert('Producto registrado correctamente.');
        }
      }
    </script>

    <?php
      // Verificar si los datos han sido enviados por POST
      $id = isset($_POST['id']) ? $_POST['id'] : 'id_producto';
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : 'nombre_producto';
      $marca = isset($_POST['marca']) ? $_POST['marca'] : 'marca_producto';
      $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : 'modelo_producto';
      $precio = isset($_POST['precio']) ? $_POST['precio'] : 'precio_producto';
      $detalles = isset($_POST['detalles']) ? $_POST['detalles'] : '';
      $unidades = isset($_POST['unidades']) ? $_POST['unidades'] : 'unidades_producto';
      $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : '';
    ?>

    <form id="formularioProducto" method="post">
      <fieldset>
        <ul>
          <li><label for="form-id">ID: </label> 
              <input type="hidden" name="id" id="form-id" value="<?php echo htmlspecialchars($id); ?>">
              <?php echo htmlspecialchars($id); ?> <!-- Mostramos el ID solo como texto -->
          </li><br />

          <li><label for="form-nombre">Nombre: </label> 
              <input type="text" name="nombre" id="form-nombre" value="<?php echo htmlspecialchars($nombre); ?>">
          </li><br />

          <li><label for="form-marca">Marca: </label>
            <select name="marca" id="form-marcas">
              <option value="">Seleccione una marca (editorial)</option>
              <option value="rba" <?php if ($marca == 'rba') echo 'selected'; ?>>RBA</option>
              <option value="alfaguara" <?php if ($marca == 'alfaguara') echo 'selected'; ?>>Alfaguara</option>
              <option value="penguin random house" <?php if ($marca == 'penguin random house') echo 'selected'; ?>>Penguin Random House</option>
              <option value="planeta" <?php if ($marca == 'planeta') echo 'selected'; ?>>Planeta</option>
              <option value="santillana" <?php if ($marca == 'santillana') echo 'selected'; ?>>Santillana</option>
            </select>
          </li><br />

          <li><label for="form-modelo">Modelo: </label> 
              <input type="text" name="modelo" id="form-modelo" value="<?php echo htmlspecialchars($modelo); ?>">
          </li><br />

          <li><label for="form-precio">Precio: </label>
              <input type="number" name="precio" id="form-precio" step="0.01" placeholder="0.00" value="<?php echo htmlspecialchars($precio); ?>">
          </li><br />

          <li><label for="form-detalles">Detalles del producto: </label><br>
              <textarea name="detalles" rows="3" cols="40" id="form-detalles" placeholder="Edicion especial, firmado por el autor, de colección, etc."><?php echo htmlspecialchars($detalles); ?></textarea>
          </li><br />

          <li><label for="form-unidades">Unidades: </label>
              <input type="number" name="unidades" id="form-unidades" placeholder="0" value="<?php echo htmlspecialchars($unidades); ?>">
          </li><br />

          <li><label for="form-img">Imagen: </label> 
              <input type="text" name="img" id="form-img" placeholder="nombre_imagen.png" value="<?php echo htmlspecialchars($imagen); ?>">
          </li>
        </ul>
      </fieldset>

      <p>
        <input type="submit" value="Enviar" onclick="validarEntradas()">&nbsp;&nbsp;
        <input type="reset">
      </p>
    </form>

  </body>

</html>
