<?php $permiteacesso=2; 
include("_header.php");
require_once("classes/conexao.class.php");
require_once("classes/solicitacao.class.php"); ?>
<title>SISCMEX</title>
</header>

<body>
<div class="conteudo">

<?php if($_SESSION['nivel']<=1) { ?>

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
		<td align="center" width='25%'><a href='solicitacao_visualizar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_visualizar.png"></a> <a href='solicitacao_aprovar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_aprovar.png" ></a> <a href='solicitacao_reaprovar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_reaprovar.png" ></a></td> 
	  </tr></tr></tr><?php } ?><th colspan="5"></th>
    </table></div>
    
<hr size="1">

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
		<td align="center" width='25%'><a href='solicitacao_aprovar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_liberar.png"></a> <a href='solicitacao_cancelar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_cancelar.png" ></a></td>
	</tr>
	</tr><?php } ?><th colspan="6"></th>
</table></div>
    
<hr size="1">
<?php } ?>



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

<div id="home_minhas_pendentes" style="float: left; width: 40%">
<?php 
$identidade = $_SESSION['identidade'];
$sql = "SELECT cd_solicitacao, DATE_FORMAT(dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao FROM solicitacao WHERE cd_identidade = $identidade ORDER BY dt_solicitacao DESC LIMIT 10";
	$lista = Conexao::executar($sql);  ?>
	<table id="tabela0" class="tablesorter0" width='95%'>
        <tr><td colspan="3" clas="td_titulo"><b>SOLICITAÇÕES PENDENTES</b></td></tr>
	<tr><th >nr solicitação</th><th >data solicitação</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
	<?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
		<td align="center"><a href='solicitacao_visualizar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_visualizar.png"></a></td>
	</tr><?php } ?><th colspan="3"></th></table>
</div>

<div ID="home_minhas_aprovadas" style="float: right; width: 60%">
<?php 
$identidade = $_SESSION['identidade'];
$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao , DATE_FORMAT(s.dt_aprovado, '%d/%m/%Y - %Hh%i') AS dt_aprovado , u.nm_usuario , st.nm_setor FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 1 ORDER BY s.dt_solicitacao DESC LIMIT 10";
	$lista = Conexao::executar($sql); ?>
	<table id="tabela0" class="tablesorter0" width='100%'>
        <tr><td colspan="4" clas="td_titulo"><b>AGUARDANDO RETIRADA</b></td></tr>
	<tr><th >nr solicitação</th><th >data solicitação</th><th >data aprovação</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
	<?php
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

<h2>MINHAS SOLICITAÇÕES<br>
ÚLTIMA 10 SOLICITAÇÕES REALIADAS</h2>
<button id="botao_switch_minhas_todas">Exibir/Ocultar</button>
<script>
$("#botao_switch_minhas_todas").click(function () {
$("#home_todas_minhas_solicitacoes").toggle();
});
</script>
<button onClick="location.href='./solicitacao_aprovada.php'">Todas Minhas Solicitações</button>

<hr size="1">

<div id="home_todas_minhas_solicitacoes" style="width: 100%">
<?php 
$identidade = $_SESSION['identidade'];
$sql = "SELECT cd_solicitacao, DATE_FORMAT(dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao, DATE_FORMAT(dt_aprovado, '%d/%m/%Y - %Hh%i') AS dt_aprovado, ic_aprovacao FROM solicitacao WHERE cd_identidade = $identidade ORDER BY dt_solicitacao DESC LIMIT 10";
	$lista = Conexao::executar($sql);  ?>
	
	<table id="tabela0" class="tablesorter0" width='100%'>
	<tr><th >nr solicitação</th><th >data solicitação</th><th >data aprovação</th><th >data retirada</th><th >status</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
	<?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
        <td><?php echo $linha['dt_aprovado'] ?></td>
        <td></td>
        <td><?php if($linha['ic_aprovacao']==0){ echo "pendente"; }elseif($linha['ic_aprovacao']==1){ echo "aprovada"; }elseif($linha['ic_aprovacao']==2){ echo "concluido"; }elseif($linha['ic_aprovacao']==4){ echo "reprovada"; }elseif($linha['ic_aprovacao']==5){ echo "cancelada"; } ?></td>
		<td align="center"><a href='solicitacao_visualizar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_visualizar.png"></a></td>
	</tr><?php } ?><th colspan="6"></th>
    </table>
</div>

<p>
<?php include("_footer.php") ?>