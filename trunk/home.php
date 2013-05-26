<?php $permiteacesso=2; 
include("_header.php");
require_once("classes/solicitacao.class.php"); ?>
<title>SISCMEX</title>
</header>

<body>
<div class="conteudo">

<?php if($_SESSION['nivel']<=1) { //  if home do adm e alm?>

<!--HOME SOLICITAÇÕES PENDENTES-->

<h2><?php echo mysql_num_rows(Solicitacao::lista_qt_pendentes()); ?> NOVAS SOLICITAÇÕES
<br>ÚLTIMAS 5 SOLICITAÇÕES PENDENTES:</h2>
<button id="botao_switch_pendentes">Exibir/Ocultar</button>
<script>
$("#botao_switch_pendentes").click(function () {
$("#lista_pendentes").toggle();
});
</script>
<button onClick="location.href='./solicitacao_pendente.php'">Ver Todas Solicitações Pendentes</button>
<div id="lista_pendentes">
<hr size="1">
	<table id="tabela_home_lista_pendente" width='100%'>
	<tr><th >nr solicitaçao</th><th >data da solicitaçao</th><th >solicitante</th><th >setor</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
	<?php
	$lista = Solicitacao::lista_pendentes();
	while($linha = mysql_fetch_array($lista)){ 
	?>
	 <tr>
		<td width='10%'><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
		<td width='15%'><?php echo $linha['nm_usuario'] ?></td>
        <td width='15%'><?php echo $linha['nm_setor'] ?></td>
		<td align="center" width='25%'><a href='solicitacao_visualizar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_visualizar.png"></a> <a href='solicitacao_aprovar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_aprovar.png" ></a> <a href='solicitacao_cancelar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_reaprovar.png" ></a></td> 
	  </tr></tr></tr><?php } ?><th colspan="5"></th>
    </table></div>
    
<hr size="1">

<!--HOME SOLICITAÇÕES APROVADAS-->

<h2>
<?php echo mysql_num_rows(Solicitacao::lista_qt_aprovadas()); ?> SOLICITAÇÕES APROVADAS
<br>ÚLTIMAS 5 SOLICITAÇÕES APROVADAS:</h2>
<button id="botao_switch_aprovadas">Exibir/Ocultar</button>
<script>
$("#botao_switch_aprovadas").click(function () {
$("#lista_aprovadas").toggle();
});
</script>
<button onClick="location.href='./solicitacao_aprovada.php'">Ver Todas Solicitações Aprovadas</button>
<div id="lista_aprovadas">
<hr size="1">
	<table id="tabela_home_lista_aprovadas"  width = '100%'>
	<tr><th >nr solicitaçao</th><th >data solicitação</th><th >data aprovação</th><th >solicitante</th><th >setor</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
	<?php
	$lista = Solicitacao::lista_aprovadas();
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td width='10%'><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
        <td><?php echo $linha['dt_aprovado'] ?></td>
		<td width='15%'><?php echo $linha['nm_usuario'] ?></td>
         <td width='15%'><?php echo $linha['nm_setor'] ?></td>
		<td align="center" width='25%'><a href='solicitacao_visualizar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_visualizar.png"></a> <a href='solicitacao_aprovar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_liberar.png"></a> <a href='solicitacao_cancelar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_cancelar.png" ></a></td>
	</tr>
	</tr><?php } ?><th colspan="6"></th>
</table></div>
    
<hr size="1">

<!--HOME SOLICITAÇÕES RETIRADAS-->

<h2>ÚLTIMAS 5 SOLICITAÇÕES RETIRADAS/CONCLUÍDAS:</h2>
<button id="botao_switch_retiradas">Exibir/Ocultar</button>
<script>
$("#botao_switch_retiradas").click(function () {
$("#lista_retiradas").toggle();
});
</script>
<button onClick="location.href='./solicitacao_aprovada.php'">Ver Todas Solicitações Concluídas</button>
<div id="lista_retiradas">
<hr size="1">
	<table id="tabela_home_lista_retiradas"  width = '100%'>
	<tr><th >nr solicitaçao</th><th >data solicitação</th><th >data aprovado</th><th >data retirada</th><th >solicitante</th><th >setor</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
	<?php
	$lista = Solicitacao::lista_retiradas();
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
	</tr><?php } ?><th colspan="7"></th>
</table></div>
    
<hr size="1">

<!--HOME SOLICITAÇÕES CANCELADAS-->

<h2>ÚLTIMAS 5 SOLICITAÇÕES CANCELADAS:</h2>
<button id="botao_switch_canceladas">Exibir/Ocultar</button>
<script>
$("#botao_switch_canceladas").click(function () {
$("#lista_canceladas").toggle();
});
</script>
<button onClick="location.href='./solicitacao_aprovada.php'">Ver Todas Solicitações Canceladas</button>
<div id="lista_canceladas">
<hr size="1">
	<table id="tabela_home_lista_canceladas"  width = '100%'>
	<tr><th >nr solicitaçao</th><th >data solicitação</th><th >data cancelada</th><th >motivo</th><th >solicitante</th><th >setor</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
	<?php
	$lista = Solicitacao::lista_canceladas();
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
	</tr><?php } ?><th colspan="7"></th>
