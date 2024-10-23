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
    
    // Solo hacer la petición si hay texto en el campo de búsqueda
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

          // Añadir los resultados al contenedor
          $('#container-resultados').html(template);

          // Mostrar la sección de resultados
          $('#product-result').show();
        },
      });
    } else {
      // Si no hay texto en la búsqueda, ocultar los resultados
      $('#product-result').hide();
    }
  });
});