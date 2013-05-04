<?php
require_once("classes/setor.class.php");

$permiteacesso=1; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)

if(isset($_POST["cadastrar_setor"])){
	$setor = new Setor($_POST["sigla"],$_POST["nome"],1);
	$msg = $setor->inserir();
}

if(isset($_POST["procurar_setor"])){
	$setor = new Setor($_POST["sigla"],$_POST["nome"],$_POST["ativo"]);
}
?>

<?php include("_header.php")?>
<header>
<title>SISCMEX - Cadastro/Setor</title>

</header>
<div class="conteudo">

<body>
<h1>Cadastro/Setor</h1>
<p>
  <button id="botao_cadastrar">Cadastrar Novo Setor</button>
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
$("#form_cadastrar_setor").validate({
	rules: {
    	sigla: {
			required: true,
			minlength: 5
			},
		nome: {
			required: true,
			minlength: 5
			}
        },
	messages: {
    	sigla: {
			required: " Campo obrigatório",
			minlength: " Mínimo de 5 caracteres"
			},
		nome: {
			required: " Campo obrigatório",
			minlength: " Mínimo de 5 caracteres"
			}
		}
	});
});
</script>
<h2>Cadastrar Novo Setor</h2>
<form id="form_cadastrar_setor" name="form_cadastrar_setor" method="post" action="">
<p>sigla do setor*:<br>
<label for="sigla"></label>
<input name="sigla" type="text" id="sigla" maxlength="5" />
</p>
<p>nome do setor*:<br>
<label for="nome"></label>
<input name="nome" type="text" id="nome" maxlength="30" />
<label></label>
</p>

<p>&nbsp;</p> <p>
<input type="submit" name="cadastrar_setor" id="cadastrar_setor" value="Cadastrar" />
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
<h2>Procurar Cadastro Setor</h2>
<form id="form_procurar_setor" name="form_procurar_setor" method="post" action="">
<p>sigla do setor:<br>
<label for="sigla"></label>
<input name="sigla" type="text" id="sigla" maxlength="5" />
</p>
<p>nome do setor:<br>
<label for="nome"></label>
<input name="nome" type="text" id="nome" maxlength="30" />
</p>
<p>ativo:<br>
<select name="ativo" id="ativo">
      <option value="1">Ativos</option>
      <option value="0">Inativos</option>
      <option value="2">Todos</option>
</select>
</p>

<p>
<input type="submit" name="procurar_setor" id="procurar_setor" value="Procurar" />
<input type="reset" value="Limpar Campos">
</p>
</form><hr size="1">
</div>



<?php 
if(isset($_POST["procurar_setor"])){
	$lista = $setor->procurar();
}else{
	$lista = Setor::listar();
}
	
if(isset($lista)){ 
	if(mysql_num_rows($lista)){ 
?>
<table id="tabela" class="tablesorter" width='100%'><thead>
	<tr><th >sigla setor</th><th >nome do setor</th><th >ativo</th><th align="center" >op&ccedil;&otilde;es</th></tr></thead> 
	<tbody><?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['sg_setor'] ?></td>
		<td><?php echo $linha['nm_setor'] ?></td>
		<td><?php if($linha['cd_ativo_setor']==1){echo "Sim";}else{ echo "Não";} ?></td>
		<td align="center"><a href='setor_editar.php?sigla=<?php echo $linha['sg_setor']?>'><img border=0 src="imagens/icone_editar.png"> editar</a> <a href='setor_desativar.php?sigla=<?php echo $linha['sg_setor']?>'><img border=0 src="imagens/inativo.png" > desativar</a></td>
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

