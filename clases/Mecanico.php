<?php

class Mecanico {
    private $id, $dni, $nombre, $apellido1, $apellido2, $direccion, $telefono;
    
    function __construct($id=null, $dni=null, $nombre=null, $apellido1=null, $apellido2=null, $direccion=null, $telefono=null) {
        $this->id = $id;
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
    }
    
    function getId() {
        return $this->id;
    }

    function getDni() {
        return $this->dni;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido1() {
        return $this->apellido1;
    }

    function getApellido2() {
        return $this->apellido2;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getTelefono() {
        return $this->telefono;
    }
    
    function getPassword() {
        return $this->password;
    }


    function setId($id) {
        $this->id = $id;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;
    }

    function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    
    function setPassword($password) {
        $this->password = $password;
    }

    public function getJson() {
        $r = '{';
        foreach ($this as $indice => $valor) {
            $r .= '"' . $indice . '"' . ':' . '"' . $valor . '"' . ',' ;
        }
        $r = substr($r, 0, -1);
        $r .= '}';
        return $r;
    }
    
    function set($valores, $inicio=0) {
        $i = 0;
        foreach ($this as $indice => $valor) {
            $this->$indice = $valores[$i+$inicio];
            $i++;
        }
    }
    
     public function __toString() {
        $r = '';
        foreach ($this as $key => $valor){
            $r .= "$valor ";
        }
        return $r;
    }
    
    public function getArray($valores=true) {
        $array = array();
        foreach ($this as $key => $valor) {
            if($valores===true){
                $array[$key] = $valor;
            }else{
                $array[$key] = null;
            }
        }
        return $array;
    }
    
    function read() {
        foreach ($this as $key => $valor){
            $this->$key = Request::req($key);
        }
    }

}
