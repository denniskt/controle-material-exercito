<?php 
require_once("classes/conexao.class.php");

	class Fornecedor {
	private $cnpj;
	private $razao;
	private $endereco;
	private $telefone;
	private $email;
	private $ramo;
	private $ativo;
  
function __construct($cnpj, $razao, $endereco, $telefone, $email, $ramo, $ativo){
	$this->cnpj = $cnpj;
	$this->razao = $razao;
	$this->endereco = $endereco;
	$this->telefone = $telefone;
	$this->email = $email;
	$this->ramo = $ramo;
	$this->ativo = $ativo;
}

function __get($atributo){
	return $this->atributo;
}  
 
function __set($atributo, $valor){
	$this->atributo = $valor; 
}

function inserir(){
	$sql = "SELECT * FROM fornecedor WHERE cd_cnpj = '$this->cnpj'";
	if(mysql_num_rows(Conexao::executar($sql))>0){
		return "CNPJ já cadastrado!!";
	}else{
		$sql = "INSERT INTO fornecedor (cd_cnpj, nm_razao_soc, nm_endereco, nm_telefone, nm_email, nm_ramo_ativ, cd_ativo_fornecedor) ";
		$sql .= "VALUES ('$this->cnpj', '$this->razao','$this->endereco','$this->telefone','$this->email','$this->ramo', '$this->ativo')";
		if(Conexao::executar($sql)=="1"){
			return "Cadastro realizado com sucesso!";
		}else{
			return "Erro ao cadastrar fornecedor!";
		}
	}
}

static function editar($cnpj){
	$sql = "SELECT * FROM fornecedor WHERE cd_cnpj='$cnpj'";
	return mysql_fetch_object(Conexao::executar($sql));
}
 
function atualizar(){
	$sql  = "UPDATE fornecedor SET ";
	$sql .= "nm_razao_soc = '$this->razao', ";
	$sql .= "nm_endereco = '$this->endereco', ";
	$sql .= "nm_telefone = '$this->telefone', ";
	$sql .= "nm_email = '$this->email', ";
	$sql .= "nm_ramo_ativ = '$this->ramo', ";
	$sql .= "cd_ativo_fornecedor = $this->ativo ";
	$sql .= "WHERE cd_cnpj = '$this->cnpj'";
	if(Conexao::executar($sql)=="1"){
		return "Cadastro atualizado com sucesso!";
	}else{
		return "Erro ao atualizar fornecedor!";
	}
}
 


static function desativar($cnpj){
	$sql  = "UPDATE fornecedor SET cd_ativo_fornecedor = 0 WHERE cd_cnpj = '$cnpj'";
	if(Conexao::executar($sql)=="1"){
		return "Cadastro desativado com sucesso!";
	}else{
		return "Erro ao desativar fornecedor!";
	}
}
 
static function listar(){
	$sql = "SELECT * FROM fornecedor ORDER BY nm_razao_soc";
	return Conexao::executar($sql);
}
  
function procurar(){
	$sql = "SELECT * FROM fornecedor WHERE ";
	if($this->cnpj<>NULL){
		$sql .= " cd_cnpj LIKE '%$this->cnpj%' AND";
	}
	if($this->razao<>NULL){
		$sql .= " nm_razao_soc LIKE '%$this->razao%' AND";
	}
	if($this->endereco<>NULL){
		$sql .= " nm_endereco LIKE '%$this->endereco%' AND";
	}
	if($this->telefone<>NULL){
		$sql .= " nm_telefone LIKE '%$this->telefone%' AND";
	}
	if($this->email<>NULL){
		$sql .= " nm_email LIKE '%$this->email%' AND";
	}
	if($this->ramo<>NULL){
		$sql .= " nm_ramo_ativ LIKE '%$this->ramo%' AND";
	}
	
	$sql .= " cd_ativo_fornecedor = $this->ativo"; 
	$sql .= " ORDER BY nm_razao_soc";
	return Conexao::executar($sql);
	}

}
?>