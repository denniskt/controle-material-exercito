<?php
require_once("classes/material.class.php");

$permiteacesso=1; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)

if(isset($_GET)){
	$material = material::editar($_GET["codigo"]);
}
if(isset($_POST["editar_material"])){	
	$material = new Material($_POST["codigo"],$_POST["material"],$_POST["descricao"],$_POST["unidade"],$_POST["tipo"],$_POST["ativo"]);
	$msg = $material->atualizar();
	Material::editar($_POST["codigo"]);
	$material = Material::editar($_GET["codigo"]);
}
?>

<?php include("_header.php")?>
<header>
<title>SISCMEX - Cadastro/Material/Editar</title>

</header>
<div class="conteudo">

<body>
<h1>Cadastro/Material/Editar</h1>
<p>
  <input type=button onClick="location.href='./material.php'" value="< Voltar">
  <button id="botao_editar">Editar Cadastro Material</button>
<hr size="1">
</p>

<p>
<?php if(isset($msg)){ echo "<h3>$msg</h3>"; }?>


<div id="form_editar">
<script type="text/javascript">
$(document).ready(function(){
$("#form_editar_material").validate({
	rules: {
    	material: {
			required: true,
			},
		descricao: {
			required: true,
			},
		unidade: {
			required: true,
			},
		tipo: {
			required: true,
			}
		},
	messages: {
    	material: {
			required: " Campo obrigatório",
			},
		descricao: {
			required: " Campo obrigatório",
			},
		unidade: {
			required: " Campo obrigatório",
			},
		tipo: {
			required: " Campo obrigatório",
			}
		}
	});
});
</script>	
<h2>Editar Cadastro Material</h2>
<form id="form_editar_material" name="form_editar_material" method="post" action="">
  <p>codigo:<br>
  <label for="codigo"></label>
  <input name="codigo" type="text" id="codigo" value="<?php echo $material->cd_material; ?>" maxlength="11" readonly />
  </p>
  <p>nome do material*:<br>
    <label for="material"></label>
    <input name="material" type="text" id="material" value="<?php echo $material->nm_material; ?>" maxlength="30" />
    <label></label>
  </p>
  <p>descrição do material*:<br>
    <label for="descricao"></label>
    <input name="descricao" type="text" id="descricao"  size="100" value="<?php  echo $material->nm_descricao; ?>" maxlength="100" />
  </p>
  <p>unidade de medida*:
  <br>
    <input name="unidade" type="text" id="unidade" value="<?php echo $material->sg_unidade_med; ?>" maxlength="5" />
  </p>
  <p>tipo de material*:<br>
    <input name="tipo" type="text" id="tipo" value="<?php echo $material->sg_tipo_material; ?>" maxlength="10" />
  </p>
  <p>ativo: 
  	<input type="hidden" name="ativo" value="0" />
    <input name="ativo" type="checkbox" id="ativo" value="1" <?php  if($material->cd_ativo_material==1){ echo "checked"; } ?>/>
    <label for="ativo"></label>
  </p>
  <p>
    <input type="submit" name="editar_material" id="editar_material" value="Editar" />
    <input type=button onClick="location.href='./material.php'" value="Cancelar">
  </p>
</form>
</div>


</diV>
<?php include("_footer.php"); ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

