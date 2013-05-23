<?php session_start() ?>

<script type="text/javascript" src="./js/jquery.min.js" ></script>
<script type="text/javascript" src="./js/jquery.validate.js" ></script>
<script type="text/javascript" src="./js/jquery.tablesorter.js" ></script>
<script type="text/javascript" src="./js/jquery.tablesorter.pager.js"></script>

<script type="text/javascript">
var ddmenuitem      = 0;
function jsddm_open()
{	jsddm_close();
	ddmenuitem = $(this).find('ul').eq(0).css('visibility', 'visible');}
function jsddm_close()
{	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}
function jsddm_timer()
{	closetimer = window.setTimeout(jsddm_close, timeout);}
$(document).ready(function()
{	$('#jsddm > li').bind('mouseover', jsddm_open);
	$('#jsddm > li').bind('mouseout',  jsddm_close);});
</script>

<script>
$(function(){
  var pagerOptions = {container: $(".pager"), };
  $("table").tablesorter({widthFixed: true,widgets: ['zebra']})
    .tablesorterPager(pagerOptions);
});
</script>

<?php if(!isset($_SESSION['nome'])){
	header("location: ./usuario_sair.php");
}
if($_SESSION['nivel'] > $permiteacesso){
	header("location: ./acessonegado.php");
}?>

<link type="text/css" rel="stylesheet" href="./css/css.css" />
<link type="text/css" rel="stylesheet" href="./css/menu.css" >

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<div class="_headerF">
<div class="_header" style="float: left; width: 300px"><a href="./home.php"><img src="./imagens/home_logo.png" alt="SISCMEX" border=0/></a></div>
<div class="_header_id" style="float: right; width: 300px"><b><img src="imagens/icone_identidade.png" alt="identidade" /><?php echo $_SESSION['guerra']?></b> [<?php echo $_SESSION['nivelT']; ?>] - <a href="usuario_sair.php">Sair</a></div></div>
<div style="clear: both"></div>
<div id="menu_">
<ul id="jsddm">
	<li><a href="./home.php"><img src="./imagens/menu_home.png" alt="SISCMEX" border=0/>Home</a></li>
	<?php if($_SESSION['nivel'] <=1){ ?>
    <li><a href="#">Cadastro</a>
		<ul>
			<li><a href='usuario.php'>Usuário</a></li>
         	<li><a href='setor.php'>Setor</a></li>
         	<li><a href='fornecedor.php'>Fornecedor</a></li>
         	<li><a href='material.php'>Material</a></li>
		</ul>
	</li> <?php } ?>
	<li><a href='#'>Solicitações</a>
		<ul>
        	<li><a href='solicitacao.php'>Nova Solicitação</a></li>
			<li><a href=#>Minhas Solicitações</a></li>
			<li><a href="#">Aprovadas</a></li>
			<li><a href="#">Pendentes</a></li>
			<li><a href="#">Desativar</a></li>
			<li><a href="#">Procurar</a></li>
		</ul>
	</li>
	<li><a href="#">Entrada/Saída</a>
		<ul>
			<li><a href='entrada.php'>Entrada de Material</a></li>
			<li><a href="#">Saída de Material</a></li>
		</ul>
	</li><?php if($_SESSION['nivel'] <=1){ ?>
	<li><a href="#">Relatórios</a></li><?php } ?>
</ul>
</div>

<div class="menu"  style="width:800px">

</div>