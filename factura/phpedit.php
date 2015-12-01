<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageFactura($bd);
$factura = new Factura();
$factura->read();
$pknumFactura = Request::post("pknumFactura");

//sacar el propietario del vehículo 
$matricula = $factura->getVehiculo();
$gestorVehiculo = new ManageVehiculo($bd);
$vehiculo = new Vehiculo();
$vehiculo = $gestorVehiculo->get($matricula);
$idCliente = $vehiculo->getPropietario();
$factura->setCliente($idCliente);

$r = $gestor->set($factura, $pknumFactura);
$bd->close();

//echo $r;
//var_dump($bd->getError());

header("Location:index.php?op=editado&r=$r");