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
                <h3 class="card-title">Cadastrar contato</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nome</label>
                    <input name="nome" type="text" class="form-control" id="exampleInputPassword1" placeholder="Digite o nome de contato...">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Telefone</label>
                    <input name="telefone" type="text" class="form-control" id="exampleInputPassword1" placeholder="Digite seu telefone...">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Endereço de E-mail</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Digite o endereço de e-mail...">
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
                  <button name="btnCContato" type="submit" class="btn btn-primary">Cadastrar Contato</button>
                </div>
              </form>
              <?php
                  include_once('./../config/conexao.php');
                  if(isset($_POST['btnCContato'])){
                      $nome = $_POST['nome'];
                      $telefone = $_POST['telefone'];
                      $email = $_POST['email'];
                      $formatP = array("png","jpg","jpeg","JPG","gif");
                      $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

                      if(in_array($extensao, $formatP)){
                          $pasta = "./../img/contato/";
                          $temporario = $_FILES['foto']['tmp_name'];
                          $novoNome = uniqid().".$extensao";
                          if(move_uploaded_file($temporario, $pasta.$novoNome)){
                              $cadastro = "INSERT INTO tb_contato (nome_contato, telefone_contato, email_contato, foto_contato) VALUES (:nome, :telefone, :email, :foto)";
                      try{
                        $result = $conect->prepare($cadastro);
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
                          }else{
                            echo "Erro, não foi possível fazer o upload do arquivo!";
                          }

                      }else{
                        echo "Formato Inválido";
                      }     
                  }
              ?>
            </div>
          </div>
          <div class="col-md-7">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Últimos contatos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th>Perfil</th>
                      <th>Nome</th>
                      <th>Telefone</th>
                      <th>E-mail</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $select = "SELECT * FROM tb_contato ORDER BY id_contato DESC LIMIT 8";
                      try{
                        $resultado = $conect->prepare($select);
                        $resultado->execute();
                        $contar = $resultado->rowCount();
                        if($contar > 0){
                          while($show = $resultado->FETCH(PDO::FETCH_OBJ)){   
                    ?>
                    <tr>
                      <td><img style="width: 41px; border-radius: 100%;" src="./../img/contato/<?php echo $show->foto_contato;?>"></td>
                      <td><?php echo $show->nome_contato;?></td>
                      <td><?php echo $show->telefone_contato;?></td>
                      <td><?php echo $show->email_contato;?></td>
                    </tr>
                    <?php
                      }
                    }else{
                      echo "Contatos não existentes!!!";
                    }
                  }catch(PDOException $e){
                    echo '<strong>ERRO DE PDO= </strong>'.$e->getMessage();
                  }
                    ?>
                    
                  </tbody>
                </table>
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