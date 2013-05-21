<?php
//<?php $item->excluir($linha['cd_material'],$linha['cd_material']);
require_once("classes/material.class.php");
require_once("classes/itens_entrada.class.php");

$permiteacesso=1; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)

if(isset($_GET["id"])){
	$lista = ItemEntrada::listar($_GET["id"]);
}

if(isset($_GET["action"])){
	if($_GET["action"]=='excluir')
	ItemEntrada::excluir($_GET["entrada"], $_GET["material"]);
	if($_GET["action"]=='gravar'){
		$item = ItemEntrada($_GET["material"], $_GET["entrada"], 0, $_SESSION["qtde"]);
		$item->alterarQtde();		
	}
}

if(isset($_POST["cadastrar_item"])){
	$item = new ItemEntrada($_POST["material"],$_POST["descricao"],$_POST["unidade"],$_POST["tipo"],1);
	$msg = $item->inserir();	
}

if(isset($_POST["procurar_material"])){
	$material = new Material($_POST["codigo"],$_POST["material"],$_POST["descricao"],$_POST["unidade"],$_POST["tipo"], 1);
	$listaM = $material->procurar();
}
?>

<?php include("_header.php")?>
<header>
<title>SISCMEX - Cadastro/Item</title>

</header>
<div class="conteudo">

<body>
<h1>Cadastro/Item</h1>
<p>
  <input type=button onClick="location.href='./entrada.php'" value="Voltar">
  <button id="botao_procurar">Procurar Material</button>
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
</p>

<div id="form_procurar" style="display: none">

<?php if(isset($msg)){ echo "<h3>$msg</h3>"; }?>

<script type="text/javascript">
$(document).ready(function(){
$("#form_procurar_material").validate({
	rules: {
    	codigo: {
			number: true,
			}
		},
	messages: {
    	codigo: {
			number: " Digite somente números",
			}
		}
});
});
</script>
<h2>Procurar Material</h2>
<form id="form_procurar_material" name="form_procurar_material" method="post" action="">
<p>codigo (digite somente números)*:<br>
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
<input name="descricao" size="100" type="text" id="descricao" maxlength="100" />
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
<p>
<input type="submit" name="procurar_material" id="procurar_material" value="Procurar" />
<input type="reset" value="Limpar Campos">
</p>

<?php 
if(isset($_POST["procurar_material"])){
	$listaM = $material->procurar();;
}
	
if(isset($listaM)){
	if(mysql_num_rows($listaM)){ 
?>
<table id="tabela" class="tablesorter" width='50%'><thead>
	<tr><th >codigo</th><th >nome</th><th >descrição</th><th >unidade</th><th align="center" >op&ccedil;&otilde;es</th></tr></thead> 
	<tbody><?php
	while($linha = mysql_fetch_array($listaM)){ ?>
	 <tr>
		<td><?php echo $linha['cd_material'] ?></td>
		<td><?php echo $linha['nm_material'] ?></td>
		<td><?php echo $linha['nm_descricao']?></td>
		<td><?php echo $linha['sg_unidade_med'] ?></td>       
		<td align="center"><img border=0 src="imagens/icone_editar.png"><a href="adicionar($linha['cd_material'])">adicionar</a></td>
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
  
</form><hr size="1">
</div>
<?php
if(isset($lista)){
	if(mysql_num_rows($lista)){ 
?>
<table id="tabelaItens" class="tablesorter" width='100%'><thead>
	<tr><th>codigo</th><th>material</th><th >unidade</th><th >quantidade</th><th align="center" >op&ccedil;&otilde;es</th></tr></thead> 
	<tbody><?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_material'] ?></td>
		<td><?php echo $linha['nm_material'] ?></td>
		<td><?php echo $linha['sg_unidade_med'] ?></td>
		<td><input name="qtde" type="text" id="qtde" value="<?php echo $linha['qt_recebido'] ?>" maxlength="5" /></td>
		<td align="center">
		<a href='itens_entrada.php?action=gravar&entrada=<?php echo $linha['cd_entrada'] ?>&material=<?php echo $linha['cd_material']?>'><img border=0 src="imagens/icone_editar.png" /> gravar </a>
		<a href='itens_entrada.php?action=excluir&entrada=<?php echo $linha['cd_entrada'] ?>&material=<?php echo $linha['cd_material']?>'><img border=0 src="imagens/icone_editar.png" /> excluir </a></td>
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
  
</form><hr size="1">
</div>
  <?php include("_footer.php"); ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

