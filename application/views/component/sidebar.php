<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">
      <?= $this->session->userdata('user_name') ?>
    </div>
  </a>
  <hr class="sidebar-divider my-0">

  <li class="nav-item" id="kasir">
    <a class="nav-link" href="<?= site_url() ?>">
    <i class="fas fa-fw fa-cash-register"></i>
    <span>Kasir</span></a>
  </li>
  <hr class="sidebar-divider">

  <li class="nav-item" id="product">
    <a class="nav-link" href="<?= site_url() ?>product/data_barang">
    <i class="fas fa-fw fa-cubes"></i>
    <span>Produk</span></a>
  </li>
  <hr class="sidebar-divider">

  <li class="nav-item" id="penjualan">
    <a class="nav-link" href="<?= site_url() ?>option/data_penjualan">
    <i class="far fa-handshake"></i>
    <span>Penjualan</span></a>
  </li>
  <hr class="sidebar-divider">

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-money-bill-wave"></i>
      <span>Laporan</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" id="laporan-table" href="<?= site_url() ?>report/view_report_table"><i class="fas fa-table"></i> Tabel</a>
        <a class="collapse-item" id="laporan-chart" href="<?= site_url() ?>report/view_report_chart"><i class="far fa-chart-bar"></i> Diagram</a>
      </div>
    </div>
  </li>
  <hr class="sidebar-divider">

  <?php if($this->session->userdata('role')== 'admin'){ ?>

    <li class="nav-item" id="user">
      <a class="nav-link" href="<?= site_url() ?>user/data_user">
      <i class="far fa-user"></i>
      <span>User</span></a>
    </li>
    <hr class="sidebar-divider">

    <li class="nav-item" id="merchant">
      <a class="nav-link" href="<?= site_url() ?>merchant/my_merchant">
      <i class="fas fa-store"></i>
      <span>Toko</span></a>
    </li>
    <hr class="sidebar-divider">

  <?php } ?>

  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>

<script>
  let activeSession = "<?= $this->session->userdata('active_class') ?>";
  let element = document.getElementById(activeSession);
  element.classList.add("active");
  if(activeSession === 'laporan-table' || activeSession === 'laporan-chart'){
    $("#collapseTwo").collapse('show');
  }
</script>
