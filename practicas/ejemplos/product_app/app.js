// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
  precio: 0.0,
  unidades: 1,
  modelo: 'XX-000',
  marca: 'NA',
  detalles: 'NA',
  imagen: 'img/default.png',
};

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarID(e) {
  /**
   * Revisar la siguiente información para entender porqué usar event.preventDefault();
   * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
   * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
   */
  e.preventDefault();

  // SE OBTIENE EL ID A BUSCAR
  var id = document.getElementById('search').value;
  var cat = document.getElementById('cat').value;

  // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
  var client = getXMLHttpRequest();
  client.open('POST', './backend/read.php', true);
  client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  client.onreadystatechange = function () {
    // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
    if (client.readyState == 4 && client.status == 200) {
      console.log('[CLIENTE]\n' + client.responseText);

      // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
      let productos = JSON.parse(client.responseText); // similar a eval('('+client.responseText+')');

      // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
      if (Object.keys(productos).length > 0) {
        // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
        let descripcion = '';
        descripcion += '<li>precio: ' + productos.precio + '</li>';
        descripcion += '<li>unidades: ' + productos.unidades + '</li>';
        descripcion += '<li>modelo: ' + productos.modelo + '</li>';
        descripcion += '<li>marca: ' + productos.marca + '</li>';
        descripcion += '<li>detalles: ' + productos.detalles + '</li>';

        // SE CREA UNA PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
        let template = '';
        template += `
                        <tr>
                            <td>${productos.ID}</td>
                            <td>${productos.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;

        // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
        document.getElementById('productos').innerHTML = template;
      }
    }
  };
  client.send('id=' + id);
}

function buscarProducto(e) {
  e.preventDefault();

  // SE OBTIENEN LOS VALORES DE BÚSQUEDA Y CATEGORÍA
  var search = document.getElementById('search').value;
  var cat = document.getElementById('cat').value;

  // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
  var client = getXMLHttpRequest();
  client.open('POST', './backend/read.php', true);
  client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  client.onreadystatechange = function () {
    if (client.readyState == 4 && client.status == 200) {
      console.log('[CLIENTE]\n' + client.responseText);

      let productos = JSON.parse(client.responseText);

      if (productos.length > 0) {
        let template = '';
        productos.forEach((producto) => {
          let descripcion = '';
          descripcion += `<li>precio: ${producto.precio}</li>`;
          descripcion += `<li>unidades: ${producto.unidades}</li>`;
          descripcion += `<li>modelo: ${producto.modelo}</li>`;
          descripcion += `<li>marca: ${producto.marca}</li>`;
          descripcion += `<li>detalles: ${producto.detalles}</li>`;

          template += `
                        <tr>
                            <td>${producto.ID}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                            <td><img src="../../img/${producto.imagen}" alt="${producto.nombre}" width="100" height="100" /></td>
                        </tr>
                    `;
        });

        // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
        document.getElementById('productos').innerHTML = template;
      } else {
        document.getElementById('productos').innerHTML =
          '<tr><td colspan="3">No se encontraron productos</td></tr>';
      }
    }
  };
  client.send('search=' + search + '&cat=' + cat);
}

// Función para validar el JSON antes de enviarlo al servidor
function validarProducto(producto) {
  if (!producto.nombre || producto.nombre.length > 100) {
    alert('Nombre requerido y debe ser menor o igual a 100 caracteres.');
    return false;
  }

  if (!producto.marca) {
    alert('Marca requerida.');
    return false;
  }

  if (!producto.modelo || producto.modelo.length > 26) {
    alert('Modelo requerido y debe ser menor o igual a 26 caracteres.');
    return false;
  }

  if (isNaN(producto.precio) || producto.precio <= 99.99) {
    alert('Precio debe ser un número mayor a 99.99.');
    return false;
  }

  if (producto.detalles.length > 251) {
    alert('Detalles deben ser menores o igual a 250 caracteres.');
    return false;
  }

  if (isNaN(producto.unidades) || producto.unidades < 0) {
    alert('Unidades deben ser un número positivo.');
    return false;
  }

  if (!producto.imagen || producto.imagen.trim() === '') {
    producto.imagen = 'default.png';
  }

  return true;
}

function agregarProducto(e) {
  e.preventDefault();

  // Obtener el JSON desde el textarea
  var productoJsonString = document.getElementById('description').value;

  try {
    // Convertir a objeto JSON
    var producto = JSON.parse(productoJsonString);
    // Agregar el nombre
    producto['nombre'] = document.getElementById('name').value;

    // Validar producto
    if (!validarProducto(producto)) {
      return; // Si la validación falla, no continuar
    }

    // Convertir a string para enviar
    var productoJsonString = JSON.stringify(producto, null, 2);

    // Enviar al servidor
    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
    client.onreadystatechange = function () {
      if (client.readyState == 4 && client.status == 200) {
        window.alert(client.responseText); // Mostrar el estado de la inserción
      }
    };
    client.send(productoJsonString);
  } catch (error) {
    alert(
      'Error al procesar el JSON. Verifica que esté correctamente formateado.'
    );
  }
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
  var objetoAjax;

  try {
    objetoAjax = new XMLHttpRequest();
  } catch (err1) {
    /**
     * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
     *       pero se comparten por motivos historico-académicos.
     */
    try {
      // IE7 y IE8
      objetoAjax = new ActiveXObject('Msxml2.XMLHTTP');
    } catch (err2) {
      try {
        // IE5 y IE6
        objetoAjax = new ActiveXObject('Microsoft.XMLHTTP');
      } catch (err3) {
        objetoAjax = false;
      }
    }
  }
  return objetoAjax;
}

function init() {
  /**
   * Convierte el JSON a string para poder mostrarlo
   * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
   */
  var JsonString = JSON.stringify(baseJSON, null, 2);
  document.getElementById('description').value = JsonString;
}
