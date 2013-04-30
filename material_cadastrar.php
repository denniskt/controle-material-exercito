<?php
require_once("classes/material.class.php");

if(isset($_POST["cadastrar_material"])){
	$material = new Material($_POST["codigo"],$_POST["material"],$_POST["descricao"],$_POST["unidade"],$_POST["tipo"],1);
	$msg = $material->inserir();	
}

$permiteacesso=1;

?>
<?php include("_header.php")?>
<header>
<title>SISCMEX - Cadastrar Novo Material</title>
<script type="text/javascript">

$(document).ready(function(){
$("#form_cadastrar_material").validate({
	rules: {
    	codigo: {
			required: true,
			number: true,
			},
		material: {
			required: true,
			minlength: 5
			},
		descricao: {
			required: true,
			minlength: 5
			},
		unidade: {
			required: true,
			},
		tipo: {
			required: true,
			}
        },
	messages: {
    	codigo: {
			required: " Campo obrigatório",
			number: " Digite somente números"
			},
		material: {
			required: " Campo obrigatório",
			minlength: " Minimo de 5 caracteres"
			},
		descricao: {
			required: " Campo obrigatório",
			minlength: " Minimo de 5 caracteres"
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
</header>
<div class="conteudo">

<body>
<h1>Cadastrar Novo Material
</h1>
<form id="form_cadastrar_material" name="form_cadastrar_material" method="post" action="">
<?php if(isset($msg)){ echo "<h3>$msg</h3>"; }?>
<p>codigo (digite somente súmeros)*:<br>
<label for="codigo"></label>
<input name="codigo" type="text" id="codigo" maxlength="11" />
</p>
<p>nome material*:<br>
<label for="material"></label>
<input name="material" type="text" id="material" maxlength="30" />
<label></label>
</p>
<p>descrição*:<br>
<label for="descricao"></label>
<input name="descricao" type="text" id="descricao" maxlength="100" />
</p>
<p>unidade de medida*:<br>
<label for="unidade"></label>
<input name="unidade" type="text" id="unidade" maxlength="5" />
</p>
<p>tipo de material:
<br>
<label for="tipo"></label>
<input name="tipo" type="text" id="tipo" maxlength="10" />
</p>
<p>&nbsp;</p> <p>
<input type="submit" name="cadastrar_material" id="cadastrar_material" value="Cadastrar" />
</p>
</form>
<p>&nbsp;</p>

</diV>
<?php include("_footer.php")?>