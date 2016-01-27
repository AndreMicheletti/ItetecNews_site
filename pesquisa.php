<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ItETEC News</title>

<link type="text/css" rel="stylesheet" href="style.css" />
<link rel="icon" href="images\icon_itetec.png">

<!-- Nivo Slider Links -->
<link rel="stylesheet" href="../jquery/slider/themes/default/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../jquery/slider/themes/light/light.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../jquery/slider/themes/dark/dark.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../jquery/slider/themes/bar/bar.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../jquery/slider/nivo-slider.css" type="text/css" media="screen" />
<!-- # END Nivo Slider Links # -->

<script type="text/javascript" src="../jquery/slider/jquery.nivo.slider.js"></script>
<script src="../jquery/javascriptjure.js"></script>

<!-- SCEditor Links -->
<link rel="stylesheet" href="sceditor/minified/themes/office-toolbar.min.css" type="text/css" media="all" />
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="sceditor/minified/jquery.sceditor.bbcode.min.js"></script>
<!-- END SCEditor Links -->

<!-- SCEditor Replacer Script -->
<script>
$(document).ready(function() {
	initEditor();
});
</script>
<!-- #END SCEditor Replacer Script # -->

<?php 
	session_start();
	include("../connect.php");
	include("login.php");
	if (isset($_GET['cat'] )) {
		$cat = $_GET['cat'];
	} else {
		if (isset($_GET['q'] )) {
			$query = $_GET['q'];
		} else {
			header("location:index.php");
		}
	}	
?>
</head>

<body style="background:#DDD">
<div class="site">

<?php echoHeader() ?>

<div class="site_content">
	<div class="principal3"><br />
	<div class="p">
   		<font size="+2" style="margin-left:4%; color:#FFF;"><b>
		
		<?php
			if (isset($cat)) {
				$result = mysql_query("select nome from tb_categoria where codcategoria = $cat");
				$linha = mysql_fetch_row($result);
				$catname = $linha[0];
				echo "Categoria - " . $catname;
			} else {
				echo "Resultado da Pesquisa";
			}
		?></b></font>    
    </div>
	<br />
    
    <div class="p-container">
    <?php
		
		if (isset($cat)) {
			$result = mysql_query("select * from tb_postagem inner join tb_jornalista on tb_postagem.id = tb_jornalista.id
			 where tb_postagem.codcategoria = $cat order by datapublicacao desc");
		} else {
			$result = mysql_query("select * from tb_postagem inner join tb_jornalista on tb_postagem.id = tb_jornalista.id
			 where tb_postagem.titulo like '$query%' order by datapublicacao desc");
		}
		
		if ($result) {
			
		while ($linha = mysql_fetch_array($result)) {
			$codpostagem = $linha[0];
			$codcategoria = $linha[1];
			$id = $linha[2];
			$titulo = $linha[3];
			$conteudo = $linha[4];
			$caminhoimagem = $linha[5];
			$datapublicacao = implode("/", array_reverse(explode("-", $linha[6])));
			$nome = $linha[10];
			
			echo "
				<a class=nonelink href=noticia.php?cod=$codpostagem>
				<div class=postagem>
					<div style=float:left;><img src=$caminhoimagem class=noticia-icon /></div>
					<span style=padding-left:30px;font-size:20px;><b>$titulo</b></span><br /><br />
					<span style=padding-left:20px>Publicado em $datapublicacao</span><br />
					<span style=padding-left:20px>Por $nome</span><br /><br />
					</div></a><br /><hr><br />";	
		}
		}
	?>
    </div>
    <br /></div>
</div>

<?php echoFooter(); ?>

</div>
</body>
</html>