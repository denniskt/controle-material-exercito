<?php 
if(!isset($_SESSION['nome'])){
	header("location:./usuario_sair.php");
}

if($_SESSION['nivel'] > $permiteacesso){
	header("location:./acessonegado.php");
}
?>
</div>
</body>
<div class="footer">Fim da p&aacute;gina</div>
</html>