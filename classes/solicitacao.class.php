<?
	require_once("classes/conexao.class.php");

	class Fornecedor {
		
	function ultima_solicitacao(){
	$sql = "SELECT cd_solicitacao FROM solicitacao ORDER BY 1 DESC LIMIT 1";
	return Conexao::executar($sql);
	}
	
	function limpar_carrinho(){
	unset($_SESSION["cesta"]);
	}
}
?>