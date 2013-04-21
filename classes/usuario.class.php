<?php 
require_once("classes/conexao.class.php");

	class Usuario {
	private $identidade;
	private $senha;
	private $nomecompleto;
	private $nomeguerra;
	private $setor;
	private $nivelacesso;
  
function __construct($identidade, $senha, $nomecompleto, $nomeguerra, $setor, $nivelacesso){
	$this->identidade = $identidade;
	$this->senha = $senha;
	$this->nomecompleto = $nomecompleto;
	$this->nomeguerra = $nomeguerra;
	$this->setor = $setor;
	$this->nivelacesso = $nivelacesso;
}

function __get($atributo){
	return $this->atributo;
}  
 
function __set($atributo, $valor){
	$this->atributo = $valor; 
}
 
function inserir(){
	 //$sql = "call inserirUsuario('$this->identidade', '$this->nomecompleto', '$this->nomeguerra', '$this->senha', '$this->nivelacesso', '$this->setor')";
	$sql = "SELECT * FROM usuario WHERE cd_identidade = $this->identidade";
	if(mysql_num_rows(Conexao::executar($sql))<1){ //verificar se já não existe a id no banco de dados
		$sql = "INSERT INTO usuario (cd_identidade, nm_usuario, nm_guerra, nm_senha, nm_acesso, cd_setor) ";
		$sql .= "VALUES ('$this->identidade', '$this->nomecompleto', '$this->nomeguerra', '$this->senha', '$this->nivelacesso', '$this->setor')"; 
		Conexao::executar($sql);
		return "Cadastro realizado com sucesso!";
	 }else{
		return "Identidade já cadastrada!!";
	 }
}

static function editar($id){
	$sql = "SELECT * FROM usuario WHERE cd_identidade = $id";
 	return mysql_fetch_object(Conexao::executar($sql));
}
 
function atualizar(){
	//$sql = "call atualizarUsuario('$this->identidade', '$this->nomecompleto', '$this->nomeguerra', '$this->senha', '$this->nivelacesso', '$this->setor')";
	$sql  = "UPDATE usuario SET ";
	$sql .= "cd_identidade = $this->identidade, ";
	$sql .= "nm_usuario = '$this->nomecompleto', ";
	$sql .= "nm_guerra = '$this->nomeguerra', ";
	$sql .= "nm_senha = '$this->senha', ";
	$sql .= "nm_acesso = $this->nivelacesso, ";
	$sql .= "cd_setor = $this->setor ";
	$sql .= "WHERE cd_identidade = $this->identidade";
	Conexao::executar($sql);
	return "Cadastro atualizado com sucesso!";
}
 
function excluir(){
	$sql = "call atualizarUsuario('$this->identidade')";
	return Conexao::executar($sql);
}
 
static function listar(){
	$sql = "SELECT * FROM usuario u, setor s WHERE u.cd_setor = s.cd_setor ORDER BY nm_usuario";
	return Conexao::executar($sql);
}
  
function procurar(){
	$sql = "SELECT * FROM usuario u, setor s WHERE u.cd_setor = s.cd_setor AND";
	if($this->identidade<>NULL){
		$sql .= " u.cd_identidade = '$this->identidade' AND";
	}
	if($this->nomecompleto<>NULL){
		$sql .= " u.nm_usuario LIKE '%$this->nomecompleto%' AND";
	}
	if($this->nomeguerra<>NULL){
		$sql .= " u.nm_guerra LIKE '%$this->nomeguerra%' AND";
	}
	if($this->setor<>-1){
		$sql .= " u.cd_setor = $this->setor AND";
	} 
	if($this->nivelacesso<>NULL){
		$sql .= " u.nm_acesso = $this->nivelacesso AND";
	/* }
	if($_POST['ativo']=="Sim"){
		$sql .= " u.ch_ativo_usuario = '{$_POST['ativo']}'";
	}else if($_POST['ativo']=="Nao"){
		$sql .= " u.ch_ativo_usuario = '{$_POST['ativo']}'"; */
	}
			
	if(substr($sql, -3) == "AND"){
		$sql = substr($sql, 0, - 3);
	}	
	$sql .= " ORDER BY nm_usuario";
 	return Conexao::executar($sql);
}

}
?>