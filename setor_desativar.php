<?php
require_once("classes/setor.class.php");

$permiteacesso=0; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)
		
if(isset($_GET)){
	$setor = Setor::editar($_GET["sigla"]);
}
if(isset($_POST["desativa_setor"])){
	$msg = Setor::desativar($_GET["sigla"]);
}
?>

<?php include("_header.php")?>
<header>
<title>SISCMEX - Cadastro/Setor/Desativar</title>

</header>
<div class="conteudo">

<body>
<h1>Cadastro/Setor/Desativar</h1>
<p>
  <input type=button onClick="location.href='./usuario.php'" value="< Voltar">
  <button id="botao_desativar">Desativar Cadastro Setor</button>
<hr size="1">
</p>
<h2>Desativar Cadastro Setor</h2>
<div id="form_desativar">

<form id="form_desativa_setor" name="form_deativar_setor" method="post" action="">
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
  <h3><?php if(isset($msg)){ echo $msg; 
  }else{?>
    Setores com contas desativadas não poderão realizar solicitações de material. <br>
    Confirma  a desativa&ccedil;&atilde;o do cadastro do setor?</h3>
  <p>
    <input type="submit" name="desativa_setor" id="botaovermelho" value="Sim" />
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

