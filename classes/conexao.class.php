<?php 
class Conexao{

	private static $servidor = "localhost";
	private static $usuario = "root";
	private static $senha = "";
	private static $banco = "siscmex";

	
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
				throw new Exception("Falha ao enviar instrução SQL ao banco.<br>Problema: [". mysql_error() ."]");
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