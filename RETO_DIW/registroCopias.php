<?php
include 'conexion.php';

$nombre_juego = $_POST['nombre_juego'];
$id_almacen   = $_POST['id_almacen'];
$precio_nuevo = $_POST['precio_nuevo'];
$precio_semi  = $_POST['precio_seminuevo'];
$precio_compra = $_POST['precio_compra'];
$stock        = $_POST['stock'];
$plataforma   = $_POST['plataforma'];

$juego = mysqli_query($conexion, "SELECT id_juego FROM juegos WHERE nombre='$nombre_juego' LIMIT 1");
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

$sqlinsertar = "INSERT INTO copias (id_almacenes, id_juegos, precio_nuevo, precio_seminuevo, precio_compra, stock,id_plataformas)
                VALUES ('$id_almacen', '$id_juego', '$precio_nuevo', '$precio_semi', '$precio_compra', '$stock','$id_plataforma')";
$ok = mysqli_query($conexion, $sqlinsertar);

if ($ok) {
    $id_copia = mysqli_insert_id($conexion);

    echo "<h2>Copia añadida</h2>";
    echo "<ul>";
    echo "<li><strong>Juego:</strong> $nombre_juego</li>";
    echo "<li><strong>Almacén:</strong> $id_almacen</li>";
    echo "<li><strong>Precio nuevo:</strong> $precio_nuevo</li>";
    echo "<li><strong>Precio seminuevo:</strong> $precio_semi</li>";
    echo "<li><strong>Precio compra:</strong> $precio_compra</li>";
    echo "<li><strong>Stock:</strong> $stock</li>";
    echo "<li><strong>Plataforma:</strong> $plataforma</li>";
    echo "</ul>";
    echo '<a href="eleccion.html"><button id="boton">Volver</button></a>';
} else {
    echo '
        <script>  
            alert("No se pudo guardar la copia.");
            window.location = "eleccion.html";
        </script>
    ';
}

mysqli_close($conexion);
exit;
?>
