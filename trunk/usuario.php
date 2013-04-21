<?php
require_once("classes/usuario.class.php");
session_start();

if(isset($_POST["procurar_usuario"])){
	$usuario = new Usuario($_POST["identidade"],NULL,$_POST["nome"],$_POST["nomeguerra"],$_POST["setor"],$_POST["nivel"]);
	$lista = $usuario->procurar();
}
if(isset($_POST["listar"])){
	$lista = Usuario::listar();
}
?>
<?php include("_header.php")?>
<header>
<title>Untitled Document</title>
</header>
<div class="conteudo">

<body>
<h1>Procurar Cadastro Usu&aacute;rio
</h1>
<form id="form1" name="form1" method="post" action="">
  <p>identidade:</p>
  <p>
    <label for="identidade"></label>
    <input name="identidade" type="text" id="identidade" maxlength="11" />
</p>
  <p>nome completo:</p>
  <p>
    <label for="nome"></label>
    <input name="nome" type="text" id="nome" maxlength="30" />
  </p>
  <p>nome guerra:
    <label for="nomeguerra"></label>
  </p>
  <p>
    <input name="nomeguerra" type="text" id="nomeguerra" maxlength="15" />
  </p>
  <p>setor:
    <label for="setor"></label>
  </p>
  <p>
    <select name="setor" id="setor">;
		<option  value="-1" selected="selected">-</option>;
        <?php 
		$sql = "SELECT * FROM setor ORDER BY nm_setor";
		$resultado = Conexao::executar($sql);
		while($dados = mysql_fetch_array($resultado)){
		    echo "<option value='".$dados['cd_setor']."'>".$dados['cd_setor'] . " - " . $dados['nm_setor']."</option>";
		} ?>
    </select>
  </p>
  <p>nivel acesso:  </p>
  <p>
    <label for="nivel"></label>
    <input name="nivel" type="text" id="nivel" maxlength="30" />
  </p>
  <p>&nbsp;</p>
  <p>
    <input type="submit" name="procurar_usuario" id="procurar_usuario" value="Procurar" />
    <input type="submit" name="listar" id="listar" value="listar">
  </p>
</form>
<p><?php if(isset($lista)){ ?>
			<table width='100%' border='1'>
			<tr><td>identidade</td><td>nome</td><td>guera</td><td>setor</td><td>nivel de acesso</td><td>Opções</td></tr>
			<?php
			while($linha = mysql_fetch_array($lista)){ ?>
			<tr>
			<td><?php echo $linha['cd_identidade'] ?></td>
			<td><?php echo $linha['nm_usuario'] ?></td>
			<td><?php echo $linha['nm_guerra'] ?></td>
			<td><?php echo $linha['nm_setor'] ?></td>
			<td><?php echo $linha['nm_acesso']?></td>
			<td><a href='usuario_editar.php?id=<?php echo $linha['cd_identidade']?>'>[editar]</a> - <a href='usuario_excluir.php?id=<?php echo $linha['cd_identidade']?>'>[excluir]</a></td>
			</tr>
			<?php } ?>
            </table>
            <?php } ?>
</p>
		

</diV>
<?php include("_footer.php"); ?>