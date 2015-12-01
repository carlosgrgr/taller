<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageVehiculo($bd);
$vehiculo = new Vehiculo();
$vehiculo->read();
$pkMatricula = Request::post("pkMatricula");

//Necesito saber el id del cliente a través del dni
//cojo el dni del cliente que se crea en el formulario
$dni = $vehiculo->getPropietario();

//Creo un objeto ManageCliente para utilizar la función a la que
//le paso el dni y me devuelve el id del cliente
$gestorCliente = new ManageCliente($bd);
$cliente = new Cliente();
$cliente = $gestorCliente->getporDNI($dni);
$idCliente = $cliente->getId();
$vehiculo->setPropietario($idCliente);

$r = $gestor->set($vehiculo, $pkMatricula);
$bd->close();
//var_dump($bd->getError());
header("Location:index.php?op=editado&r=$r");