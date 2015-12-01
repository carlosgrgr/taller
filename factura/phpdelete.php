<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageFactura($bd);
$numFactura = Request::get("numFactura");
$r = $gestor->delete($numFactura);

$bd->close();
//var_dump($bd->getError());
header("Location:index.php?op=borrado&r=$r");