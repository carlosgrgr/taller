<?php
require './clases/AutoCarga.php';

$users = array("admin" => "admin");
$user = Request::post("usuario");
$password = Request::post("password");
$sesion = new Session();

if(isset($users[$user]) && $users[$user] == $password){
    $usuario = new Usuario($user, $password);
    $sesion->setUser($usuario);
    $sesion->sendRedirect("index.php");
}else{
    $sesion->destroy();
    $sesion->sendRedirect("login.php?log=-1");
}