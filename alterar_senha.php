<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alterar senha</title>
<link rel="shortcut icon" href="icone.ico" type="image/x-icon"/>
</head>
<body>
	<?php
		session_start();
		if($_SESSION['login'] == "")
		{
			header('location:index.php');
		}
		$id = $_GET['id'];
		require("topo.php");		
	?>
    <form name="alt_senha" id="alt_senha" action="alterar_senha.php" method="post">
      <p>
        <label for="oldpasswd">Senha antiga: </label>
        <input type="password" name="oldpasswd" id="oldpasswd" required/><br/>
        <label for="newpasswd">Nova senha: </label>
        <input type="password" name="newpasswd" id="newpasswd"  required/><br/>
        <label for="repeat_newpasswd">Repita a nova senha: </label>
        <input type="password" name="repeat_newpasswd" id="repeat_newpasswd"  required/><br/>
        
        <input type="submit" value="Alterar senha" name="btn_altsenha" id="btn_altsenha" />
      </p>
    </form>
    <small><a href="intranet_aluno.php">Voltar</a></small>
	<?php
		if(isset($_REQUEST['btn_altsenha'])){
			$query="SELECT `senha` FROM `aluno` where `id_aluno` = $id LIMIT 0, 1";
			$resultado = mysql_query($query, $conexao);
			if(mysql_num_rows($resultado) > 0){
				while($linha=mysql_fetch_array($resultado)){
				  $senha = $senha['senha'];
				}
				$old = $_POST['oldpasswd'];
				$newpass = $_POST['newpasswd'];
				$repeat = $_POST['repeat_newpasswd'];
				if(($old === $senha) && ($newpass === $repeat)){
					$query = "UPDATE  `intranet`.`aluno` SET  `senha` =  '$newpass' WHERE  `aluno`.`id_aluno` = $id;";
					echo "<script>alert('Senha alterada com sucesso')</script>";
					header('location:intranet_aluno.php');
				} else {
					echo "<script>alert('As senha não coincidem')</script>";
					header('location:alterar_senha.php?id='.$id);
				}
			} else {
				echo "<script>alert('A senha antiga esta incorreta!');</script>";
			}
		}
		require("fim.php")
	?>
    
</body>
</html>