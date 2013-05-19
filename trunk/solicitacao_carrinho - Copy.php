<?php
require_once("classes/material.class.php");
require_once("classes/solicitacao.class.php");

$permiteacesso=2; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)

error_reporting(0);

include("_header.php");

if(isset($_GET["remover"])) {
	$id = $_GET["remover"];
	$_SESSION["cesta"][$id]["QTDE"] = 0;
}

if(isset($_POST["opc_efetivar"])) {
	$cesta = $_SESSION["cesta"];
	$v_prod = $_POST["txtprod"];
	$chave = array_keys($v_prod);

	for($i=0; $i<300; $i++) {
	$indice = $chave[$i];

		if(isset($v_prod[$indice]["QTDE"]) ) {
			$cesta[$indice]["CODIGO"] = $v_prod[$indice]["CODIGO"];
			$cesta[$indice]["MATERIAL"] = $v_prod[$indice]["MATERIAL"];
			$cesta[$indice]["DESCRICAO"] = $v_prod[$indice]["DESCRICAO"];
			$cesta[$indice]["UNIDADE"] = $v_prod[$indice]["UNIDADE"];
			$cesta[$indice]["TIPO"] = $v_prod[$indice]["TIPO"];
			$cesta[$indice]["QTDE"] = $v_prod[$indice]["QTDE"];
		}
	}
$_SESSION["cesta"] = $cesta;
}
?>

<script language="JavaScript">
function enviar(opcao) {
	if(opcao == 'F') {
		document.forms[0].opc_finalizar.value = 1;
		document.forms[0].action = "solicitacao_finalizar.php";
		document.forms[0].submit();
	}
}
</script>



<header>
<title>SISCMEX - Solicitação/Material/Carrinho</title>

</header>
<div class="conteudo">

<body>
<h1>Solicitação/Carrinho</h1>
<hr size="1">

<script>
$("#botao_lista").click(function () {
$("h3").hide();
$("#form_procurar").hide();
$("#form_lista").toggle();
});
</script>
<script>
$("#botao_procurar").click(function () {
$("h3").hide();
$("#form_lista").hide();
$("#form_procurar").toggle();

});
</script>
<p>
<div id="carrinho">

<form name="frmCarrinho" method="post" action="solicitacao_finalizar.php">
<input type="hidden" name="opc_finalizar">
<table id="table" class="tablesorter" width='100%'><thead>
	<tr><th >item</th><th >codigo</th><th >tipo</th><th >material</th><th >descrição</th><th>quantidade</th><th >unidade</th><th >opções</th></tr> </thead>
<?php
for($i=1; $i<300; $i++) {
$indice = $i;

if($_SESSION["cesta"][$indice]["QTDE"] <> 0){
?>
	 <tr>
        <td><?php echo ++$j; $_SESSION['qtde_itens']=$j; ?></td>
		<td><?php echo $_SESSION["cesta"][$indice]["CODIGO"]; ?></td>
		<td><?php echo $_SESSION["cesta"][$indice]["TIPO"]; ?></td>
		<td><?php echo $_SESSION["cesta"][$indice]["MATERIAL"]; ?></td>
        <td><?php echo substr($_SESSION["cesta"][$indice]["DESCRICAO"],0,40); if(strlen($_SESSION["cesta"][$indice]["DESCRICAO"]) > 40){ echo "...";} ?></td>
        
		<td><input type="text" class="qtde" name="a_prod[<?php echo $indice; ?>]" value="<?php echo $_SESSION["cesta"][$indice]["QTDE"]; ?>" size="3"></td>
        <td><?php echo $_SESSION["cesta"][$indice]["UNIDADE"]; ?></td>
        <td><a href="solicitacao_carrinho.php?remover=<?php echo $_SESSION["cesta"][$indice]["CODIGO"]; ?>"><img border=0 src="imagens/inativo.png" > remover</a></td>
	</tr>
	<?php  } } ?>
</table>
		<p align="right"><input type="button" value="Esvaziar Carrinho" onClick="enviar('F');">
       <input type="button" value="Finalizar Pedido" onClick="enviar('F');"></p></form>
    
</diV>
<?php include("_footer.php"); ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

