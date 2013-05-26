<?php
require_once("classes/conexao.class.php");
require_once("classes/solicitacao.class.php");

$permiteacesso=2; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)

if(isset($_GET)){
	$codigo = ($_GET["codigo"]);
}
?>

<?php include("_header.php")?>
<header>
<title>SISCMEX - Solicita��o/Visualizar</title>

</header>
<div class="conteudo">

<body>
<h1>Solicita��o/Visualizar</h1>
<p>
  <input type=button onClick="location.href='./home.php'" value="< Voltar">
  <button id="botao_procurar">Procurar</button>
<hr size="1">
</p>

<script>
$("#botao_procurar").click(function () {
$("#form_procurar").toggle();

});
</script>
<p>

<div id="form_procurar" style="display: none">
</script>
<p>
<?php if(isset($msg)){ echo "<h3>$msg</h3>"; }?>
<script type="text/javascript">
$(document).ready(function(){
$("#form_procurar_solicitacao").validate({
	rules: {
� � 	codigo: {
			number: true,
			}
		},
	messages: {
� � 	codigo: {
			number: " Digite somente n�meros",
			}
		}
});
});
</script>
<h2>Procurar Solicita��o</h2>
<form id="form_procurar_solicitacao" name="form_procurar_solicitacao" method="post" action="">
<p>numero da solicita��o (protocolo)*:<br>
<label for="codigo"></label>
<input name="codigo" type="text" id="codigo" maxlength="11" />
</p>
<p>solicitante:<br>
<label for="unidade"></label>
<input name="unidade" type="text" id="unidade" maxlength="5" />
</p>
<p>setor:
<br>
<label for="tipo"></label>
<input name="tipo" type="text" id="tipo" maxlength="10" />
</p>
<p>status da solicita��o:<br>
<select name="ativo" id="ativo">
	  <option value="2">Conclu�das</option>
      <option value="1">Pendentes</option>
      <option value="0">Aprovadas</option>
      <option value="2">Canceladas</option>
      <option value="2">Todas</option>
</select>
</p>
<p>
<input type="submit" name="procurar_solicitacao" id="procurar_solicitacao" value="Procurar" />
<input type="reset" value="Limpar Campos">
</p>
</form><hr size="1">
</div>



<?php 
if(isset($_POST["procurar_solicitacao"])){
;
}else{
;
}
?>
<form id="form_solicitacao" name="form_solicitacao" method="post" action="">
<?php 
	$lista = Solicitacao::visualizar($codigo);
	while($linha = mysql_fetch_array($lista)){ 
	$nivel_botoes = $linha['ic_aprovacao']; ?>
    <h2>SOLICITA��O NR: <?php echo $linha['cd_solicitacao'] ?><br>
    STATUS ATUAL: <?php if($linha['ic_aprovacao']==0){ echo "PENDENTE"; }elseif($linha['ic_aprovacao']==1){ echo "APROVADA"; }elseif($linha['ic_aprovacao']==2){ echo "CONCLU�DA"; }elseif($linha['ic_aprovacao']==3){ echo "CANCELADO"; } ?></h2>
    <?php if($linha['ic_aprovacao']==3){ echo "MOTIVO DO CANCELAMENTO: ".$linha['ds_cancelamento']; } ?>
    <p>
    <table width='100%'>
    <tr><td colspan="6">ETAPAS E DATAS DO PROCESSO DE SOLICITA��O:</td></tr><tr>
    <td bgcolor="#D7D700">1</td>
    <td width="33%">DATA SOLICITA��O: <?php echo $linha['dt_solicitacao'] ?></td>
    <td bgcolor="<?php if($linha['dt_aprovado']== '00/00/0000 - 00h00' OR $linha['dt_aprovado']== NULL){ echo '#666666'; } else { echo '#009900';} ?>">2</td>
    <td width="33%">DATA APROVA��O: <?php echo $linha['dt_aprovado'] ?></td>
    <td bgcolor="<?php if($linha['ic_aprovacao']==2){ echo '#009900'; } elseif($linha['ic_aprovacao']==3) { echo '#FF0000';} else { echo '#666666';} ?>">3</td>
    <td width="34%"><?php if($linha['ic_aprovacao']==3){ echo 'DATA CANCELAMENTO: '.$linha['dt_cancelado']; } else{ echo 'DATA RETIRADA: '.$linha['dt_retirada'];}  ?></td>
    </table>
    <p>
    SOLICITANTE: <?php echo $linha['nm_usuario'] ?><br>
    SETOR: <?php echo $linha['nm_setor'] ?></p>
	<?php } ?><table id="tabela0" class="tablesorter0" width='100%'>
         <tr><td colspan="8" clas="td_titulo">MATERIAL SOLICITADO</td></tr> 
        <tr><th >item</th><th >c�digo</th><th >tipo</th><th >material</th><th >descricao</th><th >qtde solicitado</th><th >qtde dispon�vel</th><th >unidade</th></tr>  
	<?php
    $i = 0;
	$lista = Solicitacao::visualizar_lista_material($codigo);
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo ++$i ?></td>
		<td><?php echo $linha['cd_material'] ?></td>
		<td><?php echo $linha['sg_tipo_material'] ?></td>
		<td><?php echo $linha['nm_material'] ?></td>
		<td><?php echo $linha['nm_descricao'] ?></td>
		<td><?php echo $linha['qt_solicitado']; 
		if($linha['qt_solicitado']<$linha['sg_unidade_med']) { ?>
        <img border=0 src="imagens/saldo_ok.png" ><?php }else{?>
        <img border=0 src="imagens/saldo_insuficiente.png" <?php } ?>></td>
        <td><?php echo $linha['qt_material'] ?></td>
		<td><?php echo $linha['sg_unidade_med'] ?></td>
        <?php 
		if(isset($_POST["solicitacao_aprovar"])){	
    	Solicitacao::liberar($codigo); }
		?>
	</tr>
	<?php }  ?><th colspan="8"></th></table>
    
<p align="right">
<?php if($_SESSION['nivel']<=1 AND $nivel_botoes==0) { //VERIFICA BOTOES DE ACORDO COM O NIVEL?>
<input type="submit" name="solicitacao_aprovar" id="solicitacao_aprovar" value="Aprovar" />
<?php }; if($_SESSION['nivel']<=1 AND  $nivel_botoes==1) { //VERIFICA BOTOES DE ACORDO COM O NIVEL?>
<input type="submit" name="solicitacao_liberar" id="solicitacao_liberar" value="Liberar" />
<?php }; if($_SESSION['nivel']<=2 AND  $nivel_botoes<=1) { //VERIFICA BOTOES DE ACORDO COM O NIVEL?>
<input type="submit" name="solicitacao_cancelar" id="solicitacao_cancelar" value="Cancelar" />
<?php };

if(isset($_POST["solicitacao_liberar"])){	
    Solicitacao::liberar($codigo);
}
if(isset($_POST["solicitacao_cancelar"])){	
    $sql = "UPDATE solicitacao SET ic_aprovacao = 2, dt_retirada = SYSDATE() WHERE cd_solicitacao = $codigo";
	Conexao::executar($sql);
	$msg = "Aprovado!!!!!!";
}

?>

</form>
</p>
    
  </diV>
  <?php include("_footer.php"); ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

