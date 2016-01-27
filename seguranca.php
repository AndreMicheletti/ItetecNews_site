<?php

	if (!isset($_SESSION['logado'])) {
		session_unset();
		header("location:index.php");
	}

?>