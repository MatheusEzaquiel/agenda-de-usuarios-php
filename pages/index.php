<?php
    include_once("./../config/conexao.php");
	include_once("./../includes/header.php");

	include_once("./../includes/sidebar.php");

	if(isset($_GET['page'])){

		$page = $_GET['page'];

		switch ($page) {

        //Usuário Logado
		case 'home':
			include_once("./conteudo/home.php");
			break;

        case 'perfil':
            include_once("./conteudo/perfil.php");
            break;

        //Contatos
		case 'relatorioContatos':
			include_once("./conteudo/relatorio-contato.php");
			break;

        case 'editarContato':
            include_once("./conteudo/editar-contato.php");
            break;
        
        case 'deletarContato':
            include_once("./conteudo/del-contato.php");
            break;
        
        //Usuários
        case 'relatorioUser':
            include_once("./conteudo/relatorio-usuario.php");
            break;

        case 'editarUser':
            include_once("./conteudo/editar-usuario.php");
            break;

        case 'deletarUser':
            include_once("./conteudo/del-usuario.php");
            break;
		
		default:
			include_once("./conteudo/home.php");
			break;
		}	
	}else{
		include_once("./conteudo/home.php");
	}


	include_once("./../includes/footer.php");
?>
