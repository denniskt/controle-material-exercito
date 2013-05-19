<?php session_start(); 
$_SESSION['qtde_itens']=0;
?>
<head>
<link type="text/css" rel="stylesheet" href="css/css.css" />
<style type="text/css">
body {
	background-color: #333333;
}
#login_rodape {
	color: #999999;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SISCOMEX</title>
<script type="text/javascript" src="./js/jquery.min.js" ></script>
<script type="text/javascript" src="./js/jquery.validate.js" ></script>
<script type="text/javascript">
$(document).ready(function(){
$("#form_login").validate({
	rules: {
    	identidade: {
			required: true,
			number: true,
			minlength: 1
			},
		senha: {
			required: true,
			minlength: 1
			}
        },
	messages: {
    	identidade: {
			required: " Digite sua identidade militar",
			number: " Insira apenas números",
		},
        senha: {
			required: " Digite sua senha"
          	}
		}
});
});
</script>

</head>

<body>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
 <p>&nbsp;</p><center>
<table border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" id="login">
   <tr >
     <td  width="150px"><img src="imagens/login_logo.png" alt="siscmex" align="right"></td>
     <td valign="top"><form id="form_login" name="form_login" method="post" action="usuario_validar.php">
  <h2><br>
    LOGIN  </h2>
  <p>identidade*:<br>
    <input type="text" class="textfield" name="identidade" id="identidade" /></p>
  <p>senha*:<br>
    <input type="password" name="senha" id="senha" />
  <p><?php if(isset($_SESSION['mensagem'])){ echo $_SESSION['mensagem']; }?></p>
  <p>
    <br>
    <input name="login" type="submit" value="Login" />
  </p>
</form></td>
   </tr>
 </table></center>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
 <p align="center" id="login_rodape">SISCMEX - SISTEMA DE CONTROLE DE MATERIAL DO EX&Eacute;RCITO</p>

<p>
<p></p>
</body>
