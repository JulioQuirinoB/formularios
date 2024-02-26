<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Practicar Tabla de Multiplicar</title>
</head>
<body>

<h2>Selecciona la tabla de multiplicar y el rango de números:</h2>

<form id="tablaForm">
  <label for="tabla">Tabla de multiplicar:</label>
  <input type="number" id="tabla" name="tabla" min="1" max="10" required>
  <br><br>
  <label for="inicio">Desde:</label>
  <input type="number" id="inicio" name="inicio" min="1" max="10" required>
  <label for="fin">Hasta:</label>
  <input type="number" id="fin" name="fin" min="1" max="10" required>
  <br><br>
  <input type="submit" value="Empezar">
</form>

<div id="preguntasForm" style="display:none;">
  <h2>Responde las preguntas:</h2>
  <div id="tablaMultiplicar"></div>
  <br>
  <input type="submit" value="Finalizar" id="finalizarBtn">
</div>

<div id="resultado" style="display:none;">
  <h2>Resultado:</h2>
  <div id="respuestasCorrectas"></div>
  <div id="respuestasIncorrectas"></div>
  <div id="porcentajeCorrectas"></div>
  <br>
  <button onclick="regresarInicio()">Regresar al inicio</button>
</div>

<script>
document.getElementById("tablaForm").addEventListener("submit", function(event) {
  event.preventDefault();
  var tabla = parseInt(document.getElementById("tabla").value);
  var inicio = parseInt(document.getElementById("inicio").value);
  var fin = parseInt(document.getElementById("fin").value);
  if (tabla >= 1 && tabla <= 10 && inicio >= 1 && inicio <= 10 && fin >= 1 && fin <= 10 && inicio <= fin) {
    mostrarPreguntas(tabla, inicio, fin);
  } else {
    alert("Por favor, introduce números válidos entre 1 y 10, y asegúrate de que el número de inicio sea menor o igual que el número de fin.");
  }
});

function mostrarPreguntas(tabla, inicio, fin) {
  var tablaMultiplicar = document.getElementById("tablaMultiplicar");
  tablaMultiplicar.innerHTML = "";
  for (var i = inicio; i <= fin; i++) {
    var pregunta = document.createElement("div");
    pregunta.innerHTML = "<label for='respuesta" + i + "'>" + tabla + " x " + i + " = </label>" +
                         "<input type='number' id='respuesta" + i + "' name='respuesta" + i + "' required><br>";
    tablaMultiplicar.appendChild(pregunta);
  }
  document.getElementById("preguntasForm").style.display = "block";
  document.getElementById("tablaForm").style.display = "none";
}

document.getElementById("finalizarBtn").addEventListener("click", function(event) {
  event.preventDefault();
  var respuestasCorrectas = [];
  var respuestasIncorrectas = [];
  var inicio = parseInt(document.getElementById("inicio").value);
  var fin = parseInt(document.getElementById("fin").value);
  var totalPreguntas = fin - inicio + 1;
  var respuestasCorrectasCount = 0;
  for (var i = inicio; i <= fin; i++) {
    var respuestaUsuario = parseInt(document.getElementById("respuesta" + i).value);
    var respuestaCorrecta = parseInt(document.getElementById("tabla").value) * i;
    if (respuestaUsuario === respuestaCorrecta) {
      respuestasCorrectas.push("<p>La respuesta a " + document.getElementById("tabla").value + " x " + i + " es correcta.</p>");
      respuestasCorrectasCount++;
    } else {
      respuestasIncorrectas.push("<p>La respuesta a " + document.getElementById("tabla").value + " x " + i + " es incorrecta. La respuesta correcta es " + respuestaCorrecta + ".</p>");
    }
  }
  var porcentajeCorrectas = (respuestasCorrectasCount / totalPreguntas) * 100;
  mostrarResultado(respuestasCorrectas, respuestasIncorrectas, porcentajeCorrectas);
});

function mostrarResultado(respuestasCorrectas, respuestasIncorrectas, porcentajeCorrectas) {
  document.getElementById("respuestasCorrectas").innerHTML = respuestasCorrectas.join("");
  document.getElementById("respuestasIncorrectas").innerHTML = respuestasIncorrectas.join("");
  document.getElementById("porcentajeCorrectas").innerHTML = "<p>Porcentaje de respuestas correctas: " + porcentajeCorrectas.toFixed(2) + "%</p>";
  document.getElementById("resultado").style.display = "block";
  document.getElementById("preguntasForm").style.display = "none";
}

function regresarInicio() {
  document.getElementById("tablaForm").style.display = "block";
  document.getElementById("resultado").style.display = "none";
}
</script>

</body>
</html>