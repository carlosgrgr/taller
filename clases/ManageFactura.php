<?php

class ManageFactura {

    private $bd = null;
    private $tabla = "factura";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function get($numFactura) {
        //devuelve el objeto de la fila cuyo id coincide con el id que le estoy pasando
        //devuelve el objeto entero
        $parametros = array();
        $parametros["numFactura"] = $numFactura;
        $this->bd->select($this->tabla, "*", "numFactura =:numFactura", $parametros);
        $fila = $this->bd->getRow();
        $factura = new Factura();
        $factura->set($fila);
        return $factura;
    }

    function delete($numFactura) {
        //borrar por id
        $parametros = array();
        $parametros["numFactura"] = $numFactura;
        return $this->bd->delete($this->tabla, $parametros);
    }

    function deleteFactura($parametros) {
        return $this->bd->delete($this->tabla, $parametros);
    }

//    function forzarDelete($numFactura){
//        $parametros = array();
//        $parametros['id'] = $numFactura;
//        $gestor = new ManageCliente($this->bd);
//        $gestor->deleteCliente($parametros);
//        $this->bd->delete("cliente", $parametros);
//        
//        $parametros['matricula'] = $numFactura;
//        $gestor = new ManageVehiculo($this->bd);
//        $gestor->deleteVehiculo($parametros);
//        $this->bd->delete("id", $parametros);
//        
//        $parametros['id'] = $numFactura;
//        $gestor = new ManageCliente($this->bd);
//        $gestor->deleteCliente($parametros);
//        $this->bd->delete("id", $parametros);
//        
//        $parametros = array();
//        $parametros['numFactura'] = $numFactura;
//        return $this->bd->delete($this->tabla, $parametros);
//    }

    function erase(Factura $factura) {
        //borrar por nombre
        //dice el numero de filas borratas
        return $this->delete($factura->getNumFactura());
    }

    function set(Factura $factura, $pknumFactura) {
        //update de todos los campos de la city menos del ID
        //dice el numero de filas modificades
        $parametros = $factura->getArray();
        $parametrosWhere = array();
        $parametrosWhere["numFactura"] = $pknumFactura;
        return $this->bd->update($this->tabla, $parametros, $parametrosWhere);
    }

    function insert(Factura $factura) {
        //se le pasa un objeto City y lo inserta en la tabla
        //dice el numero de filas insertadas;
        $fecha = $factura->getFecha();

        function validateDate($date, $format = 'Y-m-d H:i:s') {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }
        if (validateDate($fecha, 'Y-m-d') == false) {
            return false;
        }

        $precio = $factura->getPrecio();
        if (filter_var($precio, FILTER_VALIDATE_FLOAT) == false) {
            return false;
        }



        $parametros = $factura->getArray();
        return $this->bd->insert($this->tabla, $parametros, false);
    }

    function getList($pagina = 1, $nrpp = Constants::NRPP) {
        $registroInicial = ($pagina - 1) * $nrpp;
        $this->bd->select($this->tabla, "*", "1=1", array(), "numFactura", "$registroInicial,$nrpp");
        $r = array();
        while ($fila = $this->bd->getRow()) {
            $factura = new Factura();
            $factura->set($fila);
            $r[] = $factura;
        }
        return $r;
    }

    function getValuesSelect() {
        $this->bd->query($this->tabla, "numFactura, numFactura", array(), "numFactura");
        $array = array();
        while ($fila = $this->bd->getRow()) {
            $array[$fila[0]] = $fila[1];
        }
        return $array;
    }

    function count($parametros) {
        //funcion que le pasas los parámetros y las condiciones del select y que nos diga cuantos registros han resultado;
    }

}
