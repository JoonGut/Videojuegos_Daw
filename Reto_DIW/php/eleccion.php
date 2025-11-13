<?php
session_start(); // Inicia la sesión o continúa la existente

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html"); // Si no hay sesión, redirige al login
    exit; // Detiene la ejecución del resto de la página
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/estilos3.css">
  <link rel="shortcut icon" href="../imagenes/faviconGame.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">    
  <title>Acciones</title>
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
      <h4>Panel de Acciones</h4>
    </section>
  </header>

  <main class="formulario contenedor">
    <h1 class="titulo" id="bienvenida">Elige una opción</h1>
    <p>Selecciona qué operación deseas realizar.</p>

    <nav class="panel-acciones">
  
  <a class="accion" href="../html/formulario.html">
    <i class="fa-solid fa-plus"></i>
    <span>Introducir Juego</span>
  </a>

  <a class="accion" href="../html/formularioBorrar.html">
    <i class="fa-solid fa-trash"></i>
    <span>Borrar Juego</span>
  </a>

  <a class="accion" href="../php/mostrar.php">
    <i class="fa-solid fa-list"></i>
    <span>Ver Juegos</span>
  </a>

  <a class="accion" href="../html/formularioCopias.html">
    <i class="fa-solid fa-copy"></i>
    <span>Introducir Copias</span>
  </a>

  <a class="accion" href="../php/mostrarCopias.php">
    <i class="fa-solid fa-folder-open"></i>
    <span>Ver Copias</span>
  </a>

  <a class="accion" href="../html/formularioBorrarCopias.html">
    <i class="fa-solid fa-xmark"></i>
    <span>Borrar Copias</span>
  </a>

</nav>
  </main>
</body>
</html>
