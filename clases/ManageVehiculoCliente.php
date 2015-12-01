<?php

class ManageVehiculoCliente {
    private $bd = null;
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function join($condicion = "1=1", $parametros = array()) {
        $sql = "select ve.*, cli.* from vehiculo ve left join cliente cli on ve.propietario=cli.id where $condicion";
        $this->bd->send($sql, $parametros);
        $contador = 0;
        $r = array();
        while($fila = $this->bd->getRow()){
            $vehiculo = new Vehiculo();
            $vehiculo->set($fila);
            $cliente= new Cliente();
            $cliente->set($fila, 5);
 
            $r[$contador]["vehiculo"] = $vehiculo;
            $r[$contador]["cliente"] = $cliente;
            $contador++;
        }
        return $r;
    }
    
}
