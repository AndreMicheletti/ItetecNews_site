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
<link rel="stylesheet" href="sceditor/minified/themes/modern.min.css" type="text/css" media="all" />
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
	include("seguranca.php");
?>
</head>

<body style="background:#DDD">
<div class="site">

<?php echoHeader() ?>

<div class="site_content">

<div class="principal3">
	<br /><br /><br />
	<div class="p">
   		<font size="+2" style="margin-left:4%; color:#FFF;"><b>Criar Postagem</b></font>
    </div>
	<br />
    
    <div class="p-container">
    <form method="post" enctype="multipart/form-data">
    	
        <div class="criar-table">
        <table border="0">
        	<tr>
            	<td>Título:</td>
            	<td><input type="text" id="titulo" name="titulo" class="criar" maxlength="46" /></td>
            </tr>
        	<tr>
            	<td>Categoria:</td>
            	<td>
                <select id="categoria" name="categoria" class="criar">
                	<option value="4">Etec Itaquera</option>
                	<option value="1">Atualidades</option>
                	<option value="3">Cultura</option>
                	<option value="5">Esportes</option>
                	<option value="8">Eventos</option>
                	<option value="7">Cinema</option>
                	<option value="2">Musica</option>
                	<option value="6">Curiosidade</option>
                	<option value="10">Area dos Escritores</option>
                </select>
                </td>
            </tr>
        	<tr>
            	<td>Imagem Capa:</td>
            	<td><input type="file" id="imagem" name="imagem" class="criar" />
                <font size="3" color="#999"><sub> Tamanho : 800 x 600 pixels; Formato : .png ou .jpg</sub></font></td>
            </tr>

        </table>
        </div>
            
        <br	/><br /><br />
        
        <div style="width:90%; padding-left:5%; padding-right:5%;">
        <textarea id="conteudo" name="conteudo" style="width:100%; height:350px;">
        
        </textarea><br />
        </div>
        
        <center>
        <div style="width:90%; margin-left:5%; margin-right:5%; height:50px;">
            <input type="reset" value="Limpar" name="limpar" class="salvar"/>
            <input type="submit" value="Postar" name="postar" id="postar" class="salvar" />
        </div>
        </center>
    </form>      
    </div>
	<br /><br /><br />


</div>

</div>

<?php echoFooter(); ?>

</div>
<?php

if (isset($_POST['postar'])) {
	$codcategoria = $_POST['categoria'];
	$id = $_SESSION['id'];
	$titulo = $_POST['titulo'];
	$conteudo = $_POST['conteudo'];
	$datapublicacao = date('Y-m-d');
	$imagem = $_FILES['imagem'];
	
	if ($titulo == '' or $conteudo == '' or !isset($imagem) or $imagem['tmp_name'] == '') {
		
		echo "<script>alert('Preencha os campos !')</script>";	
		
	} else {
			
		$query = "insert into tb_postagem values (null, $codcategoria, $id, '$titulo', '$conteudo', null, '$datapublicacao', 0, 0)";
		
		if (mysql_query($query, $con)) {
			
			$row = mysql_insert_id($con);
			@ move_uploaded_file($imagem['tmp_name'],"images/postagem/$row.jpg");	
			
			mysql_query("update tb_postagem set caminhoimagem = 'images/postagem/$row.jpg' where codpostagem = $row",$con);
			echo "<script>alert('Publicado com sucesso !')</script>";
			
			header("location:postagens.php?id=$id");	
		} else {
			echo "<script>alert('Erro ao publicar!')</script>";
		}
	}
}

?>
</body>
</html>