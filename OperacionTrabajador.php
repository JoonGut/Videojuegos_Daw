<?php
namespace Videojuegos_Daw;

class OperacionTrabajador {
    private $DNI;
    private $id_copia;
    private $accion;
    private $fecha_accion;

    //constructor
    public function __construct($DNI, $id_copia, $accion, $fecha_accion) {
        $this->DNI = $DNI;
        $this->id_copia = $id_copia;
        $this->accion = $accion;
        $this->fecha_accion = $fecha_accion;
    }

    //getters y setters
    public function getDni(){
        return $this->DNI;
    }
    
    public function setDni($DNI){
        $this->DNI = $DNI;
    }

    public function getIdCopia(){
        return $this->id_copia;
    }

    public function getAccion(){
        return $this->accion;
    }

    public function getFechaAccion(){
        return $this->fecha_accion;
    }

    //toString
    public function __toString(){
        return "Operación: ".$this->accion." - Copia #".$this->id_copia." - Trabajador DNI: ".$this->DNI." - Fecha: ".$this->fecha_accion;
    }
}
?>
