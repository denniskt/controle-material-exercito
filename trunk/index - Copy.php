<?php session_start() ?>
<head>
<link type="text/css" rel="stylesheet" href="_style.css" />
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
			required: "Digite sua identidade militar",
			number: "Insira apenas números",
		},
        senha: {
			required: "Digite sua senha"
          	}
		}
});
});
</script>

</head>

<body>
 <p>&nbsp;</p>
 <p>SISCOMEX - Sistema de Controle de Material do Ex&eacute;rcito
 </p>
<form id="form_login" name="form_login" method="post" action="usuario_validar.php">
  <p>
  </p>
  <h1>LOGIN  </h1>
  <p>Identidade
    <input type="text" name="identidade" id="identidade" /></p>
  <p>Senha 
    <input type="password" name="senha" id="senha" />
  <p>
    <input name="login" type="submit" id="login" value="Login" />
  </p>
</form>
<p><?php if(isset($_SESSION['mensagem'])){ echo $_SESSION['mensagem']; }?></p>
<table width="300" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>Usu&aacute;rios Testes</td>
    <td>Identidade</td>
    <td>senha</td>
  </tr>
  <tr>
    <td>Administrador</td>
    <td>0</td>
    <td>0</td>
  </tr>
  <tr>
    <td>Almoxarife</td>
    <td>1</td>
    <td>1</td>
  </tr>
  <tr>
    <td>Solicitante</td>
    <td>2</td>
    <td>2</td>
  </tr>
</table>



</body>
