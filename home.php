<?php $permiteacesso=2; 
include("_header.php");
require_once("classes/solicitacao.class.php"); ?>
<title>SISCMEX</title>
</header>

<body>
<div class="conteudo">

<?php if($_SESSION['nivel']<=1) { //  if home do adm e alm?>

<!--HOME SOLICITA��ES PENDENTES-->

<h2><?php echo mysql_num_rows(Solicitacao::lista_qt_pendentes()); ?> NOVAS SOLICITA��ES
<br>�LTIMAS 5 SOLICITA��ES PENDENTES:</h2>
<button id="botao_switch_pendentes">Exibir/Ocultar</button>
<script>
$("#botao_switch_pendentes").click(function () {
$("#lista_pendentes").toggle();
});
</script>
<button onClick="location.href='./solicitacao_pendente.php'">Ver Todas Solicita��es Pendentes</button>
<div id="lista_pendentes">
<hr size="1">
	<table id="tabela_home_lista_pendente" width='100%'>
	<tr><th >nr solicita�ao</th><th >data da solicita�ao</th><th >solicitante</th><th >setor</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
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

<!--HOME SOLICITA��ES APROVADAS-->

<h2>
<?php echo mysql_num_rows(Solicitacao::lista_qt_aprovadas()); ?> SOLICITA��ES APROVADAS
<br>�LTIMAS 5 SOLICITA��ES APROVADAS:</h2>
<button id="botao_switch_aprovadas">Exibir/Ocultar</button>
<script>
$("#botao_switch_aprovadas").click(function () {
$("#lista_aprovadas").toggle();
});
</script>
<button onClick="location.href='./solicitacao_aprovada.php'">Ver Todas Solicita��es Aprovadas</button>
<div id="lista_aprovadas">
<hr size="1">
	<table id="tabela_home_lista_aprovadas"  width = '100%'>
	<tr><th >nr solicita�ao</th><th >data solicita��o</th><th >data aprova��o</th><th >solicitante</th><th >setor</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
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

<!--HOME SOLICITA��ES RETIRADAS-->

<h2>�LTIMAS 5 SOLICITA��ES RETIRADAS/CONCLU�DAS:</h2>
<button id="botao_switch_retiradas">Exibir/Ocultar</button>
<script>
$("#botao_switch_retiradas").click(function () {
$("#lista_retiradas").toggle();
});
</script>
<button onClick="location.href='./solicitacao_aprovada.php'">Ver Todas Solicita��es Conclu�das</button>
<div id="lista_retiradas">
<hr size="1">
	<table id="tabela_home_lista_retiradas"  width = '100%'>
	<tr><th >nr solicita�ao</th><th >data solicita��o</th><th >data aprovado</th><th >data retirada</th><th >solicitante</th><th >setor</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
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

<!--HOME SOLICITA��ES CANCELADAS-->

<h2>�LTIMAS 5 SOLICITA��ES CANCELADAS:</h2>
<button id="botao_switch_canceladas">Exibir/Ocultar</button>
<script>
$("#botao_switch_canceladas").click(function () {
$("#lista_canceladas").toggle();
});
</script>
<button onClick="location.href='./solicitacao_aprovada.php'">Ver Todas Solicita��es Canceladas</button>
<div id="lista_canceladas">
<hr size="1">
	<table id="tabela_home_lista_canceladas"  width = '100%'>
	<tr><th >nr solicita�ao</th><th >data solicita��o</th><th >data cancelada</th><th >motivo</th><th >solicitante</th><th >setor</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
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

<!--HOME COME�O DAS MINHA SOLICITA��ES-->

<h2>MINHAS SOLICITA��ES:<br>
<?php echo mysql_num_rows(Solicitacao::lista_minhas_qt_pendentes()); ?> SOLICITA��ES PENDENTES<br>
<?php echo mysql_num_rows(Solicitacao::lista_minhas_qt_aprovadas()); ?> AGUARDANDO RETIRADA
</h2>
<button id="botao_switch_minhas">Exibir/Ocultar</button>
<script>
$("#botao_switch_minhas").click(function () {
$("#home_minhas_solicitacoes").toggle();
});
</script>
<button onClick="location.href='./solicitacao_aprovada.php'">Minhas Solicita��es Pendentes</button>
<button onClick="location.href='./solicitacao_aprovada.php'">Minhas Solicita��es Aprovadas</button>

<div id="home_minhas_solicitacoes">

<hr size="1">

<!--HOME MINHAS SOLICITA��ES PENDENTES-->

<div id="home_minhas_pendentes" style="float: left; width: 40%">
	<table id="tabela0" class="tablesorter0" width='95%'>
        <tr><td colspan="3" clas="td_titulo"><b>SOLICITA��ES PENDENTES</b></td></tr>
	<tr><th >nr solicita��o</th><th >data solicita��o</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
    
	<?php
	$lista = Solicitacao::lista_minhas_pendentes();
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
		<td align="center"><a href='solicitacao_visualizar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_visualizar.png"></a></td>
	</tr><?php } ?><th colspan="3"></th></table>
</div>

<!--HOME MINHAS SOLICITA��ES APROVADAS-->

<div ID="home_minhas_aprovadas" style="float: right; width: 60%">
	<table id="tabela0" class="tablesorter0" width='100%'>
        <tr><td colspan="4" clas="td_titulo"><b>AGUARDANDO RETIRADA</b></td></tr>
	<tr><th >nr solicita��o</th><th >data solicita��o</th><th >data aprova��o</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
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

<!--HOME TODAS MINHAS SOLICITA��ES-->

<h2>MINHAS SOLICITA��ES<br>
�LTIMA 10 SOLICITA��ES REALIZADAS</h2>
<button id="botao_switch_minhas_todas">Exibir/Ocultar</button>
<script>
$("#botao_switch_minhas_todas").click(function () {
$("#home_todas_minhas_solicitacoes").toggle();
});
</script>
<button onClick="location.href='./solicitacao_aprovada.php'">Todas Minhas Solicita��es</button>

<hr size="1">

<div id="home_todas_minhas_solicitacoes" style="width: 100%">
	<table id="tabela0" class="tablesorter0" width='100%'>
	<tr><th >nr solicita��o</th><th >data solicita��o</th><th >data aprova��o</th><th >data cancelado</th><th >data retirada</th><th >status</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
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