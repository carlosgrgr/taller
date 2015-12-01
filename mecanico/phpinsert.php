<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageMecanico($bd);
$mecanico = new Mecanico();
$mecanico->read();

$r = $gestor->insert($mecanico);
$bd->close();
//echo $r;
//var_dump($bd->getError());
header("Location:index.php?op=insertado&r=$r");