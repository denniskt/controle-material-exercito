<?php session_start() ?>
<script type="text/javascript" src="./js/jquery.min.js" ></script>
<script type="text/javascript" src="./js/jquery.validate.js" ></script>
<link type="text/css" rel="stylesheet" href="_style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<div class="header"><a href="./home.php"><img src="imagens/home_logo.png" width="286" height="40" alt="SISCMEX" /><br />
</a>Bem Vindo <b><b><?php echo $_SESSION['guerra']?></b></b> ao SISCOMEX | Minha Solicitações | <a href="usuario_sair.php">Sair</a> </div>
<div class="menu">

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><a href="usuario_cadastrar.php">Cadastrar Novo Usu&aacute;rio</a></td>
      <td>Cadastrar Setor</td>
      <td>Cadastrar Fornecedor</td>
      <td>Cadastrar Material</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><a href="usuario_editar.php?id=<?php echo $_SESSION['identidade']?>">Alterar Meu Cadastro</a></td>
      <td>Alterar Cadastro Setor</td>
      <td>Alterar Cadastro Fornecedor</td>
      <td>Alterar Cadastro Material</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><a href="usuario.php">Excluir Usu&aacute;rio</a></td>
      <td>Excluir Setor</td>
      <td>Excluir Fornecedor</td>
      <td>Excluir Material</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><a href="usuario.php">Pesquisar Usu&aacute;rio</a></td>
      <td>Pesquisar Setor</td>
      <td>Pesquisar Fornecedor</td>
      <td>Pesquisar Material</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  * HEADER ADMINISTRADOR
</div>