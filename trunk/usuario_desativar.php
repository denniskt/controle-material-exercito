<?php
require_once("classes/usuario.class.php");
		
if(isset($_GET)){
	$usuario = Usuario::editar($_GET["id"]);
}
if(isset($_POST["desativa_usuario"])){
	$msg = Usuario::desativar($_GET["id"]);
}
	
$permiteacesso=0;

?>
<?php include("_header.php"); ?>
<head>
<title>SISCMEX - Desativar Cadastro Usuário</title>
</head>
<div class="conteudo">

<body>
<h1>Desativar Cadastro Usu&aacute;rio
</h1>
<form id="form_desativa" name="form_deativa" method="post" action="">
  <table width="300" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="50%">identidade:</td>
      <td width="50%"><?php echo $usuario->cd_identidade; ?></td>
    </tr>
    <tr>
      <td>nome completo:</td>
      <td><?php  echo $usuario->nm_usuario; ?></td>
    </tr>
    <tr>
      <td>nome guerra:</td>
      <td><?php echo $usuario->nm_guerra; ?></td>
    </tr>
    <tr>
      <td>setor:</td>
      <td><?php echo $usuario->sg_setor; ?></td>
    </tr>
    <tr>
      <td>n&iacute;vel de acesso:</td>
      <td><?php echo $usuario->nm_acesso; ?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <h2><?php if(isset($msg)){ echo $msg; }else{?>
    Usu&aacute;rios com contas desativadas n&atilde;o ter&atilde;o mais acesso ao sistema. <br>
    Confirma  a desativa&ccedil;&atilde;o do cadastro do usu&aacute;rio?</h2>
  <p>
    <input type="submit" name="desativa_usuario" id="desativa_usuario" value="Sim" />
  </p><?php }?>
</form>
<p>&nbsp;</p>

</diV>
<?php include("_footer.php")?>