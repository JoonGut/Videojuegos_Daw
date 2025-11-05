<?php
include 'conexion.php';

$nom    = $_POST['nombre_juego'];
$plataforma = $_POST['plataforma'];


$juego = mysqli_query($conexion, "SELECT id_juego FROM juegos WHERE nombre='$nom' LIMIT 1");
if (mysqli_num_rows($juego) == 0) {
    echo "El juego no existe en la base de datos.";
    echo '<a href="eleccion.html"><button id="boton">Volver</button></a>';
    mysqli_close($conexion);
    exit;
}
$fila = mysqli_fetch_assoc($juego);
$id_juego = $fila['id_juego'];


$convertirPlataforma = mysqli_query($conexion, "SELECT id_plataforma FROM plataformas WHERE nombre='$plataforma' LIMIT 1");
if (mysqli_num_rows($convertirPlataforma) == 0) {
    echo "La plataformano existe en la base de datos.";
    echo '<a href="eleccion.html"><button id="boton">Volver</button></a>';
    mysqli_close($conexion);
    exit;
}
$fila2 = mysqli_fetch_assoc($convertirPlataforma);
$id_plataforma = $fila2['id_plataforma'];


$existe = mysqli_query($conexion, "SELECT 1 FROM juegos WHERE nombre='$nom' LIMIT 1");
if (mysqli_num_rows($existe) > 0) {
    $sqlborrar="DELETE FROM juegos
                WHERE nombre = '$nom'";
    $ok = mysqli_query($conexion, $sqlborrar);
    if ($ok) {
    echo"El juego ha sido borrado de la base de datos.";
    echo '<a href="eleccion.html"><button id="boton">Volver</button></a>';
    mysqli_close($conexion);
    exit;
} else {
    echo '
        <script>  
            alert("No se pudo borrar el juego.");
            window.location = "eleccion.html";
        </script>
    ';
}
    mysqli_close($conexion);
    exit;
} 





mysqli_close($conexion);
exit;

?>
