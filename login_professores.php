<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Professores</title>
<link rel="shortcut icon" href="icone.ico" type="image/x-icon"/>
</head>

<body>
	<fieldset>
  <p id="p_id"><strong> Intranet Professores - Login </strong></p>
  <form method="post" action="" name="log_prof">
    <div> 
      
      <!--Campo p/ o RA-->
      <label for="txt_usu" id="txtusulab_id"><strong>Usuário: </strong></label>
      <br>
      <input type="text" name="txt_usu" id="txt_usu" required  value autofocus="autofocus">
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
  </form>
 </div>
</fieldset>
<?php
		require("topo.php");
		session_start(); #Inicia a sessão para proteger o site
		if(isset($_REQUEST['sub_id'])){
			
			$log = $_POST["txt_usu"];
			$senha = $_POST["pass_id"];
			
			$logar = FALSE;	#variavel para verificar se o usuário exite no banco
			
			#seleciona os usuarios no banco
			$query="SELECT id_professor, usuario, senha from professor";
			$resultado=mysql_query($query,$conexao); #executa a consulta
			
			$id = "";
			
			while($linha=mysql_fetch_array($resultado))
			{
				if(($linha["usuario"] == $log) && ($linha["senha"] == $senha)){ #Verifica se o login e a senha existem no banco
					$logar = TRUE; #Confirmada a existencia do professor
					$id = $linha["id_professor"];
					mysql_close($conexao);
					break; #para o WHILE
				}
			}
			if($logar){ #Se o usuario existir cria uma variavel de sessão
				$_SESSION['login_prof'] = $log;
				$_SESSION['id_prof'] = $id;
				header('location:intranet_aluno.php'); 
			} else { #Se o usuario nao existir limpa a variavel de sessão e exibe uma mensagem para o usuario
				unset ($_SESSION['login_prof']);
				echo "<script>alert('Usuário ou senha incorretos')</script>";
				
			}
			
		}
		require("fim.php");
	?>
</body>
</html>