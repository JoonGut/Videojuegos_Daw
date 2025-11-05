<?php
include 'conexion.php';
mysqli_set_charset($conexion, 'utf8mb4');

// 1) Recoger parámetros del POST
$id_juego      = $_POST['id_juego']      ?? null;   // int (PK de juegos)
$id_almacen    = $_POST['id_almacen']    ?? null;   // int (PK de almacenes)
$precio_nuevo  = $_POST['precio_nuevo']  ?? null;   // decimal
$precio_semi   = $_POST['precio_seminuevo'] ?? null; // decimal
$precio_compra = $_POST['precio_compra'] ?? null;   // decimal
$stock         = $_POST['stock']         ?? null;   // int >= 0
$plataforma    = trim($_POST['plataforma'] ?? "");  // opcional

// 2) Validación básica
$err = [];
if (!ctype_digit((string)$id_juego))   $err[] = "id_juego inválido.";
if (!ctype_digit((string)$id_almacen)) $err[] = "id_almacen inválido.";
if (!is_numeric($precio_nuevo) || $precio_nuevo < 0)     $err[] = "precio_nuevo inválido.";
if (!is_numeric($precio_semi)  || $precio_semi  < 0)     $err[] = "precio_seminuevo inválido.";
if (!is_numeric($precio_compra)|| $precio_compra< 0)     $err[] = "precio_compra inválido.";
if (!ctype_digit((string)$stock) || (int)$stock < 0)     $err[] = "stock inválido (>=0).";

if ($err) {
    echo "<h3>Errores</h3><ul><li>" . implode("</li><li>", array_map('htmlspecialchars',$err)) . "</li></ul>";
    echo '<a href="eleccion.html"><button>Volver</button></a>';
    exit;
}

// 3) Comprobar existencia de claves foráneas
$existeJuego = $conexion->prepare("SELECT 1 FROM juegos WHERE id_juego=? LIMIT 1");
$existeJuego->bind_param("i", $id_juego);
$existeJuego->execute();
$existeJuego->store_result();
if ($existeJuego->num_rows === 0) { echo "El juego no existe."; exit; }

$existeAlm = $conexion->prepare("SELECT 1 FROM almacenes WHERE id_almacen=? LIMIT 1");
$existeAlm->bind_param("i", $id_almacen);
$existeAlm->execute();
$existeAlm->store_result();
if ($existeAlm->num_rows === 0) { echo "El almacén no existe."; exit; }



// 5) Transacción: insertar copia (+ plataforma opcional)
$conexion->begin_transaction();
try {
    $stmt = $conexion->prepare("
        INSERT INTO copias
        (id_almacenes, id_juegos, precio_nuevo, precio_seminuevo, precio_compra, stock)
        VALUES (?,?,?,?,?,?)
    ");
    $stmt->bind_param("iidddi", $id_almacen, $id_juego, $precio_nuevo, $precio_semi, $precio_compra, $stock);
    if (!$stmt->execute()) throw new Exception("Error al insertar copia: ".$stmt->error);

    $id_copia = $stmt->insert_id;

    // 5.1) Si nos pasan plataforma, la insertamos ligada a la copia (evitando duplicado)
    if ($plataforma !== "") {
        $chkPl = $conexion->prepare("SELECT 1 FROM plataformas WHERE id_copias=? AND nombre=? LIMIT 1");
        $chkPl->bind_param("is", $id_copia, $plataforma);
        $chkPl->execute();
        $chkPl->store_result();
        if ($chkPl->num_rows === 0) {
            $insPl = $conexion->prepare("INSERT INTO plataformas (id_copias, nombre) VALUES (?,?)");
            $insPl->bind_param("is", $id_copia, $plataforma);
            if (!$insPl->execute()) throw new Exception("Error al insertar plataforma: ".$insPl->error);
        }
    }

    $conexion->commit();

    // 6) Mostrar resumen
    $q = $conexion->prepare("
        SELECT c.id_copia, c.id_juegos, c.id_almacenes, c.precio_nuevo, c.precio_seminuevo, c.precio_compra, c.stock,
               j.nombre AS titulo, a.id_tiendas
        FROM copias c
        JOIN juegos j   ON j.id_juego   = c.id_juegos
        JOIN almacenes a ON a.id_almacen = c.id_almacenes
        WHERE c.id_copia = ?
    ");
    $q->bind_param("i", $id_copia);
    $q->execute();
    $res = $q->get_result()->fetch_assoc();

    echo "<h2>Copia insertada</h2>";
    echo "<ul>";
    echo "<li><strong>ID copia:</strong> ".htmlspecialchars($res['id_copia'])."</li>";
    echo "<li><strong>Juego:</strong> ".htmlspecialchars($res['titulo'])." (ID ".$res['id_juegos'].")</li>";
    echo "<li><strong>Almacén:</strong> ".htmlspecialchars($res['id_almacenes'])."</li>";
    echo "<li><strong>Precios:</strong> nuevo ".$res['precio_nuevo']." | seminuevo ".$res['precio_seminuevo']." | compra ".$res['precio_compra']."</li>";
    echo "<li><strong>Stock:</strong> ".$res['stock']."</li>";
    if ($plataforma !== "") echo "<li><strong>Plataforma:</strong> ".htmlspecialchars($plataforma)."</li>";
    echo "</ul>";
    echo '<a href="eleccion.html"><button>Volver</button></a>';

} catch (Exception $e) {
    $conexion->rollback();
    echo "<strong>Error:</strong> ".htmlspecialchars($e->getMessage());
    echo '<br><a href="eleccion.html"><button>Volver</button></a>';
}

$conexion->close();
