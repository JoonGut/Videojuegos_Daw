<?php
namespace Videojuegos_Daw;

class Tienda {
    private $id_tienda;
    private $direccion;
    private $pais;
    private $almacen;
    private $trabajadores = [];
    //constructor
    public function __construct($id_tienda, $direccion, $pais) {
        $this->id_tienda = $id_tienda;
        $this->direccion = $direccion;
        $this->pais = $pais;
    }
    //getters y setters
    public function getId(){
        return $this->id_tienda;
    }

    public function setId($id_tienda){
        $this->id_tienda = $id_tienda;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    public function getPais(){
        return $this->pais;
    }

    public function setPais($pais){
        $this->pais = $pais;
    }

    public function getAlmacen(){
        return $this->almacen;
    }

    public function setAlmacen($almacen){
        $this->almacen = $almacen;
    }

    //funciones 
    public function addTrabajador($trabajador){
        $this->trabajadores[$trabajador->getDni()] = $trabajador;
        $trabajador->setIdTienda($this->id_tienda);
    }

    public function getTrabajadores(){
        return array_values($this->trabajadores);
    }

    public function getTotalTrabajadores(){
        return count($this->trabajadores);
    }

    //toString
    public function __toString(){
        return "Tienda #".$this->id_tienda." - ".$this->direccion." (".$this->pais->getNombre().")";
    }
}
?>