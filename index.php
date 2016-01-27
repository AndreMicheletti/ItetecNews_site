<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ItETEC News</title>

<link type="text/css" rel="stylesheet" href="style.css" />
<link rel="icon" href="images\icon_itetec.png">

<script type="text/javascript" src="../jquery/slider/jquery.nivo.slider.js"></script>

<!-- SCEditor Links -->
<link rel="stylesheet" href="sceditor/minified/themes/office-toolbar.min.css" type="text/css" media="all" />
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="sceditor/minified/jquery.sceditor.bbcode.min.js"></script>
<!-- END SCEditor Links -->

<!-- Nivo Slider Links -->
<link rel="stylesheet" href="../jquery/slider/themes/default/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../jquery/slider/themes/light/light.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../jquery/slider/themes/dark/dark.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../jquery/slider/themes/bar/bar.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../jquery/slider/nivo-slider.css" type="text/css" media="screen" />
<script type="text/javascript" src="../jquery/slider/jquery.nivo.slider.js"></script>
<!-- # END Nivo Slider Links # -->

<script src="../jquery/javascriptjure.js"></script>

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
	
	function getNoticiasByCat($codcat) {
		include("../connect.php");
		$noticias = array();
		$index = 0;
	
		$result = mysql_query("select tb_postagem.codpostagem, tb_postagem.titulo, tb_postagem.caminhoimagem, tb_jornalista.nome from tb_postagem
		 inner join tb_jornalista on tb_postagem.id = tb_jornalista.id 
		 where tb_postagem.codcategoria = $codcat and tb_postagem.weekold <= 1 order by tb_postagem.gostei desc limit 0 , 9", $con);
		
		if ($result) {
		
			while ($linha = mysql_fetch_array($result)) {
				$codpostagem = $linha[0];
				$titulo = $linha[1];
				$img = $linha[2];
				$nome = $linha[3];
				
				$noticias[$index] = array($codpostagem, $titulo, $img, $nome);
				$index += 1;
			}
			
			$tamanho = 250 * (($index / 3) + 1) . "px";
			echo "<div class='wrapper-n' style='height:$tamanho'>";
			foreach($noticias as $i => $value) {
				$codpostagem = $value[0];
				$titulo = $value[1];
				$img = $value[2];
				$nome = $value[3];
				echo "<a href='noticia.php?cod=$codpostagem' class=nonelink><div class='noticia-index'>
						<img src='$img' class='noticia-index' />
						<b>$titulo</b><br /><font style='color:rgb(140, 140, 140); text-align:left; font-size:13px;'>por $nome</font>
					</div></a>";
				if ($i % 3 == 0 and $i != 0) {
					echo "<br />";
				}
			}
			echo "</div>";
		} else {
			
		}
	}
?>
</head>

<body style="background:#DDD">
<div class="site">

<?php echoHeader() ?>

<div id="top" class="site_content">

<div class="principal" id="principal"><br />

<div class="p">
   	<font size="+3" style="margin-left:4%; color:#FFF;"><b>   Notícias</b></font>
</div>

<div class="destaques-center">
<br /><br />
    <center>
    <div class="divCentro" id="galeria" >
        <div class="slider-wrapper theme-default">
        	<br />
        	<div id="slider" class="nivoSlider">
 			<?php
	
				$result = mysql_query("select * from tb_postagem where codcategoria != 10 and weekold <= 1 order by gostei desc limit 0 , 5", $con);
				
				while ($linha = mysql_fetch_array($result)) {
					$codpostagem = $linha[0];
					$titulo = $linha[3];
					$img = $linha[5];
					
					echo "<a href=noticia.php?cod=$codpostagem ><img src='$img' data-thumb='$img' title='$titulo' alt='' /></a>";
				}
			?>
            </div>
        </div>
    </div> 
	</center>
</div>

<div class="destaques-right">
	<br /><p style="font-size:22px;"><b>Categorias</b></p><br />
    <a href="pesquisa.php?cat=4" class="nonelink"><div class="btn-categoria">Etec de Itaquera</div></a>
    <a href="pesquisa.php?cat=1" class="nonelink"><div class="btn-categoria">Atualidades</div></a>
    <a href="pesquisa.php?cat=3" class="nonelink"><div class="btn-categoria">Cultura</div></a>
    <a href="pesquisa.php?cat=5" class="nonelink"><div class="btn-categoria">Esportes</div></a>
    <a href="pesquisa.php?cat=8" class="nonelink"><div class="btn-categoria">Eventos</div></a>
    <a href="pesquisa.php?cat=7" class="nonelink"><div class="btn-categoria">Cinema</div></a>
    <a href="pesquisa.php?cat=2" class="nonelink"><div class="btn-categoria">Música</div></a>
    <a href="pesquisa.php?cat=6" class="nonelink"><div class="btn-categoria">Curiosidades</div></a>
    <a href="pesquisa.php?cat=10" class="nonelink"><div class="btn-categoria">Area dos Escritores</div></a>
</div>


</div>

<div class="outros"><br /><br />
   	<div id="etec" class="categoria-title"><b> Etec de Itaquera</b><div style="float:right; font-size:18px;"><a class="nonelink2" href="#top">Voltar ao topo</a></div></div><br />
	<?php
        getNoticiasByCat(4);
    ?><br />
    
   	<div id="atualidades" class="categoria-title"><b> Atualidades</b><div style="float:right; font-size:18px;"><a class="nonelink2" href="#top">Voltar ao topo</a></div></div><br />
	<?php
        getNoticiasByCat(1);
    ?><br />
    
   	<div id="cultura" class="categoria-title"><b> Cultura</b><div style="float:right; font-size:18px;"><a class="nonelink2" href="#top">Voltar ao topo</a></div></div><br />
	<?php
        getNoticiasByCat(3);
    ?><br />
    
   	<div id="esportes" class="categoria-title"><b> Esportes</b><div style="float:right; font-size:18px;"><a class="nonelink2" href="#top">Voltar ao topo</a></div></div><br />
	<?php
        getNoticiasByCat(5);
    ?><br />
    
   	<div id="eventos" class="categoria-title"><b> Eventos</b><div style="float:right; font-size:18px;"><a class="nonelink2" href="#top">Voltar ao topo</a></div></div><br />
	<?php
        getNoticiasByCat(8);
    ?><br />
    
   	<div id="cinema" class="categoria-title"><b> Cinema</b><div style="float:right; font-size:18px;"><a class="nonelink2" href="#top">Voltar ao topo</a></div></div><br />
	<?php
        getNoticiasByCat(7);
    ?><br />
    
   	<div id="musica" class="categoria-title"><b> Musica</b><div style="float:right; font-size:18px;"><a class="nonelink2" href="#top">Voltar ao topo</a></div></div><br />
	<?php
        getNoticiasByCat(2);
    ?><br />
    
   	<div id="curiosidades" class="categoria-title"><b> Curiosidades</b><div style="float:right; font-size:18px;"><a class="nonelink2" href="#top">Voltar ao topo</a></div></div><br />
	<?php
        getNoticiasByCat(6);
    ?><br />
    
    <div class="index-cat">
    	<div class="categoria-title"><b> Conheça os Colunistas</b><div style="float:right; font-size:18px;"><a class="nonelink2" href="#top">Voltar ao topo</a></div></div><br />
        <?php	
		
			$array = array(1, 2, 3, 4, 5, 6, 7, 10);
			shuffle($array);
			
			foreach ($array as $value) {
				echoProfile($value, $con);	
			}
		?>
    </div>

</div>

<?php echoFooter(); ?>

</div>
</div>
</body>
</html>