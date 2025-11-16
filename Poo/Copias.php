<?php
namespace Videojuegos_Daw;

class Copia {
    private $id_copia;
    private $precio_nuevo;
    private $precio_seminuevo;
    private $precio_compra;
    private $stock;
    private $id_almacen;
    private $juego;
    private $plataformas = [];

    // Constructor
    public function __construct($id_copia, $precio_nuevo, $precio_seminuevo, $precio_compra, $stock, $id_almacen, $juego) {
        $this->id_copia = $id_copia;
        $this->precio_nuevo = $precio_nuevo;
        $this->precio_seminuevo = $precio_seminuevo;
        $this->precio_compra = $precio_compra;
        $this->stock = $stock;
        $this->id_almacen = $id_almacen;
        $this->juego = $juego;
    }

    // getters y setters
    public function getId(){
        return $this->id_copia;
    }

    public function setId($id_copia){
        $this->id_copia = $id_copia;
    }

    public function getPrecioNuevo(){
        return $this->precio_nuevo;
    }

    public function setPrecioNuevo($precio_nuevo){
        $this->precio_nuevo = $precio_nuevo;
    }

    public function getPrecioSeminuevo(){
        return $this->precio_seminuevo;
    }

    public function setPrecioSeminuevo($precio_seminuevo){
        $this->precio_seminuevo = $precio_seminuevo;
    }

    public function getPrecioCompra(){
        return $this->precio_compra;
    }

    public function setPrecioCompra($precio_compra){
        $this->precio_compra = $precio_compra;
    }
    
    public function getStock(){
        return $this->stock;
    }

    public function setStock($stock){
        $this->stock = $stock;
    }

    public function getIdAlmacen(){
        return $this->id_almacen;
    }

    public function setIdAlmacen($id_almacen){
        $this->id_almacen = $id_almacen;
    }

    public function getJuego(){
        return $this->juego;
    }

    public function setJuego($juego){
        $this->juego = $juego;
    }

    public function addPlataforma($p){
        $this->plataformas[$p->getId()] = $p;
    }

    public function getPlataformas(){
        return array_values($this->plataformas);
    }

    public function tienePlataforma($nombrePlataforma) {
    foreach ($this->plataformas as $p) {
        if ($p->getNombre() === $nombrePlataforma) {
            return true;
        }
    }
    return false;
}


    //toString
    public function __toString(){
        return "Copia #".$this->id_copia." (Juego: ".$this->juego->getNombre().", Almacén #".$this->id_almacen.")";
    }
}
?>