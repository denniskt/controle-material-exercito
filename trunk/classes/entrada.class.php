<?php
require_once("classes/conexao.class.php");

	class Entrada {
		private $codigo;
		private $codigoNota;
		private $dataEmissao;
		private $cnpj;
	  
	function __construct($codigo, $codigoNota, $dataEmissao, $cnpj){
		$this->codigo = $codigo;
		$this->codigoNota = $codigoNota;
		$this->dataEmissao = $dataEmissao;
		$this->cnpj = $cnpj;
	}

	function __get($atributo){
		return $this->atributo;
	}  
 
	function __set($atributo, $valor){
		$this->atributo = $valor; 
	}
	
	static function editar($id){
		$sql = "SELECT e.cd_entrada, e.cd_nota_fiscal, e.dt_emissao_nf, e.cd_cnpj, f.nm_razao_soc FROM entrada e JOIN fornecedor f USING (cd_cnpj)";
	return mysql_fetch_object(Conexao::executar($sql));			
	}

	function inserir(){
		$sql = "INSERT INTO entrada (cd_nota_fiscal, dt_emissao_nf, cd_cnpj) ";
		$sql .= "VALUES ('$this->codigoNota', '$this->dataEmissao', '$this->cnpj')";
			if(Conexao::executar($sql)=="1"){
				return "Cadastro realizado com sucesso!";
			}else{return "Erro ao cadastrar Entrada de Material!";}
	}

static function listar(){
	$sql = "SELECT e.cd_entrada, e.cd_nota_fiscal, e.dt_emissao_nf, e.cd_cnpj, f.nm_razao_soc FROM entrada e JOIN fornecedor f USING (cd_cnpj)";
	return Conexao::executar($sql);
}

function procurar(){
	$sql = "SELECT e.cd_entrada, e.cd_nota_fiscal, e.dt_emissao_nf, e.cd_cnpj, f.nm_razao_soc FROM entrada e JOIN fornecedor f USING (cd_cnpj)";
	if($this->codigo<>NULL){
		$sql .= " e.cd_entrada = $this->codigo ";
	}
	if($this->codigoNota<>NULL){
		$sql .= "  e.cd_nota_fiscal = $this->codigoNota ";
	}		
	if($this->cnpj<>NULL){
		$sql .= " e.cd_cnpj = $this->cnpj ";
	}
	 
	 if($this->dataEmissao<>NULL){
		$sql .= " dt_emissao_nf ='$this->dataEmissao' ";
	}	
	
	$sql .= " ORDER BY e.dt_emissao_nf desc";
	return Conexao::executar($sql);
	}

function atualizar(){
	$sql  = "UPDATE entrada SET ";
	$sql .= "cd_nota_fiscal = $this->codigoNota, ";
	$sql .= "dt_emissao_nf = '$this->dataEmissao', ";
	$sql .= "cd_cnpj = $this->cnpj ";
	$sql .= "WHERE cd_entrada = $this->codigo";
	if(Conexao::executar($sql)=="1"){
		return "Cadastro atualizado com sucesso!";
	}else{return "Erro ao atualizar Entrada!";}
	}

}
?>