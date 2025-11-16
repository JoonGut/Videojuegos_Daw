<?php
namespace Videojuegos_Daw;
require_once "Tienda.php";
require_once "Almacen.php";
require_once "Copias.php";
require_once "Trabajador.php";
require_once "Juegos.php";
require_once "Plataforma.php";
require_once "Paises.php";
require_once "OperacionTrabajador.php";

class PruebaAyuda {
    private array $tiendas = [];

    public function __construct(array $tiendas = []) {
        $this->tiendas = $tiendas;
    }

    public function addTienda(Tienda $t): void {
        $this->tiendas[$t->getId()] = $t;
    }

    public function cuantosTrabajadores(): void {
        $total = 0;
        echo "<h2>Resumen de trabajadores</h2>";
        echo "<ul>";
        foreach ($this->tiendas as $t) {
            $count = $t->getTotalTrabajadores();
            $total += $count;
            echo "<li>Tienda #" . $t->getId() . " (" . htmlspecialchars($t->getDireccion()) . "): $count trabajador(es)</li>";
        }
        echo "</ul>";
        echo "<p><strong>Total trabajadores en todas las tiendas:</strong> $total</p>";
    }

    public function queVideojuegos(string $plataformaNombre): void {
        $plataformaNombre = trim($plataformaNombre);
        echo "<h2>Videojuegos para la plataforma: " . htmlspecialchars($plataformaNombre) . "</h2>";
        foreach ($this->tiendas as $t) {
            echo "<h3>Tienda #" . $t->getId() . " - " . htmlspecialchars($t->getDireccion()) . "</h3>";
            $almacen = $t->getAlmacen();
            if ($almacen === null) {
                echo "<p>Sin almacen asignado.</p>";
                continue;
            }
            $juegosMostrados = [];
            $filas = [];
            foreach ($almacen->getCopias() as $copia) {
                if ($copia->tienePlataforma($plataformaNombre)) {
                    $j = $copia->getJuego();
                    if (!isset($juegosMostrados[$j->getId()])) {
                        $juegosMostrados[$j->getId()] = true;
                        $filas[] = [
                            'id' => $j->getId(),
                            'nombre' => $j->getNombre(),
                            'fecha' => $j->getFechaPublicacion(),
                            'estudio' => $j->getEstudiosDesarrollo(),
                            'precio_nuevo' => $copia->getPrecioNuevo(),
                            'precio_seminuevo' => $copia->getPrecioSeminuevo(),
                            'stock' => $copia->getStock()
                        ];
                    }
                }
            }
            if (count($filas) === 0) {
                echo "<p>No hay videojuegos para esa plataforma en esta tienda.</p>";
                continue;
            }
            echo "<table border='1' cellpadding='6' cellspacing='0'>";
            echo "<thead><tr>
                    <th>ID Juego</th>
                    <th>Nombre</th>
                    <th>Fecha Public.</th>
                    <th>Estudio</th>
                    <th>Precio Nuevo</th>
                    <th>Precio Seminuevo</th>
                    <th>Stock</th>
                  </tr></thead><tbody>";
            foreach ($filas as $f) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars((string)$f['id']) . "</td>";
                echo "<td>" . htmlspecialchars($f['nombre']) . "</td>";
                echo "<td>" . htmlspecialchars($f['fecha']) . "</td>";
                echo "<td>" . htmlspecialchars($f['estudio']) . "</td>";
                echo "<td>" . htmlspecialchars(number_format($f['precio_nuevo'], 2)) . " €</td>";
                echo "<td>" . htmlspecialchars(number_format($f['precio_seminuevo'], 2)) . " €</td>";
                echo "<td>" . htmlspecialchars((string)$f['stock']) . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        }
    }
}
?>
