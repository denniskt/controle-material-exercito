<?php
require_once("classes/setor.class.php");

if(isset($_POST["cadastrar_setor"])){
	$setor = new Setor($_POST["sigla"],$_POST["nome"],1);
	$msg = $setor->inserir();
}

$permiteacesso=1;

include("_header.php")?>
<header>
<title>SISCMEX - Cadastrar Novo Setor</title>
<script type="text/javascript">
$(document).ready(function(){
$("#form_cadastrar_setor").validate({
	rules: {
    	sigla: {
			required: true,
			minlength: 5
			},
		nome: {
			required: true,
			minlength: 5
			}
        },
	messages: {
    	sigla: {
			required: " Campo obrigatório",
			minlength: " Mínimo de 5 caracteres"
			},
		nome: {
			required: " Campo obrigatório",
			minlength: " Mínimo de 5 caracteres"
			}
		}
	});
});
</script>
</header>
<div class="conteudo">

<body>
<h1>Cadastrar Novo Setor
</h1>
<form id="form_cadastrar_setor" name="form_cadastrar_setor" method="post" action="">
<?php if(isset($msg)){ echo "<h3>$msg</h3>"; }?>
<p>sigla do setor*:<br>
<label for="sigla"></label>
<input name="sigla" type="text" id="sigla" maxlength="5" />
</p>
<p>nome do setor*:<br>
<label for="nome"></label>
<input name="nome" type="text" id="nome" maxlength="30" />
<label></label>
</p>

<p>&nbsp;</p> <p>
<input type="submit" name="cadastrar_setor" id="cadastrar_setor" value="Cadastrar" />
</p>
</form>
<p>&nbsp;</p>

</diV>
<?php include("_footer.php")?>