<?php
require_once("classes/fornecedor.class.php");

$permiteacesso=0; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)

if(isset($_GET)){
	$fornecedor = Fornecedor::editar($_GET["cnpj"]);
}
if(isset($_POST["desativa_fornecedor"])){
	$msg = Fornecedor::desativar($_GET["cnpj"]);
}

include("_header.php")?>
<header>
<title>SISCMEX - Cadastro/Fornecedor/Desativar</title>

</header>
<div class="conteudo">

<body>
<h1>Cadastro/Fornecedor/Desativar</h1>
<p>
  <input type=button onClick="location.href='./fornecedor.php'" value="< Voltar">
  <button id="botao_desativar">Desativar Cadastro Fornecedor</button>
<hr size="1">
</p>

<h2>Desativar Cadastro Fornecedor</h2>
<div id="form_desativar">

<form id="form_desativa_fornecedor" name="form_desativar_fornecedor" method="post" action="">
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
  <h3><?php if(isset($msg)){ echo $msg; 
  }else{?>
    Confirma  a desativa&ccedil;&atilde;o do cadastro do fornecedor??</h3>
  <p>
    <input type="submit" name="desativa_fornecedor" id="botaovermelho" value="Sim" />
    <input type=button onClick="location.href='./fornecedor.php'" value="Cancelar">
  </p><?php }?>
</form>
</div>


  
    
  </diV>
  <?php include("_footer.php"); ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

