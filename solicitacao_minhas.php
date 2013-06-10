<?php
mb_http_input("iso-8859-1");
mb_http_output("iso-8859-1");
?>
<?php
require_once("classes/solicitacao.class.php");

$permiteacesso=2; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)

if(isset($_GET['lista'])){
	$tipo = $_GET['lista'];
} ?>

<?php include("_header.php")?>
<header>
<title>SISCMEX - Minhas Solicitações/Listar</title>

</header>
<div class="conteudo">

<body>
<h1>Solicitação/<?php 
if($tipo==0){ echo "Pendentes"; 
}elseif($tipo==1){ echo "Aprovadas"; 
}elseif($tipo==2){ echo "Concluídas"; 
}elseif($tipo==3){ echo "Canceladas"; 
}elseif(isset($_POST['procurar'])){ echo "Procurar"; 
}else{ echo "Todas"; } ?></h1>
<p>
  <input type="button" onClick="JavaScript: window.history.back();" value="< Voltar">
  <button id="botao_procurar">Procurar</button>
<hr size="1">
</p>

<script>
$("#botao_procurar").click(function () {
$("#form_procurar").toggle();

});
</script>

<div id="form_procurar" style="display: none">
</script>
<p>
<script type="text/javascript">
$(document).ready(function(){
$("#form_procurar_solicitacao").validate({
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
<h2>Procurar Minha Solicitação</h2>
<form id="form_procurar_solicitacao" name="form_procurar_solicitacao" method="post" action="">
<p>código (digite somente números):<br>
<input name="codigo" type="text" id="codigo" maxlength="11" />
</p>
<p>solicitante:<br>
<input name="solicitante" type="text" id="solicitante" maxlength="30" />
</p>
<p>setor:<br>
<input name="setor" type="text" id="setor" maxlength="30" />
</p>
<p>status:<br>
<select name="status" id="status">
	<option value="4">Todos</option>
    <option value="0">Pendentes</option>
    <option value="1">Aprovados</option>
    <option value="2">Concluídos</option>
    <option value="3">Cancelados</option>
</select>
</p>
<p>
<input type="submit" name="procurar" id="procurar" value="Procurar" />
<input type="reset" value="Limpar Campos">
</p>
</form><hr size="1">
</div>



<?php 
if(isset($_POST["procurar"])){
	$lista = Solicitacao::procurar($_POST["codigo"],$_POST["solicitante"],$_POST["setor"],$_POST["status"],$_SESSION["identidade"]);
	$tipo = 4;
}else{
	$lista = Solicitacao::lista_todas_minhas($tipo,$_SESSION["identidade"]);
}
	
if(isset($lista)){
	if(mysql_num_rows($lista)){ 
	
if($tipo==0){ ?>

<table id="tabela" class="tablesorter" width='100%'><thead>
	<tr><th >nr solicitação</th><th >data da solicitação</th><th >solicitante</th><th >setor</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
	</thead><tbody><?php
	while($linha = mysql_fetch_array($lista)){ 
	?>
	 <tr>
		<td width='10%'><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
		<td width='15%'><?php echo $linha['nm_usuario'] ?></td>
        <td width='15%'><?php echo $linha['nm_setor'] ?></td>
		<td align="center" width='25%'><a href='solicitacao_visualizar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_visualizar.png"></a><?php if($_SESSION['nivel'] <=1){ ?><a href='solicitacao_visualizar.php?acao=aprovar&codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_aprovar.png" ></a> <a href='solicitacao_visualizar.php?acao=cancelar&codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_reaprovar.png" ></a><?php } ?></td> 
	  </tr></tr></tr><?php } ?><th colspan="5"></th></thead></tbody>
</table>
    
<?php }elseif($tipo==1){ ?>

<table id="tabela" class="tablesorter" width='100%'><thead>
	<tr><th >nr solicitaçao</th><th >data solicitação</th><th >data aprovação</th><th >solicitante</th><th >setor</th><th align="center" >op&ccedil;&otilde;es</th></tr> </thead><tbody>
	<?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td width='10%'><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
        <td><?php echo $linha['dt_aprovado'] ?></td>
		<td width='15%'><?php echo $linha['nm_usuario'] ?></td>
         <td width='15%'><?php echo $linha['nm_setor'] ?></td>
		<td align="center" width='25%'><a href='solicitacao_visualizar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_visualizar.png"></a> <?php if($_SESSION['nivel'] <=1){ ?><a href='solicitacao_visualizar.php?acao=liberar&codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_liberar.png"></a> <a href='solicitacao_visualizar.php?acao=cancelar&codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_cancelar.png" ></a><?php } ?></td>
	</tr>
	</tr><?php } ?><th colspan="6"></th></tbody>
</table>
    
<?php }elseif($tipo==2){ ?>

<table id="tabela" class="tablesorter" width='100%'><thead>
	<tr><th >nr solicitaçao</th><th >data solicitação</th><th >data aprovado</th><th >data retirada</th><th >solicitante</th><th >setor</th><th align="center" >op&ccedil;&otilde;es</th></tr></thead><tbody> 
	<?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td width='10%'><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
        <td><?php echo $linha['dt_aprovado'] ?></td>
        <td><?php echo $linha['dt_retirada'] ?></td>
		<td width='15%'><?php echo $linha['nm_usuario'] ?></td>
         <td width='15%'><?php echo $linha['nm_setor'] ?></td>
		<td align="center" width='10%'><a href='solicitacao_visualizar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_visualizar.png"></a></td>
	</tr>
	</tr><?php } ?><th colspan="7"></th></tbody>
</table>
    
<?php }elseif($tipo==3){ ?>

<table id="tabela" class="tablesorter" width='100%'><thead>
	<tr><th >nr solicitaçao</th><th >data solicitação</th><th >data cancelada</th><th >motivo</th><th >solicitante</th><th >setor</th><th align="center" >op&ccedil;&otilde;es</th></tr></thead><tbody>
	<?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td width='10%'><?php echo $linha['cd_solicitacao'] ?></td>
		<td width='12%'><?php echo $linha['dt_solicitacao'] ?></td>
        <td width='12%'><?php echo $linha['dt_cancelado'] ?></td>
        <td><?php echo $linha['ds_cancelamento'] ?></td>
		<td width='13%'><?php echo $linha['nm_usuario'] ?></td>
         <td width='13%'><?php echo $linha['nm_setor'] ?></td>
		<td align="center" width='10%'><a href='solicitacao_visualizar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_visualizar.png"></a></td>
	</tr>
	</tr><?php } ?><th colspan="7"></th></tbody>
</table>
    
<?php }else { ?>

<table id="tabela" class="tablesorter" width='100%'><thead>
	<tr><th >nr</th><th >data solicitação</th><th >data aprovação</th><th >data cancelado</th><th >data retirada</th><th >solicitante</th><th >setor</th><th >status</th><th align="center" >op&ccedil;&otilde;es</th></tr></thead><tbody>
	<?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
        <td><?php if($linha['dt_aprovado']== '00/00/0000 - 00h00' OR $linha['dt_aprovado']== NULL){ echo "-"; } else { echo $linha['dt_aprovado']; } ?></td>
        <td><?php if($linha['dt_cancelado']== '00/00/0000 - 00h00' OR $linha['dt_cancelado']== NULL){ echo "-"; } else { echo $linha['dt_cancelado']; } ?></td>
        <td><?php if($linha['dt_retirada']== '00/00/0000 - 00h00' OR $linha['dt_retirada']== NULL ){ echo "-"; } else { echo $linha['dt_retirada']; } ?></td>
        <td><?php echo $linha['nm_usuario'] ?></td>
        <td><?php echo $linha['nm_setor'] ?></td>
        <td><?php if($linha['ic_aprovacao']==0){ echo "pendente"; }elseif($linha['ic_aprovacao']==1){ echo "aprovado"; }elseif($linha['ic_aprovacao']==2){ echo "concluído"; }elseif($linha['ic_aprovacao']==3){ echo "cancelado"; } ?></td>
		<td align="center"><a href='solicitacao_visualizar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_visualizar.png"></a></td>
	</tr><?php } ?><th colspan="9"></th></tbody>
</table>
    
<?php } ?>

<?php if(mysql_num_rows($lista)>10){?>
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
<?php } ?>
<p><script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
   <?php }else{echo "<h3>Nenhum resultado encontrado!</h3>"; } }?>
</p>
</diV>
  <?php include("_footer.php"); ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

