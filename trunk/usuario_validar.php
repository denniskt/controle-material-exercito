<?php
session_start();
require_once("classes/usuario.class.php");

$_SESSION['mensagem']=""; 

$usuario = new Usuario($_POST["identidade"],$_POST["senha"],NULL,NULL,NULL,NULL);
if($usuario->validar()){
	header("location:./home.php");
}
else {
	$_SESSION['mensagem']="Usu�rio ou senha inv�lidos, caso n�o lembre sua senha favor entrar em contato com o respons�vel do Almoxarifado.";
	header("location:./index.php");
}
?>