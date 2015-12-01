<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageCliente($bd);
$cliente = new Cliente();
$cliente->read();

$r = $gestor->insert($cliente);
$bd->close();
//echo $r;
//var_dump($bd->getError());
header("Location:index.php?op=insertado&r=$r");