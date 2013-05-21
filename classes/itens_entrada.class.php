<?php 
require_once("classes/conexao.class.php");

	class ItemEntrada{
	private $codigoMaterial;
	private $codigoEntrada;
	private $data;
	private $quantidade;
	
function __construct($codigoMaterial, $codigoEntrada, $data, $quantidade){
	$this->codigoMaterial = $codigoMaterial;
	$this->codigoEntrada = $codigoEntrada;
	$this->data = $data;
	$this->quantidade = $quantidade;
}

function __get($atributo){
	return $this->atributo;
}  
 
function __set($atributo, $valor){
	$this->atributo = $valor; 
}

function inserir(){
	$sql = "INSERT INTO item_entrada VALUES ($this->codigoMaterial, $this->codigoEntrada, '$this->data', $this->quantidade)";
	if(Conexao::executar($sql)=="1"){
		return "Cadastro realizado com sucesso!";
	}else{
		return "Erro ao cadastrar item da entrada!";
	}
}

static function editar($codigoEntrada){
	$sql = "select i.cd_material, m.nm_material, i.cd_entrada, Date_Format(i.dt_recebido, '%d/%m/%Y') as dt_recebido, i.qt_recebido from item_entrada i join material m where i.cd_entrada=$codigoEntrada";
	return mysql_fetch_object(Conexao::executar($sql));
}
 
function atualizar(){
	$sql  = "UPDATE item_material SET ";
	$sql .= "cd_material = $this->codigoMaterial, ";
	$sql .= "cd_entrada = $this->codigoEntrada, ";
	$sql .= "dt_recebido = '$this->data', ";
	$sql .= "qt_recebido = $this->quantidade ";
	
	if(Conexao::executar($sql)=="1"){
		return "Cadastro atualizado com sucesso!";
	}else{
		return "Erro ao atualizar material!";
	}
}
 
function alterarQtde($qtde){ 
		$sql = "UPDATE item_entrada set qt_recebido=$this->quantidade WHERE cd_entrada=$this->codigoEntrada and cd_material=$this->codigoMaterial";
		return Conexao::executar($sql);
}

static function excluir($codigoEntrada, $codigoMaterial){
	$sql  = "DELETE FROM item_entrada WHERE cd_material=$codigoMaterial and cd_entrada=$codigoEntrada";
	return Conexao::executar($sql);
}
 
static function listar($id){
	$sql = "select i.cd_material, m.nm_material,  m.sg_unidade_med, i.cd_entrada, Date_Format(i.dt_recebido, '%d/%m/%Y') as dt_recebido, i.qt_recebido from item_entrada i join material m where i.cd_entrada=$id order by 3";
	return Conexao::executar($sql);
}
}
?>