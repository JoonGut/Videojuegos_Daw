<?php
include 'conexion.php';

if ($conexion->connect_errno) {
    die("No se pudo establecer conexión: " . $conexion->connect_error);
}

$consulta = "
SELECT
    c.id_copia,
    j.nombre AS nombre_juego,
    p.nombre AS plataforma,
    c.precio_nuevo,
    c.precio_seminuevo,
    c.precio_compra,
    c.stock,
    c.id_almacenes
FROM copias c
JOIN juegos j ON j.id_juego = c.id_juegos
LEFT JOIN plataformas p ON p.id_plataforma = c.id_plataformas
ORDER BY j.nombre, p.nombre;
";

$respuesta = $conexion->query($consulta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Copias</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/estilos3.css">
  <link rel="shortcut icon" href="../imagenes/faviconGame.png">
</head>
<body>
  <header>
    <nav>
      <div class="menu" id="_items">
        <div class="nav_logo">
          <img class="logo" src="../imagenes/faviconGame.png" alt="Game">
        </div>
        <div class="nav_items">
          <a href="../index.html">Inicio</a>
        </div>
      </div>
      <div class="dropdown">
        <button class="menu-btn">☰</button>
        <div class="dropdown-content">
          <a href="../index.html">Inicio</a>
        </div>
      </div>
    </nav>
    <section class="textoheader">
      <h1>Game</h1>
      <h4>Listado de Copias</h4>
    </section>
  </header>

  <main class="contenedor">
    <h2 class="titulo">Copias registradas</h2>

    <div class="tabla-contenedor">
      <?php
      if ($respuesta && $respuesta->num_rows > 0) {
          echo "<table class='tabla-juegos'>";
          echo "<tr>";
          while ($cabecera = $respuesta->fetch_field()) {
              echo "<th>" . htmlspecialchars($cabecera->name) . "</th>";
          }
          echo "</tr>";

          while ($datos = $respuesta->fetch_assoc()) {
              echo "<tr>";
              foreach ($datos as $campo) {
                  echo "<td>" . htmlspecialchars($campo) . "</td>";
              }
              echo "</tr>";
          }

          echo "</table>";
          echo "<a href='../php/eleccion.php'><button class='boton-regresar' type='button'>Regresar</button></a>";
      } else {
          echo "<p>No se encontraron registros en la base de datos.</p>";
      }
      $conexion->close();                                   
      ?>
    </div>
  </main>
  <footer>
  <div class="contenedor-footer">
        <div class="contenido-footer">
            <h4>Phone</h4>
            <p>+34 944 88 66 22</p>
        </div>
        <div class="contenido-footer">
            <h4>Email</h4>
            <p>info_game@game.com</p>
        </div>

    </div>
</footer>
</body>
</html>
