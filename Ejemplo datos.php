<<<<<<< HEAD
<?php
namespace Videojuegos_Daw;

require_once 'Paises.php';
require_once 'Tienda.php';
require_once 'Trabajador.php';
require_once 'OperacionTrabajador.php';
require_once 'Almacen.php';
require_once 'Copias.php';
require_once 'Plataforma.php';
require_once 'Juegos.php';
require_once 'PruebaAyuda.php';

$pais = new Pais(1, "España");

$tienda1 = new Tienda(1, "Calle Mayor 1, Madrid", $pais);
$tienda2 = new Tienda(2, "Gran Vía 5, Barcelona", $pais);

$alm1 = new Almacen(1, $tienda1->getId());
$alm2 = new Almacen(2, $tienda2->getId());
$tienda1->setAlmacen($alm1);
$tienda2->setAlmacen($alm2);

$j1 = new Juego(1, "Aventura Épica", "2021-11-10", "Estudio A", "PS5");
$j2 = new Juego(2, "Carreras Xtreme", "2020-06-22", "Estudio B", "Xbox Series X");
$j3 = new Juego(3, "Puzzle Master", "2019-02-05", "Estudio C", "Switch");

$ps5 = new Plataforma(1, "PS5", 101);
$xbox = new Plataforma(2, "Xbox Series X", 102);
$switch = new Plataforma(3, "Switch", 104);
$pc = new Plataforma(4, "PC", 101);

$c1 = new Copia(101, 69.99, 39.99, 20.00, 5, $alm1->getId(), $j1);
$c1->addPlataforma($ps5);
$c1->addPlataforma($pc);

$c2 = new Copia(102, 59.99, 34.99, 18.00, 2, $alm1->getId(), $j2);
$c2->addPlataforma($xbox);

$c3 = new Copia(103, 49.99, 24.99, 12.00, 10, $alm2->getId(), $j2);
$c3->addPlataforma($ps5);
$c3->addPlataforma($xbox);

$c4 = new Copia(104, 29.99, 14.99, 6.00, 0, $alm2->getId(), $j3);
$c4->addPlataforma($switch);

$alm1->addCopia($c1);
$alm1->addCopia($c2);
$alm2->addCopia($c3);
$alm2->addCopia($c4);

$t1 = new Trabajador("12345678A", "Ana", "Gómez", "1990-04-12", "ana@example.com", "ana90", "pass1");
$t2 = new Trabajador("87654321B", "Luis", "Martín", "1985-09-03", "luis@example.com", "lmartin", "pass2");
$t3 = new Trabajador("11223344C", "Marta", "Sánchez", "1992-12-20", "marta@example.com", "marta92", "pass3");

$tienda1->addTrabajador($t1);
$tienda1->addTrabajador($t2);
$tienda2->addTrabajador($t3);

$app = new PruebaAyuda([$tienda1, $tienda2]);

$app->cuantosTrabajadores();
$app->queVideojuegos("PS5");
?>
=======
<?php
namespace Videojuegos_Daw;

require_once 'Paises.php';
require_once 'Tienda.php';
require_once 'Trabajador.php';
require_once 'OperacionTrabajador.php';
require_once 'Almacen.php';
require_once 'Copias.php';
require_once 'Plataforma.php';
require_once 'Juegos.php';
require_once 'MainApp.php';

$pais = new Pais(1, "España");

$tienda1 = new Tienda(1, "Calle Mayor 1, Madrid", $pais);
$tienda2 = new Tienda(2, "Gran Vía 5, Barcelona", $pais);

$alm1 = new Almacen(1, $tienda1->getId());
$alm2 = new Almacen(2, $tienda2->getId());
$tienda1->setAlmacen($alm1);
$tienda2->setAlmacen($alm2);

$j1 = new Juego(1, "Aventura Épica", "2021-11-10", "Estudio A", "PS5");
$j2 = new Juego(2, "Carreras Xtreme", "2020-06-22", "Estudio B", "Xbox Series X");
$j3 = new Juego(3, "Puzzle Master", "2019-02-05", "Estudio C", "Switch");

$ps5 = new Plataforma(1, "PS5", 101);
$xbox = new Plataforma(2, "Xbox Series X", 102);
$switch = new Plataforma(3, "Switch", 104);
$pc = new Plataforma(4, "PC", 101);

$c1 = new Copia(101, 69.99, 39.99, 20.00, 5, $alm1->getId(), $j1);
$c1->addPlataforma($ps5);
$c1->addPlataforma($pc);

$c2 = new Copia(102, 59.99, 34.99, 18.00, 2, $alm1->getId(), $j2);
$c2->addPlataforma($xbox);

$c3 = new Copia(103, 49.99, 24.99, 12.00, 10, $alm2->getId(), $j2);
$c3->addPlataforma($ps5);
$c3->addPlataforma($xbox);

$c4 = new Copia(104, 29.99, 14.99, 6.00, 0, $alm2->getId(), $j3);
$c4->addPlataforma($switch);

$alm1->addCopia($c1);
$alm1->addCopia($c2);
$alm2->addCopia($c3);
$alm2->addCopia($c4);

$t1 = new Trabajador("12345678A", "Ana", "Gómez", "1990-04-12", "ana@example.com", "ana90", "pass1");
$t2 = new Trabajador("87654321B", "Luis", "Martín", "1985-09-03", "luis@example.com", "lmartin", "pass2");
$t3 = new Trabajador("11223344C", "Marta", "Sánchez", "1992-12-20", "marta@example.com", "marta92", "pass3");

$tienda1->addTrabajador($t1);
$tienda1->addTrabajador($t2);
$tienda2->addTrabajador($t3);

$app = new MainApp([$tienda1, $tienda2]);

$app->cuantosTrabajadores();
$app->queVideojuegos("PS5");
?>
>>>>>>> 381082ee9d240ecc04f6de9b8b3e1bb43dd56e2d
