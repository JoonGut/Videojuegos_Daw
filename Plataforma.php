<?php
namespace Videojuegos_Daw;

class Plataforma {
    private $id_plataforma;
    private $nombre;
    private $id_copia;

    public function __construct($id_plataforma, $nombre, $id_copia) {
        $this->id_plataforma = $id_plataforma;
        $this->nombre = $nombre;
        $this->id_copia = $id_copia;
    }

    public function getId(){
        return $this->id_plataforma;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getIdCopia(){
        return $this->id_copia;
    }
}
?>
