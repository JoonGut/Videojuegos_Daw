<?php
include 'conexion.php';

$nom    = $_POST['nombre_juego'];
$fecha    = $_POST['fecha_publicacion'];
$estudiosDesarrollo    = $_POST['estudios_desarrollo'];



$existe = mysqli_query($conexion, "SELECT 1 FROM juegos WHERE nombre='$nom' LIMIT 1");
if (mysqli_num_rows($existe) > 0) {
    ;
    echo"El juego ya existe en la base de datos.";
    echo '<a href="eleccion.html"><button id="boton">Volver</button></a>';
    mysqli_close($conexion);
    exit;
} 

$sqlinsertar1="INSERT INTO juegos(nombre,fecha_publicacion,estudios_desarrollo) 
                VALUES ('$nom','$fecha','$estudiosDesarrollo')";
$ok = mysqli_query($conexion, $sqlinsertar1);
if ($ok) {
    $rs = mysqli_query($conexion, "SELECT nombre,fecha_publicacion,estudios_desarrollo FROM juegos WHERE nombre='$nom'");
    $row = mysqli_fetch_assoc($rs);

    echo "<h2>Registro completado</h2>";
    echo "<ul>";
    echo "<li><strong>Nombre:</strong> " . $row['nombre'] . "</li>";
    echo "<li><strong>Fecha De Publicacion:</strong> " . $row['fecha_publicacion'] . "</li>";
    echo "<li><strong>Estudios De Desarrollo:</strong> " . $row['estudios_desarrollo'] . "</li>";
    echo "</ul>";
    echo '<a href="eleccion.html"><button id="boton">Volver</button></a>';
} else {
    echo '
        <script>  
            alert("No se pudo guardar el usuario.");
            window.location = "eleccion.html";
        </script>
    ';
}



mysqli_close($conexion);
exit;

?>
