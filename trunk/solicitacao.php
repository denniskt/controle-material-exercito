<?php
require_once("classes/material.class.php");
//require_once("classes/solicitacao.class.php");

$permiteacesso=2; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)

if(isset($_POST["procurar_material"])){
	$material = new Material($_POST["codigo"],$_POST["material"],NULL,NULL,$_POST["tipo"],1);
	$lista = $material->procurar();
}

?>

<script language="javascript">
	function adiciona(cod){
		document.form1.cod_produto.value=cod;
		document.form1.comando.value='adicionar';
		document.form1.submit();
	}
</script>

<?php include("_header.php")?>



<header>
<title>SISCMEX - Solicitação/Nova Solicitação</title>

</header>
<div class="conteudo">

<body>
<h1>Solicitação/Nova Solicitação</h1>
<p>
  
  <button id="botao_carrinho" onClick="location.href='./solicitacao_carrinho.php'">Carrinho (<?php if(isset($_SESSION['qtde_itens'])){echo $_SESSION['qtde_itens']; } ?>) Itens</button>
  <button id="botao_procurar">Procurar Material</button>
<hr size="1">
</p>

<script>
$("#botao_procurar").click(function () {
$("h3").hide();
$("#form_carrinho").hide();
$("#form_procurar").toggle();

});
</script>
<p>

<div id="form_procurar" style="display: none">
</script>
<p>
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
<p>tipo de material:
<br>
<label for="tipo"></label>
<input name="tipo" type="text" id="tipo" maxlength="10" />
</p>
<p>
<input type="submit" name="procurar_material" id="procurar_material" value="Procurar" />
<input type="reset" value="Limpar Campos">
</p>
</form><hr size="1">
</div>



<?php 
if(isset($_POST["procurar_material"])){
	$lista = $material->procurar();
}else{
	$lista = Material::listar();
}
	
if(isset($lista)){
	if(mysql_num_rows($lista)){ 
?>

<form action="solicitacao_carrinho.php" method="post" name="frmcarrinho">
<input type="hidden" name="opc_efetivar" value="1">
<table id="tabela" class="tablesorter" width='100%'><thead>
	<tr><th >codigo</th><th >nome</th><th >descrição</th><th >unidade</th><th >tipo</th>
	  <th align="center" >quantidade</th></tr></thead> 
	<tbody><?php
	$indice = 0;
	while($linha = mysql_fetch_array($lista)){ 
	?>
	 <tr>
		<td><?php echo $linha['cd_material'] ?></td>
        <input type="hidden" name="txtprod[<?php echo $linha['cd_material'];?>][CODIGO]" value="<?php echo $linha['cd_material']; ?>">
		<td><?php echo $linha['nm_material'] ?></td>
        <input type="hidden" name="txtprod[<?php echo $linha['cd_material'];?>][MATERIAL]" value="<?php echo $linha['nm_material']; ?>">
		<td><?php echo substr($linha['nm_descricao'],0,60); if(strlen($linha['nm_descricao']) > 60){ echo "...";} ?></td>
        <input type="hidden" name="txtprod[<?php echo $linha['cd_material'];?>][DESCRICAO]" value="<?php echo $linha['nm_descricao'] ?>">
		<td><?php echo $linha['sg_unidade_med'] ?></td>
        <input type="hidden" name="txtprod[<?php echo $linha['cd_material'];?>][UNIDADE]" value="<?php echo $linha['sg_unidade_med']; ?>">
        <td><?php echo $linha['sg_tipo_material'] ?></td>
        <input type="hidden" name="txtprod[<?php echo $linha['cd_material'];?>][TIPO]" value="<?php echo $linha['sg_tipo_material']; ?>">
	    <td align="center">
		  <input type="text"  class="qtde" name="txtprod[<?php echo $linha['cd_material'];?>][QTDE]" value="<?php
		  $codigo = $linha['cd_material'];
		  if(isset($_SESSION['cesta'][$codigo]['QTDE'])){
		  	echo $_SESSION['cesta'][$codigo]['QTDE']; 
			}else{
				echo 0; }  ?>"
            size="3" align="right">
		  <input name="qtde" type="submit" class="qtde" id="qtde" value=" adicionar" onClick="java script: document.forms[0].submit();"></td>
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
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

