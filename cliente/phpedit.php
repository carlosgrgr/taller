<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageCliente($bd);
$cliente = new Cliente();
$cliente->read();
$pkid = Request::post("pkid");
$r = $gestor->set($cliente, $pkid);
$bd->close();

//echo $r;
//var_dump($bd->getError());

header("Location:index.php?op=editado&r=$r");