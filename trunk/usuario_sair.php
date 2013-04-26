<?php 
require_once("classes/conexao.class.php");
session_start();
session_destroy();
Conexao::desconectar();

header("Location: ./index.php");
?>