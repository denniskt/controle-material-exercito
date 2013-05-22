<?php
require_once("classes/conexao.class.php");

$permiteacesso=1; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)

if(isset($_GET)){
	$codigo = ($_GET["codigo"]);
}
if(isset($_POST["solicitacao_aprovar"])){	
    $sql = "UPDATE solicitacao SET ic_aprovacao = 1, dt_aprovado = SYSDATE() WHERE cd_solicitacao = $codigo";
	Conexao::executar($sql);
	$msg = "Aprovado!!!!!!";
}
?>

<?php include("_header.php")?>
<header>
<title>SISCMEX - Solicitação/Aprovar</title>

</header>
<div class="conteudo">

<body>
<h1>Solicitação/Aprovar</h1>
<p>
  <input type=button onClick="location.href='./home.php'" value="< Voltar">
  <button id="botao_procurar">Aprovar</button>
<hr size="1">
<?php if(isset($msg)){ echo "<h3>$msg</h3>"; }?>
</p>
<form id="form_solicitacao_aprovar" name="form_solicitacao_aprovar" method="post" action="">
<?php 
$identidade = $_SESSION['identidade'];
$sql = "SELECT s.cd_solicitacao, DATE_FORMAT(s.dt_solicitacao, '%d/%m/%Y - %Hh%i') AS dt_solicitacao, DATE_FORMAT(s.dt_aprovado, '%d/%m/%Y - %Hh%i') AS dt_aprovado,  DATE_FORMAT(s.dt_retirada, '%d/%m/%Y - %Hh%i') AS dt_retirada, u.nm_usuario, st.nm_setor  FROM solicitacao s, usuario u, setor st WHERE cd_solicitacao = $codigo AND u.cd_identidade = s.cd_identidade AND u.sg_setor = st.sg_setor ORDER BY dt_solicitacao";
	$lista = Conexao::executar($sql);   
	while($linha = mysql_fetch_array($lista)){?>
    <p>Solicitação Nr: <?php echo $linha['cd_solicitacao'] ?><br>
    Data Solicitação: <?php echo $linha['dt_solicitacao'] ?><br>
    Data Aprovação: <?php echo $linha['dt_aprovado'] ?><br>
    Data Retirada: <?php echo $linha['dt_retirada'] ?><br>
    Solicitante: <?php echo $linha['nm_usuario'] ?><br>
    Setor: <?php echo $linha['nm_setor'] ?></p>
	<?php } ?>
        </table><table id="tabela0" class="tablesorter0" width='100%'>
        <tr><th >item</th><th >código</th><th >tipo</th><th >material</th><th >descricao</th><th >quantidade</th><th >unidade</th></tr>  
	<?php
        $i = 0;
        $sql = "SELECT i.cd_solicitacao , m.cd_material , m.sg_tipo_material , m.nm_material , m.nm_descricao , i.qt_solicitado , m.sg_unidade_med FROM item_solicitacao i , material m WHERE i.cd_material = m.cd_material AND i.cd_solicitacao = $codigo";
	$lista = Conexao::executar($sql);  
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo ++$i ?></td>
		<td><?php echo $linha['cd_material'] ?></td>
		<td><?php echo $linha['sg_tipo_material'] ?></td>
		<td><?php echo $linha['nm_material'] ?></td>
		<td><?php echo $linha['nm_descricao'] ?></td>
		<td><?php echo $linha['qt_solicitado'] ?></td>
		<td><?php echo $linha['sg_unidade_med'] ?></td>
	</tr>
	<?php } ?></table>
    <input type="submit" name="solicitacao_aprovar" id="solicitacao_aprovar" value="Aprovar" /></form>
</p>
  
    
  </diV>
  <?php include("_footer.php"); ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

