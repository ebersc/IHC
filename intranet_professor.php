<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Intranet Professores</title>
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
            <?php
					} else if($cont == 0){
			?>
            <th><font color="#FF0000" style="font-size:24px"><?php echo $linha['nome'];?><br/></font></th>
            <?php
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
<!--
 select a.fk_professor, a.caminho, a.id_arquivo,d.id_disciplina, d.nome
    from arquivo as a join disciplina as d on a.fk_professor = d.fk_prof join professor as p
    where p.id_professor = 1
-->