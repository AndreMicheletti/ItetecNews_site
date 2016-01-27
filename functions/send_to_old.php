<?php
	include ("../connect.php");
	
	$result = mysql_query("select * from tb_postagem", $con);
	$count = 0;
	$gotit = 0;
	
	while ($linha = mysql_fetch_array($result)) {
		$count ++;
		$cod = $linha[0];
		$codcategoria = $linha[1];
		$id = $linha[2];
		$titulo = $linha[3];
		$conteudo = $linha[4];
		$imagem = $linha[5];
		$datapublicacao = $linha[6];
		$gostei = $linha[7];
	
		$query = "insert into tb_postagem_old values ($cod, $codcategoria, $id, '$titulo', '$conteudo', '$imagem', '$datapublicacao', $gostei)";
		
		if (mysql_query($query,$con)) {
			$gotit ++;
			move_uploaded_file("$imagem","images/postagem/old/$cod.jpg");	
		}
	}
	
	if ($count == $gotit) {
		mysql_query("delete from tb_postagem",$con);
	}
	
	echo $count;
	echo "<br />";
	echo $gotit;
	
	header("location.index.php");
		
?>