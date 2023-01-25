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
                <h3 class="card-title">Editar Contato</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
                $id=$_GET['idUp'];
                $select = "SELECT * FROM tb_contato WHERE id_contato=:id";
                try{
                    $resultSel = $conect->prepare($select);
                    $resultSel->bindParam(':id',$id,PDO::PARAM_INT);
                    $resultSel->execute();

                    $contar=$resultSel->rowCount();
                    if($contar>0){
                        while($show = $resultSel->FETCH(PDO::FETCH_OBJ)){
                            $idCont = $show->id_contato;
                            $nomeCont = $show->nome_contato;
                            $foneCont = $show->telefone_contato;
                            $emailCont = $show->email_contato;
                            $fotoCont = $show->foto_contato;
                        }  
                    }else{
                        echo '<div class="alert alert-danger">
                    Contato não Cadastrado!</div>';
                    }
                }catch(PDOException $e){
                  echo "<strong>ERRO DE SELECT NO PDO: </strong>".$e->getMessage();
                }
                

              ?>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nome</label>
                    <input name="nome" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $nomeCont; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Telefone</label>
                    <input name="telefone" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $foneCont; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Endereço de E-mail</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $emailCont; ?>">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputFile">Foto do contato</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="foto" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Upload da foto</label>
                      </div>
                      
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button name="btnUpContato" type="submit" class="btn btn-primary">Editar Contato</button>
                </div>
              </form>
              <?php
                  
                  if(isset($_POST['btnUpContato'])){
                      $nome = $_POST['nome'];
                      $telefone = $_POST['telefone'];
                      $email = $_POST['email'];

                      if(!empty($_FILES['foto']['name'])){
                      $formatP = array("png","jpg","jpeg","JPG","gif");
                      $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

                      if(in_array($extensao, $formatP)){
                          $pasta = "./../img/contato/";
                          $temporario = $_FILES['foto']['tmp_name'];
                          $novoNome = uniqid().".$extensao";
                          if(move_uploaded_file($temporario, $pasta.$novoNome)){
                              
                          }else{
                            echo "Erro, não foi possível fazer o upload do arquivo!";
                          }

                      }else{
                        echo "Formato de imagem Inválida";
                      }
                    }else{
                      $novoNome=$fotoCont;
                    }
                      $editar = "UPDATE tb_contato SET nome_contato=:nome,telefone_contato=
                      :telefone,email_contato=:email,foto_contato=:foto WHERE 
                      id_contato=:id";
                      try{
                        $result = $conect->prepare($editar);
                        $result->bindParam(':id',$id,PDO::PARAM_STR);
                        $result->bindParam(':nome',$nome,PDO::PARAM_STR);
                        $result->bindParam(':telefone',$telefone,PDO::PARAM_STR);
                        $result->bindParam(':email',$email,PDO::PARAM_STR);
                        $result->bindParam(':foto',$novoNome,PDO::PARAM_STR);
                        $result->execute();

                        $contar = $result->rowCount();
                        if($contar > 0){
                          echo '<div class="container">
                                    <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> OK!</h5>
                                    Contato inserido com sucesso !!!
                                  </div>
                                </div>';
                        }else{
                          echo '<div class="container">
                                    <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Ops!</h5>
                                    Contato não cadastrados !!!
                                  </div>
                                </div>';
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
                <img style="width:150px; border-radius:100%;margin-top:100px" src="./../img/contato/<?php echo $fotoCont; ?>">
                <h1><?php echo $nomeCont; ?></h1>
                <h2><?php echo $foneCont; ?></h2>
                <h4 style="margin-bottom:110px"><?php echo $emailCont; ?></h4>
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