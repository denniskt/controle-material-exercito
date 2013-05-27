<?php
require_once("classes/conexao.class.php");
require_once("classes/solicitacao.class.php");

$permiteacesso=2; // nivel de permissao minimo de acesso a pagina (0 adm, 1 almox, 2 solic)
include("_header.php");

if(isset($_GET)){
	$codigo = ($_GET["codigo"]);
}

if($_SESSION['nivel']<=1){
	if(isset($_POST["aprovar"]) OR $_GET['acao']=='aprovar'){	
		Solicitacao::aprovar($codigo);
	}
	if($_SESSION['nivel']<=1 AND (isset($_POST["liberar"]) OR $_GET['acao']=='liberar')){	
		Solicitacao::liberar($codigo);
	}
}
if(isset($_POST["cancelar"])){	
	$mensagem = $_POST["mensagem"];
    Solicitacao::cancelar($codigo,$mensagem);
}

?>
<header>
<title>SISCMEX - Solicitação/Visualizar</title>

</header>
<div class="conteudo">

<body>
<h1>Solicitação/Visualizar</h1>
<p>
  <input type="button" onClick="JavaScript: window.history.back();" value="< Voltar">
  <button id="botao_procurar">Procurar</button>
<hr size="1">
</p>

<script>
$("#botao_procurar").click(function () {
$("#form_procurar").toggle();
$("#div_mensagem").toggle();

});
</script>
<p>

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
<h2>Procurar Solicitação</h2>
<form id="form_procurar_solicitacao" name="form_procurar_solicitacao" method="post" action="solicitacao_lista.php">
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
    <h2>SOLICITAÇÃO NR: <?php echo $linha['cd_solicitacao'] ?><br>
    STATUS ATUAL: <?php if($linha['ic_aprovacao']==0){ echo "PENDENTE"; }elseif($linha['ic_aprovacao']==1){ echo "APROVADA"; }elseif($linha['ic_aprovacao']==2){ echo "CONCLUÍDO"; }elseif($linha['ic_aprovacao']==3){ echo "CANCELADO"; } ?></h2>
    <?php if($linha['ic_aprovacao']==3){ echo "MOTIVO DO CANCELAMENTO: ".$linha['ds_cancelamento']; } ?>
    <p>
    <table width='100%'>
    <tr><td colspan="6">ETAPAS E DATAS DO PROCESSO DE SOLICITAÇÃO:</td></tr><tr>
    <td bgcolor="#D7D700" width="10%">1. SOLICITAÇÃO</td>
    <td width="23%"><?php echo $linha['dt_solicitacao'] ?></td>
    <td  width="10%" bgcolor="<?php if($linha['dt_aprovado']== '00/00/0000 - 00h00' OR $linha['dt_aprovado']== NULL){ echo '#CCCCCC'; } else { echo '#009900';} ?>">2. APROVAÇÃO</td>
    <td width="23%"><?php if($linha['dt_aprovado']== '00/00/0000 - 00h00' OR $linha['dt_aprovado']== NULL){ echo "-";} else {echo $linha['dt_aprovado']; }  ?></td>
    <td  width="10%" bgcolor=<?php if($linha['ic_aprovacao']==2){ echo "'#009900' >3. RETIRADA"; } elseif($linha['ic_aprovacao']==3) { 
	echo "'#FF0000' >3. CANCELADO";} else {echo "'#CCCCCC' >3. RETIRADA";} ?></td>
    <td width="24%"><?php if($linha['ic_aprovacao']==3){ 
	if($linha['dt_cancelado']== '00/00/0000 - 00h00' OR $linha['dt_cancelado']== NULL){ echo "-"; }else{ echo $linha['dt_cancelado']; }
	}else{
		if($linha['dt_retirada']== '00/00/0000 - 00h00' OR $linha['dt_retirada']== NULL){ echo "-"; }else{ echo $linha['dt_retirada']; } } ?></td>
    </table>
    <p>
    SOLICITANTE: <?php echo $linha['nm_usuario'] ?><br>
    SETOR: <?php echo $linha['nm_setor'] ?></p>
	<?php } ?><table id="tabela0" class="tablesorter0" width='100%'>
         <tr><td colspan="8" clas="td_titulo">MATERIAL SOLICITADO</td></tr> 
        <tr><th >item</th><th >código</th><th >tipo</th><th >material</th><th >descricao</th><th >qtde solicitado</th><th >qtde disponível</th><th >unidade</th></tr>  
	<?php
    $i = 0;
	$lista = Solicitacao::visualizar_lista_material($codigo);
	while($linha = mysql_fetch_array($lista)){ ?>
	 <tr>
		<td><?php echo ++$i ?></td>
		<td><?php echo $linha['cd_material'] ?></td>
		<td><?php echo $linha['sg_tipo_material'] ?></td>
		<td><?php echo $linha['nm_material'] ?></td>
		<td><?php echo substr($linha['nm_descricao'],0,40); if(strlen($linha['nm_descricao']) > 40){ echo "...";} ?></td>
		<td><?php echo $linha['qt_solicitado']; 
		if($linha['qt_solicitado']<$linha['qt_material']) { ?>
        <img border=0 src="imagens/saldo_ok.png"<?php }else{?>
        <img border=0 src="imagens/saldo_insuficiente.png" <?php } ?>></td>
        <td><?php echo $linha['qt_material'] ?></td>
		<td><?php echo $linha['sg_unidade_med'] ?></td>
	</tr>
	<?php }  ?><th colspan="8"></th></table>


<p align="right">

<?php if(isset($_POST["solicitacao_cancelar_motivo"]) OR $_GET['acao']=='cancelar'){ ?>
<?php if($_SESSION['nivel']<=2 AND  $nivel_botoes<=1) { ?>
<script type="text/javascript">
$(document).ready(function(){
$("#form_solicitacao").validate({
	rules: {
    	mensagem: {
			required: true,
			}
		},
	messages: {
    	mensagem: {
			required: "",
			}
		}
});
});
</script>

MOTIVO DO CANCELAMENTO*: 
<input name="mensagem" type="text" id="mensagem" size="100" maxlength="100" />

<input type="submit" name="cancelar" id="solicitacao_cancelar" value="Confirmar" />
<input type="BUTTON" value="Cancelar" ONCLICK="window.location.href='solicitacao_visualizar.php?codigo=<?php echo $codigo ?>'" />
<?php } } else { ?>
<?php if($_SESSION['nivel']<=1 AND $nivel_botoes==0) { //VERIFICA BOTOES DE ACORDO COM O NIVEL?>
<input type="submit" name="aprovar" id="aprovar" value="Aprovar" />
<?php } if($_SESSION['nivel']<=1 AND  $nivel_botoes==1) { ?>
<input type="submit" name="liberar" id="liberar" value="Liberar" />
<?php } if($_SESSION['nivel']<=2 AND  $nivel_botoes<=1) { ?>
<input type="submit" name="solicitacao_cancelar_motivo" id="solicitacao_cancelar_motivo" value="Cancelar" />
<?php }  } ?>

</p>
</form>

    
  </diV>
  <?php include("_footer.php"); ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

