<?php
require_once("classes/material.class.php");

$permiteacesso=0; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)

if(isset($_GET)){
	$material = Material::editar($_GET["codigo"]);
}
if(isset($_POST["desativar_material"])){
	$msg = Material::desativar($_GET["codigo"]);
}
?>

<?php include("_header.php")?>
<header>
<title>SISCMEX - Cadastro/Material/Desativar</title>

</header>
<div class="conteudo">

<body>
<h1>Cadastro/Material/Desativar</h1>
<p>
  <input type=button onClick="location.href='./material.php'" value="< Voltar">
  <button id="botao_desativar">Desativar Cadastro Material</button>
<hr size="1">
</p>

<h2>Desativar Cadastro Material</h2>
<div id="form_desativar">

<form id="form_desativa_material" name="form_desativa_material" method="post" action="">
  <table width="300" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="50%">código:</td>
      <td width="50%"><?php echo $material->cd_material; ?></td>
    </tr>
    <tr>
      <td>nome do material:</td>
      <td><?php  echo $material->nm_material; ?></td>
    </tr>
    <tr>
      <td>descrição do material:</td>
      <td><?php echo $material->nm_descricao; ?></td>
    </tr>
    <tr>
      <td>unidade de medida:</td>
      <td><?php echo $material->sg_unidade_med; ?></td>
    </tr>
    <tr>
      <td>tipo de material:</td>
      <td><?php echo $material->sg_tipo_material; ?></td>
    </tr>
  </table>
  <h3><?php if(isset($msg)){ echo $msg; 
  }else{?>
    Confirma  a desativa&ccedil;&atilde;o do cadastro deste material?</h3>
  <p>
    <input type="submit" name="desativar_material" id="botaovermelho" value="Sim" />
    <input type=button onClick="location.href='./material.php'" value="Cancelar">
  </p><?php }?>
</form>
</div>


  
    
  </diV>
  <?php include("_footer.php"); ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

