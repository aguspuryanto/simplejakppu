<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel d-none">
      <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/img/<?php echo $userdata->foto; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $userdata->nama; ?></p>
        <!-- Status -->
        <a href="<?php echo base_url(); ?>assets/#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu tree" data-widget="tree">
      <li class="header">LIST MENU</li>
      <!-- Optionally, you can add icons to the links -->

      <li <?php if ($page == 'home') {echo 'class="active"';} ?> style="<?=($userdata->rule=="admin" || $userdata->rule=="kasi") ? 'display:block;' : 'display:none;';?>">
        <a href="<?php echo base_url('Home'); ?>">
          <i class="fa fa-home"></i>
          <span>DASHBOARD</span>
        </a>
      </li>

      <?php
      $list_menu = [
        array(
          'title' => 'PIDUM',
          'url' => 'Pidum',
          'show_menu' => show_my_menu($userdata, 'pidum'),
          'submenu' => array(
            array('title' => 'Statistik', 'url' => 'index'),
            array('title' => 'Data Perkara', 'url' => 'pidum'),
            array('title' => 'Penahanan', 'url' => 'pidum_penahanan'),
            array('title' => 'PNBP', 'url' => 'pidum_pnbp'),
            array('title' => 'Perkara Inkracth', 'url' => 'pidum_inkracth'),
            array('title' => 'Barang Bukti Pemusnahan', 'url' => 'pidum_bbmusnah'),
            // array('title' => 'Barang Bukti Dikembalikan', 'url' => 'pidum_bbkembali'),
            array('title' => 'Barang Bukti Rampas Negara', 'url' => 'pidum_bbrampas'),
            array('title' => 'Barang Bukti Belum Lelang', 'url' => 'pidum_bblelang'),
          ),
        ),
        array(
          'title' => 'PIDSUS',
          'url' => 'Pidsus',
          'show_menu' => show_my_menu($userdata, 'pidus'),
          'submenu' => array(
            array('title' => 'Statistik', 'url' => 'index'),
            array('title' => 'Data Perkara', 'url' => 'pidsus'),
            array('title' => 'Penahanan', 'url' => 'pidsus_penahanan'),
            array('title' => 'PNBP', 'url' => 'pidsus_pnbp'),
            array('title' => 'Mafia Pelabuhan', 'url' => 'mafia_pelabuhan'),
          ),
        ),
        array(
          'title' => 'INTEL',
          'url' => 'Intel',
          'show_menu' => show_my_menu($userdata, 'intel'),
          'submenu' => array(
            array('title' => 'Statistik', 'url' => 'index'),
            array('title' => 'Surat Perintah Tugas', 'url' => 'sp_tugas'),
            array('title' => 'Operasi Intelijen', 'url' => 'op_intelijen'),
            array('title' => 'Pencegahan & Penangkalan', 'url' => 'cegah_tangkal'),
            array('title' => 'Tangkap Buron', 'url' => 'tangkap_buron'),
            array('title' => 'Pengawasan WNA', 'url' => 'awas_wna'),
            array('title' => 'WNA Terlibat Pidana', 'url' => 'pidana_wna'),
            array('title' => 'Data Proyek Strategis', 'url' => 'proyek_strategis'),
            array('title' => 'Pemberantasan Mafia Tanah', 'url' => 'berantas_mafia'),
            array('title' => 'Percepatan Investasi', 'url' => 'cepat_investasi'),
          ),
        ),
        array(
          'title' => 'DATUN',
          'url' => 'Datun',
          'show_menu' => show_my_menu($userdata, 'datun'),
          'submenu' => array(
            array('title' => 'Statistik', 'url' => 'index'),
            array('title' => 'Data Perkara', 'url' => 'datun'),
          ),
        ),
        array(
          'title' => 'PEMBINAAN',
          'url' => 'Pembinaan',
          'show_menu' => show_my_menu($userdata, 'bin'),
          'submenu' => array(
            array('title' => 'Realisasi Anggaran', 'url' => 'realisasi'),
            array('title' => 'Rumah Dinas', 'url' => 'rumdinas'),
            array('title' => 'Gedung Kantor', 'url' => 'gedung'),
            array('title' => 'Kendaraan Dinas', 'url' => 'kendaraan'),
          )
        ),
        array(
          'title' => 'PB3R',
          'url' => 'pb3r',
          'show_menu' => show_my_menu($userdata, 'pb3r'),
          'submenu' => array(            
            array('title' => 'Barang Bukti Dikembalikan', 'url' => 'index'),
          )
        )
      ];

      // echo json_encode($userdata->rule) . "<br>";
      // echo json_encode($list_menu);
      foreach($list_menu as $key => $lmenu) {
      ?>
      
      <li class="treeview <?php if ($page == 'pegawai') echo 'active'; ?>" style="<?=($lmenu['show_menu']==TRUE) ? 'display:block;' : 'display:none;';?>">
        <a href="<?=base_url($lmenu['url']); ?>">
          <i class="fa fa-user"></i>
          <span><?=$lmenu['title']; ?></span>
          <?php if($lmenu['submenu']) echo '<i class="fa fa-angle-left pull-right"></i>'; ?>
        </a>
        <?php if (!empty($lmenu['submenu'])) { ?>
          <ul class="treeview-menu">
            <?php foreach($lmenu['submenu'] as $smenu) { ?>
              <li>
                <a href="<?=base_url($lmenu['url'] . '/' . $smenu['url']); ?>"><?=$smenu['title']; ?></a>
              </li>
            <?php } ?>
          </ul>
        <?php } ?>
      </li>
      <?php } ?>

    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>