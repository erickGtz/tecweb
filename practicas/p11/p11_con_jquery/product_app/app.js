// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
  precio: 0.0,
  unidades: 1,
  modelo: 'XX-000',
  marca: 'NA',
  detalles: 'NA',
  imagen: 'img/default.png',
};

function init() {
  /**
   * Convierte el JSON a string para poder mostrarlo
   * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
   */
  var JsonString = JSON.stringify(baseJSON, null, 2);
  document.getElementById('description').value = JsonString;
}

$(document).ready(function () {
  obtenerProductos();

  $('#search').keyup(function (e) {
    let search = $('#search').val();

    if (search.length > 0) {
      $.ajax({
        url: 'backend/product-search.php',
        type: 'POST',
        data: { search },
        success: function (response) {
          let products = JSON.parse(response);
          // Mostrar los nombres de los productos coincidentes en la barra de estado
          mostrarNombresEnBarraEstado(products);

          if (products.length > 0) {
            $('#product-result').removeClass('d-none');
            // Llamar a la función para mostrar los productos en la tabla
            mostrarProductosEnTabla(products);
          } else {
            $('#product-result').addClass('d-none');
            $('#container-resultados').html(''); // Limpiar la barra de estado si no hay coincidencias
          }
        },
      });
    } else {
      // Si no hay búsqueda, mostramos todos los productos
      obtenerProductos();
      $('#product-result').addClass('d-none');
      $('#container-resultados').html(''); // Limpiar la barra de estado
    }
  });

  // Función agregarProducto()
  $('#product-form').submit(function (e) {
    e.preventDefault(); // Prevenir la recarga por defecto de la página

    // Obtener el contenido del campo description como JSON
    let descriptionJSON;
    try {
      // Parsear el contenido del textarea como JSON
      descriptionJSON = JSON.parse($('#description').val());
    } catch (error) {
      console.error('Error en el JSON:', error);
      alert('El formato del JSON es inválido');
      return;
    }

    // Crear el objeto con los datos del formulario
    const postData = {
      nombre: $('#name').val(), // Nombre del producto
      marca: descriptionJSON.marca, // Marca del JSON ingresado
      modelo: descriptionJSON.modelo, // Modelo del JSON ingresado
      precio: descriptionJSON.precio, // Precio del JSON ingresado
      detalles: descriptionJSON.detalles, // Detalles del JSON ingresado
      unidades: descriptionJSON.unidades, // Unidades del JSON ingresado
      imagen: descriptionJSON.imagen, // Imagen del JSON ingresado
    };

    // Enviar los datos como JSON usando $.ajax()
    $.ajax({
      url: 'backend/product-add.php', // Tu archivo PHP de agregar productos
      type: 'POST',
      data: JSON.stringify(postData), // Enviar el objeto como JSON string
      contentType: 'application/json', // Asegurarse de enviar como JSON
      success: function (response) {
        // Verificar si el producto fue agregado correctamente
        let respuesta = JSON.parse(response);

        // Plantilla para mensajes de error o éxito
        let template_bar = `
        <li style="list-style: none;">status: ${respuesta.status}</li>
        <li style="list-style: none;">message: ${respuesta.message}</li>
      `;

        // Mostrar el mensaje en la barra de estado
        $('#container-resultados').html(template_bar);
        $('#product-result').removeClass('d-none'); // Mostrar el div de resultados

        if (respuesta.status === 'success') {
          // Si se agregó correctamente, reiniciar el formulario y restablecer JSON base
          $('#product-form').trigger('reset');
          init(); // Restablecer el JSON base en el textarea
          obtenerProductos(); // Refrescar la lista de productos
        }
      },
      error: function (xhr, status, error) {
        console.error('Error al agregar el producto:', error);
        let template_bar = `
        <li style="list-style: none;">status: error</li>
        <li style="list-style: none;">message: Error al agregar el producto</li>
      `;
        $('#container-resultados').html(template_bar);
        $('#product-result').removeClass('d-none');
      },
    });
  });

  $(document).on('click', '.product-delete', function () {
    if (confirm('Estás seguro de borrar este producto?')) {
      let element = $(this).closest('tr'); // Usa closest para encontrar el <tr> más cercano
      let id = element.attr('productoID');
      $.post('backend/product-delete.php', { id }, function () {
        obtenerProductos();
      });
    }
  });

  function obtenerProductos() {
    $.ajax({
      url: 'backend/product-list.php',
      type: 'GET',
      success: function (response) {
        let productos = JSON.parse(response);
        mostrarProductosEnTabla(productos);
      },
    });
  }

  function mostrarProductosEnTabla(productos) {
    let template = '';

    productos.forEach((producto) => {
      let descripcion = '';
      descripcion += '<li>precio: ' + producto.precio + '</li>';
      descripcion += '<li>unidades: ' + producto.unidades + '</li>';
      descripcion += '<li>modelo: ' + producto.modelo + '</li>';
      descripcion += '<li>marca: ' + producto.marca + '</li>';
      descripcion += '<li>detalles: ' + producto.detalles + '</li>';

      template += `
                <tr productoID="${producto.ID}">
                    <td>${producto.ID}</td>
                    <td>${producto.nombre}</td>
                    <td><ul>${descripcion}</ul></td>
                    <td>
                        <button class="product-delete btn btn-danger">
                            Eliminar
                        </button>
                    </td>
                </tr>
                `;
    });
    $('#products').html(template);
  }

  function mostrarNombresEnBarraEstado(productos) {
    // Crear una lista con cada nombre como un elemento <li> separado
    let template_bar = '<ul>';
    productos.forEach(producto => {
      template_bar += `<li>${producto.nombre}</li>`;
    });
    template_bar += '</ul>';

    $('#container-resultados').html(template_bar);
  }
});