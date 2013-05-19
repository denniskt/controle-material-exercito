<?php $permiteacesso=2; 
include("_header.php");
require_once("classes/conexao.class.php"); ?>
<header>
<title>SISCMEX</title>
</header>
<div class="conteudo">
<body>
<p>HOME ADMINISTRADOR</p>

<h1>Solicita&ccedil;&otilde;es Pendentes:<h1>
<?php 
$sql = "SELECT s.cd_solicitacao, s.dt_solicitacao , u.nm_usuario , st.nm_setor FROM solicitacao s , usuario u , setor st WHERE u.sg_setor = st.sg_setor AND s.cd_identidade = u.cd_identidade AND s.ic_aprovacao = 1 ORDER BY s.dt_solicitacao";
	$lista = Conexao::executar($sql);  ?>
	
	<table id="tabela0" class="tablesorter0" width='100%'>
	<tr><th >codgo</th><th >data</th><th >solicitante</th><th >setor</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
	<?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
		<td><?php echo $linha['nm_usuario'] ?></td>
        <td><?php echo $linha['nm_setor'] ?></td>
		<td align="center"><a href='solicitacao_aprovar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_editar.png"> aprovar </a> <a href='solicitacao_cancelar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/inativo.png" > cancelar</a></td>
	</tr>
	<?php } ?></table>
    
<hr size="1">

<h1>Minhas Solicitaçoes Pendentes:<h1>
<?php 
$identidade = $_SESSION['identidade'];
$sql = "SELECT cd_solicitacao, dt_solicitacao FROM solicitacao WHERE cd_identidade = $identidade ORDER BY dt_solicitacao";
	$lista = Conexao::executar($sql);  ?>
	<table id="tabela0" class="tablesorter0" width='100%'>
	<tr><th >codgo</th><th >data</th><th >solicitante</th><th >setor</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
	<?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
		<td><?php echo $linha['nm_usuario'] ?></td>
        <td><?php echo $linha['nm_setor'] ?></td>
		<td align="center"><a href='solicitacao_aprovar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_editar.png"> aprovar </a> <a href='solicitacao_cancelar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/inativo.png" > cancelar</a></td>
	</tr>
	<?php } ?></table>

<hr size="1">

<h1>Minhas Últimas 5 Solicitaçoes:<h1>
<?php 
$identidade = $_SESSION['identidade'];
$sql = "SELECT cd_solicitacao, dt_solicitacao FROM solicitacao WHERE cd_identidade = $identidade ORDER BY dt_solicitacao LIMIT 5";
	$lista = Conexao::executar($sql);  ?>
	
	<table id="tabela0" class="tablesorter0" width='100%'>
	<tr><th >codgo</th><th >data</th><th >solicitante</th><th >setor</th><th align="center" >op&ccedil;&otilde;es</th></tr> 
	<?php
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo $linha['cd_solicitacao'] ?></td>
		<td><?php echo $linha['dt_solicitacao'] ?></td>
		<td><?php echo $linha['nm_usuario'] ?></td>
        <td><?php echo $linha['nm_setor'] ?></td>
		<td align="center"><a href='solicitacao_aprovar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/icone_editar.png"> aprovar </a> <a href='solicitacao_cancelar.php?codigo=<?php echo $linha['cd_solicitacao']?>'><img border=0 src="imagens/inativo.png" > cancelar</a></td>
	</tr>
	<?php } ?></table>

<?php include("_footer.php")?>