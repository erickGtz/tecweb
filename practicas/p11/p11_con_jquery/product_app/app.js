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
  $('#search').keyup(function (e) {
    let search = $('#search').val();
    
    if (search.length > 0) {
      $.ajax({
        url: 'backend/product-search.php',
        type: 'POST',
        data: { search },
        success: function (response) {
          let products = JSON.parse(response);
          console.log(products);

          let template = '';
          products.forEach((product) => {
            template += `<li>
                          ${product.nombre}
                        </li>`;
          });

          $('#container-resultados').html(template);

          if (products.length > 0) {
            $('#product-result').removeClass('d-none');
          } else {
            $('#product-result').addClass('d-none');
          }
        },
      });
    } else {
      $('#product-result').addClass('d-none');
    }
  });


  $('#product-form').submit(function (e){
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
        nombre: $('#name').val(),         // Nombre del producto
        marca: descriptionJSON.marca,     // Marca del JSON ingresado
        modelo: descriptionJSON.modelo,   // Modelo del JSON ingresado
        precio: descriptionJSON.precio,   // Precio del JSON ingresado
        detalles: descriptionJSON.detalles, // Detalles del JSON ingresado
        unidades: descriptionJSON.unidades, // Unidades del JSON ingresado
        imagen: descriptionJSON.imagen    // Imagen del JSON ingresado
    };

    // Enviar los datos como JSON usando $.ajax()
    $.ajax({
      url: 'backend/product-add.php',   // Tu archivo PHP de agregar productos
      type: 'POST',                     
      data: JSON.stringify(postData),    // Enviar el objeto como JSON string
      contentType: 'application/json',   // Asegurarse de enviar como JSON
      success: function (response) {
        console.log(response);           // Mostrar la respuesta en la consola
        $('#product-form').trigger('reset');  // Limpiar el formulario
      },
    });
  });
});
