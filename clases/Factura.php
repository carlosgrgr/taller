<?php

class Factura {
    private $numFactura, $cliente, $vehiculo, $mecanico, $fecha, $detalle, $precio;
    
    function __construct($numFactura=null, $cliente=null, $vehiculo=null, $mecanico=null, $fecha=null, $detalle=null, $precio=null) {
        $this->numFactura = $numFactura;
        $this->cliente = $cliente;
        $this->vehiculo = $vehiculo;
        $this->mecanico = $mecanico;
        $this->fecha = $fecha;
        $this->detalle = $detalle;
        $this->precio = $precio;
    }
    
    function getNumFactura() {
        return $this->numFactura;
    }

    function getCliente() {
        return $this->cliente;
    }

    function getVehiculo() {
        return $this->vehiculo;
    }

    function getMecanico() {
        return $this->mecanico;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getDetalle() {
        return $this->detalle;
    }

    function getPrecio() {
        return $this->precio;
    }
    
    function setNumFactura($numFactura) {
        $this->numFactura = $numFactura;
    }

    function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    function setVehiculo($vehiculo) {
        $this->vehiculo = $vehiculo;
    }

    function setMecanico($mecanico) {
        $this->mecanico = $mecanico;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    
    function setDetalle($detalle) {
        $this->detalle = $detalle;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
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
