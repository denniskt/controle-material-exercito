<?php session_start() ?>
<script type="text/javascript" src="./js/jquery.min.js" ></script>
<script type="text/javascript" src="./js/jquery.validate.js" ></script>

<link type="text/css" rel="stylesheet" href="./css/css.css" />
<link type="text/css" rel="stylesheet" href="./css/menu.css" >

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<div class="header"><a href="./home.php"><img src="./imagens/home_logo.png" alt="SISCMEX" /><br />
</a>Bem Vindo <b><b><?php echo $_SESSION['guerra']?></b></b> ao SISCOMEX | <a href="usuario_sair.php">Sair</a> </div>
<div id='cssmenu'>
<ul>
   <li><a href='./home.php'><span>Home</span></a></li>
   <li class='has-sub '><a href='#'><span>Cadastro</span></a>
      <ul>
         <li class='has-sub '><a href='#'><span>Usuário</span></a>
            <ul>
               <li><a href='./usuario_cadastrar.php'><span>Cadastrar</span></a></li>
               <li><a href='./usuario.php'><span>Alterar</span></a></li>
               <li><a href='./usuario.php'><span>Desativar</span></a></li>
               <li><a href='./usuario.php'><span>Procurar</span></a></li>
            </ul>
         </li>
         <li class='has-sub '><a href='#'><span>Setor</span></a>
            <ul>
               <li><a href='#'><span>Cadastrar</span></a></li>
               <li><a href='#'><span>Alterar</span></a></li>
               <li><a href='#'><span>Desativar</span></a></li>
               <li><a href='#'><span>Procurar</span></a></li>
            </ul>
         </li>
         <li class='has-sub '><a href='#'><span>Fornecedor</span></a>
            <ul>
               <li><a href='#'><span>Cadastrar</span></a></li>
               <li><a href='#'><span>Alterar</span></a></li>
               <li><a href='#'><span>Desativar</span></a></li>
               <li><a href='#'><span>Procurar</span></a></li>
            </ul>
         </li>
         <li class='has-sub '><a href='#'><span>Material</span></a>
            <ul>
               <li><a href='#'><span>Cadastrar</span></a></li>
               <li><a href='#'><span>Alterar</span></a></li>
               <li><a href='#'><span>Desativar</span></a></li>
               <li><a href='#'><span>Procurar</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li class='has-sub '><a href='#'><span>Solicitações</span></a>
      <ul>
         <li class='has-sub '><a href='#'><span>Minhas Solicitações</span></a>
            <ul>
               <li><a href='#'><span>Aprovadas</span></a></li>
               <li><a href='#'><span>Pendentes</span></a></li>
               <li><a href='#'><span>Desativar</span></a></li>
               <li><a href='#'><span>Procurar</span></a></li>
            </ul>
         </li>
         <li class='has-sub '><a href='#'><span>Setor</span></a>
            <ul>
               <li><a href='#'><span>Cadastrar</span></a></li>
               <li><a href='#'><span>Alterar</span></a></li>
               <li><a href='#'><span>Desativar</span></a></li>
               <li><a href='#'><span>Procurar</span></a></li>
            </ul>
         </li>
         <li class='has-sub '><a href='#'><span>Fornecedor</span></a>
            <ul>
               <li><a href='#'><span>Cadastrar</span></a></li>
               <li><a href='#'><span>Alterar</span></a></li>
               <li><a href='#'><span>Desativar</span></a></li>
               <li><a href='#'><span>Procurar</span></a></li>
            </ul>
         </li>
         <li class='has-sub '><a href='#'><span>Material</span></a>
            <ul>
               <li><a href='#'><span>Cadastrar</span></a></li>
               <li><a href='#'><span>Alterar</span></a></li>
               <li><a href='#'><span>Desativar</span></a></li>
               <li><a href='#'><span>Procurar</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li class='has-sub '><a href='#'><span>Entrada/Saída</span></a>
      <ul>
         <li class='has-sub '><a href='#'><span>Entrada de Material</span></a>
         </li>
         <li class='has-sub '><a href='#'><span>Saída de Material</span></a>
         </li>
      </ul>
   </li>
   <li><a href='#'><span>Relatórios</span></a></li>
</ul>
</div>

<div id='cssmenu'></div>

<div class="menu">

 * HEADER ADMINISTRADOR
</div>