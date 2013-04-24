<?php session_start() ?>
<link type="text/css" rel="stylesheet" href="_style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<div class="header">Bem Vindo <b><?php echo $_SESSION['guerra']?></b> ao SISCOMEX | Minha Solicitações | <a href="usuario_sair.php">Sair</a> </div>
<div class="menu">
  <p>Dados da Sess&atilde;o</p>
  <p>nome guerra: <?php echo $_SESSION['guerra']?><Br />
identidade: <?php echo $_SESSION['identidade']?><Br />
nome: <?php echo $_SESSION['nome']?><Br />
nivel: <?php echo $_SESSION['nivel']?></p>
  <hr />
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