<?php
	require_once("classes/usuario.class.php");
		
	if(isset($_GET)){
		$usuario = Usuario::editar($_GET["id"]);
	}
	if(isset($_POST["editar_usuario"])){
		
	$usuario = new Usuario($_POST["identidade"],md5($_POST["senha"]),$_POST["nome"],$_POST["nomeguerra"],$_POST["setor"],$_POST["nivel"],$_POST["ativo"]);
	$msg = $usuario->atualizar();
	Usuario::editar($_POST["identidade"]);
	$usuario = Usuario::editar($_GET["id"]);
}
?>
<?php 
if(!$_GET["id"]){
	header("location:./usuario_editar.php?id=".$_SESSION['identidade']."");
}else if($_SESSION['nivel']==0){
	$permiteacesso=0;
}else if($_GET["id"] <> $_SESSION['identidade']){
	header("location:./usuario_editar.php?id=".$_SESSION['identidade']."");
}else{
	$permiteacesso=2;
}
include("_header.php"); 
?>
<head>
<title>SISCMEX - Alterar Cadastro Usuário</title>
<script type="text/javascript">
$(document).ready(function(){
$("#form_editar").validate({
	rules: {
    	identidade: {
			number: true,
			},
	messages: {
    	identidade: {
			number: " Digite somente números",
			}
		}
	}
});
});
</script>
</header>
<div class="conteudo">

<body>
<h1>Alterar Usu&aacute;rio
</h1>
<form id="form_editar" name="form_editar" method="post" action="">
  <?php if(isset($msg)){ echo "<h3>$msg</h3>"; }?>
  <p>identidade*:<br>
  <label for="identidade"></label>
  <input name="identidade" type="text" id="identidade" value="<?php echo $usuario->cd_identidade; ?>" maxlength="11" readonly />
  </p>
  <p>senha*:<br>
    <label for="senha"></label>
    <input name="senha" type="password" id="senha" value="<?php echo $usuario->nm_senha;?>" maxlength="8" />
    <label></label>
  </p>
  <p>nome completo*:<br>
    <label for="nome"></label>
    <input name="nome" type="text" id="nome" value="<?php  echo $usuario->nm_usuario; ?>" maxlength="30" />
  </p>
  <p>nome guerra*:
    <label for="nomeguerra"></label>
  <br>
    <input name="nomeguerra" type="text" id="nomeguerra" value="<?php echo $usuario->nm_guerra; ?>" maxlength="15" />
  </p>
  <p>setor*:
    <label for="setor"></label>
  <br>
  <select name="setor" id="setor">
		<option></option>
        <?php  
		$aux = $usuario->sg_setor;
		$sql = "SELECT * FROM setor ORDER BY nm_setor";
		$resultado = Conexao::executar($sql);
		while($dados = mysql_fetch_array($resultado)){
		    echo "<option value='".$dados['sg_setor']."'";
			if($aux==$dados['sg_setor']){
				echo " selected='selected' ";
				}
			echo ">".$dados['nm_setor'];
			if($dados['cd_ativo_setor']==0){echo " Inativo";}  
			echo "</option>";
		}; ?>
  </select>
  </p>
  <p>nivel acesso*:<br>
    <select name="nivel" id="nivel" <?php if($_SESION['nivel']<>0){ echo "disabled";} ?>>
	  <option></option>
        <?php  
		$aux = $usuario->cd_acesso;
		$sql = "SELECT * FROM nivel_acesso ORDER BY cd_acesso";
		$resultado = Conexao::executar($sql);
		while($dados = mysql_fetch_array($resultado)){
		    echo "<option value='".$dados['cd_acesso']."'";
			if($aux==$dados['cd_acesso']){
				echo " selected='selected' ";
				}
			echo ">".$dados['nm_acesso']."</option>";
		}; ?>
  </select>
    
  </p>
  <p>Ativo:<br>
  	<input type="hidden" name="ativo" value="0" />
    <input name="ativo" type="checkbox" id="ativo" value="1" <?php  if($usuario->cd_ativo_usuario==1){ echo "checked"; } ?>/>
    <label for="ativo"></label>
  </p>
  <p>&nbsp;</p>
  <p>
    <input type="submit" name="editar_usuario" id="editar_usuario" value="Editar" />
  </p>
</form>
</diV>
<?php include("_footer.php")?>