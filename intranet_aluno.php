<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Intranet Alunos</title>
	<meta http-equiv="Content Type" content="text/html" charset="utf-8">
	<link rel="stylesheet" type="text/css" href="loc.css">
</head>
<?php
	session_start();
	if($_SESSION['login'] == ""){
		header('location:index.php');
	}
	$id = $_SESSION['id'];
?>
<!--EDIÇÃO DOS BOTÕES-->
<style type="text/css">

#btnota_id:hover {
	box-shadow: inset 0px 2px 5px gray, 0px 2px 3px gray !important;
}
#btarq_id:hover {
	box-shadow: inset 0px 2px 5px gray, 0px 2px 3px gray !important;
}
#btpass_id:hover {
	box-shadow: inset 0px 2px 5px gray, 0px 2px 3px gray !important;
}
#btsair_id:hover {
	box-shadow: inset 0px 2px 5px gray, 0px 2px 3px gray !important;
}
#foto_id:hover {
	background-image: url(addUser.png) !important;
	background-repeat: no-repeat;
	background-attachment: inerant; 
	background-size: contain;
}	
</style>

<body>
	
	<br>
	
	<h1 align="center" style="font-family: serif; color: #DDDDDD">FAEN - Faculdade de Engenharia</h1>

	<hr><br>

	<a href=""></a><!--Ancoras p/ alguns Botoes-->

	<form method="post" action="altera_foto.php?id=<?php echo $id ?>" name="foto">

	<!--BOTÃO FOTO--><?php
	require("topo.php");
	$query="SELECT `foto` FROM `aluno` where `id_aluno` = $id LIMIT 0, 1";
	$resultado = mysql_query($query, $conexao);
	while($linha=mysql_fetch_array($resultado)){
	  $senha = $linha['foto'];
	}
	
	echo "<button name='foto' type='file' id='foto_id' alt='Add Foto' style='border-radius: 50%; display: inline-block; height: 200px; width: 200px; margin: 18px; margin-bottom: -5px; margin-top: -8px; border: 14px solid lightblue; cursor: pointer; background-image: url($foto); background-repeat: no-repeat; background-attachment: inerant; background-size: contain'> </button>"?>
    </form>
		
	<fieldset>
	<div align="center">
	<p style="font-family: Colibri; box-shadow: 2px 2px 2px black; margin-left: 0px; font-size: 21px; border: 2px solid"><strong>Opções do Aluno</strong></p><br>

	<!--BOTÕES-->
	<form><!--
	<button name="btnota" id="btnota_id"> Boletim </button><br>
-->
	<button name="btarq" id="btarq_id"> Arquivos </button><br>

	<button name="btpass_id" id="btpass_id"> Alterar Senha </button><br>

	<button name="btsair_id" id="btsair_id"> Logout </button><br>
    </form>
    <?php
    	if(isset($_REQUEST['btsair_id'])){#Botao sair
			unset($_SESSION['login']);
			unset($_SESSION['id']);
			header('location:index.php');
		}
		if(isset($_REQUEST['btpass_id'])){
			header('location:alterar_senha.php?id='.$id);
		}
		
	?>
	
	</div>
	</fieldset>
	<!--</form>-->
	<fieldset>
    	<div id="arquivos" name="arquivos">
        	<?php	
				$query = "select a.fk_discipina, a.fk_aluno, d.id_disciplina, r.nome_arquivo, r.caminho
							from aula as a join disciplina as d on a.fk_discipina = d.id_disciplina
    						join arquivo as r  on d.id_disciplina = r.fk_disciplina where a.fk_aluno = $id;"
			?>
        </div>
    </fieldset>

<?php require("fim.php"); ?>
</body>
</html>