</table></div>
    
<hr size="1">


<?php } // fim do home, nivel adm e alm?>

<!--HOME COMEÇO DAS MINHA SOLICITAÇÕES-->

<h2>MINHAS SOLICITAÇÕES:<br>
<?php echo mysql_num_rows(Solicitacao::lista_minhas_qt_pendentes()); ?> SOLICITAÇÕES PENDENTES<br>
<?php echo mysql_num_rows(Solicitacao::lista_minhas_qt_aprovadas()); ?> AGUARDANDO RETIRADA
</h2>
<button id="botao_switch_minhas">Exibir/Ocultar</button>
<script>
$("#botao_switch_minhas").click(function () {
$("#home_minhas_solicitacoes").toggle();
});
</script>
<button onClick="location.href='./solicitacao_aprovada.php'">Minhas Solicitações Pendentes</button>
<button onClick="location.href='./solicitacao_aprovada.php'">Minhas Solicitações Aprovadas</button>

<div id="home_minhas_solicitacoes">

<hr size="1">

<!--HOME MINHAS SOLICITAÇÕES PENDENTES-->

<div id="home_minhas_pendentes" style="float: left; width: 40%">
	<table id="tabela0" class="tablesorter0" width='95%'>
        <tr><td colspan="3" clas="td_titulo"><b>SOLICITAÇÕES PENDENTES</b></td></tr>
	<tr><th >nr solicitação</th><th >data solicitação</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
    
	<?php
	$lista = Solicitacao::lista_minhas_pendentes();
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
		<td align="center"><a href='solicitacao_visualizar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_visualizar.png"></a></td>
	</tr><?php } ?><th colspan="3"></th></table>
</div>

<!--HOME MINHAS SOLICITAÇÕES APROVADAS-->

<div ID="home_minhas_aprovadas" style="float: right; width: 60%">
	<table id="tabela0" class="tablesorter0" width='100%'>
        <tr><td colspan="4" clas="td_titulo"><b>AGUARDANDO RETIRADA</b></td></tr>
	<tr><th >nr solicitação</th><th >data solicitação</th><th >data aprovação</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
	<?php
	$lista = Solicitacao::lista_minhas_aprovadas();
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
        <td><?php echo $linha['dt_aprovado'] ?></td>
		<td align="center"><a href='solicitacao_visualizar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_visualizar.png"></a>    </td>
	</tr>
	<?php } ?><th colspan="4"></th></table>
</div></div>
<div style="clear: both"></div>
<hr size="1">

<!--HOME TODAS MINHAS SOLICITAÇÕES-->

<h2>MINHAS SOLICITAÇÕES<br>
ÚLTIMA 10 SOLICITAÇÕES REALIZADAS</h2>
<button id="botao_switch_minhas_todas">Exibir/Ocultar</button>
<script>
$("#botao_switch_minhas_todas").click(function () {
$("#home_todas_minhas_solicitacoes").toggle();
});
</script>
<button onClick="location.href='./solicitacao_aprovada.php'">Todas Minhas Solicitações</button>

<hr size="1">

<div id="home_todas_minhas_solicitacoes" style="width: 100%">
	<table id="tabela0" class="tablesorter0" width='100%'>
	<tr><th >nr solicitação</th><th >data solicitação</th><th >data aprovação</th><th >data cancelado</th><th >data retirada</th><th >status</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
	<?php
	$lista = Solicitacao::lista_todas_minhas_solicitacoes();
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
        <td><?php if($linha['dt_aprovado']== '00/00/0000 - 00h00' OR $linha['dt_aprovado']== NULL){ echo "-"; } else { echo $linha['dt_aprovado']; } ?></td>
        <td><?php if($linha['dt_cancelado']== '00/00/0000 - 00h00' OR $linha['dt_cancelado']== NULL){ echo "-"; } else { echo $linha['dt_cancelado']; } ?></td>
        <td><?php if($linha['dt_retirada']== '00/00/0000 - 00h00' OR $linha['dt_retirada']== NULL ){ echo "-"; } else { echo $linha['dt_retirada']; } ?></td>
        <td><?php if($linha['ic_aprovacao']==0){ echo "pendente"; }elseif($linha['ic_aprovacao']==1){ echo "aprovada"; }elseif($linha['ic_aprovacao']==2){ echo "concluido"; }elseif($linha['ic_aprovacao']==3){ echo "cancelada"; } ?></td>
		<td align="center"><a href='solicitacao_visualizar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_visualizar.png"></a></td>
	</tr><?php } ?><th colspan="7"></th>
    </table>
</div>

<p>
<?php include("_footer.php") ?>