<?php
	require_once("classes/usuario.class.php");
		
	if(isset($_GET)){
		$usuario = Usuario::editar($_GET["id"]);
	}
	if(isset($_POST["editar_usuario"])){
		
	$usuario = new Usuario($_POST["identidade"],$_POST["senha"],$_POST["nome"],$_POST["nomeguerra"],$_POST["setor"],$_POST["nivel"]);
	$msg = $usuario->atualizar();
	Usuario::editar($_POST["identidade"]);
	$usuario = Usuario::editar($_GET["id"]);
}
?>
<?php include("_header.php"); ?>
<head>
<title>SISCMEX - Alterar Cadastro Usuário</title>
</header>
<div class="conteudo">

<body>
<h1>Alterar Usu&aacute;rio
</h1>
<form id="form1" name="form1" method="post" action="">
  <div class="mensagem"><?php if(isset($msg)){ echo $msg; }?></div>
  <p>identidade:</p>
  <p>
  <label for="identidade"></label>
  <input name="identidade" type="text" id="identidade" value="<?php echo $usuario->cd_identidade; ?>" maxlength="11" readonly />
  </p>
  <p>senha:</p>
  <p>
    <label for="senha"></label>
    <input name="senha" type="text" id="senha" value="<?php echo $usuario->nm_senha;?>" maxlength="8" />
    <label></label>
  </p>
  <p>nome completo:</p>
  <p>
    <label for="nome"></label>
    <input name="nome" type="text" id="nome" value="<?php  echo $usuario->nm_usuario; ?>" maxlength="30" />
  </p>
  <p>nome guerra
    <label for="nomeguerra"></label>
  </p>
  <p>
    <input name="nomeguerra" type="text" id="nomeguerra" value="<?php echo $usuario->nm_guerra; ?>" maxlength="15" />
  </p>
  <p>setor:
    <label for="setor"></label>
  </p>
  <p>
  <select name="setor" id="setor">
		<option  value="-1">-</option>
        <?php  
		$aux = $usuario->cd_setor;
		$sql = "SELECT * FROM setor ORDER BY nm_setor";
		$resultado = Conexao::executar($sql);
		while($dados = mysql_fetch_array($resultado)){
		    echo "<option value='".$dados['cd_setor']."'";
			if($aux==$dados['cd_setor']){
				echo " selected='selected' ";
				}
			echo ">".$dados['nm_setor']."</option>";
		}
		echo "</select>"; ?>
  </p>
  <p>&nbsp;</p>
  <p>nivel acesso:</p>
  <p>
    <label for="nivel"></label>
    <input name="nivel" type="text" id="nivel" value="<?php echo $usuario->nm_acesso; ?>" maxlength="30" />
  </p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>
    <input type="submit" name="editar_usuario" id="editar_usuario" value="Editar" />
  </p>
</form>
</diV>
<?php include("_footer.php")?>