<?php
	
	include ("../connect.php");

	if (isset($_GET['cod'])) {
		$codpostagem = $_GET['cod'];
			
		$result = mysql_query("select gostei from tb_postagem where codpostagem = $codpostagem",$con);
		$row =  mysql_fetch_row($result);
		$gostei = $row[0] + 1;
		
		// Seta um cookie
		setcookie("liked_".$codpostagem, true, time()+60*60*24*6004);
		
		$result = mysql_query("update tb_postagem set gostei = $gostei where codpostagem = $codpostagem",$con);
		
	}
	
	header("location:noticia.php?cod=$codpostagem");
	
?>