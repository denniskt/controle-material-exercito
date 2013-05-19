<?php

//INICIALIZA A SESSÃO
session_start();

//VERIFICA SE FOI ESCOLHIDA A OPÇÃO PARA FECHA O PEDIDO
if($_POST[opc_enviar]) {

//RECEBE OS DADOS DO FORMULÁRIO
$v_nome = $_POST[txtNome];
$v_end = $_POST[txtEndereco];
$v_email = $_POST[txtEmail];
$v_produtos = $_POST[v_produtos];
$v_total = number_format($_POST[v_total],2,',','.');

//EMAIL DO ADMINISTRADOR QUE VAI RECEBER O PEDIDO
$email_dest = "publiqueseuemailaqui@gmail.com";

//PREPARA O PEDIDO
$mensagem = "<center><table width='500' border='0' cellspacing='1' cellpadding='4' bgcolor='#4a66a3'>
<tr>
    <td bgcolor='white' valign='top'>
       <link rel='important stylesheet' href='chrome://messenger/skin/messageBody.css'>
       <style type='text/css' media='screen'>
       <!-- td { color: #069; font-size: 8pt; font-family: Arial, Verdana, Arial, Helvetica, sans-serif } --></style><br>
        <p align='justify'>Prezado Administrador,<br><br>
          Recebemos através do site o pedido de compra abaixo descrito:<br><br>

          <b>DADOS DA COMPRA:</b><BR>


          <b>Produto:</b> $v_produtos<br>
          <b>Quantidade:</b> <?php echo $_SESSION[cesta][$indice][QTDE]<br>
          <b>Total a Pagar:</b> $v_total<br><br>

          <b>DADOS PARA ENTREGA:</b><BR>
          <b>Nome:</b> $v_nome<br>
          <b>Endereço:</b> $v_end<br>
          <b>Email:</b> $v_email<br>

          <p> <font color='#076DB8'>Atenciosamente,<br>

        <br>

        <b>Departamento Comercial</b><br>
        Nome do Seu site</font>
      <br>
      <b><font color='#7694CB' size='1' face='Verdana, Arial, Helvetica, sans-serif'>:: Politica de Privacidade::<br></font></b>
      <font color='#7694CB' size='1' face='Verdana, Arial, Helvetica, sans-serif'>O envio e recebimento de nossas mensagens procura estar alinhado com o C&oacute;digo de &Eacute;tica Anti-SPAM que objetiva reger e orientar a comunica&ccedil;&atilde;o institucional, comercial e publicit&aacute;ria enviada sob a forma de mensagens eletr&ocirc;nicas.</font>
      <br>
      <hr size='1'>
       <font size='1' face='Verdana, Arial, Helvetica, sans-serif'>
       Temos a forte convic&ccedil;&atilde;o de que a rela&ccedil;&atilde;o entre cliente e empresa deve ser marcada pelo conceito de parceria, fortalecendo o v&iacute;nculo estabelecido em bases de
       confian&ccedil;a e apoio m&uacute;tuo.</font></td>
       </tr></table></center>";

	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";// More headers
	$headers .= "From: $v_email" . "\r\n"; // 'From: $email_dest' . "\r\n";

mail("$email_dest", "Pedido: Nome do Seu Site", "$mensagem", "$headers");



if (mail){

	   //ELIMINA TODAS AS VARIÁVEIS DA SESSÃO
       $_SESSION = array();

	   //DESTRÓI A SESSÃO PARA GARANTIR
       @session_destroy();

?>




<script language="JavaScript">
<!--
alert("PARABÉNS!!\n\nO seu pedido foi enviado com sucesso.");
window.location.href = "index.php";
//-->
</script>
<?php
}//FECHA IF(envia)
else {?>
&lt;script language="JavaScript">
<!--
alert("ERRO!!\n\nAconteceu algum problema.\n\nPor favor, tente novamente...");
window.location.href = "index.php";
//-->
</script>
<?php
}//FECHA ELSE (envia)
}//FECHA IF

?>


<html>
<head>
<title>.:: WebMaster.PT :: Carrinho de Compras Personalizado ::.</title>
<style type="text/css">
<!--
body {
margin-left: 0px;
margin-top: 0px;
margin-right: 0px;
margin-bottom: 0px;
}
.style2 {
color: #000000;
font-weight: bold;
}
.style5 {
color: #FFFFFF;
font-weight: bold;
}
-->
</style>

<script language="JavaScript">
<!--
function finaliza() {
if(confirm('Deseja mesmo efetivar esse pedido ?'))
return true;
else return false;
}//FECHA FUNCTION
//-->
</script>

</head>

<body>
<table width="773" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><br><br>

<br><br>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td><font size="2" face="Arial">Fechamento do pedido de compras: </font></td>
</tr>
</table>

<br>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr bgcolor="#0099CC">
<td width="10%"><span class="style2">Qtde</span></td>
<td width="53%"><span class="style2">Produto</span></td>
<td width="19%"><span class="style2">Valor</span></td>
<td width="18%"><span class="style2">Subtotal</span></td>
</tr>

<?php
//PEGA A CHAVE
$chave_cesta = array_keys($_SESSION[cesta]);

//EXIBE OS PRODUTOS DA CESTA
for($i=0; $i<sizeof($chave_cesta); $i++) {
$indice = $chave_cesta[$i];

//ATRIBUI CONTEUDO A VAR QUE VAI SER USADO NO EMAIL
$v_produtos .= $_SESSION[cesta][$indice][QTDE]." - ".$_SESSION[cesta][$indice][ARTISTA]." ".$_SESSION[cesta][$indice][ALBUM]." - ".$_SESSION[cesta][$indice][preço]."\n";

//SUBTOTAIS DE CADA PRODUTO
$subtotal = $_SESSION[cesta][$indice][QTDE] * $_SESSION[cesta][$indice][preço];

//TOTAL GERAL
$total += $subtotal;
?>
<tr>
<td height="25"><font face='Arial' size='2'><?php echo $_SESSION[cesta][$indice][QTDE]; ?></font></td>
<td height="25"><font face='Arial' size='2'><?php echo $_SESSION[cesta][$indice][ARTISTA]; ?> - <?php echo $_SESSION[cesta][$indice][ALBUM]; ?></font></td>
<td height="25"><font face='Arial' size='2'>R$ <?php echo $_SESSION[cesta][$indice][preço]; ?></font></td>
<td width="18%" height="25"><font face='Arial' size='2'> R$ <?php echo number_format($subtotal,2,',','.'); ?></font></td>
</tr>
<?php
}//FECHA FOR ?>
<tr>
<td height="25" colspan="2"> </td>
<td height="25" bgcolor="#FF0000"><span class="style5"> Total à pagar: </span></td>
<td height="25" bgcolor="#FFF0F0" class="style2"> R$ <b><?php echo number_format($total,2,',','.'); ?></b></td>
</tr>
</table>

<form name="frmFinalizar" method="post" onSubmit="return finaliza();">
<input type="hidden" name="opc_enviar" value="1">
<input type="hidden" name="v_produtos" value="<?php echo $v_produtos; ?>">
<input type="hidden" name="v_total" value="<?php echo $total; ?>">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td bgcolor="#FFCC99" class="style2"><div align="center">Dados Pessoais</div></td>
</tr>
</table>

<br>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="11%" height="25"><font face="Arial" size="2">Nome:</font></td>
<td height="25" colspan="3"><font face="Arial" size="2">
<input name="txtNome" type="text" size="50" maxlength="50"></font></td>
</tr>

<tr>
<td height="25"><font face="Arial" size="2">Endereço:</font></td>
<td width="45%" height="25"><font face="Arial" size="2">
<input name="txtEndereco" type="text" size="40" maxlength="80"></font></td>
<td width="8%" height="25"><font face="Arial" size="2">Email:</font></td>
<td width="36%" height="25"><input name="txtEmail" type="text" size="40" maxlength="45"></td>
</tr>

<tr valign="bottom">
<td height="50" colspan="4"><div align="center">
<input name="btnEnviar" type="submit" value="Confirmar o pedido de compras >>"></div></td>
</tr>
</table>
</form>

<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="47%" align='center'><font face='Arial' size='2'><a href="index.php"><< Página inicial </a></font></td>
<td width="53%" align='center'><font face='Arial' size='2'><a href="carrinho.php"><< Carrinho de compras</a></font> </td>
</tr>
</table><br></td>
</tr>

</table>
</body>
</html>
