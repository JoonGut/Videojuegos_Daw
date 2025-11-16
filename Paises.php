<?php
namespace Videojuegos_Daw;

class Pais {
    private $id_pais;
    private $nombre;
    //constructor
    public function __construct($id_pais, $nombre) {
        $this->id_pais = $id_pais;
        $this->nombre = $nombre;
    }
    //getters y setters
    public function getId(){
        return $this->id_pais;
    }

    public function setId($id_pais){
        $this->id_pais = $id_pais;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
}
?>
