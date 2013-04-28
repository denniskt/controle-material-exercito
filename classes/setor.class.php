<?php 
require_once("classes/conexao.class.php");

	class Usuario {
	private $identidade;
	private $senha;
	private $nomecompleto;
	private $nomeguerra;
	private $setor;
	private $nivelacesso;
	private $ativo;
  
function __construct($identidade, $senha, $nomecompleto, $nomeguerra, $setor, $nivelacesso, $ativo){
	$this->identidade = $identidade;
	$this->senha = $senha;
	$this->nomecompleto = $nomecompleto;
	$this->nomeguerra = $nomeguerra;
	$this->setor = $setor;
	$this->nivelacesso = $nivelacesso;
	$this->ativo = $ativo;
}

function __get($atributo){
	return $this->atributo;
}  
 
function __set($atributo, $valor){
	$this->atributo = $valor; 
}


function validar(){
	$sql = "SELECT * FROM usuario WHERE cd_identidade = $this->identidade AND nm_senha = $this->senha";
	$aux = Conexao::executar($sql);
	if(mysql_num_rows($aux)==1){
		$usuario = mysql_fetch_object($aux);
		if($usuario->cd_ativo==1){
			$_SESSION['identidade']=$usuario->cd_identidade;
			$_SESSION['nome'] =$usuario->nm_usuario;
			$_SESSION['guerra'] =$usuario->nm_guerra;
			$_SESSION['nivel']=$usuario->cd_acesso;
			return true;
		}else{
			$_SESSION['mensagem']="Usu�rio inativo";
			return false;
		}
	}else{
		$_SESSION['mensagem']="Usu�rio ou senha inv�lidos!<br>caso n�o lembre sua senha favor entrar em contato com o respons�vel do Almoxarifado.";
		return false;
	}
}

function inserir(){
	$sql = "SELECT * FROM usuario WHERE cd_identidade = $this->identidade";
	if(mysql_num_rows(Conexao::executar($sql))>0){
		return "Identidade Militar j� cadastrada!!";
	}else{
		$sql = "INSERT INTO usuario (cd_identidade, nm_usuario, nm_guerra, sg_setor, nm_senha, cd_acesso) ";
		$sql .= "VALUES ('$this->identidade', '$this->nomecompleto', '$this->nomeguerra', '$this->setor', '$this->senha', '$this->nivelacesso')";
		$resultado = Conexao::executar($sql);
		if($resultado==1){
			return "Cadastro realizado com sucesso!";
		}else{
			return $resultado;
		}
	}
}

static function editar($id){
	$sql = "SELECT * FROM usuario u, setor s, nivel_acesso n WHERE n.cd_acesso = u.cd_acesso AND cd_identidade = $id AND u.sg_setor = s.sg_setor";
	return mysql_fetch_object(Conexao::executar($sql));
}
 
function atualizar(){
	$sql  = "UPDATE usuario SET ";
	$sql .= "cd_identidade = $this->identidade, ";
	$sql .= "nm_usuario = '$this->nomecompleto', ";
	$sql .= "nm_guerra = '$this->nomeguerra', ";
	$sql .= "nm_senha = '$this->senha', ";
	$sql .= "cd_acesso = $this->nivelacesso, ";
	$sql .= "sg_setor = '$this->setor', ";
	$sql .= "cd_ativo = $this->ativo ";
	$sql .= "WHERE cd_identidade = $this->identidade";
	$resultado = Conexao::executar($sql);
	if($resultado==1){
		return "Cadastro atualizado com sucesso!";
	}else{
		return $resultado;
	}
}
 
/* static function excluir($id){
	try{
		$sql = "DELETE FROM usuario WHERE cd_identidade = $id";
		Conexao::executar($sql);
 		return "Cadastro de Usu�rio exluido com sucesso!";
	}catch(Exception $ex){
		return "Erro ao excluir o cadastro";
	}
} */

static function desativar($id){
	$sql  = "UPDATE usuario SET cd_ativo = 0 WHERE cd_identidade = $id";
	$resultado = Conexao::executar($sql);
	if($resultado==1){
		return "Cadastro desativado com sucesso!";
	}else{
		return $resultado;
	}
}
 
static function listar(){
	$sql = "SELECT * FROM usuario u, setor s, nivel_acesso n WHERE u.sg_setor = s.sg_setor AND u.cd_acesso = n.cd_acesso ORDER BY nm_usuario";
	return Conexao::executar($sql);
}
  
function procurar(){
	$sql = "SELECT * FROM usuario u, setor s, nivel_acesso n WHERE u.sg_setor = s.sg_setor AND u.cd_acesso = n.cd_acesso AND";
	if($this->identidade<>NULL){
		$sql .= " u.cd_identidade = '$this->identidade' AND";
	}
	if($this->nomecompleto<>NULL){
		$sql .= " u.nm_usuario LIKE '%$this->nomecompleto%' AND";
	}
	 if($this->nomeguerra<>NULL){
		$sql .= " u.nm_guerra LIKE '%$this->nomeguerra%' AND";
	}
	if($this->setor<>NULL){
		$sql .= " u.cd_setor = $this->setor AND";
	} 
	if($this->nivelacesso<>NULL){
		$sql .= " u.cd_acesso = $this->nivelacesso AND";
	}
	$sql .= " u.cd_ativo = $this->ativo"; 
	$sql .= " ORDER BY nm_usuario";

	return Conexao::executar($sql);
	}

}
?>