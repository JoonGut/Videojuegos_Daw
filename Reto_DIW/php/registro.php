<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Página PHP</title>
    <link rel="stylesheet" href="estilos.css">
</head>
</html>
<?php
include 'conexion.php';

$nom    = $_POST['nombre_juego'];
$fecha    = $_POST['fecha_publicacion'];
$estudiosDesarrollo    = $_POST['estudios_desarrollo'];



$existe = mysqli_query($conexion, "SELECT 1 FROM juegos WHERE nombre='$nom' LIMIT 1");
if (mysqli_num_rows($existe) > 0) {
    ;
    echo"El juego ya existe en la base de datos.";
    echo '<a href="../php/eleccion.php"><button id="boton">Volver</button></a>';
    mysqli_close($conexion);
    exit;
} 

$sqlinsertar1="INSERT INTO juegos(nombre,fecha_publicacion,estudios_desarrollo) 
                VALUES ('$nom','$fecha','$estudiosDesarrollo')";
$ok = mysqli_query($conexion, $sqlinsertar1);
if ($ok) {
    $rs = mysqli_query($conexion, "SELECT nombre,fecha_publicacion,estudios_desarrollo FROM juegos WHERE nombre='$nom'");
    $row = mysqli_fetch_assoc($rs);

    echo '<div class="barra">';
echo '  <h1>Registro</h1>';
echo '</div>';

echo '<div class="formulario">';
echo '  <form>';
echo '    <h2 style="margin:0;">Registro completado</h2>';

echo '    <ul style="list-style:none; padding-left:0; margin:8px 0 0;">';
echo '      <li><strong>Nombre:</strong> ' . htmlspecialchars($row["nombre"] ?? "", ENT_QUOTES, "UTF-8") . '</li>';
echo '      <li><strong>Fecha de publicación:</strong> ' . htmlspecialchars($row["fecha_publicacion"] ?? "", ENT_QUOTES, "UTF-8") . '</li>';
echo '      <li><strong>Estudios de desarrollo:</strong> ' . htmlspecialchars($row["estudios_desarrollo"] ?? "", ENT_QUOTES, "UTF-8") . '</li>';
echo '    </ul>';

echo '    <a href="../php/eleccion.php" style="text-decoration:none; margin-top:12px;">';
echo '      <button id="boton" type="button">Volver</button>';
echo '    </a>';

echo '  </form>';
echo '</div>';
} else {
    echo '
        <script>  
            alert("No se pudo guardar el usuario.");
            window.location = "../php/eleccion.php";
        </script>
    ';
}



mysqli_close($conexion);
exit;

?>
