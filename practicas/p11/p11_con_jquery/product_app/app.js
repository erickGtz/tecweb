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
});
