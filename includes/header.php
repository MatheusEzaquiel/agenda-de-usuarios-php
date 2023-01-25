<?php
  ob_start(); //Armazena meus dados em cache
  session_start(); //Inicia a sessão
  if(!isset($_SESSION['loginUser'])&&(!isset($_SESSION['senhaUser']))){
    header("Location: ./../index.php?acao=negado");
  }

  include_once('./sair.php');
  include_once("./../config/conexao.php");

  $emailLogado = $_SESSION['loginUser'];
  $senhaLogado = base64_encode($_SESSION['senhaUser']);
  

  //Select Usuário Logado

    $selUserLogado = "SELECT * FROM tb_user WHERE email_user=:emailLogado and senha_user=:senhaLogado";

    try{
        $resUserLogado = $conect->prepare($selUserLogado);
        $resUserLogado->bindParam(':emailLogado',$emailLogado,PDO::PARAM_STR);
        $resUserLogado->bindParam(':senhaLogado',$senhaLogado,PDO::PARAM_STR);
        $resUserLogado->execute();

        $contUser= $resUserLogado->rowCount();

        if($contUser > 0){
            while($userLogado = $resUserLogado->FETCH(PDO::FETCH_OBJ)){
              
                $idUserLogado = $userLogado->id_user;
                $nomeUserLogado = $userLogado->nome_user;
                $emailUserLogado = $userLogado->email_user;
                $senhaUserLogado = $userLogado->senha_user;
                $fotoUserLogado = $userLogado->foto_user;
            }  

        }
    }catch(PDOException $e){
      echo "<strong>ERRO DE SELECT PDO: </strong>".$e->getMessage();
    }
                

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MBAgenda</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href=".https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="./../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="./../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="./../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="./../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="./../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="./../plugins/summernote/summernote-bs4.min.css">
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="./../dist/AdminLTELogo.png" alt="MB Agenda" height="60" width="60">
      </div>

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          
          
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          

          <!-- Messages Dropdown Menu -->
          
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fas fa-caret-square-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              
              
              <a href="#" class="dropdown-item">
                <i class="fas fa-user-edit"></i></i> Editar Perfil
                
              </a>
              <div class="dropdown-divider"></div>
              <a href="?sair" class="dropdown-item">
                <i class="fas fa-sign-out-alt"></i> Sair do sistema
              </a>
              
          </li>
          
        </ul>
      </nav>
      <!-- /.navbar -->


