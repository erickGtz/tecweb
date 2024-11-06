// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
  precio: 0.0,
  unidades: 1,
  modelo: 'XX-000',
  marca: 'NA',
  detalles: 'NA',
  imagen: 'default.png',
};

function init() {
  var JsonString = JSON.stringify(baseJSON, null, 2);
  document.getElementById('description').value = JsonString;
}

$(document).ready(function () {
  let edit = false;
  obtenerProductos();
/*
  $('#search').keyup(function (e) {
    let search = $('#search').val();

    if (search.length > 0) {
      $.ajax({
        url: 'backend/product-search.php',
        type: 'POST',
        data: { search },
        success: function (response) {
          let products = JSON.parse(response);
          mostrarNombresEnBarraEstado(products);

          if (products.length > 0) {
            $('#product-result').removeClass('d-none');
            mostrarProductosEnTabla(products);
          } else {
            $('#product-result').addClass('d-none');
            $('#container-resultados').html(''); // Limpiar la barra de estado si no hay coincidencias
          }
        },
      });
    } else {
      obtenerProductos();
      $('#product-result').addClass('d-none');
      $('#container-resultados').html('');
    }
  });*/

  $('#search').keyup(function (e) {
    let search = $('#search').val();

    if (search.length > 0) {
      $.ajax({
        url: 'backend/product-single-by-name.php',
        type: 'POST',
        data: { search },
        success: function (response) {
          console.log(response);
          let products = JSON.parse(response);
          mostrarNombresEnBarraEstado(products);

          if (products.length > 0) {
            console.log('estoy aaqui');
            $('#product-result').removeClass('d-none');
            mostrarProductosEnTabla(products);
          } else {
            $('#product-result').addClass('d-none');
            $('#container-resultados').html(''); // Limpiar la barra de estado si no hay coincidencias
          }
        },
      });
    } else {
      obtenerProductos();
      $('#product-result').addClass('d-none');
      $('#container-resultados').html('');
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
      alert('El formato del JSON es inválido');
      return;
    }

    // Crear el objeto con los datos del formulario
    const postData = {
      nombre: $('#name').val(),
      marca: descriptionJSON.marca,
      modelo: descriptionJSON.modelo,
      precio: descriptionJSON.precio,
      detalles: descriptionJSON.detalles,
      unidades: descriptionJSON.unidades,
      imagen: descriptionJSON.imagen,
      ID: $('#productId').val(),
    };

    // Imprimir en consola el JSON del producto antes de enviarlo
    console.log('Producto a enviar:', postData);
    console.log('Valor de edit:', edit);

    let url =
      edit === false ? 'backend/product-add.php' : 'backend/product-edit.php';

    // Enviar los datos como JSON usando $.ajax()
    $.ajax({
      url: url,
      type: 'POST',
      data: JSON.stringify(postData),
      contentType: 'application/json',
      success: function (response) {
        let result;
          result = response;
        // Mostrar el mensaje en la barra de estado
        let template_bar = `
          <li style="list-style: none;">status: ${result.status}</li>
          <li style="list-style: none;">message: ${result.message}</li>
        `;
        $('#container-resultados').html(template_bar);
        $('#product-result').removeClass('d-none'); // Mostrar la barra de estado

        if (result.status === 'success') {
          $('#product-form')[0].reset(); // Limpiar el formulario
          $('#description').val(JSON.stringify(baseJSON, null, 2)); // Restablecer el JSON base
          $('#productId').val(''); // Limpiar el campo del ID
          $('#product-form button[type="submit"]').text('Agregar Producto'); // Restablecer el texto del botón
          edit = false; // Reiniciar el estado de edición
          obtenerProductos(); // Actualizar la lista de productos
        }
      },
      error: function (xhr, status, error) {
        console.error('Error en la solicitud AJAX:', status, error);
        console.log('Detalles del error:', xhr.responseText); // Imprimir detalles del error si la solicitud falla
      },
    });
  });

  // Función eliminar producto
  $(document).on('click', '.product-delete', function () {
    if (confirm('Estás seguro de borrar este producto?')) {
      let element = $(this).closest('tr');
      let id = element.attr('productoID');
      $.post('backend/product-delete.php', { id }, function (response) {
        let result = JSON.parse(response);

        // Mostrar mensaje en la barra de estado
        let template_bar = `
          <li style="list-style: none;">status: ${result.status}</li>
          <li style="list-style: none;">message: ${result.message}</li>
        `;
        $('#container-resultados').html(template_bar);
        $('#product-result').removeClass('d-none');

        if (result.status === 'success') {
          obtenerProductos(); // Actualizar la lista de productos
        }
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
          <td><button class="product-item btn btn-link">${producto.nombre}</button></td>
          <td><ul>${descripcion}</ul></td>
          <td>
            <button class="product-delete btn btn-danger">Eliminar</button>
          </td>
        </tr>
      `;
    });
    $('#products').html(template);
  }

  function mostrarNombresEnBarraEstado(productos) {
  if (Array.isArray(productos)) {
    let template_bar = '<ul>';
    productos.forEach((producto) => {
      template_bar += `<li>${producto.nombre}</li>`;
    });
    template_bar += '</ul>';
    $('#container-resultados').html(template_bar);
  } else if (productos.error) {
    // Mostrar el mensaje de error en la barra de estado si hay un error
    $('#container-resultados').html(`<li style="list-style: none;">${productos.error}</li>`);
  }
}


  // Función editar producto
  $(document).on('click', '.product-item', function () {
    let element = $(this).closest('tr');
    let id = element.attr('productoID');

    $.post('backend/product-single.php', { id }, function (response) {
      const product = JSON.parse(response);

      // Cargar los valores en el formulario
      $('#name').val(product.nombre);

      let descriptionJSON = {
        precio: product.precio,
        unidades: product.unidades,
        modelo: product.modelo,
        marca: product.marca,
        detalles: product.detalles,
        imagen: product.imagen,
      };

      // Mostrar el JSON en el campo de descripción
      $('#description').val(JSON.stringify(descriptionJSON, null, 2));
      $('#productId').val(product.ID);
      edit = true;

      $('#product-form button[type="submit"]').text('Actualizar Producto');
    });
  });
});
