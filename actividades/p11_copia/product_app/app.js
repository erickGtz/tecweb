$(document).ready(function () {
  let edit = false;
  limpiarForm();

  $('#name').keyup(function () {
    let isValid = true;
    let message = '';
    const name = $(this).val();

    if (!name) {
      isValid = false;
      message = 'Nombre requerido';
      updateFieldState($('#name'), isValid, message);
    } else if (name.length > 100) {
      isValid = false;
      message = 'Nombre debe ser menor o igual a 100 caracteres';
      updateFieldState($('#name'), isValid, message);
    } else {
      // Realizar la validación de existencia de nombre en la base de datos
      $.ajax({
        url: './backend/product-search-by-name.php?name=' + name,
        type: 'GET',
        success: function (response) {
          const resultado = JSON.parse(response);
          if (resultado.exists) {
            isValid = false;
            message = 'Este nombre de producto ya existe';
          }
          updateFieldState($('#name'), isValid, message);
        },
      });
    }
  });

  $('#form-marcas').blur(function () {
    let isValid = true;
    let message = '';

    if (!$(this).val()) {
      isValid = false;
      message = 'Por favor selecciona una marca.';
    }

    // Actualizar el estado del campo
    updateFieldState($('#form-marcas'), isValid, message);
  });

  $('#form-modelo').blur(function () {
    let isValid = true;
    let message = '';

    if (!$(this).val()) {
      isValid = false;
      message = 'Modelo requerido.';
    } else if ($(this).val().length > 25) {
      isValid = false;
      message = 'Modelo debe ser menor o igual a 25 caracteres.';
    }

    // Actualizar el estado del campo
    updateFieldState($('#form-modelo'), isValid, message);
  });

  $('#form-precio').blur(function () {
    let isValid = true;
    let message = '';

    let precio = parseFloat($(this).val());
    if (isNaN(precio)) {
      isValid = false;
      message = 'Precio requerido.';
    } else if (precio <= 99.99) {
      isValid = false;
      message = 'Precio debe ser mayor a 99.99.';
    }

    // Actualizar el estado del campo
    updateFieldState($('#form-precio'), isValid, message);
  });

  $('#form-detalles').blur(function () {
    let isValid = true;
    let message = '';

    if ($(this).val().length > 250) {
      isValid = false;
      message = 'Los detalles deben ser menores o igual a 250 caracteres';
    }

    // Actualizar el estado del campo
    updateFieldState($('#form-detalles'), isValid, message);
  });

  $('#form-unidades').blur(function () {
    let isValid = true;
    let message = '';

    let unidades = parseInt($(this).val());
    if (isNaN(unidades)) {
      isValid = false;
      message = 'Unidades requeridas.';
    } else if (unidades < 0) {
      isValid = false;
      message = 'Las unidades deben ser mayores o igual a 0';
    }

    // Actualizar el estado del campo
    updateFieldState($('#form-unidades'), isValid, message);
  });

  function updateFieldState(field, isValid, message) {
    // Cambiar el color del borde
    if (isValid) {
      field.addClass('valid').removeClass('invalid');
    } else {
      field.addClass('invalid').removeClass('valid');
    }

    // Mostrar el mensaje de validación en la barra de estado
    let statusElement = field.siblings('.validation-status');
    if (!statusElement.length) {
      // Si no existe la barra de estado, creamos una nueva
      statusElement = $('<div class="validation-status"></div>');
      field.after(statusElement);
    }

    // Actualizar el mensaje de estado
    statusElement.text(message).removeClass('valid invalid');
    if (isValid) {
      statusElement.addClass('valid').removeClass('invalid');
    } else {
      statusElement.addClass('invalid').removeClass('valid');
    }

    // Mostrar la barra de estado
    statusElement.show();
  }

  $('#product-result').hide();
  listarProductos();

  function listarProductos() {
    $.ajax({
      url: './backend/product-list.php',
      type: 'GET',
      success: function (response) {
        const productos = JSON.parse(response);

        if (Object.keys(productos).length > 0) {
          let template = '';

          productos.forEach((producto) => {
            let descripcion = '';
            descripcion += '<li>precio: ' + producto.precio + '</li>';
            descripcion += '<li>unidades: ' + producto.unidades + '</li>';
            descripcion += '<li>modelo: ' + producto.modelo + '</li>';
            descripcion += '<li>marca: ' + producto.marca + '</li>';
            descripcion += '<li>detalles: ' + producto.detalles + '</li>';

            template += `
                            <tr productId="${producto.ID}">
                                <td>${producto.ID}</td>
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
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
      },
    });
    limpiarForm();
  }

  $('#search').keyup(function () {
    if ($('#search').val()) {
      let search = $('#search').val();
      $.ajax({
        url: './backend/product-search.php?search=' + $('#search').val(),
        data: { search },
        type: 'GET',
        success: function (response) {
          if (!response.error) {
            const productos = JSON.parse(response);

            if (Object.keys(productos).length > 0) {
              let template = '';
              let template_bar = '';

              productos.forEach((producto) => {
                let descripcion = '';
                descripcion += '<li>precio: ' + producto.precio + '</li>';
                descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                descripcion += '<li>marca: ' + producto.marca + '</li>';
                descripcion += '<li>detalles: ' + producto.detalles + '</li>';

                template += `
                                    <tr productId="${producto.ID}">
                                        <td>${producto.ID}</td>
                                        <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="product-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                template_bar += `
                                    <li>${producto.nombre}</il>
                                `;
              });
              $('#product-result').show();
              $('#container').html(template_bar);
              $('#products').html(template);
            }
          }
        },
      });
    } else {
      $('#product-result').hide();
    }
    limpiarForm();
  });

  $('#product-form').submit((e) => {
    e.preventDefault();

    let productData = {
      nombre: $('#name').val(),
      marca: $('#form-marcas').val(),
      modelo: $('#form-modelo').val(),
      precio: parseFloat($('#form-precio').val()),
      detalles: $('#form-detalles').val(),
      unidades: parseInt($('#form-unidades').val()),
      img: $('#form-img').val(),
    };

    if (edit) {
      productData.id = $('#productId').val();
    }

    if (validarEntradas(productData)) {
      const url =
        edit === false
          ? './backend/product-add.php'
          : './backend/product-edit.php';

      $.post(url, productData, (response) => {
        let respuesta = JSON.parse(response);
        let template_bar = `
          <li style="list-style: none;">status: ${respuesta.status}</li>
          <li style="list-style: none;">message: ${respuesta.message}</li>
        `;
        $('#product-result').show();
        $('#container').html(template_bar);
        listarProductos();
        limpiarForm();
        edit = false;
      });
    }
  });

  $(document).on('click', '.product-delete', (e) => {
    if (confirm('¿Realmente deseas eliminar el producto?')) {
      const element = $(this)[0].activeElement.parentElement.parentElement;
      const id = $(element).attr('productId');
      $.post('./backend/product-delete.php', { id }, (response) => {
        let respuesta = JSON.parse(response);
        let template_bar = '';
        template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
        $('#name').val('');
        $('#description').val('');
        $('#product-result').show();
        $('#container').html(template_bar);
        listarProductos();
      });
    }
    limpiarForm();
  });

  $(document).on('click', '.product-item', (e) => {
    const element = $(this)[0].activeElement.parentElement.parentElement;
    const id = $(element).attr('productId');
    $.post('./backend/product-single.php', { id }, (response) => {
      let product = JSON.parse(response);

      $('#name').val(product.nombre);
      $('#form-id-display').text(product.ID);
      $('#productId').val(product.ID);
      $('#form-marcas').val(product.marca);
      $('#form-modelo').val(product.modelo);
      $('#form-precio').val(parseFloat(product.precio));
      $('#form-detalles').val(product.detalles);
      $('#form-unidades').val(parseInt(product.unidades));
      $('#form-img').val(product.imagen);

      delete product.nombre;
      delete product.eliminado;
      delete product.ID;

      edit = true;
    });
    e.preventDefault();
    limpiarForm();
  });

  function validarEntradas(productData) {
    if (!productData.nombre || String(productData.nombre).trim() === '') {
      alert('El campo nombre no puede estar vacío.');
      return false;
    }
    if (
      !productData.precio ||
      isNaN(productData.precio) ||
      productData.precio <= 99.99
    ) {
      alert('El campo precio es requerido y debe ser mayor a 99.99.');
      return false;
    }
    if (
      !productData.unidades ||
      isNaN(productData.unidades) ||
      productData.unidades < 0
    ) {
      alert('El campo unidades es requerido y debe ser mayor o igual a 0.');
      return false;
    }
    if (!productData.modelo || String(productData.modelo).trim() === '') {
      alert('El campo modelo no puede estar vacío.');
      return false;
    }
    if (
      !productData.marca ||
      productData.marca === 'Seleccione una marca (editorial)'
    ) {
      alert('Por favor selecciona una marca.');
      return false;
    }
    if (!productData.img || String(productData.img).trim() === '') {
      productData.img = 'default.png';
    }
    return true;
  }

  function limpiarForm() {
    $('#name').val('');
    $('#form-id-display').text('');
    $('#productId').val('');
    $('#form-marcas').val('');
    $('#form-modelo').val('');
    $('#form-precio').val('');
    $('#form-detalles').val('');
    $('#form-unidades').val('');
    $('#form-img').val('');
  }
});
