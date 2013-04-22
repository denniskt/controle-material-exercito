<?php
	require_once("classes/usuario.class.php");
		
	if(isset($_GET)){
		$usuario = Usuario::editar($_GET["id"]);
	}
	if(isset($_POST["excluir_usuario"])){
		$msg = Usuario::excluir($_GET["id"]);
	}
?>
<?php include("_header.php"); ?>
<head>
<title>SISCMEX - Excluir Cadastro Usuário</title>
</head>
<div class="conteudo">

<body>
<h1>Excluir Cadastro Usu&aacute;rio
</h1>
<form id="form1" name="form1" method="post" action="">
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
      <td><?php echo $usuario->nm_setor; ?></td>
    </tr>
    <tr>
      <td>n&iacute;vel de acesso:</td>
      <td><?php echo $usuario->nm_acesso; ?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <h2><?php if(isset($msg)){ echo $msg; }else{?>Confirmar a Exclus&atilde;o do Cadastro?</h2>
  <p>
    <input type="submit" name="excluir_usuario" id="excluir_usuario" value="Sim" />
  </p><?php }?>
</form>
<p>&nbsp;</p>

</diV>
<?php include("_footer.php")?>