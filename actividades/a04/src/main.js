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
  div.innerHTML =
    '<p>Hola ' + nombre + ', asi que tienes ' + edad + ' años.</p>';
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
  } else {
    div.innerHTML =
      '<p>' + nombre + ' reprobaste con ' + nota + ', echale más ganas.</p>';
  }
}

//JS03 pag. 11
function calcularMayorMenor() {
  var num1 = prompt('Ingresa el primer numero: ', 0);
  var num2 = prompt('Ingresa el segundo numero: ', 0);

  num1 = parseInt(num1);
  num2 = parseInt(num2);

  var div = document.getElementById('mayorMenor');

  if (num1 > num2) {
    div.innerHTML = '<p>El mayor es ' + num1 + ' .</p>';
  } else {
    div.innerHTML = '<p>El mayor es ' + num2 + ' .</p>';
  }
}

//JS03 pag. 15-16
function calcularPromedio() {
  var nota1 = prompt('Ingresa 1ra. nota: ', 0);
  var nota2 = prompt('Ingresa 2da. nota: ', 0);
  var nota3 = prompt('Ingresa 3ra. nota: ', 0);

  nota1 = parseInt(nota1);
  nota2 = parseInt(nota2);
  nota3 = parseInt(nota3);

  var pro = (nota1 + nota2 + nota3) / 3;

  var div = document.getElementById('promedio');

  if (pro >= 7) {
    div.innerHTML = '<p>Aprobado con: ' + pro + '</p>';
  } else {
    if (pro >= 4) {
      div.innerHTML = '<p>Regular con: ' + pro + '</p>';
    } else {
      div.innerHTML = '<p>Reprobado con: ' + pro + '</p>';
    }
  }
}

//JS03 pag. 18
function valorComprendido() {
  var valor = prompt('Ingresa un valor entre 1 y 5: ', 0);
  valor = parseInt(valor);

  var div = document.getElementById('switch');

  switch (valor) {
    case 1:
      div.innerHTML = '<p>Uno</p>';
      break;
    case 2:
      div.innerHTML = '<p>Dos</p>';
      break;
    case 3:
      div.innerHTML = '<p>Tres</p>';
      break;
    case 4:
      div.innerHTML = '<p>Cuatro</p>';
      break;
    case 5:
      div.innerHTML = '<p>Cinco</p>';
      break;
    default:
      div.innerHTML = '<p>Debes ingresar un valor entre 1 y 5, necio uste.</p>';
  }
}

//JS03 pag. 21
function cambiarColor() {
  var col = prompt(
    'Ingresa el color para pintar el fondo de la ventana (rojo, verde, azul): ',
    ''
  );
  var div = document.getElementById('color');

  switch (col) {
    case 'rojo':
      document.bgColor = '#ff0000';
      break;
    case 'verde':
      document.bgColor = '#00ff00';
      break;
    case 'azul':
      document.bgColor = '#0000ff';
      break;
    default:
      div.innerHTML = '<p>No esta ese color, perdón.</p>';
  }
}

//JS04 pag. 5
function cicloWhile() {
  var x = 1;
  var div = document.getElementById('ciclo');

  while (x <= 100) {
    div.innerHTML += x + '<br />';
    x += 1;
  }
}

//JS04 pag. 6
function sumarValores() {
  var x = 1;
  var suma = 0;
  var valor;

  var div = document.getElementById('acumulador');

  while (x <= 5) {
    valor = prompt('Ingresa el valor: ', 0);
    valor = parseInt(valor);

    suma += valor;
    x += 1;
  }

  div.innerHTML = '<p>La suma de los valores es ' + suma + ' .</p>';
}

//JS04 pag. 12
function cicloDoWhile() {
  var valor;

  do {
    valor = prompt('Ingresa un valor entre el 0 y 999: ', 0);
    valor = parseInt(valor);

    document.write('El valor ' + valor + ' tiene');

    if (valor < 10) {
      document.write(' 1 digito');
    } else {
      if (valor < 100) {
        document.write(' 2 digitos');
      } else {
        document.write(' 3 digitos');
      }
    }
    document.write('<br />');
  } while (valor != 0);
}

//JS04 pag. 16
function sentenciaFor() {
  var f;
  var div = document.getElementById('sentencia-for');

  for (f = 1; f <= 10; f++) {
    div.innerHTML += f + ' ';
  }
}

//JS05 pag. 5
function mensaje1() {
  var div = document.getElementById('implementacion1');

  div.innerHTML = '<p>Cuidado</p>';
  div.innerHTML += '<p>Ingresa tu documento correctamente</p>';
  div.innerHTML = '<p>Cuidado</p>';
  div.innerHTML += '<p>Ingresa tu documento correctamente</p>';
  div.innerHTML = '<p>Cuidado</p>';
  div.innerHTML += '<p>Ingresa tu documento correctamente</p>';
}
