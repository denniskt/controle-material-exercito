<?php
require_once("classes/conexao.class.php");
require_once("classes/material.class.php");
//require_once("classes/solicitacao.class.php");

$permiteacesso=2; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)
error_reporting(0);
include("_header.php");

if(isset($_POST[opc_finalizar])) {
	$identidade = $_SESSION['identidade'];
	$sql = "INSERT INTO solicitacao VALUES(NULL,SYSDATE(),NULL,NULL,NULL,0,NULL, $identidade)";
	Conexao::executar($sql);
	
	$sql = "SELECT cd_solicitacao FROM solicitacao ORDER BY 1 DESC LIMIT 1";
	$codigo_solicitacao = mysql_fetch_assoc(Conexao::executar($sql));
}
?>
<header>
<title>SISCMEX - Solicitação/Material/Carrinho</title>

</header>
<div class="conteudo">

<body>
<h1>Solicitação/Material/Carrinho</h1>
<p>
  <input type="button" onClick="location.href='./solicitacao.php'" value="Voltar">
  <input type="button" onClick="location.href='./solicitacao_minhas.php'" value="Minhas Solicitações">
  <input type="button" onClick="location.href='./solicitacao.php'" value="Nova Solicitação">
<hr size="1">
</p>
<div id="concluido">
    <h1>PROTOCOLO DA SUA SOLICITAÇÃO: <?php echo $codigo_solicitacao['cd_solicitacao'];?></h1>
    <table id="tabela0" class="tablesorter0" width='100%'>
	<tr><th >item</th><th >codigo</th><th >tipo</th><th >material</th><th >descrição</th><th>quantidade</th><th >unidade</th></tr>
<?php
for($i=1; $i<300; $i++) {
$indice = $i;

if($_SESSION["cesta"][$indice]["QTDE"] <> 0){
	$codigo = $_SESSION["cesta"][$i]["CODIGO"];
	$qtde = $_SESSION["cesta"][$i]["QTDE"];
	$sql = "INSERT INTO item_solicitacao VALUES($codigo,$codigo_solicitacao[cd_solicitacao],$qtde,NULL,NULL)";
	$msg = Conexao::executar($sql);
?>
	 <tr>
        <td><?php echo ++$j; $_SESSION['qtde_itens']=$j; ?></td>
		<td><?php echo $_SESSION["cesta"][$indice]["CODIGO"]; ?></td>
		<td><?php echo $_SESSION["cesta"][$indice]["TIPO"]; ?></td>
		<td><?php echo $_SESSION["cesta"][$indice]["MATERIAL"]; ?></td>
        <td><?php echo substr($_SESSION["cesta"][$indice]["DESCRICAO"],0,60); if(strlen($_SESSION["cesta"][$indice]["DESCRICAO"]) > 60){ echo "...";} ?></td>
		<td><?php echo $_SESSION["cesta"][$indice]["QTDE"]; ?></td>
        <td><?php echo $_SESSION["cesta"][$indice]["UNIDADE"]; ?></td>
	</tr>
	<?php  } } unset($_SESSION["cesta"]);
	$_SESSION['qtde_itens']=0; ?>
</table>

<input type="button" value="Finalizar Pedido" onClick="enviar('F');"></p></form>
</diV>
<hr size="1">
<?php include("_footer.php"); ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

