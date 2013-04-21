<?php session_start() ?>
<link type="text/css" rel="stylesheet" href="_style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<div class="header">Bem Vindo <b><?php echo $_SESSION['guerra']?></b> ao SISCOMEX | Minha Solicitações | Sair
</div>
<div class="menu">
nome guerra: <?php echo $_SESSION['guerra']?><Br />
identidade: <?php echo $_SESSION['identidade']?><Br />
nome: <?php echo $_SESSION['nome']?><Br />
nivel: <?php echo $_SESSION['nivel']?><Br />
  <p>Novas Solictações</p>
  <p><a href="usuario_cadastrar.php">Cadastrar Novo Usu&aacute;rio</a></p>
  <p><a href="usuario_editar.php?id=<?php echo $_SESSION['identidade']?>">Alterar Meu Cadastro</a></p>
  <p><a href="usuario.php">Excluir Usu&aacute;rio</a></p>
  <p><a href="usuario.php">Pesquisar Usu&aacute;rio</a></p>
</div>