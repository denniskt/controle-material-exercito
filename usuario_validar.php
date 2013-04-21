<?php
session_start();
require_once("classes/usuario.class.php");

$_SESSION['mensagem']=""; 

$usuario = new Usuario($_POST["identidade"],$_POST["senha"],NULL,NULL,NULL,NULL);
if($usuario->validar()){
	header("location:./home.php");
}
else {
	$_SESSION['mensagem']="Usuário ou senha inválidos, caso não lembre sua senha favor entrar em contato com o responsável do Almoxarifado.";
	header("location:./index.php");
}
?>