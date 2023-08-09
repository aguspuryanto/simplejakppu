<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?=($page == 'home') ? 'active' : ''; ?> <?=($userdata->rule=="admin" || $userdata->rule=="kasi") ? 'd-block;' : 'd-none;';?>">
        <a class="nav-link" href="<?= base_url('Home'); ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

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
            // array('title' => 'Barang Bukti Pemusnahan', 'url' => 'pidum_bbmusnah'),
            // array('title' => 'Barang Bukti Dikembalikan', 'url' => 'pidum_bbkembali'),
            // array('title' => 'Barang Bukti Rampas Negara', 'url' => 'pidum_bbrampas'),
            // array('title' => 'Barang Bukti Belum Lelang', 'url' => 'pidum_bblelang'),
            ),
        ),
        array(
            'title' => 'PIDSUS',
            'url' => 'Pidsus',
            'show_menu' => show_my_menu($userdata, 'pidsus'),
            'submenu' => array(
            array('title' => 'Statistik', 'url' => 'index'),
            array('title' => 'Data Perkara', 'url' => 'pidsus'),
            array('title' => 'Penahanan', 'url' => 'pidsus_penahanan'),
            array('title' => 'PNBP', 'url' => 'pidsus_pnbp'),
            array('title' => 'Mafia Pelabuhan', 'url' => 'pidsus_mafia_pelabuhan'),
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
            array('title' => 'GAKKUM', 'url' => 'gakkum'),
            array('title' => 'TIMKUM', 'url' => 'timkum'),
            array('title' => 'BANKUM', 'url' => 'bankum'),
            array('title' => 'THL', 'url' => 'thl'),
            array('title' => 'YANKUM', 'url' => 'yankum'),
            array('title' => 'Penyelamatan KN', 'url' => 'penyelamatan_kn'),
            array('title' => 'Pemulihan KN', 'url' => 'pemulihan_kn'),
            ),
        ),
        array(
            'title' => 'PEMBINAAN',
            'url' => 'Pembinaan',
            'show_menu' => show_my_menu($userdata, 'bin'),
            'submenu' => array(
            array('title' => 'Realisasi Anggaran', 'url' => 'realisasi'),
            array('title' => 'Penyerapan Anggaran', 'url' => 'penyerapan'),
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
            array('title' => 'Barang Bukti Dikelola', 'url' => 'bbkelola'),
            array('title' => 'Barang Bukti Disita', 'url' => 'bbsita'),
            array('title' => 'Barang Bukti Dikembalikan', 'url' => 'bbkembali'),
            array('title' => 'Barang Bukti Dilelang', 'url' => 'bblelang'),
            array('title' => 'Uang Pengganti', 'url' => 'uangganti'),
            array('title' => 'Denda', 'url' => 'uangdenda'),
            array('title' => 'Uang Rampasan', 'url' => 'uangrampas'),
            )
        )
    ];

    // echo json_encode($userdata->rule) . "<br>";
    // echo json_encode($list_menu);
    foreach($list_menu as $key => $lmenu) {
    ?>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link <?=($page == $lmenu['title']) ? 'collapsed' : '';?> <?=($userdata->rule=="admin" || $userdata->rule=="kasi") ? 'd-block;' : 'd-none;';?>" href="<?=base_url($lmenu['url']); ?>" data-toggle="collapse" data-target="#<?=$lmenu['title']; ?>"
            aria-expanded="true" aria-controls="<?=$lmenu['title']; ?>">
            <i class="fas fa-fw fa-cog"></i>
            <span><?=$lmenu['title']; ?></span>
        </a>
        <?php if (!empty($lmenu['submenu'])) { ?>
        <div id="<?=$lmenu['title']; ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php foreach($lmenu['submenu'] as $smenu) { ?>
                <a class="collapse-item" href="<?=base_url($lmenu['url'] . '/' . $smenu['url']); ?>"><?=$smenu['title']; ?></a>
                <?php } ?>                
            </div>
        </div>
        <?php } ?>
    </li>
    <?php } ?>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <!-- <hr class="sidebar-divider d-none d-md-block"> -->

    <!-- Sidebar Toggler (Sidebar) -->
    <!-- <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> -->

    <!-- Sidebar Message -->
    <!-- <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div> -->

</ul>
<!-- End of Sidebar -->