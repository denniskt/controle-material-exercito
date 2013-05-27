<?php 
require_once("classes/conexao.class.php");

	class Solicitacao {
	private $codigo;
	private $dt_solicitacao;
	private $dt_aprovacao;
	private $dt_retirada;
	private $status;
	private $solicitante;
	private $setor;
  
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

// FUNCOES DA HOME

static function lista_qt_pendentes(){
	$sql = "SELECT s.cd_solicitacao AS num FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 0 ORDER BY s.dt_solicitacao";
	return Conexao::executar($sql);
}

static function lista_pendentes(){
	$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao , u.nm_usuario , st.nm_setor FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 0 ORDER BY s.dt_solicitacao DESC LIMIT 5";
	return Conexao::executar($sql);
}

static function lista_todas($tipo){
	if($tipo==0){
		$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao , u.nm_usuario , st.nm_setor FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 0 ORDER BY s.dt_solicitacao DESC";
	}elseif($tipo==1){
		$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao , DATE_FORMAT(s.dt_aprovado, '%d/%m/%Y - %Hh%i') AS dt_aprovado , u.nm_usuario , st.nm_setor FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 1 ORDER BY s.dt_aprovado DESC";
	}elseif($tipo==2){
		$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao , DATE_FORMAT(s.dt_aprovado, '%d/%m/%Y - %Hh%i') AS dt_aprovado, DATE_FORMAT(s.dt_retirada, '%d/%m/%Y - %Hh%i') AS dt_retirada, u.nm_usuario , st.nm_setor FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 2 ORDER BY s.dt_retirada";
	}elseif($tipo==3){
		$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao , DATE_FORMAT(s.dt_cancelado, '%d/%m/%Y - %Hh%i') AS dt_cancelado, s.ds_cancelamento, u.nm_usuario , st.nm_setor FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 3 ORDER BY s.dt_cancelado DESC";
	}elseif($tipo==4){
		$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao, DATE_FORMAT(s.dt_aprovado, '%d/%m/%Y - %Hh%i') AS dt_aprovado,  DATE_FORMAT(s.dt_retirada, '%d/%m/%Y - %Hh%i') AS dt_retirada, DATE_FORMAT(s.dt_cancelado, '%d/%m/%Y - %Hh%i') AS dt_cancelado, s.ic_aprovacao, u.nm_usuario, st.nm_setor  FROM solicitacao s, usuario u, setor st WHERE u.cd_identidade = s.cd_identidade AND u.sg_setor = st.sg_setor";
	}
	return Conexao::executar($sql);
}

static function lista_todas_minhas($tipo,$identidade){
	if($tipo==0){
		$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao , u.nm_usuario , st.nm_setor FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 0  AND s.cd_identidade = $identidade ORDER BY s.dt_solicitacao DESC";
	}elseif($tipo==1){
		$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao , DATE_FORMAT(s.dt_aprovado, '%d/%m/%Y - %Hh%i') AS dt_aprovado , u.nm_usuario , st.nm_setor FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 1  AND s.cd_identidade = $identidade ORDER BY s.dt_aprovado DESC";
	}elseif($tipo==2){
		$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao , DATE_FORMAT(s.dt_aprovado, '%d/%m/%Y - %Hh%i') AS dt_aprovado, DATE_FORMAT(s.dt_retirada, '%d/%m/%Y - %Hh%i') AS dt_retirada, u.nm_usuario , st.nm_setor FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 2  AND s.cd_identidade = $identidade ORDER BY s.dt_retirada";
	}elseif($tipo==3){
		$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao , DATE_FORMAT(s.dt_cancelado, '%d/%m/%Y - %Hh%i') AS dt_cancelado, s.ds_cancelamento, u.nm_usuario , st.nm_setor FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 3  AND s.cd_identidade = $identidade ORDER BY s.dt_cancelado DESC";
	}elseif($tipo==4){
		$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao, DATE_FORMAT(s.dt_aprovado, '%d/%m/%Y - %Hh%i') AS dt_aprovado,  DATE_FORMAT(s.dt_retirada, '%d/%m/%Y - %Hh%i') AS dt_retirada, DATE_FORMAT(s.dt_cancelado, '%d/%m/%Y - %Hh%i') AS dt_cancelado, s.ic_aprovacao, u.nm_usuario, st.nm_setor  FROM solicitacao s, usuario u, setor st WHERE u.cd_identidade = s.cd_identidade AND u.sg_setor = st.sg_setor AND s.cd_identidade = $identidade";
	}
	return Conexao::executar($sql);
}


static function lista_qt_aprovadas(){
	$sql = "SELECT s.cd_solicitacao AS num FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 1 ORDER BY s.dt_solicitacao";
	return Conexao::executar($sql);
}

static function lista_aprovadas(){
	$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao , DATE_FORMAT(s.dt_aprovado, '%d/%m/%Y - %Hh%i') AS dt_aprovado , u.nm_usuario , st.nm_setor FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 1 ORDER BY s.dt_aprovado DESC LIMIT 5";
	return Conexao::executar($sql);
}

static function lista_retiradas(){
	$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao , DATE_FORMAT(s.dt_aprovado, '%d/%m/%Y - %Hh%i') AS dt_aprovado, DATE_FORMAT(s.dt_retirada, '%d/%m/%Y - %Hh%i') AS dt_retirada, u.nm_usuario , st.nm_setor FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 2 ORDER BY s.dt_retirada DESC LIMIT 5";
	return Conexao::executar($sql);
}

static function lista_canceladas(){
	$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao , DATE_FORMAT(s.dt_cancelado, '%d/%m/%Y - %Hh%i') AS dt_cancelado, s.ds_cancelamento, u.nm_usuario , st.nm_setor FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 3 ORDER BY s.dt_cancelado DESC LIMIT 5";
	return Conexao::executar($sql);
}

static function lista_minhas_qt_pendentes(){
	$identidade = $_SESSION['identidade'];
	$sql = "SELECT * FROM solicitacao WHERE cd_identidade = $identidade AND ic_aprovacao = 0";
	return Conexao::executar($sql);
}

static function lista_minhas_qt_aprovadas(){
	$identidade = $_SESSION['identidade'];
	$sql = "SELECT * FROM solicitacao WHERE cd_identidade = $identidade AND ic_aprovacao = 1";
	return Conexao::executar($sql);
}

static function lista_minhas_pendentes(){
	$identidade = $_SESSION['identidade'];
	$sql = "SELECT cd_solicitacao, DATE_FORMAT(dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao FROM solicitacao WHERE cd_identidade = $identidade AND ic_aprovacao = 0 ORDER BY dt_solicitacao DESC LIMIT 10";
	return Conexao::executar($sql);
}

static function lista_minhas_aprovadas(){
	$identidade = $_SESSION['identidade'];
	$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao , DATE_FORMAT(s.dt_aprovado, '%d/%m/%Y - %Hh%i') AS dt_aprovado , u.nm_usuario , st.nm_setor FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 1 AND s.cd_identidade = $identidade ORDER BY s.dt_aprovado DESC LIMIT 10";
	return Conexao::executar($sql);
}

static function lista_todas_minhas_solicitacoes(){
	$identidade = $_SESSION['identidade'];
	$sql = "SELECT cd_solicitacao, DATE_FORMAT(dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao, DATE_FORMAT(dt_aprovado, '%d/%m/%Y - %Hh%i') AS dt_aprovado, DATE_FORMAT(dt_retirada, '%d/%m/%Y - %Hh%i') AS dt_retirada, DATE_FORMAT(dt_cancelado, '%d/%m/%Y - %Hh%i') AS dt_cancelado, ic_aprovacao FROM solicitacao WHERE cd_identidade = $identidade ORDER BY dt_solicitacao DESC LIMIT 10";
	return Conexao::executar($sql);
}

// FIM DA HOME

static function visualizar($codigo){
	$identidade = $_SESSION['identidade'];
	$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao, DATE_FORMAT(s.dt_aprovado, '%d/%m/%Y - %Hh%i') AS dt_aprovado,  DATE_FORMAT(s.dt_retirada, '%d/%m/%Y - %Hh%i') AS dt_retirada, DATE_FORMAT(s.dt_cancelado, '%d/%m/%Y - %Hh%i') AS dt_cancelado, s.ic_aprovacao, s.ds_cancelamento, u.nm_usuario, st.nm_setor  FROM solicitacao s, usuario u, setor st WHERE cd_solicitacao = $codigo AND u.cd_identidade = s.cd_identidade AND u.sg_setor = st.sg_setor";
	return Conexao::executar($sql);
}

static function visualizar_lista_material($codigo){
	$sql = "SELECT i.cd_solicitacao , m.cd_material , m.sg_tipo_material , m.nm_material , m.nm_descricao , i.qt_solicitado, e.qt_material, m.sg_unidade_med FROM item_solicitacao i, material m, estoque e  WHERE i.cd_material = m.cd_material AND i.cd_solicitacao = $codigo AND m.cd_material = e.cd_material";
	return Conexao::executar($sql);
}

static function aprovar($codigo){
	$sql = "UPDATE solicitacao SET ic_aprovacao = 1, dt_aprovado = SYSDATE() WHERE cd_solicitacao = $codigo";
	return Conexao::executar($sql);
}

static function liberar($codigo){
	$sql = "UPDATE solicitacao SET ic_aprovacao = 2, dt_retirada = SYSDATE() WHERE cd_solicitacao = $codigo";
	return Conexao::executar($sql);
}

static function cancelar($codigo,$mensagem){
	$sql = "UPDATE solicitacao SET ic_aprovacao = 3, dt_cancelado = SYSDATE(), ds_cancelamento = '$mensagem' WHERE cd_solicitacao = $codigo";
	return Conexao::executar($sql);
}
  
static function procurar($codigo,$solicitante,$setor,$status,$identidade){
	$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao, DATE_FORMAT(s.dt_aprovado, '%d/%m/%Y - %Hh%i') AS dt_aprovado,  DATE_FORMAT(s.dt_retirada, '%d/%m/%Y - %Hh%i') AS dt_retirada, DATE_FORMAT(s.dt_cancelado, '%d/%m/%Y - %Hh%i') AS dt_cancelado, s.ic_aprovacao, s.ds_cancelamento, u.nm_usuario, st.nm_setor FROM solicitacao s, usuario u, setor st WHERE";
	if($codigo<>NULL){
		$sql .= " s.cd_solicitacao = $codigo AND";
	}
	if($solicitante<>NULL){
		$sql .= " u.nm_usuario LIKE '%$solicitante%' AND";
	}
	if($setor<>NULL){
		$sql .= " st.nm_setor LIKE '%$setor%' AND";
	}
	if($identidade<>NULL){
		$sql .= " s.cd_identidade = $identidade AND";
	}
	if($status<>4){
		$sql .= " s.ic_aprovacao = $status AND";
	}
	$sql .= " u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade ORDER BY s.cd_solicitacao";
	return Conexao::executar($sql);
	}
	
}
?>