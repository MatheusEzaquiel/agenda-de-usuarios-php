  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="?page=home" class="brand-link">
      <img src="./../dist/AdminLTELogo.png" alt="MB Agenda" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MBAgenda</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./../dist/avatar.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="?page=perfil" class="d-block"><?php echo $nomeUserLogado;?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               
              <li class="nav-item">
                <a href="?page=perfil" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Meu Perfil</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="?page=home" class="nav-link">
                  <i class="nav-icon fas fa-pencil-alt"></i>
                  
                  <p>
                    Cadastro   
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="?page=relatorioContatos" class="nav-link">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    Relatório de Contatos
                  </p>
                </a>
              </li>
              
               <li class="nav-item">
                <a href="?page=relatorioUser" class="nav-link">
                  <i class="nav-icon fas fa-address-card"></i>
                  <p>
                    Relatório de Usuários
                  </p>
                </a>
              </li>           
             
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>