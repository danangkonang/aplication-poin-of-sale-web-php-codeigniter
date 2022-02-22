<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <div class="h3 ml-auto"><?= $this->session->userdata('title') ?></div>
  
  <ul class="navbar-nav ml-auto">

    <div class="topbar-divider d-none d-sm-block"></div>

    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('username') ?></span>
        <img class="img-profile rounded-circle" src="<?= site_url() ?>assets/images/p.jpeg">
      </a>
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <!-- <a class="dropdown-item" href="<?= base_url() ?>profile/me">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Profile
        </a> -->
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?= base_url() ?>auth/logout">
          <i class="fas fa-power-off fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout
        </a>
      </div>
    </li>

  </ul>

</nav>