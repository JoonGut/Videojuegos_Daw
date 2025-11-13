<?php
// === PHP antes de cualquier salida por si acaso ===
include 'conexion.php';
if ($conexion->connect_errno) {
    die("No se pudo establecer conexión: " . $conexion->connect_error);
}
$consulta  = "SELECT * FROM juegos";
$respuesta = $conexion->query($consulta);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acciones</title>
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

    <div class="textoheader">
      <h1>Listado de juegos</h1>
      <h4>Resultados de la base de datos</h4>
    </div>

  </header>

  <main class="contenedor">
    <div style="width:100%; overflow-x:auto; -webkit-overflow-scrolling:touch;">
      <?php
      if ($respuesta && $respuesta->num_rows > 0) {
    echo "<div class='tabla-contenedor'>";
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
    echo "</div>";

    echo "<a href='../php/eleccion.php'>";
    echo "<button class='boton-regresar'>Regresar</button>";
    echo "</a>";
    } else {
        echo "<p>No se encontraron registros en la base de datos.</p>";
    }

      $conexion->close();
      ?>
    </div>
  </main>
</body>
</html>
