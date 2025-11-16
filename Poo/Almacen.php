<?php
namespace Videojuegos_Daw;

class Almacen {
    private $id_almacen;
    private $id_tienda;
    private $copias = [];

    // Constructor
    public function __construct($id_almacen, $id_tienda) {
        $this->id_almacen = $id_almacen;
        $this->id_tienda = $id_tienda;
    }

    // Getters
    public function getId(){
        return $this->id_almacen;
    }


    public function getIdTienda(){
        return $this->id_tienda;
    }

    public function addCopia(Copia $c){
        $this->copias[$c->getId()] = $c;
    }

    public function getCopias(){
        return array_values($this->copias);
    }

    //toString
    public function __toString(){
        return "Almacén #".$this->id_almacen." (Tienda #".$this->id_tienda.")";
    }
}
?>