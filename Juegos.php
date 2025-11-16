<?php
namespace Videojuegos_Daw;

class Juego {
    private $id_juego;
    private $nombre;
    private $fecha_publicacion;
    private $estudios_desarrollo;
    private $plataforma;
    //constructor
    public function __construct($id_juego, $nombre, $fecha_publicacion, $estudios_desarrollo, $plataforma) {
        $this->id_juego = $id_juego;
        $this->nombre = $nombre;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->estudios_desarrollo = $estudios_desarrollo;
        $this->plataforma = $plataforma;
    }
    //getters y setters
    public function getId(){
        return $this->id_juego;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getFechaPublicacion(){
        return $this->fecha_publicacion;
    }

    public function getEstudiosDesarrollo(): string {
        return $this->estudios_desarrollo;
    }

    public function getPlataforma(): string {
        return $this->plataforma;
    }

    //toString
    public function __toString(){
        return "Juego #".$this->id_juego." - ".$this->nombre." (".$this->plataforma.")";
    }
}
?>
