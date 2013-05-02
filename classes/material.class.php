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
	$sql = "INSERT INTO material (nm_material, nm_descricao, sg_unidade_med, sg_tipo_material, cd_ativo_material) ";
	$sql .= "VALUES ('$this->material','$this->descricao','$this->unidade','$this->tipo', '$this->ativo')";
	if(Conexao::executar($sql)=="1"){
		return "Cadastro realizado com sucesso!";
	}else{
		return "Erro ao cadastrar material!";
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
 


static function desativar($codigo){
	$sql  = "UPDATE material SET cd_ativo_material = 0 WHERE cd_material = '$codigo'";
	if(Conexao::executar($sql)=="1"){
		return "Cadastro desativado com sucesso!";
	}else{
		return "Erro ao desativar material!";
	}
}
 
static function listar(){
	$sql = "SELECT * FROM material WHERE cd_ativo_material=1 ORDER BY nm_material";
	return Conexao::executar($sql);
}
  
function procurar(){
	$sql = "SELECT * FROM material WHERE";
	if($this->codigo<>NULL){
		$sql .= " cd_material = $this->codigo AND";
	}
	if($this->material<>NULL){
		$sql .= " nm_material LIKE '%$this->material%' AND";
	}
	if($this->descricao<>NULL){
		$sql .= " nm_descricao LIKE '%$this->descricao%' AND";
	}
	if($this->unidade<>NULL){
		$sql .= " sg_unidade_med LIKE '%$this->unidade%' AND";
	}
	if($this->tipo<>NULL){
		$sql .= " sg_tipo_material LIKE '%$this->tipo%' AND";
	}
	if($this->ativo<>2){
	$sql .= " cd_ativo_material = $this->ativo"; 
	}
	if(substr($sql, -3) == "AND"){
		$sql = substr($sql, 0, - 3);
	}else if(substr($sql, -5) == "WHERE"){
		$sql = substr($sql, 0, - 5);
	}
	$sql .= " ORDER BY nm_material";
	return Conexao::executar($sql);
	}

}
?>