<?php

// ## LOGIN HANDLER ##

	if(isset($_POST['logar'])) {
		
		// Tenta Logar
		$user = $_POST['login'];
		$pass = $_POST['senha'];
		
		if ($user == "" or $pass == "") {
			echo "<script> alert('Preencha todos os campos'); </script>";
			return;
		}
		
		$result = mysql_query("select * from tb_jornalista", $con);
		$success = false;
		
		while ($linha = mysql_fetch_array($result)) {
			if ($linha[2] == $user and $linha[3] == $pass) {
				$_SESSION['logado'] = true;
				$_SESSION['id'] = $linha[0];
				$_SESSION['nome'] = $linha[1];
				$_SESSION['foto'] = $linha[4];
				$_SESSION['idade'] = $linha[5];
				$_SESSION['perfil'] = $linha[6];
				$_SESSION['quote'] =  $linha[7];
				$_SESSION['facebook'] =  $linha[8];
				$_SESSION['twitter'] =  $linha[9];
				$_SESSION['instagram'] =  $linha[10];
				$_SESSION['genero'] = $linha[11];
				$_SESSION['login'] = $user;
				$_SESSION['senha'] = $pass;	
				$success = true;
			}
		}
		
		if ($success) {
			header("location:index.php");
		} else {
			$login_failed = true;
			session_unset();
		}
	}
	
// ## END LOGIN HANDLER ##

// ## LOGOUT HANDLER ##
	if (isset($_POST['sair'])) {
		session_unset();
		header("location:index.php");
	}
// ## END LOGOUT HANDLER ##

// ## SEARCH HANDLER ##
	if (isset($_POST['pesquisar'])) {
		$pesquisa = $_POST['pesquisa'];
		if ($pesquisa != '')
			header("location:pesquisa.php?q=$pesquisa");
	}
// ## END SEARCH HANDLER ##

// ## PROFILE HANDLER ##
	if (isset($_POST['perfil'])) {
		$id = $_SESSION['id'];
		header("location:postagens.php?id=$id");
	}
// ## END PROFILE HANDLER ##

// ## FUNÇÃO REFRESH ##
function refreshSession($con) {
	$id = $_SESSION['id'];
	$result = mysql_query("select * from tb_jornalista where id = $id", $con);
	
	$linha = mysql_fetch_row($result);
	$_SESSION['nome'] = $linha[1];
	$_SESSION['login'] = $linha[2];
	$_SESSION['senha'] =  $linha[3];
	$_SESSION['idade'] = $linha[5];
	$_SESSION['perfil'] = $linha[6];
	$_SESSION['quote'] =  $linha[7];
	$_SESSION['facebook'] =  $linha[8];
	$_SESSION['twitter'] =  $linha[9];
	$_SESSION['instagram'] =  $linha[10];
}
// ## END FUNÇÃO REFRESH ##

// ## FUNÇÃO PROFILE ##
function echoProfile($id, $con) {
	
		$result = mysql_query("select * from tb_jornalista where id = $id", $con);
	
		$linha = mysql_fetch_row($result);
		
		$nome = $linha[1];
		$foto = $linha[4];
		$idade = $linha[5];
		$perfil = $linha[6];
		$quote = $linha[7];
		$facebook = $linha[8];
		$twitter = $linha[9];
		$instagram = $linha[10];
			
		echo " <br />
		<a class=nonelink href=postagens.php?id=$id>
		<div class=perfil>
			<div style=float:left;><img src=$foto class=foto-perfil /></div>
			<span style=padding-left:30px><b>$nome - $idade anos</b></span>
			
			";
			
			if ($quote != '') {
				echo "<span style=float:right; margin-top:15px;>'<i>$quote</i>'</span>";
			}
			
			echo "<br /><br />
			<span style=padding-left:20px>$perfil</span><br />
			</div></a><br />";
}
// ## END FUNÇÃO ##


// ## FUNÇÃO HEADER ##

function echoHeader() {
	echo "
<div class=head_menu>
    <div class='head_logo'>
        <a href='../index.php'><img title='Voltar' src='../images/voltar.png' style='float:left;' /></a>
        <center><a href='index.php'><img class='head_logo' src='images/logo.png' /></a></center>
    </div>
    <div class='head_search'>
    	<form method='post'>
        	<input type='text' id='pesquisa' name='pesquisa' tabindex='1' placeholder='Pesquisar' />
            <input type='submit' id='pesquisar' name='pesquisar' class='pesquisar_btn' value='' />
       	</form>
    </div>
    <div class='header_divider'></div>
    <div class='head_login'>";	
	if (isset($login_failed)) {
		$login_form = "<form method=post>
			<input type=text class=login_input_failed name=login id=login placeholder=Login />
			<input type=password class=login_input_failed name=senha id=senha placeholder=Senha />  
			<input type=submit  class=login_btn name=logar id=logar value=Entrar /></form>";
	} else {
		$login_form = "<form method=post>
			<input type=text class=login_input name=login id=login placeholder=Login />
			<input type=password class=login_input name=senha id=senha placeholder=Senha />  
			<input type=submit  class=login_btn name=logar id=logar value=Entrar /></form>";
	}
		
	if (isset($_SESSION['logado'])) {
		if ($_SESSION['genero'] == 'm') {
			echo "<font class=welcome >Bem-Vindo <b>$_SESSION[nome]</b>!</font>";
		} else {
			echo "<font class=welcome >Bem-Vinda <b>$_SESSION[nome]</b>!</font>";
		}
		echo "<form method=post>
		<input type=submit class=login_btn name=sair id=sair value=Sair />
		<input type=submit class=login_btn name=perfil id=perfil value=Perfil />
		</form>";
	} else {
		echo $login_form;
	}		
    echo " </div></div>";
}

// ## END FUNÇÃO ##

// ## FUNÇÃO FOOTER ##

function echoFooter() {
	echo "
	<div class='footer'>
	<div style='padding-left:30%; padding-right:30%'>	
	<img src='../images/hashtag_icon.png' style='margin-bottom:-15px;'/> 
	<a class='twitter' href='https://twitter.com/instagremio2014/' target='_blank'></a>
	<a class='facebook' href='https://www.facebook.com/instagremio/' target='_blank'></a>
	Criado pela Diretoria de Imprensa - Grêmio JURE 2014
	<p style='color:rgb(153, 153, 153);padding-left:30px;'>@ 2014 All rights reserved</p>
	<a href='http://lynxwarebr.com' class='lynx' target='_blank'></a>
	</div>
	</div>";
}
// ## END FUNÇÃO ##
?>