<?php

class ManageFacturaVehiculo {
    private $bd = null;
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function join($condicion = "1=1", $parametros = array()) {
        $sql = "select fa.*, ve.* from factura fa left join vehiculo ve on fa.vehiculo=ve.matricula where $condicion";
        $this->bd->send($sql, $parametros);
        $contador = 0;
        $r = array();
        while($fila = $this->bd->getRow()){
            $factura = new Factura();
            $factura->set($fila);
            $vehiculo = new Vehiculo();
            $vehiculo->set($fila, 7);
 
            $r[$contador]["factura"] = $factura;
            $r[$contador]["vehiculo"] = $vehiculo;
            $contador++;
        }
        return $r;
    }
    
    
}
