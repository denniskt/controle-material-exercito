<?php 
require_once("classes/conexao.class.php");

	class Material {
	private $codigo;
	private $material;
	private $descricao;
	private $unidade;
	private $tipo;
	private $ativo;
  
function __construct($codigo, $material, $descricao, $unidade, $tipo, $ativo){
	$this->codigo = $codigo;
	$this->material = $material;
	$this->descricao = $descricao;
	$this->unidade = $unidade;
	$this->tipo = $tipo;
	$this->ativo = $ativo;
}

function __get($atributo){
	return $this->atributo;
}  
 
function __set($atributo, $valor){
	$this->atributo = $valor; 
}

function inserir(){
	$sql = "SELECT * FROM material WHERE cd_material = '$this->codigo'";
	if(mysql_num_rows(Conexao::executar($sql))>0){
		return "Código já cadastrado!!";
	}else{
		$sql = "INSERT INTO material (cd_material, nm_material, nm_descricao, sg_unidade_med, sg_tipo_material, cd_ativo_material) ";
		$sql .= "VALUES ('$this->codigo', '$this->material','$this->descricao','$this->unidade','$this->tipo', '$this->ativo')";
		if(Conexao::executar($sql)=="1"){
			return "Cadastro realizado com sucesso!";
		}else{
			return "Erro ao cadastrar material!";
		}
	}
}

static function editar($codigo){
	$sql = "SELECT * FROM material WHERE cd_material='$codigo'";
	return mysql_fetch_object(Conexao::executar($sql));
}
 
function atualizar(){
	$sql  = "UPDATE material SET ";
	$sql .= "nm_material = '$this->material', ";
	$sql .= "nm_descricao = '$this->descricao', ";
	$sql .= "sg_unidade_med = '$this->unidade', ";
	$sql .= "sg_tipo_material = '$this->tipo', ";
	$sql .= "cd_ativo_material = $this->ativo ";
	$sql .= "WHERE cd_material = '$this->codigo'";
	if(Conexao::executar($sql)=="1"){
		return "Cadastro atualizado com sucesso!";
	}else{
		return "Erro ao atualizar material!";
	}
}
 


static function desativar($cnpj){
	$sql  = "UPDATE material SET cd_ativo_material = 0 WHERE cd_odigo = '$codigo'";
	if(Conexao::executar($sql)=="1"){
		return "Cadastro desativado com sucesso!";
	}else{
		return "Erro ao desativar material!";
	}
}
 
static function listar(){
	$sql = "SELECT * FROM material ORDER BY nm_material";
	return Conexao::executar($sql);
}
  
function procurar(){
	$sql = "SELECT * FROM material WHERE ";
	if($this->cnpj<>NULL){
		$sql .= " cd_material = $this->codigo AND";
	}
	if($this->razao<>NULL){
		$sql .= " nm_material LIKE '%$this->material%' AND";
	}
	if($this->endereco<>NULL){
		$sql .= " nm_descricao LIKE '%$this->descricao%' AND";
	}
	if($this->telefone<>NULL){
		$sql .= " sg_unidade_med LIKE '%$this->unidade%' AND";
	}
	if($this->email<>NULL){
		$sql .= " sg_tipo_material LIKE '%$this->tipo%' AND";
	}
	
	$sql .= " cd_ativo_material = $this->ativo"; 
	$sql .= " ORDER BY nm_material";
	return Conexao::executar($sql);
	}

}
?>