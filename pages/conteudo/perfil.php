<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <div class="col-md-5">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Meu Perfil</h3>
              </div>
              <!-- /.card-header -->

              <!-- Select Usuário Logado -->
            
              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nome</label>
                    <input name="nome-logado" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $nomeUserLogado; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Endereço de E-mail</label>
                    <input name="email-logado" type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $emailUserLogado; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Senha</label>
                    <input name="senha-logado" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo base64_decode($senhaUserLogado); ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Foto do contato</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="foto-logado" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Upload da foto</label>
                      </div>
                      
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button name="btnUpdatePerfil" type="submit" class="btn btn-primary">Atualizar</button>
                </div>
              </form>
              <?php
              
                //Update Usuário Logado
                  if(isset($_POST['btnUpdatePerfil'])){

                    $updtNome = $_POST['nome-logado'];
                    $updtEmail = $_POST['email-logado'];
                    $updtSenha = base64_encode($_POST['senha-logado']);

                      //Verificação da Imagem
                      if(!empty($_FILES['foto-logado']['name'])){

                        $formatP = array("png","jpg","jpeg","JPG","gif");
                        $extensao = pathinfo($_FILES['foto-logado']['name'], PATHINFO_EXTENSION);

                        if(in_array($extensao, $formatP)){
                            $pasta = "./../img/user/";
                            $temporario = $_FILES['foto-logado']['tmp_name'];
                            $novoNome = uniqid().".$extensao";
                            if(move_uploaded_file($temporario, $pasta.$novoNome)){
                                
                            }else{
                              echo "Erro, não foi possível fazer o upload do arquivo!";
                            }

                        }else{
                          echo "Formato de imagem Inválida";
                        }

                      }else{
                        $novoNome = $fotoUserLogado;
                      }

                    //SQL Update
                    $editar = "UPDATE tb_user SET nome_user=:novoNome,email_user=:novoEmail,senha_user=:novaSenha, foto_user=:novaFoto WHERE 
                    id_user=:id";

                    try{
                      $result = $conect->prepare($editar);
                      $result->bindParam(':id',$idUserLogado,PDO::PARAM_INT);
                      $result->bindParam(':novoNome',$updtNome,PDO::PARAM_STR);
                      $result->bindParam(':novoEmail',$updtEmail,PDO::PARAM_STR);
                      $result->bindParam(':novaSenha',$updtSenha,PDO::PARAM_STR);
                      $result->bindParam(':novaFoto',$novoNome,PDO::PARAM_STR);
                      $result->execute();

                      $contar = $result->rowCount();

                      if($contar > 0){
                        echo '<div class="container">
                                  <div class="alert alert-success alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <h5><i class="icon fas fa-check"></i> OK!</h5>
                                  Informações atualizadas!
                                </div>
                              </div>';

                        //echo'<meta http-equiv="refresh" content="2;url=http://localhost/agenda-de-usuarios/pages/sair.php"> ';
                        //header("Location: ./sair.php");
                      }

                    }catch(PDOException $e){
                      echo "<strong>ERRO DE CADASTRO PDO = </strong>".$e->getMessage();
                    }

                      
                  }
              ?>
            </div>
          </div>
          <div class="col-md-7">
            <div class="card card-primary">
              <div class="card-body p-0" style="text-align:center;">
                <img style="width:150px; border-radius:100%;margin-top:100px" src="./../img/user/<?php echo $fotoUserLogado; ?>">
                <h1><?php echo $nomeUserLogado; ?></h1>
                <h4 style="margin-bottom:110px"><?php echo $emailUserLogado; ?></h4>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->