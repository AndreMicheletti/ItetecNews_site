<?php

include("../../connect.php");

$total = 0;
$done = 0;
	
$result = mysql_query("select * from tb_postagem", $con);

while ($linha = mysql_fetch_array($result)) {
	$codpostagem = $linha[0];
	$weekold = $linha[8] + 1;
	$total++;
	
	if (mysql_query("update tb_postagem set weekold = $weekold where codpostagem = $codpostagem")) {
		$done++;	
	}
}

echo "DONE ! $done mudanças concluidas de $total registros";

?>