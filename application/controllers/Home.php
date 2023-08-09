<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_perkara');
		$this->load->model('M_penahanan');
		$this->load->model('M_pnbp');

		// $this->load->model('M_pegawai');
		// $this->load->model('M_posisi');
		// $this->load->model('M_kota');
	}

	public function index() {
		$data['jml_perkara'] 	= $this->M_perkara->total_rows();
		$data['jml_penahanan'] 	= $this->M_penahanan->total_rows();
		$data['jml_pnbp'] 		= $this->M_pnbp->total_pnbp();
		$data['userdata'] 		= $this->userdata;

		$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
		
		$perkara 				= $this->M_perkara->select_all();
		$index = 0;
		foreach ($perkara as $value) {
		    $color = '#' .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)];

			// $pegawai_by_posisi = $this->M_pegawai->select_by_posisi($value->id);
			$module = $this->M_perkara->select_by(['jenis_module'=>$value->jenis_module]);

			$data_perkara[$index]['value'] = $module->jml;
			$data_perkara[$index]['color'] = $color;
			$data_perkara[$index]['highlight'] = $color;
			$data_perkara[$index]['label'] = ucwords($value->jenis_module);
			
			$index++;
		}

		$pnbp 				= $this->M_pnbp->select_all();
		$index = 0;
		foreach ($pnbp as $value) {
		    $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];

			// $pegawai_by_kota = $this->M_pegawai->select_by_kota($value->id);
			$pnbp_by_jenis = $this->M_pnbp->select_by_perkara($value->jenis_pnpb);

			$data_pnbp[$index]['value'] = $pnbp_by_jenis->jumlah_pnpb;
			$data_pnbp[$index]['color'] = $color;
			$data_pnbp[$index]['highlight'] = $color;
			$data_pnbp[$index]['label'] = $value->jenis_pnpb;
			
			$index++;
		}

		// $listperkara = $this->M_perkara->getPerkaraAll();
		$listperkara = array_reverse(array_values(array_column(
			array_reverse($this->M_perkara->getPerkaraAll()), null, 'label'
		)));
		$data['data_perkara'] = $listperkara;
		$data['data_pnbp'] = $this->M_pnbp->statistik_pnbp();
		$data['data_statistik'] = $this->M_perkara->stat_perkara();
		
		// 2. Jenis perkara : 
		$data['data_statistik_perkara'] = $this->M_perkara->getPerkaraStatistik();

		// 3. Jumlah Tersangka, Terdakwa dan Terpidana (Laki, perempuan dan anak)
		$data['data_statistik_pidana'] = $this->M_perkara->getTerpidanaStatistik();

		// 4. Jumlah Tahanan (Laki, perempuan dan anak)
		$data['data_statistik_tahanan'] = $this->M_perkara->getTahananStatistik();

		$data['page'] 			= "home";
		$data['judul'] 			= "Beranda";
		$data['deskripsi'] 		= "Manage Data CRUD";
		$this->template->views('home', $data);
		// $this->template->render('home', $data);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
