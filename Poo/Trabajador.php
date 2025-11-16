<?php
namespace Videojuegos_Daw;

class Trabajador {
    private $DNI;
    private $nombre;
    private $apellido;
    private $fecha_nacimiento;
    private $email;
    private $usuario;
    private $password;
    private $id_tienda;
    private $operaciones = [];
    //constructor
    public function __construct($DNI, $nombre, $apellido, $fecha_nacimiento, $email, $usuario, $password) {
        $this->DNI = $DNI;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->email = $email;
        $this->usuario = $usuario;
        $this->password = $password;
    }
    //getters y setters
    public function getDni(){
        return $this->DNI;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getFechaNacimiento(){
        return $this->fecha_nacimiento;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getIdTienda(){
        return $this->id_tienda;
    }

    public function setIdTienda($id_tienda){
        $this->id_tienda = $id_tienda;
    }
    //toString
    public function __toString(){
        return "Trabajador DNI: ".$this->DNI." - Nombre: ".$this->nombre." ".$this->apellido." - Email: ".$this->email." - Usuario: ".$this->usuario;
    }
}
?>