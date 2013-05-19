<?php
require_once("classes/conexao.class.php");
require_once("classes/material.class.php");
require_once("classes/solicitacao.class.php");

$permiteacesso=2; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)
error_reporting(0);
include("_header.php");

if(isset($_POST[opc_finalizar])) {
	$identidade = $_SESSION['identidade'];
	$sql = "INSERT INTO solicitacao VALUES(NULL,SYSDATE(),0,NULL, $identidade)";
	Conexao::executar($sql);
	
	$sql = "SELECT cd_solicitacao FROM solicitacao ORDER BY 1 DESC LIMIT 1";
	$codigo_solicitacao = mysql_fetch_assoc(Conexao::executar($sql));
	
	for($i=0; $i<300; $i++) {
		
		if($_SESSION["cesta"][$i]["QTDE"] <> 0){
			$codigo = $_SESSION["cesta"][$i]["CODIGO"];
			$qtde = $_SESSION["cesta"][$i]["QTDE"];
			$sql = "INSERT INTO item_solicitacao VALUES($codigo,$codigo_solicitacao[cd_solicitacao],$qtde,NULL,NULL)";
			$msg = Conexao::executar($sql);
		}
	}
	unset($_SESSION["cesta"]);
	$_SESSION['qtde_itens']=0;
}else{
	$msg = "oi";
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
  <button id="botao_procurar">Minhas Solicitações</button>
  <button id="botao_procurar">Nova Solicitação</button>
<hr size="1">
</p>
<div id="concluido">
    <h1>PROTOCOLO DA SUA SOLICITAÇÃO: <?php echo $codigo_solicitacao['cd_solicitacao'];?></h1>
</diV>
<?php include("_footer.php"); ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

