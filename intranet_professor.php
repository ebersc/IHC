<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Intranet Professores</title>
<link rel="shortcut icon" href="icone.ico" type="image/x-icon"/>
</head>
<body>
<?php
	session_start();
	if($_SESSION['login_prof'] == ""){
		header("location:login_professores.php");
	}
	$id = $_SESSION['id_prof'];
	require("topo.php");
	?>
    	<fieldset>
    	<div id="arquivos" name="arquivos">
        <table>
        	<?php	
				$query = "select a.fk_professor, a.caminho, a.id_arquivo,a.nome_arquivo, d.id_disciplina, d.nome
    						from arquivo as a join disciplina as d on a.fk_professor = d.fk_prof join professor as p
    						where p.id_professor = $id order by d.id_discipina;";
				$resultado=mysql_query($query,$conexao);
				$cont = 0;
				while($linha=mysql_fetch_array($resultado))
				{
					$disc[$cont] = $linha['id_discipina'];
					if($cont > 0 and $disc[$cont] != $disc[$cont - 1]){ 
			?>
            
            <th><font color="#FF0000" style="font-size:24px"><?php echo $linha['nome'];?><br/></font></th>
            <th>
            	<form enctype="multipart/form-data" action="" method="POST">
                    Novo arquivo: <input name="userfile" type="file" />
                    <input type="submit" value="Adicionar" name="btnAdd" id="btnAdd"/>
                </form>
                <?php
					if(isset($_POST['btnAdd'])){
						$arquivo  = basename($_FILES['userfile']['name']);
						$uploaddir = 'files_prof/'.$_SESSION['id_prof'].'/'.$arquivo;
						$query = "insert into arquivo (nome_arquivo, caminho, fk_professor, fk_disciplina) 
						values ('$arquivo', '$uploaddir','$id','$disc[$cont]');";
						if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir)) {
							echo "<script>alert('Arquivo enviado com sucesso.');</script>";
							
							header('location:intranet_professor.php');
						} else {
							echo "<script>alert('Erro ao enviar arquivo.');</script>";
						}
					}		
                ?>
            </th>	
            <?php
					} else if($cont == 0){
			?>
            <th><font color="#FF0000" style="font-size:24px"><?php echo $linha['nome'];?><br/></font></th>
            <form enctype="multipart/form-data" action="" method="POST">
                    Novo arquivo: <input name="userfile" type="file" />
                    <input type="submit" value="Adicionar" name="btnAdd" id="btnAdd"/>
                </form>
                <?php
					if(isset($_POST['btnAdd'])){
						$arquivo  = basename($_FILES['userfile']['name']);
						$uploaddir = 'files_prof/'.$_SESSION['id_prof'].'/'.$arquivo;
						$query = "insert into arquivo (nome_arquivo, caminho, fk_professor, fk_disciplina) 
						values ('$arquivo', '$uploaddir','$id','$disc[$cont]');";
						if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir)) {
							echo "<script>alert('Arquivo enviado com sucesso.');</script>";
							
							header('location:intranet_professor.php');
						} else {
							echo "<script>alert('Erro ao enviar arquivo.');</script>";
						}
					}		
					}
			?>
            <tr>
				<td><a target="_blank" href="<?php echo $linha['caminho']?>"><?php echo $linha['nome_arquivo'];?></a></td>
                <td><a href="<?php deleta($linha['id_arquivo'], $conexao)?>">Excluir</a></td>
			</tr>
			<?php
				$cont++;
				}
			?>		
		</table>
        </div>
    </fieldset>
    <?php
		function deleta($id_file, $con){
			$deleta = "DELETE FROM ARQUIVO where id_arquivo = $id_file";
			$resultado = mysql_query($deleta, $con);
			echo "<script>alert('Arquivo deletado com sucesso!');</script>";
			header('intranet_professor.php');
		}
		require("fim.php");
	?>
</body>
</html>