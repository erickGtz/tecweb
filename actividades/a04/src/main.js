//Ejemplo mostrado en clase
function getDatos() {
  var nombre = prompt('Nombre: ', '');
  var edad = prompt('Edad: ', 0);

  var div1 = document.getElementById('nombre');
  div1.innerHTML = '<h3>Nombre: ' + nombre + ' </h3>';

  var div2 = document.getElementById('edad');
  div2.innerHTML = '<h3>Edad: ' + edad + ' </h3>';
}

//JS01 pag. 8
function saludo() {
  var div1 = document.getElementById('saludo');
  div1.innerHTML = '<p> Hola mundo (= </p>';
}

//JS02 pag. 6
function mostrarDatosJuan() {
  var nombre = 'Juan';
  var edad = '10';
  var altura = '1.92';
  var casado = 'false';

  var div = document.getElementById('datosJuan');
  div.innerHTML = '<p>Nombre: ' + nombre + '</p>';
  div.innerHTML = '<p>Edad: ' + edad + '</p>';
  div.innerHTML = '<p>Altura: ' + altura + '</p>';
  div.innerHTML = '<p>Casado: ' + casado + '</p>';
}