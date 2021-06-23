<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="image/user/<?php echo $this->session->userdata('foto'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <?php if ($this->session->userdata('level') == 'admin'){ ?>
        <li><a href="app"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="Supplier"><i class="fa fa-clone"></i> <span> Supplier</span></a></li></li>
        <li><a href="Produk?konten_manual"><i class="fa fa-clone"></i> <span> Produk </span></a></li></li>
        <li><a href="Stok"><i class="fa fa-clone"></i> <span> Stok </span></a></li></li>
        <li class="treeview" style="height: auto;">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="penjualan"><i class="fa fa-circle-o"></i> Penjualan</a></li>
            <li><a href="pengeluaran"><i class="fa fa-circle-o"></i> Pengeluaran</a></li>
          </ul>
        </li>

        <li><a href="App/laporan"><i class="fa fa-print"></i> <span> Laporan </span></a></li></li>

        
        <li><a href="a_user"><i class="fa fa-users"></i> <span>Manajemen Users </span></a></li>

        <?php } elseif ($this->session->userdata('level') == 'user') {?>

        <li><a href="app"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="Supplier"><i class="fa fa-clone"></i> <span> Supplier</span></a></li></li>
        <li><a href="Produk?konten_manual"><i class="fa fa-clone"></i> <span> Produk </span></a></li></li>
        <li><a href="Stok"><i class="fa fa-clone"></i> <span> Stok </span></a></li></li>
        <li class="treeview" style="height: auto;">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="penjualan"><i class="fa fa-circle-o"></i> Penjualan</a></li>
            <li><a href="pengeluaran"><i class="fa fa-circle-o"></i> Pengeluaran</a></li>
          </ul>
        </li>

        <li><a href="Laporan"><i class="fa fa-print"></i> <span> Laporan </span></a></li></li>
        <?php } ?>
        
        

        <!-- <li class="header">LABELS</li> -->
        <!-- <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Faqs</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>About</span></a></li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>