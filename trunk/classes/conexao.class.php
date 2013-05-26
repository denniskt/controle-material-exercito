<?php 
class Conexao{

	private static $servidor = "mysql1.000webhost.com";
	private static $usuario = "a5640723_cmex";
	private static $senha = "cmex123";
	private static $banco = "a5640723_siscmex";

	
	static function executar($sql){
		try{
			$id_conexao = mysql_connect(self::$servidor, self::$usuario, self::$senha);
				if(!$id_conexao) {
					throw new Exception("Falha ao conectar ao SGBD.<br>Problema: [". mysql_error() ."]");
			}
		
			if(!mysql_select_db(self::$banco,$id_conexao)){
				throw new Exception("Falha ao selecionar o banco.<br>Problema: [". mysql_error() ."]");
			}
		
			$resultado = mysql_query($sql);
			if(! $resultado){
				throw new Exception("Falha ao enviar instruçao SQL ao banco.<br>Problema: [". mysql_error() ."]");
			}
		
			return $resultado;
		
		}catch (Exception $ex){
			return $ex;
		}
	}	
	static function desconectar(){
		mysql_close($id_conexao);	
	}
}
?>