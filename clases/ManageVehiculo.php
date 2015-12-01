<?php

class ManageVehiculo {
    
    private $bd = null;
    private $tabla = "vehiculo";
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function get($matricula) {
        //devuelve el objeto de la fila cuyo id coincide con el id que le estoy pasando
        //devuelve el objeto entero
        $parametros = array();
        $parametros["matricula"] = $matricula;
        $this->bd->select($this->tabla, "*", "matricula =:matricula", $parametros);
        $fila = $this->bd->getRow();
        $vehiculo = new Vehiculo();
        $vehiculo->set($fila);
        return $vehiculo;
    }
    
    function delete($matricula) {
        $parametros = array();
        $parametros["matricula"] = $matricula;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    function deleteVehiculo($parametros){
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    function forzarDelete($matricula){
        $parametros1 = array();
        $parametros1['vehiculo'] = $matricula;
        $gestorFactura = new ManageFactura($this->bd);
        $gestorFactura->deleteFactura($parametros1);
        
        $parametros['matricula'] = $matricula;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    function erase(Vehiculo $vehiculo) {
        //borrar por nombre
        //dice ele numero de filas borratas
        return $this->delete($vehiculo->getMatricula());
    }
    
    function set(Vehiculo $vehiculo, $pkmatricula) {
        //update de todos los campos de la city menos del ID
        //dice el numero de filas modificades
        $parametros = $vehiculo->getArray();
        $parametrosWhere = array();
        $parametrosWhere["matricula"] = $pkmatricula;
        return $this->bd->update($this->tabla, $parametros, $parametrosWhere);
    }
    
    function insert(Vehiculo $vehiculo) {
        //se le pasa un objeto City y lo inserta en la tabla
        //dice el numero de filas insertadas;
        $matricula = $vehiculo->getMatricula();
        $patron = "/^[0-9]{4}[A-Za-z]{3}$/";
        if(!preg_match($patron, $matricula)){
            return false;
        }
        
        $marca = $vehiculo->getMarca();
        if(strlen($marca) < 1 || strlen($marca) > 20){
            return false;
        }
        
        $modelo = $vehiculo->getModelo();
        if($modelo !== null){
            if(strlen($modelo) > 20){
                return false;
            }
        }
        
        $motor = $vehiculo->getMotor();
        if($motor !== null){
            if(strlen($motor) > 20){
                return false;
            }
        }
        
        $anio = $vehiculo->getAnio();
        if($anio < 1901 || $anio > 2155 ){
            return false;
        }
            
        $parametros = $vehiculo->getArray();
        return $this->bd->insert($this->tabla, $parametros, false);
    }
    
    function getList($pagina=1, $nrpp=Constants::NRPP) {
        $registroInicial = ($pagina - 1) * $nrpp;
        $this->bd->select($this->tabla, "*", "1=1", array(), "matricula, marca", "$registroInicial,$nrpp");
        $r = array();
        while ($fila = $this->bd->getRow()){
            $vehiculo = new Vehiculo();
            $vehiculo->set($fila);
            $r[] = $vehiculo;
        }
        return $r;
    }
    
    function getValuesSelect() {
        $this->bd->query($this->tabla, "matricula, matricula", array(), "matricula");
        $array = array();
        while ($fila = $this->bd->getRow()){
            $array[$fila[0]] = $fila[1];
        }
        return $array;
    }
    
    function count($parametros){
        //funcion que le pasas los parámetros y las condiciones del select y que nos diga cuantos registros han resultado;
    }

}
