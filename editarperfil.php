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
	refreshSession($con);
?>
</head>

<body style="background:#DDD">
<div class="site">

<?php echoHeader() ?>

<div class="site_content">
	<div class="principal2">
    	<div class="mudar-perfil">
    		<font size="+2" style="margin-left:4%; color:#FFF;"><b>Modificar seu Perfil</b><br /><br /></font>
            <font size="+1" style="margin-left:6%; color:#FFF;">
            <form method="post" enctype="multipart/form-data">
            	<?php echo "<img src=$_SESSION[foto] class=foto-perfil style=padding-left:5%; />" ?>
                <table style="margin-left:8%; float:left; margin-top:40px;" border="0">
                    <tr>
                        <td>Enviar nova Foto:<font size="3" color="#999"><sub> * .jpg</sub></font></td>
                        <td><input type="file" name="foto" id="foto" /></td>
                    </tr>
                    <tr>
                        <td width="180">Nome:</td>
                        <td><input type="text" class="perfil" name="nome" id="nome" value="<?php echo $_SESSION['nome']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Idade:</td>
                        <td><input type="text" class="perfil" name="idade" id="idade" value="<?php echo $_SESSION['idade']; ?>" maxlength="2" onkeypress="return SomenteNumero(event)" /></td>
                    </tr>
                    <tr>
                        <td>Login:</td>
                        <td><input type="text" class="perfil" name="login" id="login" value="<?php echo $_SESSION['login']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Senha:</td>
                        <td><input type="text" class="perfil" name="senha" id="senha" value="<?php echo $_SESSION['senha']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Citação / Frase</td>
                        <td><input type="text" class="perfil" name="quote" id="quote" maxlength="70" value="<?php echo $_SESSION['quote']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Facebook (link)</td>
                        <td><input type="text" class="perfil" name="facebook" id="facebook" maxlength="80" value="<?php echo $_SESSION['facebook']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Twitter (link)</td>
                        <td><input type="text" class="perfil" name="twitter" id="twitter" maxlength="80" value="<?php echo $_SESSION['twitter']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Instagram (link)</td>
                        <td><input type="text" class="perfil" name="instagram" id="instagram" maxlength="80" value="<?php echo $_SESSION['instagram']; ?>" /></td>
                    </tr>
                </table>
                <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
                <p style="text-align:center; width:100%;">
                	<font size="+2" style="color:#FFF;"><b>Descrição</b><br /><br /></font>
                </p>
                <div style="width:90%; padding-left:5%; padding-right:5%;">
                <textarea id="perfil" name="perfil" style="width:100%; height:350px;">
				<?php echo $_SESSION['perfil']; ?>
                </textarea><br />
                <center>
                	<input type="reset" value="Limpar" name="limpar" class="salvar"/>
                    <input type="submit" value="Salvar" name="salvar" id="salvar" class="salvar" />
                </center>
                </div>
                
            </form>
            </font>
            
        </div>
	
	
    </div>
</div>

<?php echoFooter(); ?>

</div>
<?php

	if(isset($_POST['salvar'])) {
		
		$id = $_SESSION['id'];
		$nome = $_POST['nome'];
		$idade = $_POST['idade'];
		$perfil = $_POST['perfil'];	
		$login = $_POST['login'];
		$senha = $_POST['senha'];
		$quote = $_POST['quote'];
		$facebook = $_POST['facebook'];
		$twitter = $_POST['twitter'];
		$instagram = $_POST['instagram'];	
		$quote = str_replace('"', "", $quote);
		$quote = str_replace("'", "", $quote);
		
		$query = "update tb_jornalista set nome = '$nome', idade = $idade , perfil = '$perfil', login = '$login', senha = '$senha',	quote = '$quote', facebook = '$facebook', twitter = '$twitter', instagram = '$instagram' where id = $id;";
		
		if (mysql_query($query, $con)) {
			if (isset($_FILES['foto'])) {
				$foto = $_FILES['foto'];
				move_uploaded_file($foto['tmp_name'],"escritores/$id.jpg");	
			}
			refreshSession();
		} else {
			echo "<script> alert('Erro ao alterar registro') </script>";
		}
		header("location:editarperfil.php");
	}
	
?>
</body>
</html>