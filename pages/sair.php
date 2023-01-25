<?php
if (isset($_REQUEST['sair'])) {
	session_destroy(); //destroi a sessão
	header("Location: index.php?acao=sair");
}