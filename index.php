<!doctype html>
<html lang="pt-br">
<head>
<title>FAEN - Faculdade de Engenharia</title>
<meta name="author" content="Diogo, Albert, Eberson e Raphael">
<meta http-equiv="Content-Type" content="text/hmtl" charset="utf-8">
<link rel="stylesheet" type="text/css" href="estilo.css">
<link rel="shortcut icon" href="icone.ico" type="image/x-icon"/>
</head>
<body>
<br>
<h1 align="center" style="color: #DDDDDD">FAEN - Faculdade de Engenharia</h1>
<hr>
<br>
<br>
<br>
<br>
<div align="center">
<br>
<fieldset>
  <p id="p_id"><strong> Intranet - Login </strong></p>
  <form method="post" action="" name="log">
    <div> 
      
      <!--Campo p/ o RA-->
      <label for="txtra" id="txtralab_id"><strong>RA: </strong></label>
      <br>
      <input type="text" name="txtra_id" id="txtra_id" maxlength="6" required  value autofocus="autofocus">
      <br>
    </div>
    
    <!--Campo p/ Senha-->
    <label for="pass" name="pass_" id="passlab_id"><strong>Senha: </strong></label>
    <br>
    <input type="password" name="pass_id" id="pass_id" required>
    <br>
    <br>
    <br>
    
    <!--Botao para entrar-->
    <button name="sub_id" id="sub_id">Login</button>
    <br>
    <br>
    <!--Link esqueci minha senha--> 
	<a href="login_professores.php">Login para professores</a>
  </form>
  
 </div>
</fieldset>
<?php
		require("topo.php");
		session_start(); #Inicia a sessão para proteger o site
		if(isset($_REQUEST['sub_id'])){
			
			$log = $_POST["txtra_id"];
			$senha = $_POST["pass_id"];
			
			$logar = FALSE;	#variavel para verificar se o usuário exite no banco
			
			#seleciona os usuarios no banco
			$query="SELECT `id_aluno`,`ra`,`senha` FROM `aluno`";
			$resultado=mysql_query($query,$conexao); #executa a consulta
			
			$id = "";
			
			while($linha=mysql_fetch_array($resultado))
			{
				/*echo"<script>alert('')</script>";*/
				if(($linha["ra"] == $log) && ($linha["senha"] == $senha)){ #Verifica se o login e a senha existem no banco
					$logar = TRUE; #Confirmada a existencia do aluno
					$id = $linha["id_aluno"];
					mysql_close($conexao);
					break; #para o WHILE
				}
			}
			if($logar){ #Se o usuario existir cria uma variavel de sessão
				$_SESSION['login'] = $log;
				$_SESSION['id'] = $id;
				header('location:intranet_aluno.php'); 
			} else { #Se o usuario nao existir limpa a variavel de sessão e exibe uma mensagem para o usuario
				unset ($_SESSION['login']);
				echo "<script>alert('Usuário ou senha incorretos')</script>";
				
			}
			
		}
		require("fim.php");
	?>
</body>
</html>