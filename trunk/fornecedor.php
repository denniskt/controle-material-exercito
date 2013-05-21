<?php
require_once("classes/fornecedor.class.php");

$permiteacesso=1; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)

if(isset($_POST["cadastrar_fornecedor"])){
	if(!isset($_POST["email"])){$email=NULL;}else{$email=$_POST["email"];}
	if(!isset($_POST["ramo"])){$ramo=NULL;}else{$ramo=$_POST["ramo"];}
	$fornecedor = new Fornecedor($_POST["cnpj"],$_POST["razao"],$_POST["endereco"],$_POST["telefone"],$email,$ramo,1);
	$msg = $fornecedor->inserir();	
}

if(isset($_POST["procurar_fornecedor"])){
	$fornecedor = new Fornecedor($_POST["cnpj"],$_POST["razao"],$_POST["endereco"],$_POST["telefone"],$_POST["email"],$_POST["ramo"],$_POST["ativo"]);
	$lista = $fornecedor->procurar();
}

?>

<?php include("_header.php")?>
<header>
<title>SISCMEX - Cadastro/Fornecedor</title>

</header>
<div class="conteudo">

<body>
<h1>Cadastro/Fornecedor</h1>
<p>
  <button id="botao_cadastrar">Cadastrar Novo Fornecedor</button>
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
$("#form_cadastrar_fornecedor").validate({
	rules: {
    	cnpj: {
			required: true,
			number: true,
			minlength: 14
			},
		razao: {
			required: true,
			minlength: 5
			},
		endereco: {
			required: true,
			minlength: 5
			},
		telefone: {
			required: true,
			minlength: 8,
			},
		email: {
			required: false,
			email: true
			}
        },
	messages: {
    	cnpj: {
			required: " Campo obrigatório",
			number: " Digite somente números",
			minlength: " CPF invalido"
			},
		razao: {
			required: " Campo obrigatório",
			minlength: " Minimo de 5 caracteres"
			},
		endereco: {
			required: " Campo obrigatório",
			minlength: " Minimo de 5 caracteres"
			},
		telefone: {
			required: " Campo obrigatório",
			minlength: " Mínimo 8 digitos"
			},
		email: {
			email:  " Insira um email válido"
			}
		}
	});
});
</script>
<h2>Cadastrar Novo Fornecedor</h2>
<form id="form_cadastrar_fornecedor" name="form_cadastrar_fornecedor" method="post" action="">
<?php if(isset($msg)){ echo "<h3>$msg</h3>"; }?>
<p>cnpj (digite somente súmeros)*:<br>
<label for="cnpj"></label>
<input name="cnpj" type="text" id="cnpj" maxlength="20" />
</p>
<p>razão social*:<br>
<label for="razao"></label>
<input name="razao" size="60" type="text" id="razao" maxlength="30" />
<label></label>
</p>
<p>endereço completo*:<br>
<input name="endereco" size="100" type="text" id="endereco" maxlength="50" />
</p>
<p>telefone*:<br>
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
<input type="submit" name="cadastrar_fornecedor" id="cadastrar_fornecedor" value="Cadastrar" />
<input type="reset" value="Limpar Campos" />
</p>
</form><hr size="1">
</div>



<div id="form_procurar" style="display: none">
<script type="text/javascript">
$(document).ready(function(){
$("#form_procurar_fornecedor").validate({
	rules: {
    	cnpj: {
			number: true,
			}
		},
	messages: {
    	cnpj: {
			number: " Digite somente números",
			}
		}
});
});
</script>
<h2>Procurar Cadastro Fornecedor</h2>
<form id="form_procurar_fornecedor" name="form_procurar_fornecedor" method="post" action="">
<p>cnpj:<br>
<label for="cnpj"></label>
<input name="cnpj" type="text" id="cnpj" maxlength="20" />
</p>
<p>razão social:<br>
<label for="razao"></label>
<input name="razao" size="60" type="text" id="razao" maxlength="30" />
<label></label>
</p>
<p>endereço/cidade:<br>
<label for="endereco"></label>
<input name="endereco" size="100" type="text" id="endereco" maxlength="50" />
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
<p>ativo:<br>
<select name="ativo" id="ativo">
      <option value="1">Ativos</option>
      <option value="0">Inativos</option>
      <option value="2">Todos</option>
</select>
</p>

<p>
<input type="submit" name="procurar_fornecedor" id="procurar_fornecedor" value="Procurar" />
<input type="reset" value="Limpar Campos">
</p>
</form><hr size="1">
</div>



<?php 
if(isset($_POST["procurar_fornecedor"])){
	$lista = $fornecedor->procurar();
}else{
	$lista = Fornecedor::listar();
}
	
if(isset($lista)){ 
	if(mysql_num_rows($lista)){ 
?>
<table id="tabela" class="tablesorter" width='100%'><thead>
	<tr><th >cnpj</th><th >razao social</th><th >endereco</th><th >telefone</th><th >email</th><th>ramo</th><th>ativo</th><th align="center" >op&ccedil;&otilde;es</th></tr></thead> 
	<tbody><?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_cnpj'] ?></td>
		<td><?php echo substr($linha['nm_razao_soc'],0,20); if(strlen($linha['nm_razao_soc']) > 20){ echo "...";} ?></td>
		<td><?php echo substr($linha['nm_endereco'],0,30); if(strlen($linha['nm_endereco']) > 30){ echo "...";} ?></td>
		<td><?php echo $linha['nm_telefone'] ?></td>
        <td><?php echo $linha['nm_email'] ?></td>
        <td><?php echo $linha['nm_ramo_ativ'] ?></td>
		<td><?php if($linha['cd_ativo_fornecedor']==1){echo "Sim";}else{ echo "Não";} ?></td>
		<td align="center"><a href="fornecedor_editar.php?cnpj=<?php echo $linha['cd_cnpj']?>"> <img border=0 src="imagens/icone_alterar.png"></a><a href="fornecedor_desativar.php?cnpj=<?php echo $linha['cd_cnpj']?>"><img src="imagens/icone_desativar.png" border=0></a></td>
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

