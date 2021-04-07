 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
<a href="#" class="brand-link logo-switch">
  <img src="<?php echo base_url();?>assets/logobdmsidebarkecil.png" alt="AdminLTE Docs Logo Small" class="brand-image-xl logo-xs">
  <img src="<?php echo base_url();?>assets/logobdmsidebar.png" alt="AdminLTE Docs Logo Large" class="brand-image-xs logo-xl" style="left: 12px">
</a>


    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li>
            <a id="undo" href="#" class=" btn btn-secondary">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Undo
              </p>
            </a>

            <a id="point" href="#" class=" btn btn-secondary action">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Point
              </p>
            </a>

            <a id="path" href="#" class=" btn btn-secondary action">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Path
              </p>
            </a>
          </li>


          <li class="nav-item">
           <a href="#" onclick='logout()' class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Keluar
              </p>
            </a>
          </li>   


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>