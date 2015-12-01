<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageMecanico($bd);
$mecanico = new Mecanico();
$mecanico->read();

$pkid = Request::post("pkid");
$r = $gestor->set($mecanico, $pkid);
$bd->close();

//echo $r;
//var_dump($bd->getError());

header("Location:index.php?op=editado&r=$r");