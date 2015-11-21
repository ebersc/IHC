<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Altera Foto</title>
</head>
<body>
	<?php
		session_start();
		if($_SESSION['login'] == ""){
			header('location:index.php');
		}
		require('topo.php');
		$id = $_GET['id'];
		$query="SELECT `foto` FROM `aluno` where `id_aluno` = $id LIMIT 0, 1";
		$resultado = mysql_query($query, $conexao);/*"kenny.jpg";*/
		while($linha=mysql_fetch_array($resultado)){
		  $foto = $linha['foto'];
		}
		echo "<img src='$foto' style='width:200px; height:200px;'/>
		<br/>";		
	?>
    <form enctype="multipart/form-data" action="" method="POST">
    	<!-- MAX_FILE_SIZE deve preceder o campo input -->
<!--    	<input type="hidden" name="MAX_FILE_SIZE" value="300000" /> <!-- Descomente essa tag somente se for limitar o tamanho do arquivo em bytes-->
    	<!-- O Nome do elemento input determina o nome da array $_FILES -->
    	Nova foto: <input name="userfile" type="file" accept="image/jpeg"/>
 
        <br/><input type="date" name="data" id="data" /><br/>
    	<input type="submit" value="Salvar" name="btnSalvar" id="btnSalvar"/>
	</form>
    <?php
	if(isset($_POST['btnSalvar'])){
		$arquivo  = basename($_FILES['userfile']['name']);
		$uploaddir = 'images_users/'.$_SESSION['login'].".jpg";
			
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir) && $_FILES['userfile']['type'] == "image/jpeg") {
			echo "<script>alert('Foto alterada com sucesso enviado com sucesso.');</script>";
			header('location:intranet_aluno.php');
		} else {
			echo "<script>alert('Erro ao alterar a foto. Verifique se a imagem é um arquivo .JPG e tente novamente');</script>";
		}
	}		
	?>
</body>
</html>