<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageCliente($bd);
$id = Request::get("id");
$f = Request::get("f");

if($f !== "1"){
    $r = $gestor->delete($id);
}else{
    $r = $gestor->forzarDelete($id);
}

$bd->close();
//var_dump($bd->getError());
header("Location:index.php?op=borrado&r=$r");