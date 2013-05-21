<?php
require_once("classes/entrada.class.php");
require_once("funcoes/mascara.php");

$permiteacesso=1; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)

if(isset($_GET)){
	$entrada = Entrada::editar($_GET["id"]);
}
if(isset($_POST["editar_entrada"])){	
	$entrada = new Entrada($_POST["codigo"], $_POST["codigoNota"],$_POST["dataEmissao"],$_POST["cnpj"]);
	$msg = $entrada->atualizar();
	$entrada = Entrada::editar($_GET["id"]);		
	}
?>

<?php include("_header.php")?>
<header>
<title>SISCMEX - Cadastro/Entrada de Material/Editar</title>

</header>
<div class="conteudo">

<body>
<h1>Cadastro/Entrada de Material/Editar</h1>
<p>
  <input type=button onClick="location.href='./entrada.php'" value="Voltar">
  <hr size="1">
</p>
 
<p>
<?php if(isset($msg)){ echo "<h3>$msg</h3>"; }?>


<div id="form_editar">
<script type="text/javascript">
$(document).ready(function(){
$("#form_editar_usuario").validate({
	rules: {
	messages: {
    	identidade: {
			number: " Digite somente números",
			}
		}
	}
});
});
</script>	
<h2>Editar Cadastro Entrada de Material</h2>
<form id="form_editar_entrada" name="form_editar_entrada" method="post" action="">
 <p>Código:<br>
<label for="codigo"></label>
<input name="codigo" type="text" id="codigo" maxlength="11" value="<?php echo $entrada->cd_entrada; ?>"  />
</p>
<p>Número da NF:<br>
<label for="codigoNota"></label>
<input name="codigoNota" type="text" id="codigoNota" maxlength="8" readonly value="<?php echo $entrada->cd_nota_fiscal; ?>" />
<label></label>
</p>
<p>Data de emissão:<br>
<label for="dataEmissao"></label>
<input name="dataEmissao" type="date" id="dataEmissao" maxlength="10" value="<?php echo $entrada->dt_emissao_nf;?> "/>
</p>
<p>Fornecedor:
<br>
<select name="cnpj" id="cnpj">
	<?php 
	$aux = $entrada->cd_cnpj;
	$sql = "SELECT cd_cnpj, nm_razao_soc FROM fornecedor ORDER BY 1";
	$resultado = Conexao::executar($sql);
	while($dados = mysql_fetch_array($resultado)){
		echo "<option value='".$dados['cd_cnpj']."'";
		if($aux==$dados['cd_cnpj']){
				echo " selected='selected' ";
		}
		echo ">". $dados['nm_razao_soc']."</option>";
	}
	?>
</select>
</p>
  <p>
    <input type="submit" name="editar_entrada" id="editar_entrada" value="Editar" />
    <input type=button onClick="location.href='./entrada.php'" value="Cancelar">
  </p>
</form>
</div>


  
    
  </diV>
  <?php include("_footer.php"); ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

