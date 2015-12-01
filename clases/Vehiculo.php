<?php

class Vehiculo {
    private $matricula, $marca, $modelo, $motor, $anio, $propietario;
    
    function __construct($matricula=null, $marca=null, $modelo=null, $motor=null, $anio=null, $propietario=null) {
        $this->matricula = $matricula;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->motor = $motor;
        $this->anio = $anio;
        $this->propietario = $propietario;
    }
  
    function getMatricula() {
        return $this->matricula;
    }

    function getMarca() {
        return $this->marca;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getMotor() {
        return $this->motor;
    }

    function getAnio() {
        return $this->anio;
    }

    function getPropietario() {
        return $this->propietario;
    }

    function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function setMotor($motor) {
        $this->motor = $motor;
    }

    function setAnio($anio) {
        $this->anio = $anio;
    }

    function setPropietario($propietario) {
        $this->propietario = $propietario;
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
