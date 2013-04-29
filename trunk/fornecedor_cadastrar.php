<?php
require_once("classes/fornecedor.class.php");

if(isset($_POST["cadastrar_fornecedor"])){
	if(!isset($_POST["email"])){$email=NULL;}else{$email=$_POST["email"];}
	if(!isset($_POST["ramo"])){$ramo=NULL;}else{$ramo=$_POST["ramo"];}
	$fornecedor = new Fornecedor($_POST["cnpj"],$_POST["razao"],$_POST["endereco"],$_POST["telefone"],$email,$ramo,1);
	$msg = $fornecedor->inserir();	
}

$permiteacesso=1;

?>
<?php include("_header.php")?>
<header>
<title>SISCMEX - Cadastrar Novo Fornecedor</title>
<script type="text/javascript">

$(document).ready(function(){
$("#form_cadastrar_fornecedor").validate({
	rules: {
    	cnpj: {
			required: true,
			number: true,
			minlength: 14
			},
		razao: {
			required: true,
			minlength: 5
			},
		endereco: {
			required: true,
			minlength: 5
			},
		telefone: {
			required: true,
			minlength: 8,
			},
		email: {
			required: false,
			email: true
			}
        },
	messages: {
    	cnpj: {
			required: " Campo obrigatório",
			number: " Digite somente números",
			minlength: " CPF invalido"
			},
		razao: {
			required: " Campo obrigatório",
			minlength: " Minimo de 5 caracteres"
			},
		endereco: {
			required: " Campo obrigatório",
			minlength: " Minimo de 5 caracteres"
			},
		telefone: {
			required: " Campo obrigatório",
			minlength: " Mínimo 8 digitos"
			},
		email: {
			email:  " Insira um email válido"
			}
		}
	});
});
</script>
</header>
<div class="conteudo">

<body>
<h1>Cadastrar Novo Fornecedor
</h1>
<form id="form_cadastrar_fornecedor" name="form_cadastrar_fornecedor" method="post" action="">
<?php if(isset($msg)){ echo "<h3>$msg</h3>"; }?>
<p>cnpj (digite somente súmeros)*:<br>
<label for="cnpj"></label>
<input name="cnpj" type="text" id="cnpj" maxlength="20" />
</p>
<p>razão social*:<br>
<label for="razao"></label>
<input name="razao" type="text" id="razao" maxlength="30" />
<label></label>
</p>
<p>endereço completo*:<br>
<label for="endereco"></label>
<input name="endereco" type="text" id="endereco" maxlength="50" />
</p>
<p>telefone*:<br>
<label for="telefone"></label>
<input name="telefone" type="text" id="telefone" maxlength="20" />
</p>
<p>email:
<br>
<label for="email"></label>
<input name="email" type="text" id="email" maxlength="100" />
</p>
<p>ramo de atividade:
<br>
<label for="ramo"></label>
<input name="ramo" type="text" id="ramo" maxlength="30" />
</p>
<p>&nbsp;</p> <p>
<input type="submit" name="cadastrar_fornecedor" id="cadastrar_fornecedor" value="Cadastrar" />
</p>
</form>
<p>&nbsp;</p>

</diV>
<?php include("_footer.php")?>