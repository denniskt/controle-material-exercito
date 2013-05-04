<?php
require_once("classes/usuario.class.php");

$permiteacesso=0; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)

if(isset($_GET)){
	$usuario = Usuario::editar($_GET["id"]);
}
if(isset($_POST["desativa_usuario"])){
	$msg = Usuario::desativar($_GET["id"]);
}
?>

<?php include("_header.php")?>
<header>
<title>SISCMEX - Cadastro/Usuário/Desativar</title>

</header>
<div class="conteudo">

<body>
<h1>Cadastro/Usu&aacute;rio/Desativar</h1>
<p>
  <input type=button onClick="location.href='./usuario.php'" value="< Voltar">
  <button id="botao_desativar">Desativar Cadastro Usu&aacute;rio</button>
<hr size="1">
</p>

<h2>Desativar Cadastro Usuário</h2>
<div id="form_desativar">

<form id="form_desativa_usuario" name="form_desativa_usuario" method="post" action="">
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
  <h3><?php if(isset($msg)){ echo $msg; 
  }else{?>
    Usu&aacute;rios com contas desativadas n&atilde;o ter&atilde;o mais acesso ao sistema. <br>
    Confirma  a desativa&ccedil;&atilde;o do cadastro deste usu&aacute;rio?</h3>
  <p>
    <input type="submit" name="desativa_usuario" id="botaovermelho" value="Sim" />
    <input type=button onClick="location.href='./usuario.php'" value="Cancelar">
  </p><?php }?>
</form>
</div>


  
    
  </diV>
  <?php include("_footer.php"); ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

