<?php
require_once("classes/material.class.php");

if(isset($_POST["procurar_material"])){
	$material = new Material($_POST["codigo"],$_POST["material"],$_POST["descricao"],$_POST["unidade"],$_POST["tipo"],$_POST["ativo"]);
	$lista = $material->procurar();
}
if(isset($_POST["listar"])){
	$lista = Material::listar();
}

$permiteacesso=0;

?>

<?php include("_header.php")?>
<header>
<title>Procurar Cadastro Material</title>
<script type="text/javascript">
$(document).ready(function(){
$("#form_procurar_material").validate({
	rules: {
    	codigo: {
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
</header>
<div class="conteudo">

<body>
<h1>Procurar Cadastro Material
</h1>
<form id="form_procurar_material" name="form_procurar_material" method="post" action="">
<p>codigo (digite somente súmeros)*:<br>
<label for="codigo"></label>
<input name="codigo" type="text" id="codigo" maxlength="11" />
</p>
<p>nome material*:<br>
<label for="material"></label>
<input name="material" type="text" id="material" maxlength="30" />
<label></label>
</p>
<p>descrição*:<br>
<label for="descricao"></label>
<input name="descricao" type="text" id="descricao" maxlength="100" />
</p>
<p>unidade de medida*:<br>
<label for="unidade"></label>
<input name="unidade" type="text" id="unidade" maxlength="5" />
</p>
<p>tipo de material:
<br>
<label for="tipo"></label>
<input name="tipo" type="text" id="tipo" maxlength="10" />
</p>
<p>
<input type="hidden" name="ativo" value="0" />
<input name="ativo" type="checkbox" id="ativo" value="1" checked />
<label for="ativo"></label> 
Ativos</p>
<p>
<input type="submit" name="procurar_material" id="procurar_material" value="Procurar" />
<input type="submit" name="listar" id="listar" value="Listar Todos os Materiais">
</p>
</form>
<p>
<?php 
if(isset($lista)){ 
	if(mysql_num_rows($lista)){ 
?>
<table width='100%' border='1'>
	<tr><td>codigo</td><td>material</td><td>descricao</td><td>unidade</td><td>tipo</td><td>Ativo</td><td>Opções</td></tr>
	<?php
	while($linha = mysql_fetch_array($lista)){ ?>
	<tr>
		<td><?php echo $linha['cd_material'] ?></td>
		<td><?php echo $linha['nm_material'] ?></td>
		<td><?php echo $linha['nm_descricao'] ?></td>
		<td><?php echo $linha['sg_unidade_med'] ?></td>
        <td><?php echo $linha['sg_tipo_material'] ?></td>
		<td><?php if($linha['cd_ativo_material']==1){echo "Sim";}else{ echo "Não";} ?></td>
		<td><a href="material_visualizar.php?codigo=<?php echo $linha['cd_material']?>">[visualizar]</a> - <a href="material_editar.php?codigo=<?php echo $linha['cd_materia']?>">[editar]</a> - <a href="material_desativar.php?codigo=<?php echo $linha['cd_material']?>">[excluir]</a></td>
	</tr>
	<?php } ?>
</table>
<?php }else{echo "<h3>Nenhum resultado encontrado!</h3>"; } }?>
</p>

</diV>
<?php include("_footer.php"); ?>