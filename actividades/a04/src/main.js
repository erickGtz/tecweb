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


  var div = document.getElementById('datosJuan');
  div.innerHTML = '<p>Nombre: ' + nombre + '</p>';
  div.innerHTML += '<p>Edad: ' + edad + '</p>';
  div.innerHTML += '<p>Altura: ' + altura + '</p>';
  div.innerHTML += '<p>Casado: ' + casado + '</p>';
}

//JS02 pag. 12
function getDatosTeclado() {
  var nombre = prompt('Ingresa tu nombre: ', '');
  var edad = prompt('Ingresa tu edad: ', 0);

  var div = document.getElementById('datosTeclado');
  div.innerHTML = '<p>Hola ' + nombre + ', asi que tienes '+ edad + ' años.</p>';
}

//JS03 pag. 3
function realizarOperaciones() {
  var valor1 = prompt('Introducir primer número: ', 0);
  var valor2 = prompt('Introducir segundo número: ', 0);

  var suma = parseInt(valor1) + parseInt(valor2);
  var producto = parseInt(valor1) * parseInt(valor2);

  var div = document.getElementById('operaciones');
  div.innerHTML = '<p>La suma es: ' + suma + '</p>';
  div.innerHTML += '<p>El producto es: ' + producto + '</p>';
}

//JS03 pag. 8
function calcularNota() {
  var nombre = prompt('Ingresa tu nombre: ', '');
  var nota = prompt('Ingresa tu nota: ', 0);

  var div = document.getElementById('notas');

  if (nota >= 4) {
      div.innerHTML = '<p>' + nombre + ' esta aprobado con ' + nota + ' .</p>';
  }
}