<?php
require_once("classes/usuario.class.php");

if(isset($_POST["procurar_usuario"])){
	$usuario = new Usuario($_POST["identidade"],NULL,$_POST["nome"],$_POST["nomeguerra"],$_POST["setor"],$_POST["nivel"],$_POST["ativo"]);
	$lista = $usuario->procurar();
}
if(isset($_POST["listar"])){
	$lista = Usuario::listar();
}

$permiteacesso=0;

?>

<?php include("_header.php")?>
<header>
<title>Procurar Cadastro Usuário</title>
</header>
<div class="conteudo">

<body>
<h1>Procurar Cadastro Usu&aacute;rio
</h1>
<form id="form1" name="form1" method="post" action="">
<p>identidade:<br>
<label for="identidade"></label>
<input name="identidade" type="text" id="identidade" maxlength="11" />
</p>
<p>nome completo:<br>
<label for="nome"></label>
<input name="nome" type="text" id="nome" maxlength="30" />
</p>
<p>nome guerra:
<label for="nomeguerra"></label>
<br>
<input name="nomeguerra" type="text" id="nomeguerra" maxlength="15" />
</p>
<p>setor:
<label for="setor"></label>
<br>
<select name="setor" id="setor">;
	<option  selected="selected"></option>;
	<?php 
	$sql = "SELECT * FROM setor ORDER BY nm_setor";
	$resultado = Conexao::executar($sql);
	while($dados = mysql_fetch_array($resultado)){
		echo "<option value='".$dados['sg_setor']."'>".$dados['sg_setor'] . " - " . $dados['nm_setor']."</option>";
	} ?>
</select>
</p>
<p>nivel acesso:<br>
<select name="nivel" id="nivel">
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
<p>
<input type="hidden" name="ativo" value="0" />
<input name="ativo" type="checkbox" id="ativo" value="1" checked />
<label for="ativo"></label> 
Ativos</p>
<p>
<input type="submit" name="procurar_usuario" id="procurar_usuario" value="Procurar" />
<input type="submit" name="listar" id="listar" value="Listar Todos os Usu&aacute;rios">
</p>
</form>
<p><?php if(isset($lista)){ ?>
<table width='100%' border='1'>
	<tr><td>identidade</td><td>nome</td><td>guera</td><td>setor</td><td>nivel de acesso</td><td>Ativo</td><td>Opções</td></tr>
	<?php
	while($linha = mysql_fetch_array($lista)){ ?>
	<tr>
		<td><?php echo $linha['cd_identidade'] ?></td>
		<td><?php echo $linha['nm_usuario'] ?></td>
		<td><?php echo $linha['nm_guerra'] ?></td>
		<td><?php echo $linha['nm_setor'] ?></td>
		<td><?php echo $linha['nm_acesso']?></td>
		<td><?php if($linha['cd_ativo']==0){echo "Não";}else{ echo "Sim";} ?></td>
		<td><a href='usuario_editar.php?id=<?php echo $linha['cd_identidade']?>'>[editar]</a> - <a href='usuario_desativar.php?id=<?php echo $linha['cd_identidade']?>'>[excluir]</a></td>
	</tr>
	<?php } ?>
</table>
<?php } ?>
</p>

</diV>
<?php include("_footer.php"); ?>