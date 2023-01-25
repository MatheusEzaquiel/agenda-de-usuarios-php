

<div class="content-wrapper">
    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Main row -->
        <div class="row">
          <div class="col-md-5">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><h1>Informações do usuário Logado</h1></h3>
              </div>
                    
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
                      $select = "SELECT * FROM tb_user WHERE email_user=:emailLogado and senha_user=:senhaLogado";
                      try{
                        $resultado = $conect->prepare($select);
                        $resultado->bindParam(':emailLogado',$emailLogado,PDO::PARAM_STR);
                        $resultado->bindParam(':senhaLogado',$senhaLogado,PDO::PARAM_STR);
                        $resultado->execute();
                        $contar = $resultado->rowCount();
                        if($contar > 0){
                          while($show = $resultado->FETCH(PDO::FETCH_OBJ)){   
                    ?>
                    <tr>
                      <td><img style="width: 41px; border-radius: 100%;" src="./../img/user/<?php echo $show->foto_user;?>"></td>
                      <td><?php echo $show->nome_user;?></td>
                      <td><?php echo $show->senha_user;?></td>
                      <td><?php echo $show->email_user;?></td>
                    </tr>
                    <?php
                      }
                    }else{
                      echo "users não existentes!!!";
                    }
                  }catch(PDOException $e){
                    echo '<strong>ERRO DE PDO= </strong>'.$e->getMessage();
                  }
                    ?>
                    
                  </tbody>
                </table>
              </div>


            </div>
          </div>

          <div class="col-md-7">
            <div class="card card-primary">
              <div class="card-body p-0" style="text-align:center;">
                
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div> <!-- /.row (main row) -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
?>