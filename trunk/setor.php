<?php
require_once("classes/setor.class.php");

if(isset($_POST["procurar_setor"])){
	$setor = new Setor($_POST["sigla"],$_POST["nome"],$_POST["ativo"]);
	$lista = $setor->procurar();
}
if(isset($_POST["listar"])){
	$lista = Setor::listar();
}

$permiteacesso=0;

?>

<?php include("_header.php")?>
<header>
<title>Procurar Cadastro Setor</title>

</header>
<div class="conteudo">

<body>
<h1>Procurar Cadastro Setor
</h1>
<form id="form_procurar_setor" name="form_procurar_setor" method="post" action="">
<p>sigla do setor:<br>
<label for="sigla"></label>
<input name="sigla" type="text" id="sigla" maxlength="5" />
</p>
<p>nome do setor:<br>
<label for="nome"></label>
<input name="nome" type="text" id="nome" maxlength="30" />
</p>
<p>
<input type="hidden" name="ativo" value="0" />
<input name="ativo" type="checkbox" id="ativo" value="1" checked />
<label for="ativo"></label> 
Ativos</p>
<p>
<input type="submit" name="procurar_setor" id="procurar_setor" value="Procurar" />
<input type="submit" name="listar" id="listar" value="Listar Todos os Setores">
</p>
</form>
<p>
<?php 
if(isset($lista)){ 
	if(mysql_num_rows($lista)){ 
?>
<table width='100%' border='1'>
	<tr><td>sigla</td><td>nome</td><td>Ativo</td><td>Opções</td></tr>
	<?php
	while($linha = mysql_fetch_array($lista)){ ?>
	<tr>
		<td><?php echo $linha['sg_setor'] ?></td>
		<td><?php echo $linha['nm_setor'] ?></td>
		<td><?php if($linha['cd_ativo_setor']==1){echo "Sim";}else{ echo "Não";} ?></td>
		<td><a href='setor_editar.php?sigla=<?php echo $linha['sg_setor']?>'>[editar]</a> - <a href='setor_desativar.php?sigla=<?php echo $linha['sg_setor']?>'>[excluir]</a></td>
	</tr>
	<?php } ?>
</table>
<?php }else{echo "<h3>Nenhum resultado encontrado!</h3>"; } }?>
</p>

</diV>
<?php include("_footer.php"); ?>