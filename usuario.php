<?php
require_once("classes/usuario.class.php");

$permiteacesso=1; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)

if(isset($_POST["cadastrar_usuario"])){
	$usuario = new Usuario($_POST["identidade"],md5($_POST["senha"]),$_POST["nome"],$_POST["nomeguerra"],$_POST["setor"],$_POST["nivel"],1);
	$msg = $usuario->inserir();
}

if(isset($_POST["procurar_usuario"])){
	$usuario = new Usuario($_POST["identidade"],NULL,$_POST["nome"],$_POST["nomeguerra"],$_POST["setor"],$_POST["nivel"],$_POST["ativo"]);
	//$lista = $usuario->procurar();
}
?>

<?php include("_header.php")?>
<header>
<title>SISCMEX - Cadastro/Usuário</title>

</header>
<div class="conteudo">

<body>
<h1>Cadastro/Usuário</h1>
<p>
  <button id="botao_cadastrar">Cadastrar Novo Usu&aacute;rio</button>
  <button id="botao_procurar">Procurar</button>
<hr size="1">
</p>

<script>
$("#botao_cadastrar").click(function () {
$("h3").hide();
$("#form_procurar").hide();
$("#form_cadastrar").toggle();
});
</script>
<script>
$("#botao_procurar").click(function () {
$("h3").hide();
$("#form_cadastrar").hide();
$("#form_procurar").toggle();

});
</script>
<p>
<?php if(isset($msg)){ echo "<h3>$msg</h3>"; }?>
<div id="form_cadastrar" style="display: none">
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
<h2>Cadastrar Novo Usu&aacute;rio</h2>
<form id="form_cadastrar_usuario" name="form_cadastrar_usuario" method="post" action="">
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
	if($_SESSION['nivel']==1){ $sql .= "WHERE cd_acesso=2 ";} // Se for nivel 1 (almoxarife, só aparece opção para cadastrar nivel 2 (solicitante)
	$sql .= "ORDER BY cd_acesso";
	$resultado = Conexao::executar($sql);
	while($dados = mysql_fetch_array($resultado)){
		echo "<option value='".$dados['cd_acesso']."'>".$dados['nm_acesso']."</option>";
	}; ?>
</select>
<p>
<input type="submit" classs="confirmar" name="cadastrar_usuario" id="cadastrar_usuario" value="Cadastrar" />
<input type="reset" value="Limpar Campos" />
</p>
</form><hr size="1">
</div>



<div id="form_procurar" style="display: none">
<script type="text/javascript">
$(document).ready(function(){
$("#form_procurar_usuario").validate({
	rules: {
    	identidade: {
			number: true,
			}
		},
	messages: {
    	identidade: {
			number: " Digite somente números",
			}
		}
});
});
</script>
<h2>Procurar Cadastro Usuário</h2>
<form id="form_procurar_usuario" name="form_procurar_usuario" method="post" action="">
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
<p>Ativo:<br>
<select name="ativo" id="ativo">
      <option value="1">Ativos</option>
      <option value="0">Inativos</option>
      <option value="2">Todos</option>
</select>
</p>

<p>
<input type="submit" name="procurar_usuario" id="procurar_usuario" value="Procurar" />
<input type="reset" value="Limpar Campos">
</p>
</form><hr size="1">
</div>



<?php 
if(isset($_POST["procurar_usuario"])){
	$lista = $usuario->procurar();
}else{
	$lista = Usuario::listar();
}
	
if(isset($lista)){ 
	if(mysql_num_rows($lista)){ 
?>
<table id="tabela" class="tablesorter" width='100%'><thead>
	<tr><th >identidade</th><th >nome completo</th><th >nome de guerra</th><th >setor</th><th >nivel acesso</th><th>ativo</th><th align="center" >op&ccedil;&otilde;es</th></tr></thead> 
	<tbody><?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_identidade'] ?></td>
		<td><?php echo $linha['nm_usuario'] ?></td>
		<td><?php echo $linha['nm_guerra'] ?></td>
		<td><?php echo $linha['nm_setor'] ?></td>
		<td><?php echo $linha['nm_acesso']?></td>
		<td><?php if($linha['cd_ativo_usuario']==1){echo "Sim";}else{ echo "Não";} ?></td>
		<td align="center"><a href='usuario_editar.php?id=<?php echo $linha['cd_identidade']?>'><img border=0 src="imagens/icone_editar.png"> editar</a> <a href='usuario_desativar.php?id=<?php echo $linha['cd_identidade']?>'><img border=0 src="imagens/inativo.png" > desativar</a></td>
	</tr>
	<?php } ?>
</tbody></table>
<div id="pager" class="pager" >
 <form>
  <img border=0 src="./imagens/navtabela1.png" class="first">
  <img border=0 src="./imagens/navtabela2.png" class="prev">
  <input type="text" class="pagedisplay" id="pad0" size="8" readonly>
  <img border=0 src="./imagens/navtabela3.png" class="next">
  <img border=0 src="./imagens/navtabela4.png" class="last">
  <select id="pad0" class="pagesize">
   <option selected="selected" value="10">10</option>
   <option value="20">20</option>
   <option value="30">30</option>
   <option value="50">50</option>
  </select>
 </form>
</div>

<p>
   <?php }else{echo "<h3>Nenhum resultado encontrado!</h3>"; } }?>
</p>
  
    
  </diV>
  <?php include("_footer.php"); ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

