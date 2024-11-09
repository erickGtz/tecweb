$(document).ready(function () {
  let edit = false;
  console.log(edit);

  $('#form-detalles').val('');

  $('#name').blur(function () {
    let isValid = true;
    let message = '';

    if (!$(this).val()) {
      isValid = false;
      message = 'Nombre requerido';
    } else if ($(this).val().length > 100) {
      isValid = false;
      message = 'Nombre debe ser menor o igual a 100 caracteres';
    }

    // Actualizar el estado del campo
    updateFieldState($('#name'), isValid, message);
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

  // Lógica para enviar el formulario
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

    if (validarEntradas(productData)) {
      console.log('SI se validaron las entradas');
      // Convertir a JSON y enviar
      let postData = JSON.stringify(productData);
      console.log(postData);
      // Enviar el formulario
    } else {
      console.log('no se validaron las entradas');
    }
  });

  function validarEntradas(productData) {
    // Validación general
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
      productData.img = 'default.png'; // Asignar valor predeterminado si está vacío
    }
    return true; // Si todos los campos están completos, permite continuar
  }
});
