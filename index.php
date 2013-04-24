<?php session_start() ?>
<head>
<link type="text/css" rel="stylesheet" href="_style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SISCOMEX</title>

</head>

<body>
 <p>&nbsp;</p>
 <p>SISCOMEX - Sistema de Controle de Material do Ex&eacute;rcito
 </p>
<form id="form_login" name="form_login" method="post" action="usuario_validar.php">
  <p>
    <label for="identidade"></label>
  </p>
  <h1>LOGIN  </h1>
  <p>Identidade
    <input type="text" name="identidade" id="identidade" data-required="true" data-pattern="^[0-9]+$" data-describedby="age-description" data-description="id" />
  <div id="age-description"></div></p>
  <p>Senha 
    <label for="senha"></label>
    <input type="password" name="senha" id="senha" data-required="true" data-pattern="^[0-9]+$" data-describedby="age-description" data-description="id" />
  <div id="age-description"></div></p>
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
<p>&nbsp;</p>
<script src="./js/jquery-1.9.0.min.js"></script>
  <script src="./js/jquery-validate.js"></script>

		<script>
			$('form').validate({
				onKeyup : true,
				sendForm : false,
				eachValidField : function() {

					$(this).closest('div').removeClass('error').addClass('success');
				},
				eachInvalidField : function() {

					$(this).closest('div').removeClass('success').addClass('error');
				},
				description : {
					id : {
						required : 'Required',
						pattern : 'Pattern',
						conditional : 'Conditional',
						valid : 'Valid'
					}
				}
			});
		</script>
</body>
</html>