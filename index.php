<?php session_start() ?><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"text/css" 
</head>

<link type="text/css" rel="stylesheet" href="_style.css" />
<body>
 <p>&nbsp;</p>
 <p>SISCOMEX - Sistema de Controle de Material do Ex&eacute;rcito
 </p>
<form id="login" name="login" method="post" action="usuario_validar.php">
  <p>
    <label for="identidade"></label>
  </p>
  <h1>LOGIN</h1>
  <p>&nbsp;</p>
  <p>Usu&aacute;rio
    <input type="text" name="identidade" id="identidade" />
  </p>
  <p>Senha 
    <label for="senha"></label>
    <input type="text" name="senha" id="senha" />
  </p>
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
</body>
</html>