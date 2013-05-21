<?php
require_once("classes/material.class.php");

$permiteacesso=1; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)

if(isset($_POST["cadastrar_material"])){
	$material = new Material(0,$_POST["material"],$_POST["descricao"],$_POST["unidade"],$_POST["tipo"],1);
	$msg = $material->inserir();	
}

if(isset($_POST["procurar_material"])){
	$material = new Material($_POST["codigo"],$_POST["material"],$_POST["descricao"],$_POST["unidade"],$_POST["tipo"],$_POST["ativo"]);
	$lista = $material->procurar();
}
?>

<?php include("_header.php")?>
<header>
<title>SISCMEX - Cadastro/Material</title>

</header>
<div class="conteudo">

<body>
<h1>Cadastro/Material</h1>
<p>
  <button id="botao_cadastrar">Cadastrar Novo Material</button>
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
$("#form_cadastrar_material").validate({
	rules: {
		material: {
			required: true,
			minlength: 5
			},
		descricao: {
			required: true,
			minlength: 5
			},
		unidade: {
			required: true,
			},
		tipo: {
			required: true,
			}
        },
	messages: {
		material: {
			required: " Campo obrigatório",
			minlength: " Minimo de 5 caracteres"
			},
		descricao: {
			required: " Campo obrigatório",
			minlength: " Minimo de 5 caracteres"
			},
		unidade: {
			required: " Campo obrigatório",
			},
		tipo: {
			required: " Campo obrigatório",
			}
		}
	});
});
</script>
<h2>Cadastrar Novo Material</h2>
<form id="form_cadastrar_material" name="form_cadastrar_material" method="post" action="">
<?php if(isset($msg)){ echo "<h3>$msg</h3>"; }?>
<p>nome material*:<br>
<label for="material"></label>
<input name="material" type="text" id="material" maxlength="30" />
<label></label>
</p>
<p>descrição*:<br>
<label for="descricao"></label>
<input name="descricao" size="100" type="text" id="descricao" maxlength="100" />
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
<input type="submit" name="cadastrar_material" id="cadastrar_material" value="Cadastrar" />
<input type="reset" value="Limpar Campos" />
</p>
</form><hr size="1">
</div>



<div id="form_procurar" style="display: none">
</script>
<p>
<?php if(isset($msg)){ echo "<h3>$msg</h3>"; }?>
<script type="text/javascript">
$(document).ready(function(){
$("#form_procurar_material").validate({
	rules: {
    	codigo: {
			number: true,
			}
		},
	messages: {
    	codigo: {
			number: " Digite somente números",
			}
		}
});
});
</script>
<h2>Procurar Cadastro Material</h2>
<form id="form_procurar_material" name="form_procurar_material" method="post" action="">
<p>codigo (digite somente números)*:<br>
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
<input name="descricao" size="100" type="text" id="descricao" maxlength="100" />
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
<p>ativo:<br>
<select name="ativo" id="ativo">
      <option value="1">Ativos</option>
      <option value="0">Inativos</option>
      <option value="2">Todos</option>
</select>
</p>
<p>
<input type="submit" name="procurar_material" id="procurar_material" value="Procurar" />
<input type="reset" value="Limpar Campos">
</p>
</form><hr size="1">
</div>



<?php 
if(isset($_POST["procurar_material"])){
	$lista = $material->procurar();
}else{
	$lista = Material::listar();
}
	
if(isset($lista)){
	if(mysql_num_rows($lista)){ 
?>
<table id="tabela" class="tablesorter" width='100%'><thead>
	<tr><th >codgo</th><th >nome</th><th >descrição</th><th >unidade</th><th >tipo</th><th>ativo</th><th align="center" >op&ccedil;&otilde;es</th></tr></thead> 
	<tbody><?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_material'] ?></td>
		<td><?php echo $linha['nm_material'] ?></td>
		<td><?php echo substr($linha['nm_descricao'],0,40); if(strlen($linha['nm_descricao']) > 40){ echo "...";} ?></td>
		<td><?php echo $linha['sg_unidade_med'] ?></td>
        <td><?php echo $linha['sg_tipo_material'] ?></td>
		<td><?php if($linha['cd_ativo_material']==1){echo "Sim";}else{ echo "Não";} ?></td>
		<td align="center"><a href='material_editar.php?codigo=<?php echo $linha['cd_material']?>'><img border=0 src="imagens/icone_alterar.png"></a> <a href='material_desativar.php?codigo=<?php echo $linha['cd_material']?>'><img border=0 src="imagens/icone_desativar.png" ></a></td>
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

