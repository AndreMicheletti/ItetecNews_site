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


function deletar(codpostagem) {
	if(confirm("Deseja mesmo excluir ?")) {
		location.href = "deletepost.php?cod=" + codpostagem;
	}
}
</script>
<!-- #END SCEditor Replacer Script # -->

<?php 
	session_start();
	include("../connect.php");
	include("login.php");
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		header("location:index.php");	
	}
	$logado = false;
	if (isset($_SESSION['id'])) {
		if ($_SESSION['id'] == $id)
			$logado = true;
	}
?>
</head>

<body style="background:#DDD">
<div class="site">

<?php echoHeader() ?>

<div class="site_content">

<div class="principal3"><br />
	<br /><br />
    <?php
		echoProfile($id, $con);
		
		$result = mysql_query("select * from tb_jornalista where id = $id", $con);
		
		$linha = mysql_fetch_row($result);
		
		echo "<div class='perfil-social'><center>";
		 
		if ($linha[8] != '') {
			echo "<a class='nonelink' target='_blank' href='$linha[8]'><div class='btn-facebook'></div></a>";
		}
		if ($linha[9] != '') {
			echo "<a class='nonelink' target='_blank' href='$linha[9]'><div class='btn-twitter'></div></a>";
		}
		if ($linha[10] != '') {
			echo "<a class='nonelink' target='_blank' href='$linha[10]'><div class='btn-instagram'></div></a>";
		}
		
		echo "</center></div>";
	?>
    
	<div class="p">
	<?php
		if ($logado or $_SESSION['id'] == 11) {
			echo "<a href=editarperfil.php><div class=btn-alterar>Editar Perfil</div></a>";	
			echo "<a href=criarpost.php><div class=btn-inserir>Nova Postagem</div></a>";
		}
	 ?>
     <font size="+2" style="margin-left:4%; color:#FFF;"><b>Area do Escritor</b></font>      
    </div>
	<br />
    
    <div class="p-container">
    
    <?php
		
		$result = mysql_query("select * from tb_postagem where id = $id and codcategoria = 10 order by datapublicacao desc");
		
		if ($result) {
			
		while ($linha = mysql_fetch_array($result)) {
			$codpostagem = $linha[0];
			$codcategoria = $linha[1];
			$id = $linha[2];
			$titulo = $linha[3];
			$conteudo = $linha[4];
			$caminhoimagem = $linha[5];
			$datapublicacao = implode("/", array_reverse(explode("-", $linha[6])));
			echo "
				<a class=nonelink href=noticia.php?cod=$codpostagem>
				<div class=postagem>
					<div style=float:left;><img src=$caminhoimagem class=noticia-icon /></div>
					<span style=padding-left:30px;font-size:20px;><b>$titulo</b></span><br /><br />
					<span style=padding-left:20px>Publicado em $datapublicacao</span><br /><br />
				";
			if ($logado) {
				echo "<span style=padding-left:20%>
					<a href=editarpost.php?cod=$codpostagem ><div class=btn-alterar>Alterar</div></a><br /><br />
					<a href=javascript:deletar($codpostagem) ><div class=btn-excluir>Excluir</div></a>
				</span>";	
			}
			echo "</div></a><br />";	
		}
		}
	?>
    
    </div>
	<br /><br /><br />
    
	<div class="p">
   		<font size="+2" style="margin-left:4%; color:#FFF;"><b>Noticias Publicadas</b></font>    
    </div>
	<br />
    
    <div class="p-container">
    
    <?php
		
		$result = mysql_query("select * from tb_postagem where id = $id and codcategoria != 10 order by datapublicacao desc");
		
		if ($result) {
			
		while ($linha = mysql_fetch_array($result)) {
			$codpostagem = $linha[0];
			$codcategoria = $linha[1];
			$id = $linha[2];
			$titulo = $linha[3];
			$conteudo = $linha[4];
			$caminhoimagem = $linha[5];
			$datapublicacao = implode("/", array_reverse(explode("-", $linha[6])));
			echo "
				<a class=nonelink href=noticia.php?cod=$codpostagem>
				<div class=postagem>
					<div style=float:left;><img src=$caminhoimagem class=noticia-icon /></div>
					<span style=padding-left:30px;font-size:20px;><b>$titulo</b></span><br /><br />
					<span style=padding-left:20px>Publicado em $datapublicacao</span><br /><br />
				";
			if ($logado) {
				echo "<span style=padding-left:20%>
					<a href=editarpost.php?cod=$codpostagem ><div class=btn-alterar>Alterar</div></a><br /><br />
					<a href=javascript:deletar($codpostagem) ><div class=btn-excluir>Excluir</div></a>
				</span>";	
			}
			echo "</div></a><br />";	
		}
		}
	?>
    
    </div>
	<br /><br /><br />

</div>

</div>

<div id="comandos"></div>

<?php echoFooter(); ?>

</div>
</body>
</html>