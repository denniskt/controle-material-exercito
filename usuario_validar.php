<?php
session_start();
require_once("classes/usuario.class.php");

$_SESSION['mensagem']=""; 

$usuario = new Usuario($_POST["identidade"],base64_encode($_POST["senha"]),NULL,NULL,NULL,NULL,NULL);

if($usuario->validar()){
	header("location:./home.php");
}
else {
	header("location:./index.php");
}
?>