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

<?php 
	session_start();
	include("../connect.php");
	include("login.php");
	if (isset($_GET['cod'] )) {
		$codpostagem = $_GET['cod'];
		
		$result = mysql_query("select * from tb_postagem where codpostagem = $codpostagem", $con);
		$linha = mysql_fetch_row($result);
		
		$codcategoria = $linha[1];
		$idpostagem = $linha[2];
		$titulo = $linha[3];
		$conteudo = $linha[4];
		$caminhoimagem = $linha[5];
		$datapublicacao = $linha[6];	
		$likes = $linha[7];	
	}
?>
</head>

<body style="background:#DDD">
<div class="site">

<?php echoHeader() ?>

<div class="site_content">
	<div class="noticia-show"><br /><br />
	<div class="noticia-title"><b> <?php echo $titulo; ?></b></div><br /><br />
    	<div style="width:90%;margin-left:5%;"><center><?php echo "<img src=$caminhoimagem class=noticia />"; ?></center></div><br />
        <div class="conteudo-show" id="conteudo">
        
       		<?php echo $conteudo; ?>        
        </div>   
        
        <?php 
			if (isset($_COOKIE["liked_".$codpostagem.""])) {
				echo "	<div title='Você ja curtiu isso' class='likes2'>
        				<div style='width:70px; text-align:center;'>$likes</div>
        				<div style='width:150px;margin-top:5px; text-align:left;font:14px Helvetica Neue,Helvetica,Arial,sans-serif;'>Você curtiu isso</div>
        				</div>";
			} else {
				echo "	<a href='curtirpost.php?cod=$codpostagem' class='nonelink'><div title='Curtir' class='likes'>
        				<div style='width:70px; text-align:center;'>$likes</div>
        				</div></a>";
			}		
		?>
        
        <br /><br />
    	<?php echoProfile($idpostagem, $con); ?>
    </div>
</div>

<?php echoFooter(); ?>

</div>
</body>
</html>