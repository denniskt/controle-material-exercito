<?php
require_once("classes/entrada.class.php");
require_once("funcoes/mascara.php");

$permiteacesso=1; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)

if(isset($_POST["cadastrar_entrada"])){
	$entrada = new Entrada($_POST["codigo"],$_POST["codigoNota"],$_POST["dataEmissao"],$_POST["cnpj"]);
	$msg = $entrada->inserir();
}

if(isset($_POST["procurar_entrada"])){
	$entrada = new Entrada($_POST["codigo"],$_POST["codigoNota"],$_POST["dataEmissao"],$_POST["cnpj"]);
	//$lista = $entrada->procurar($_POST["dataIni"]);
}
?>

<?php include("_header.php")?>
<header>
<title>SISCMEX - Cadastro/Entrada de Material</title>

</header>
<div class="conteudo">

<body>
<h1>Cadastro/Entrada de Material</h1>
<p>
  <button id="botao_cadastrar">Cadastrar Nova Entrada</button>
  <button id="botao_procurar">Procurar</button>
<hr size="1">
</p>

<script>
$("#botao_cadastrar").click(function () {
$("h3").hide();
$("#form_procurar").hide();
$("#form_cadastrar").toggle();
});
</script>
<script>
$("#botao_procurar").click(function () {
$("h3").hide();
$("#form_cadastrar").hide();
$("#form_procurar").toggle();

});
</script>
<p>
<?php if(isset($msg)){ echo "<h3>$msg</h3>"; }?>
<div id="form_cadastrar" style="display: none">

<h2>Cadastrar Nova Entrada</h2>
<form id="form_cadastrar_entrada" name="form_cadastrar_entrada" method="post" action="">
<p>Número da NF*:<br>
<label for="codigoNota"></label>
<input name="codigoNota" type="text" id="codigoNota" maxlength="8" />
<label></label>
</p>
<p>Data de emissão*:<br>
<label for="dataEmissao"></label>
<input name="dataEmissao" type="date" id="dataEmissao" maxlength="30" />
</p>
<p>Fornecedor*:
<br>
<select name="cnpj" id="cnpj">;
	<option></option>;
	<?php 
	$sql = "SELECT cd_cnpj, nm_razao_soc FROM fornecedor ORDER BY 1";
	$resultado = Conexao::executar($sql);
	while($dados = mysql_fetch_array($resultado)){
		echo "<option value='".$dados['cd_cnpj']."'>". $dados['nm_razao_soc']."</option>";
	}
	?>
</select>
</p>
<p>
<input type="submit" class="confirmar" name="cadastrar_entrada" id="cadastrar_entrada" value="Cadastrar" />
<input type="reset" value="Limpar Campos" />
</p>
</form><hr size="1">
</div>



<div id="form_procurar" style="display: none">

<h2>Procurar Entrada de Material</h2>
<form id="form_procurar_entrada" name="form_procurar_entrada" method="post" action="">
<p>Código:<br>
<label for="codigo"></label>
<input name="codigo" type="text" id="codigo" maxlength="11" />
</p>
<p>Número da NF:<br>
<label for="codigoNota"></label>
<input name="codigoNota" type="text" id="codigoNota" maxlength="8" />
<label></label>
</p>
<p>Data de emissão inicial:<br>
<label for="dataIni"></label>
<input name="dataIni" type="date" id="dataEmissao" maxlength="10" />
</p>
<p>Data de emissão inicial:<br>
<label for="dataEmissao"></label>
<input name="dataEmissao" type="date" id="dataEmissao" maxlength="10" />
</p>
<p>Fornecedor:
<br>
<select name="cnpj" id="cnpj">;
	<option></option>;
	<?php 
	$sql = "SELECT cd_cnpj, nm_razao_soc FROM fornecedor ORDER BY 1";
	$resultado = Conexao::executar($sql);
	while($dados = mysql_fetch_array($resultado)){
		echo "<option value='".$dados['cd_cnpj']."'>". $dados['nm_razao_soc']."</option>";
	}
	?>
</select>
</p>
<p>
<input type="submit" name="procurar_entrada" id="procurar_entrada" value="Procurar" />
<input type="reset" value="Limpar Campos">
</p>
</form><hr size="1">
</div>



<?php 
if(isset($_POST["procurar_entrada"])){
	$lista = $entrada->procurar($_POST["dataIni"]);
}else{
	$lista = Entrada::listar();
}
	
if(isset($lista)){ 
	if(mysql_num_rows($lista)){
?>
<table id="tabela" class="tablesorter" width='100%'><thead>
	<tr><th >código</th><th >nota fiscal</th><th >data de emissão</th><th >cnpj fonecedor</th><th >razão social</th><th align="center" >op&ccedil;&otilde;es</th></tr></thead> 
	<tbody><?php
	while($linha = mysql_fetch_array($lista)){ ?> 
	 <tr>
		<td><?php echo $linha['cd_entrada'] ?></td>
		<td><?php echo $linha['cd_nota_fiscal'] ?></td>
		<td><?php echo $linha['dt_emissao_nf'] ?></td>
		<td><?php echo mask($linha['cd_cnpj'], '##.###.###/####-##') ?></td>
		<td><?php echo $linha['nm_razao_soc']?></td>
		<td align="center"><a href='entrada_editar.php?id=<?php echo $linha['cd_entrada']?>'><img border=0 src="imagens/icone_editar.png"> editar</a>
		<a href='itens_entrada.php?id=<?php echo $linha['cd_entrada']?>'><img border=0 src="imagens/icone_editar.png"> itens</a> </td>
	</tr>
	<?php } ?>
</tbody></table>
<div id="pager" class="pager" >
 <form>
  <img border=0 src="./imagens/navtabela1.png" class="first">
  <img border=0 src="./imagens/navtabela2.png" class="prev">
  <input type="text" class="pagedisplay" id="pad0" size="8" readonly>
  <img border=0 src="./imagens/navtabela3.png" class="next">
  <img border=0 src="./imagens/navtabela4.png" class="last">
  <select id="pad0" class="pagesize">
   <option selected="selected" value="10">10</option>
   <option value="20">20</option>
   <option value="30">30</option>
   <option value="50">50</option>
  </select>
 </form>
</div>

<p>
   <?php }else{echo "<h3>Nenhum resultado encontrado!</h3>"; } }?>
</p>
  
    
</diV>
<?php include("_footer.php"); ?>
