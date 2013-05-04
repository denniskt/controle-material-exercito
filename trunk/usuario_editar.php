<?php
require_once("classes/usuario.class.php");

$permiteacesso=1; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)

if(isset($_GET)){
	$usuario = Usuario::editar($_GET["id"]);
}
if(isset($_POST["editar_usuario"])){	
	$usuario = new Usuario($_POST["identidade"],base64_encode($_POST["senha"]),$_POST["nome"],$_POST["nomeguerra"],$_POST["setor"],$_POST["nivel"],$_POST["ativo"]);
	$msg = $usuario->atualizar();
	Usuario::editar($_POST["identidade"]);
	$usuario = Usuario::editar($_GET["id"]);
}
?>

<?php include("_header.php")?>
<header>
<title>SISCMEX - Cadastro/Usuário/Editar</title>

</header>
<div class="conteudo">

<body>
<h1>Cadastro/Usu&aacute;rio/Editar</h1>
<p>
  <input type=button onClick="location.href='./usuario.php'" value="< Voltar">
  <button id="botao_editar">Editar Cadastro Usu&aacute;rio</button>
<hr size="1">
</p>

<p>
<?php if(isset($msg)){ echo "<h3>$msg</h3>"; }?>


<div id="form_editar">
<script type="text/javascript">
$(document).ready(function(){
$("#form_editar_usuario").validate({
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
<h2>Editar Cadastro Usuário</h2>
<form id="form_editar_usuario" name="form_editar_usuario" method="post" action="">
  <p>identidade*:<br>
  <label for="identidade"></label>
  <input name="identidade" type="text" id="identidade" value="<?php echo $usuario->cd_identidade; ?>" maxlength="11" readonly />
  </p>
  <p>senha*:<br>
    <label for="senha"></label>
    <input name="senha" type="password" id="senha" value="<?php echo base64_decode($usuario->nm_senha);?>" maxlength="8" />
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
  <p>ativo: 
  	<input type="hidden" name="ativo" value="0" />
    <input name="ativo" type="checkbox" id="ativo" value="1" <?php  if($usuario->cd_ativo_usuario==1){ echo "checked"; } ?>/>
    <label for="ativo"></label>
  </p>
  <p>
    <input type="submit" name="editar_usuario" id="editar_usuario" value="Editar" />
    <input type=button onClick="location.href='./usuario.php'" value="Cancelar">
  </p>
</form>
</div>


  
    
  </diV>
  <?php include("_footer.php"); ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

