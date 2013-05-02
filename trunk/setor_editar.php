<?php
require_once("classes/setor.class.php");
	
$permiteacesso=0;

if(isset($_GET)){
	$setor = Setor::editar($_GET["sigla"]);
}
if(isset($_POST["editar_setor"])){
	$setor = new Setor($_POST["sigla"],$_POST["nome"],$_POST["ativo"]);
	$msg = $setor->atualizar();
	Setor::editar($_POST["sigla"]);
	$setor = Setor::editar($_GET["sigla"]);
}

include("_header.php")
?>
<header>
<title>SISCMEX - Cadastro/Setor/Editar</title>

</header>
<div class="conteudo">

<body>
<h1>Cadastro/Setor/Editar</h1>
<p>
 <input type=button onClick="location.href='./setor.php'" value="< Voltar">
 <button id="botao_editar">Editar Cadastro Setor</button>
<hr size="1">
</p>

<p>
<?php if(isset($msg)){ echo "<h3>$msg</h3>"; }?>


<div id="form_editar">
<script type="text/javascript">
$(document).ready(function(){
$("#form_editar_setor").validate({
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
<h2>Editar Cadastro Setor</h2>
<form id="form_editar_setor" name="form_editar_setor" method="post" action="">
  <p>sigla do setor*:<br>
  <label for="sigla"></label>
  <input name="sigla" type="text" id="sigla" value="<?php echo $setor->sg_setor; ?>" maxlength="5" readonly />
  </p>
  <p>nome do setor*:<br>
    <label for="nome"></label>
    <input name="nome" type="text" id="nome" value="<?php  echo $setor->nm_setor; ?>" maxlength="30" />
  </p>
  <p>ativo: 
  	<input type="hidden" name="ativo" value="0" />
    <input name="ativo" type="checkbox" id="ativo" value="1" <?php  if($setor->cd_ativo_setor==1){ echo "checked"; } ?>/>
    <label for="ativo"></label>
  </p>
  <p>
    <input type="submit" name="editar_setor" id="editar_setor" value="Editar" />
    <input type=button onClick="location.href='./setor.php'" value="Cancelar">
  </p>
</form>
</div>


  
    
  </diV>
  <?php include("_footer.php"); ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

