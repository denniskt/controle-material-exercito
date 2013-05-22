<?php $permiteacesso=2; 
include("_header.php");
require_once("classes/conexao.class.php"); ?>
<header>
<title>SISCMEX</title>
</header>
<div class="conteudo">
<body>
<?php if($_SESSION['nivel']<=1) {
$sql = "SELECT s.cd_solicitacao AS num FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 0 ORDER BY s.dt_solicitacao";
	$qtde_solicitacao_pendente = mysql_num_rows(Conexao::executar($sql));  ?>
<h2>Últimas 5 Solicita&ccedil;&otilde;es Pendentes:</h2>
<button id="botao_solicitacoes_novas">Novas Solicitações: <?php echo $qtde_solicitacao_pendente ?></button>
<button id="botao_solicitacoes_pendentes" onClick="location.href='./solicitacao_pendente.php'">Ver Todas Solicitações Pendentes</button>
<hr size="1">
<p>
<?php 
$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao , u.nm_usuario , st.nm_setor FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 0 ORDER BY s.dt_solicitacao DESC LIMIT 5";
	$lista = Conexao::executar($sql);  ?>
	
	<table id="tabela0" class="tablesorter0" width='100%'>
	<tr><th >nr solicitaçao</th><th >data da solicitaçao</th><th >solicitante</th><th >setor</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
	<?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
		<td><?php echo $linha['nm_usuario'] ?></td>
                <td><?php echo $linha['nm_setor'] ?></td>
		<td align="center"><a href='solicitacao_visualizar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_visualizar.png"></a> <a href='solicitacao_aprovar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_aprovar.png" ></a> <a href='solicitacao_reaprovar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_reaprovar.png" ></a></td> 
	</tr>
	<?php } ?></table>
    
<hr size="1">

<?php 
$sql = "SELECT s.cd_solicitacao AS num FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 1 ORDER BY s.dt_solicitacao LIMIT 5";
$qtde_solicitacao_aprovada = mysql_num_rows(Conexao::executar($sql));  ?>
<h2>Aguardando retirada:</h2>
<button id="botao_solicitacoes_aprovada">Solicitações Aprovadas: <?php echo $qtde_solicitacao_aprovada ?></button>
<button id="botao_solicitacoes_aprovadas" onClick="location.href='./solicitacao_pendente.php'">Ver Todas Solicitações Aprovadas</button>
<hr size="1">
<?php 
$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao , DATE_FORMAT(s.dt_aprovado, '%d/%m/%Y - %Hh%i') AS dt_aprovado , u.nm_usuario , st.nm_setor FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 1 ORDER BY s.dt_solicitacao LIMIT 10";
	$lista = Conexao::executar($sql);  ?>
	
	<table id="tabela0" class="tablesorter0" width='100%'>
	<tr><th >nr solicitaçao</th><th >data solicitaçao</th><th >data aprovaçao</th><th >solicitante</th><th >setor</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
	<?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
        <td><?php echo $linha['dt_aprovado'] ?></td>
		<td><?php echo $linha['nm_usuario'] ?></td>
        <td><?php echo $linha['nm_setor'] ?></td>
		<td align="center"><a href='solicitacao_aprovar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_editar.png">liberar retirada </a> <a href='solicitacao_cancelar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/inativo.png" > cancelar</a></td>
	</tr>
	<?php } ?></table>
    
<hr size="1">
<?php } ?>
<div class="home_solicitacao"><hr size="1">
<div class="home_solicitacao" style="float: left; width: 26%">
<h2>Solicitações Pendentes:<h2>
<hr size="1" align='left' width='94%'>
<?php 
$identidade = $_SESSION['identidade'];
$sql = "SELECT cd_solicitacao, DATE_FORMAT(dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao FROM solicitacao WHERE cd_identidade = $identidade ORDER BY dt_solicitacao DESC LIMIT 10";
	$lista = Conexao::executar($sql);  ?>
	<table id="tabela0" class="tablesorter0" width='95%'>
	<tr><th >nr</th><th >data solicitação</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
	<?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
		<td align="center"><a href='solicitacao_visualizar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_visualizar.png"></a></td>
	</tr>
	<?php } ?></table>
</div>

<div class="home_solicitacao" style="float: left; width: 37%">
<h2>Últimas 10 Solicitações:</h2>
<hr size="4">
<?php 
$identidade = $_SESSION['identidade'];
$sql = "SELECT cd_solicitacao, DATE_FORMAT(dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao, DATE_FORMAT(dt_aprovado, '%d/%m/%Y - %Hh%i') AS dt_aprovado FROM solicitacao WHERE cd_identidade = $identidade ORDER BY dt_solicitacao DESC LIMIT 10";
	$lista = Conexao::executar($sql);  ?>
	
	<table id="tabela0" class="tablesorter0" width='100%'>
	<tr><th >nr</th><th >data solicitação</th><th >data aprovaçao</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
	<?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
        <td><?php echo $linha['dt_aprovado'] ?></td>
		<td align="center"><a href='solicitacao_visualizar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_visualizar.png"></a></td>
	</tr>
	<?php } ?></table>
</div>

<div class="home_solicitacao" style="float: right; width: 36%">
<h2>Aguardando Retirada:<h2>
<hr size="1">
<?php 
$identidade = $_SESSION['identidade'];
$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao , DATE_FORMAT(s.dt_aprovado, '%d/%m/%Y - %Hh%i') AS dt_aprovado , u.nm_usuario , st.nm_setor FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 1 ORDER BY s.dt_solicitacao DESC LIMIT 10";
	$lista = Conexao::executar($sql); ?>
	<table id="tabela0" class="tablesorter0" width='100%'>
	<tr><th >nr</th><th >data solicitaçao</th><th >data aprovação</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
	<?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
        <td><?php echo $linha['dt_aprovado'] ?></td>
		<td align="center"><a href='solicitacao_visualizar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_visualizar.png"></a></td>
	</tr>
	<?php } ?></table>
</div></div>
<div style="clear: both"></div>


<hr size="1">



<p>
<?php include("_footer.php") ?>