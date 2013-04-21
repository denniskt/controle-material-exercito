<?php
require_once("classes/usuario.class.php");

if(isset($_POST["cadastrar_usuario"])){
	$usuario = new Usuario($_POST["identidade"],$_POST["senha"],$_POST["nome"],$_POST["nomeguerra"],$_POST["setor"],$_POST["nivel"]);
	$msg = $usuario->inserir();
}
?>
<?php include("_header.php")?>
<header>
<title>SISCMEX - Cadastrar Novo Usuário</title>
</header>
<div class="conteudo">

<body>
<h1>Cadastrar Novo Usu&aacute;rio
</h1>
<form id="form1" name="form1" method="post" action="">
  <div class="mensagem"><?php if(isset($msg)){ echo $msg; }?></div>
<p>&nbsp;</p>
  <p>identidade:</p>
  <p>
  <label for="identidade"></label>
    <input name="identidade" type="text" id="identidade" maxlength="11" />
  </p>
  <p>senha:</p>
  <p>
    <label for="senha"></label>
    <input name="senha" type="text" id="senha" maxlength="8" />
    <label></label>
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
		<option  value="-1">-</option>;
        <?php 
		$sql = "SELECT * FROM setor ORDER BY nm_setor";
		$resultado = Conexao::executar($sql);
		while($dados = mysql_fetch_array($resultado)){
		    echo "<option value='".$dados['cd_setor']."'>".$dados['cd_setor'] . " - " . $dados['nm_setor']."</option>";
		}
		echo "</select>";?>
  </p>
  <p>nivel acesso:  </p>
  <p>
    <label for="nivel"></label>
    <input name="nivel" type="text" id="nivel" maxlength="30" />
</p>
  <p>&nbsp;</p>
  <p>
    <input type="submit" name="cadastrar_usuario" id="cadastrar_usuario" value="Cadastrar" />
  </p>
</form>
<p>&nbsp;</p>

</diV>
<?php include("_footer.php")?>