<?php
	require_once("classes/fornecedor.class.php");
		
	if(isset($_GET)){
		$fornecedor = Fornecedor::editar($_GET["cnpj"]);
	}
	
	if(isset($_POST["editar_fornecedor"])){
		if(!isset($_POST["email"])){$email=NULL;}else{$email=$_POST["email"];}
		if(!isset($_POST["ramo"])){$ramo=NULL;}else{$ramo=$_POST["ramo"];}
	$fornecedor = new Fornecedor($_POST["cnpj"],$_POST["razao"],$_POST["endereco"],$_POST["telefone"],$email,$ramo,$_POST["ativo"]);
	$msg = $fornecedor->atualizar();
	
	Fornecedor::editar($_POST["cnpj"]);
	$fornecedor = Fornecedor::editar($_GET["cnpj"]);
	}
	$permiteacesso=0;

include("_header.php"); 
?>
<head>
<title>SISCMEX - Alterar Cadastro Fornecedor</title>
<script type="text/javascript">

$(document).ready(function(){
$("#form_cadastrar_fornecedor").validate({
	rules: {
    	cnpj: {
			required: true
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
			required: " Campo obrigatório"
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
<h1>Alterar Fornecedor
</h1>
<form id="form_editar" name="form_editar" method="post" action="">
  <?php if(isset($msg)){ echo "<h3>$msg</h3>"; }?>
  <p>cnpj*:<br>
<label for="cnpj"></label>
<input name="cnpj" type="text" id="cnpj" value="<?php echo $fornecedor->cd_cnpj; ?>" maxlength="20" readonly />
</p>
<p>razão social*:<br>
<label for="razao"></label>
<input name="razao" type="text" id="razao" value="<?php echo $fornecedor->nm_razao_soc; ?>" maxlength="30" />
<label></label>
</p>
<p>endereço completo*:<br>
<label for="endereco"></label>
<input name="endereco" type="text" id="endereco" value="<?php echo $fornecedor->nm_endereco; ?>" maxlength="50" />
</p>
<p>telefone*:<br>
<label for="telefone"></label>
<input name="telefone" type="text" id="telefone" value="<?php echo $fornecedor->nm_telefone; ?>" maxlength="20" />
</p>
<p>email:
<br>
<label for="email"></label>
<input name="email" type="text" id="email" value="<?php echo $fornecedor->nm_email; ?>" maxlength="100" />
</p>
<p>ramo de atividade:
<br>
<label for="ramo"></label>
<input name="ramo" type="text" id="ramo" value="<?php echo $fornecedor->nm_ramo_ativ; ?>" maxlength="30" />
</p>

  <p>Ativo:<br>
  	<input type="hidden" name="ativo" value="0" />
    <input name="ativo" type="checkbox" id="ativo" value="1" <?php  if($fornecedor->cd_ativo_fornecedor==1){ echo "checked"; } ?>/>
    <label for="ativo"></label>
  </p>
  <p>&nbsp;</p>
  <p>
    <input type="submit" name="editar_fornecedor" id="editar_fornecedor" value="Editar" />
  </p>
</form>
</diV>
<?php include("_footer.php"); ?>