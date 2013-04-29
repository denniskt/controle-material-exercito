<?php 
require_once("classes/conexao.class.php");

	class Setor {
	private $sigla;
	private $nome;
	private $ativo;
  
function __construct($sigla, $nome, $ativo){
	$this->sigla = $sigla;
	$this->nome = $nome;
	$this->ativo = $ativo;
}

function __get($atributo){
	return $this->atributo;
}  
 
function __set($atributo, $valor){
	$this->atributo = $valor; 
}

function inserir(){
	$sql = "SELECT * FROM setor WHERE sg_setor = '$this->sigla'";
	if(mysql_num_rows(Conexao::executar($sql))>0){
		return "Sigla já cadastrada!!";
	}else{
		$sql = "INSERT INTO setor (sg_setor, nm_setor, cd_ativo_setor) ";
		$sql .= "VALUES ('$this->sigla', '$this->nome', '$this->ativo')";
		if(Conexao::executar($sql)=="1"){
			return "Cadastro realizado com sucesso!";
		}else{
			return "Erro ao cadastrar setor!";
		}
	}
}

static function editar($sigla){
	$sql = "SELECT * FROM setor WHERE sg_setor='$sigla'";
	return mysql_fetch_object(Conexao::executar($sql));
}
 
function atualizar(){
	$sql  = "UPDATE setor SET ";
	$sql .= "nm_setor = '$this->nome', ";
	$sql .= "cd_ativo_setor = $this->ativo ";
	$sql .= "WHERE sg_setor = '$this->sigla'";
	if(Conexao::executar($sql)=="1"){
		return "Cadastro atualizado com sucesso!";
	}else{
		return "Erro ao atualizar setor!";
	}
}
 


static function desativar($sigla){
	$sql  = "UPDATE setor SET cd_ativo_setor = 0 WHERE sg_setor = '$sigla'";
	if(Conexao::executar($sql)=="1"){
		return "Cadastro desativado com sucesso!";
	}else{
		return "Erro ao desativar setor!";
	}
}
 
static function listar(){
	$sql = "SELECT * FROM setor ORDER BY nm_setor";
	return Conexao::executar($sql);
}
  
function procurar(){
	$sql = "SELECT * FROM setor WHERE ";
	if($this->sigla<>NULL){
		$sql .= " sg_setor LIKE '%$this->sigla%' AND";
	}
	if($this->nome<>NULL){
		$sql .= " nm_setor LIKE '%$this->nome%' AND";
	}
	$sql .= " cd_ativo_setor = $this->ativo"; 
	$sql .= " ORDER BY nm_setor";
	return Conexao::executar($sql);
	}

}
?>