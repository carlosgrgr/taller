<?php

class ManageMecanico {
    
    private $bd = null;
    private $tabla = "mecanico";
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function get($id) {
        //devuelve el objeto de la fila cuyo id coincide con el id que le estoy pasando
        //devuelve el objeto entero
        $parametros = array();
        $parametros["id"] = $id;
        $this->bd->select($this->tabla, "*", "id =:id", $parametros);
        $fila = $this->bd->getRow();
        $mecanico = new Mecanico();
        $mecanico->set($fila);
        return $mecanico;
    }
    
    function getporNombre($nombre) {
        //devuelve el objeto de la fila cuyo id coincide con el id que le estoy pasando
        //devuelve el objeto entero
        $parametros = array();
        $parametros["nombre"] = $nombre;
        $this->bd->select($this->tabla, "*", "nombre =:nombre", $parametros);
        $fila = $this->bd->getRow();
        $mecanico = new Mecanico();
        $mecanico->set($fila);
        return $mecanico;
    }
    
    function delete($id) {
        //borrar por id
        $parametros = array();
        $parametros["id"] = $id;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    function deleteMecanico($parametros){
        return $this->bd->delete($this->tabla, $parametros);
    }
    
  function forzarDelete($id){
        $parametros1 = array();
        $parametros1['mecanico'] = $id;
        $gestorFactura = new ManageFactura($this->bd);
        $gestorFactura->deleteFactura($parametros1);
        
        $parametros['id'] = $id;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    function erase(Mecanico $mecanico) {
        //borrar por nombre
        //dice ele numero de filas borratas
        return $this->delete($mecanico->getId());
    }
    
    function set(Mecanico $mecanico, $pkid) {
        //update de todos los campos de la city menos del ID
        //dice el numero de filas modificades
        $parametros = $mecanico->getArray();
        $parametrosWhere = array();
        $parametrosWhere["id"] = $pkid;
        return $this->bd->update($this->tabla, $parametros, $parametrosWhere);
    }
    
    function insert(Mecanico $mecanico) {
        $dni = $mecanico->getDni();
        $letra = strtoupper(substr($dni, -1));
        $numeros = substr($dni, 0, -1);
        if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) != $letra || strlen($letra) != 1 || strlen($numeros) != 8 ){
            return false;
        }
        
        $nombre = $mecanico->getNombre();
        if (strlen($nombre) > 20 || strlen($nombre) < 1){
            return false;
        }
        
        $apellido1 = $mecanico->getApellido1();
        if($apellido1 !== null){
            if (strlen($apellido1) > 20){
                return false;
            }
        }
        
        $apellido2 = $mecanico->getApellido2();
        if($apellido2 !== null){
            if (strlen($apellido2) > 20){
                return false;
            }
        }
        
        $direccion = $mecanico->getDireccion();
        if($direccion !== null){
            if (strlen($nombre) > 255){
                return false;
            }
        }
        
        $telefono = $mecanico->getTelefono();
        if($telefono !== null){
            $tel_length = strlen((string)$telefono);
            if($tel_length != 9){
                return false;
            }
        }
        $parametros = $mecanico->getArray();
        return $this->bd->insert($this->tabla, $parametros, false);
    }
    
    function getList($pagina=1, $nrpp=Constants::NRPP) {
        $registroInicial = ($pagina - 1) * $nrpp;
        $this->bd->select($this->tabla, "*", "1=1", array(), "id, nombre, apellido1, apellido2", "$registroInicial,$nrpp");
        $r = array();
        while ($fila = $this->bd->getRow()){
            $mecanico = new Mecanico();
            $mecanico->set($fila);
            $r[] = $mecanico;
        }
        return $r;
    }
    
    function getValuesSelect() {
        $this->bd->query($this->tabla, "id, nombre", array(), "nombre");
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
