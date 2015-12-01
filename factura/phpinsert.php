<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageFactura($bd);
$factura = new Factura();
$factura->read();

//sacar el propietario del vehículo 
$matricula = $factura->getVehiculo();
$gestorVehiculo = new ManageVehiculo($bd);
$vehiculo = new Vehiculo();
$vehiculo = $gestorVehiculo->get($matricula);
$idCliente = $vehiculo->getPropietario();
$factura->setCliente($idCliente);
$r = $gestor->insert($factura);
$bd->close();
//echo $r;



header("Location:index.php?op=insertado&r=$r");
