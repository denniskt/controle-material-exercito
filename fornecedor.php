<?php
require_once("classes/fornecedor.class.php");

if(isset($_POST["procurar_fornecedor"])){
	$fornecedor = new Fornecedor($_POST["cnpj"],$_POST["razao"],$_POST["endereco"],$_POST["telefone"],$_POST["email"],$_POST["ramo"],$_POST["ativo"]);
	$lista = $fornecedor->procurar();
}
if(isset($_POST["listar"])){
	$lista = fornecedor::listar();
}

$permiteacesso=0;

?>

<?php include("_header.php")?>
<header>
<title>Procurar Cadastro Fornecedor</title>
<script type="text/javascript">
$(document).ready(function(){
$("#form_procurar_fornecedor").validate({
	rules: {
    	cnpj: {
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
<h1>Procurar Cadastro Fornecedor
</h1>
<form id="form_procurar_fornecedor" name="form_procurar_fornecedor" method="post" action="">
<p>cnpj:<br>
<label for="cnpj"></label>
<input name="cnpj" type="text" id="cnpj" maxlength="20" />
</p>
<p>razão social:<br>
<label for="razao"></label>
<input name="razao" type="text" id="razao" maxlength="30" />
<label></label>
</p>
<p>endereço completo:<br>
<label for="endereco"></label>
<input name="endereco" type="text" id="endereco" maxlength="50" />
</p>
<p>telefone:<br>
<label for="telefone"></label>
<input name="telefone" type="text" id="telefone" maxlength="20" />
</p>
<p>email:
<br>
<label for="email"></label>
<input name="email" type="text" id="email" maxlength="100" />
</p>
<p>ramo de atividade:
<br>
<label for="ramo"></label>
<input name="ramo" type="text" id="ramo" maxlength="30" />
</p>
<p>
<input type="hidden" name="ativo" value="0" />
<input name="ativo" type="checkbox" id="ativo" value="1" checked />
<label for="ativo"></label> 
Ativos</p>
<p>
<input type="submit" name="procurar_fornecedor" id="procurar_fornecedor" value="Procurar" />
<input type="submit" name="listar" id="listar" value="Listar Todos os Fornecedores">
</p>
</form>
<p>
<?php 
if(isset($lista)){ 
	if(mysql_num_rows($lista)){ 
?>
<table width='100%' border='1'>
	<tr><td>cnpj</td><td>razao social</td><td>endereco</td><td>telefone</td><td>email</td><td>ramo</td><td>Ativo</td><td>Opções</td></tr>
	<?php
	while($linha = mysql_fetch_array($lista)){ ?>
	<tr>
		<td><?php echo $linha['cd_cnpj'] ?></td>
		<td><?php echo $linha['nm_razao_soc'] ?></td>
		<td><?php echo $linha['nm_endereco'] ?></td>
		<td><?php echo $linha['nm_telefone'] ?></td>
        <td><?php echo $linha['nm_email'] ?></td>
        <td><?php echo $linha['nm_ramo_ativ'] ?></td>
		<td><?php if($linha['cd_ativo_fornecedor']==1){echo "Sim";}else{ echo "Não";} ?></td>
		<td><a href="fornecedor_visualizar.php?cnpj=<?php echo $linha['cd_cnpj']?>">[visualizar]</a> - <a href="fornecedor_editar.php?cnpj=<?php echo $linha['cd_cnpj']?>">[editar]</a> - <a href="fornecedor_desativar.php?cnpj=<?php echo $linha['cd_cnpj']?>">[excluir]</a></td>
	</tr>
	<?php } ?>
</table>
<?php }else{echo "<h3>Nenhum resultado encontrado!</h3>"; } }?>
</p>

</diV>
<?php include("_footer.php"); ?>