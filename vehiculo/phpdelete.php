<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageVehiculo($bd);
$matricula = Request::get("matricula");
$f = Request::get("f");

if ($f !== "1"){
    $r = $gestor->delete($matricula);
}else{
    $r = $gestor->forzarDelete($matricula);
}

$bd->close();
//var_dump($bd->getError());
header("Location:index.php?op=borrado&r=$r");