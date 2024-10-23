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
    $.ajax({
      url: 'backend/product-search.php',
      type: 'POST',
      data: { search },
      success: function (response) {
        let products = JSON.parse(response);
        console.log(products);  // Puedes dejar esto para seguir depurando si es necesario

        let template = '';  // Aquí generas el HTML de los productos
        products.forEach((product) => {
          template += `<li>
                        <strong>${product.nombre}</strong> - 
                        ${product.marca} - 
                        ${product.detalles}
                    </li>`;
        });

        // Añadir los resultados al contenedor
        $('#container-resultados').html(template);

        // Mostrar la sección de resultados
        $('#product-result').removeClass('d-none');
      },
      error: function (xhr, status, error) {
        console.log('Error en la petición AJAX:', status, error);
      }
    });
  });
});

