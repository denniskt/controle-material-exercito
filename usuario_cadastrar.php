<?php
require_once("classes/usuario.class.php");

if(isset($_POST["cadastrar_usuario"])){
	$usuario = new Usuario($_POST["identidade"],md5($_POST["senha"]),$_POST["nome"],$_POST["nomeguerra"],$_POST["setor"],$_POST["nivel"],1);
	$msg = $usuario->inserir();
}

$permiteacesso=1;

?>
<?php include("_header.php")?>
<header>
<title>SISCMEX - Cadastrar Novo Usuário</title>
<script type="text/javascript">
$(document).ready(function(){
$("#form_cadastrar_usuario").validate({
	rules: {
    	identidade: {
			required: true,
			number: true,
			},
		senha: {
			required: true,
			},
		nome: {
			required: true,
			minlength: 5
			},
		nomeguerra: {
			required: true,
			minlength: 2
			},
		setor: {
			required: true,
			},
		nivel: {
			required: true,
			}
        },
	messages: {
    	identidade: {
			required: " Campo obrigatório",
			number: " Digite somente números",
			},
		senha: {
			required: " Campo obrigatório",
			},
		nome: {
			required: " Campo obrigatório",
			minlength: " Deve possuir 5 caracteres"
			},
		nomeguerra: {
			required: " Campo obrigatório",
			minlength: " Deve possuir 2 caracteres"
			},
		setor: {
			required: " Campo obrigatório",
			},
		nivel: {
			required: " Campo obrigatório",
			}
		}
	});
});
</script>
</header>
<div class="conteudo">

<body>
<h1>Cadastrar Novo Usu&aacute;rio
</h1>
<form id="form_cadastrar_usuario" name="form_cadastrar_usuario" method="post" action="">
<?php if(isset($msg)){ echo "<h3>$msg</h3>"; }?>
<p>identidade*:<br>
<label for="identidade"></label>
<input name="identidade" type="text" id="identidade" maxlength="11" />
</p>
<p>senha*:<br>
<label for="senha"></label>
<input name="senha" type="password" id="senha" maxlength="8" />
<label></label>
</p>
<p>nome completo*:<br>
<label for="nome"></label>
<input name="nome" type="text" id="nome" maxlength="30" />
</p>
<p>nome guerra*:
<br>
<label for="nomeguerra"></label>
<input name="nomeguerra" type="text" id="nomeguerra" maxlength="15" />
</p>
<p>setor*:
<br>

<select name="setor" id="setor">;
	<option></option>;
	<?php 
	$sql = "SELECT * FROM setor WHERE cd_ativo_setor=1 ORDER BY nm_setor";
	$resultado = Conexao::executar($sql);
	while($dados = mysql_fetch_array($resultado)){
		echo "<option value='".$dados['sg_setor']."'>". $dados['nm_setor']."</option>";
	}
	?>
</select>
</p>
nivel acesso*:
<br>
<select name="nivel" id="nivel">
	<option></option>
	<?php
	$sql = "SELECT * FROM nivel_acesso ";
	if($_SESSION['nivel']==1){ $sql .= "WHERE cd_acesso=2 ";}
	$sql .= "ORDER BY cd_acesso";
	$resultado = Conexao::executar($sql);
	while($dados = mysql_fetch_array($resultado)){
		echo "<option value='".$dados['cd_acesso']."'>".$dados['nm_acesso']."</option>";
	}; ?>
</select>

<p>&nbsp;</p> <p>
<input type="submit" name="cadastrar_usuario" id="cadastrar_usuario" value="Cadastrar" />
</p>
</form>
<p>&nbsp;</p>

</diV>
<?php include("_footer.php")?>