<?php
require_once("classes/setor.class.php");
		
if(isset($_GET)){
	$setor = Setor::editar($_GET["sigla"]);
}
if(isset($_POST["desativa_setor"])){
	$msg = Setor::desativar($_GET["sigla"]);
}
	
$permiteacesso=0;

?>
<?php include("_header.php"); ?>
<head>
<title>SISCMEX - Desativar Cadastro Setor</title>
</head>
<div class="conteudo">

<body>
<h1>Desativar Cadastro Setor
</h1>
<form id="form_desativa" name="form_desativa" method="post" action="">
  <table width="300" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="50%">sigla do setor:</td>
      <td width="50%"><?php echo $setor->sg_setor; ?></td>
    </tr>
    <tr>
      <td>nome do setor:</td>
      <td><?php  echo $setor->nm_setor; ?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <?php if(isset($msg)){ echo "<h3>$msg</h3>"; }else{?>
    <h2>Confirma  a desativa&ccedil;&atilde;o do cadastro do setor?</h2>
  <p>
    <input type="submit" name="desativa_setor" id="desativa_setor" value="Sim" />
  </p><?php }?>
</form>
<p>&nbsp;</p>

</diV>
<?php include("_footer.php")?>