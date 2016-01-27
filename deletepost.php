<?php
	
	include ("../connect.php");

	if(isset($_GET['cod'])) {
		$cod = 	$_GET['cod'];
		if (mysql_query("delete from tb_postagem where codpostagem = $cod", $con)) {
			unlink("images/postagem/$cod.jpg");
		}
	}
	echo "<script>location.href = 'index.php'</script>";

?>