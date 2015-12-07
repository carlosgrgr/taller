<?php

class ManageFacturaMecanico {
    private $bd = null;
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function join($condicion = "1=1", $parametros = array()) {
        $sql = "select fa.*, me.* from factura fa left join mecanico me on fa.mecanico=me.id where $condicion";
        $this->bd->send($sql, $parametros);
        $contador = 0;
        $r = array();
        while($fila = $this->bd->getRow()){
            $factura = new Factura();
            $factura->set($fila);
            $mecanico = new Mecanico();
            $mecanico->set($fila, 7);
 
            $r[$contador]["factura"] = $factura;
            $r[$contador]["mecanico"] = $mecanico;
            $contador++;
        }
        return $r;
    }
}
