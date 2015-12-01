<?php

class ManageFacturaCliente {
    private $bd = null;
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function join($condicion = "1=1", $parametros = array()) {
        $sql = "select fa.*, cli.* from factura fa left join cliente cli on fa.cliente=cli.id where $condicion";
        $this->bd->send($sql, $parametros);
        $contador = 0;
        $r = array();
        while($fila = $this->bd->getRow()){
            $factura = new Factura();
            $factura->set($fila);
            $cliente = new Cliente();
            $cliente->set($fila, 7);
 
            $r[$contador]["factura"] = $factura;
            $r[$contador]["cliente"] = $cliente;
            $contador++;
        }
        return $r;
    }
}
