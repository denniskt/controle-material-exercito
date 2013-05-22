<?php 
require_once("classes/conexao.class.php");

	class Solicitacao {
	private $codigo;
	private $dt_solicitacao;
	private $dt_aprovacao;
	private $dt_retirada;
	private $status;
	private $solicitante;
  
function __construct($codigo, $dt_solicitacao, $dt_aprovacao, $dt_retirada, $status, $solicitante){
	$this->codigo = $codigo;
	$this->dt_solicitacao = $dt_solicitacao;
	$this->dt_aprovacao =$dt_aprovacao;
	$this->dt_retirada =$dt_retirada;
	$this->status =$status;
	$this->solicitante =$solicitante;
}

function __get($atributo){
	return $this->atributo;
}  
 
function __set($atributo, $valor){
	$this->atributo = $valor; 
}


static function listar(){
	$sql = "SELECT * FROM solicitacao WHERE cd_ativo_setor=1 ORDER BY nm_setor";
	return Conexao::executar($sql);
}
  
function procurar(){
	$sql = "SELECT * FROM solicitacao s, usuario u, setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade";
	if($this->codigo<>NULL){
		$sql .= " cd_solicitacao = $this->codigo AND";
	}
	if($this->solicitante<>NULL){
		$sql .= " nm_usuario LIKE '%$this->solicitante%' AND";
	}
	if($this->setor<>NULL){
	$sql .= " nm_setor = $this->setor AND"; 
	}
	if(substr($sql, -3) == "AND"){
		$sql = substr($sql, 0, - 3);
	}else if(substr($sql, -5) == "WHERE"){
		$sql = substr($sql, 0, - 5);
	}
	$sql .= " ORDER BY nm_setor";
	return Conexao::executar($sql);
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
	}
?>