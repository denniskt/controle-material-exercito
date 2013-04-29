<?php
require_once("classes/fornecedor.class.php");
		
if(isset($_GET)){
	$fornecedor = Fornecedor::editar($_GET["cnpj"]);
}
if(isset($_POST["desativa_fornecedor"])){
	$msg = Fornecedor::desativar($_GET["cnpj"]);
}
	
$permiteacesso=0;

?>
<?php include("_header.php"); ?>
<head>
<title>SISCMEX - Desativar Cadastro Fornecedor</title>
</head>
<div class="conteudo">

<body>
<h1>Desativar Cadastro Fornecedor
</h1>
<form id="form_desativa" name="form_desativa" method="post" action="">
  <table width="300" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="50%">cnpj:</td>
      <td width="50%"><?php echo $fornecedor->cd_cnpj; ?></td>
    </tr>
    <tr>
      <td>razão social:</td>
      <td><?php  echo $fornecedor->nm_razao_soc; ?></td>
    </tr>
    <tr>
      <td>endereco:</td>
      <td><?php  echo $fornecedor->nm_endereco; ?></td>
    </tr>
    <tr>
      <td>telefone:</td>
      <td><?php  echo $fornecedor->nm_telefone; ?></td>
    </tr>
    <tr>
      <td>email:</td>
      <td><?php  echo $fornecedor->nm_email; ?></td>
    </tr>
    <tr>
      <td>ramo de atividade:</td>
      <td><?php  echo $fornecedor->nm_ramo_ativ; ?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <?php if(isset($msg)){ echo "<h3>$msg</h3>"; }else{?>
    <h2>Confirma  a desativa&ccedil;&atilde;o do cadastro do fornecedor?</h2>
  <p>
    <input type="submit" name="desativa_fornecedor" id="desativa_fornecedor" value="Sim" />
  </p><?php }?>
</form>
<p>&nbsp;</p>

</diV>
<?php include("_footer.php")?>