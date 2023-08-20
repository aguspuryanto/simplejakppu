<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datun extends AUTH_Controller {
	public $jenis_module = 'datun';
	public function __construct() {
		parent::__construct();
		$this->load->model('M_perkara');
		$this->load->model('M_perkara_pidsus');
		$this->load->model('M_penahanan');
		$this->load->model('M_pnbp');
		$this->load->model('M_datun');
	}

	public function index() {
		// Statistik DATUN
		// 1.	Bantuan Hukum (Litigasi dan non Litigasi)
		// 2.	Pertimbangan Hukum (pendampingan hukum, pendapat hukum dan audit hukum)
		// 3.	Tindakan Hukum Lain
		// 4.	Penegakan Hukum
		// 5.	Pelayanan Hukum (tertulis dan lisan)
		// 6.	Kegiatan penanggulangan Stunting
		// 7.	Kegiatan dukungan penggunaan TKDN
		// 8.	Kegiatan penanggulangan dampak inflasi daerah
		// 9.	Kegiatan penanggulangan kemisikinan ekstrim
		// 10.	Kegiatan dukungan UMKM
		// 11.	Kegiatan suporting IKN

		// GAKKUM 
		// TIMKUM
		// BANKUM
		// THL
		// YANKUM
		// Penyelamatan KN
		// Pemulihan KN
		
		$data['userdata'] 		= $this->userdata;

		// $data['data_perkara'] = isset($data_perkara) ? json_encode($data_perkara) : [];
		// $data['data_pnbp'] = isset($data_pnbp) ? json_encode($data_pnbp) : [];
		$data['data_perkara'] = $this->M_perkara->getPerkaraAll();
		$data['data_pnbp'] = $this->M_pnbp->statistik_pnbp();
		$data['data_statistik'] = $this->M_perkara->stat_perkara($this->jenis_module);
		
		$data['data_statistik_perkara'] = $this->M_perkara->getPerkaraStatistik($this->jenis_module);
		$data['data_statistik_pidana'] = $this->M_perkara->getTerpidanaStatistik($this->jenis_module);
		// echo json_encode($data_statistik_pidana);

		$data['page'] 			= "DATUN";
		$data['judul'] 			= "Statistik Datun";
		$data['deskripsi'] 		= "";

		$this->template->views('datun/home', $data);
	}

	public function datun() {
		$data['userdata'] 	= $this->userdata;

		// $options = array('jenis_module' => 'datun');
		$data['model'] = $this->M_datun;
		$data['dataDatun'] = $this->M_datun->select_all();
		
		$data['page'] 		= "DATUN";

		$this->template->views('datun/index', $data);
	}

	public function datun_add() {
		$this->load->library('form_validation');
		
		$model = $this->M_datun;

        $json = array();
		// $this->form_validation->set_rules('pulbaket_no', 'PULBAKET NO', 'required');
		$this->form_validation->set_rules($model->rules());

		$this->form_validation->set_message('required', 'Mohon lengkapi {field}!');

		if (!$this->form_validation->run()) {			
			foreach($model->rules() as $key => $val) {
				$json = array_merge($json, array(
					$val['field'] => form_error($val['field'], '<p class="mt-3 text-danger">', '</p>')
				));
			}
		} else {
			// $data = array(
			// 	'skk' => $this->input->post('skk'),
			// 	'kegiatan' => $this->input->post('kegiatan'),
			// 	'penggugat' => $this->input->post('penggugat'),
			// 	'tergugat' => $this->input->post('tergugat'),
			// 	'seksi' => $this->input->post('seksi'),
			// 	'sk_tim' => $this->input->post('sk_tim'),
			// 	'posisi_kasus' => $this->input->post('posisi_kasus'),
			// 	'tahap' => $this->input->post('tahap'),
			// 	'periode' => $this->input->post('periode'),
			// 	'keterangan' => $this->input->post('keterangan'),
			// );

			$data = array(
				'skk' => $this->input->post('skk'),
				'kategori' => $this->input->post('kategori'),
				'kegiatan' => $this->input->post('kegiatan'),
				'pemohon' => $this->input->post('pemohon'),
				'jenis_perkara' => $this->input->post('jenis_perkara'),
				'dok_sp1' => $this->input->post('dok_sp1'),
				'dok_telaah' => $this->input->post('dok_telaah'),
				'dok_sp2' => $this->input->post('dok_sp2'),
				'kasus_posisi' => $this->input->post('kasus_posisi'),
				'tahap' => $this->input->post('tahap'),
				'laporan_kegiatan' => $this->input->post('laporan_kegiatan'),
				'uang_selamat' => $this->input->post('uang_selamat'),
				'uang_dipulihkan' => $this->input->post('uang_dipulihkan'),
				'petunjuk_kajari' => $this->input->post('petunjuk_kajari'),
				'saran_kasi' => $this->input->post('saran_kasi'),
				'keterangan' => $this->input->post('keterangan'),
			);

			if($this->input->post('id')) {
				$id = $this->input->post('id');
				$model->update($id, $data);				
			} else {
				$model->save($data);
			}

            $this->session->set_flashdata('success', 'Berhasil disimpan');
			$json = array('success' => true, 'message' => 'Berhasil disimpan');
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($json));
		
	}

	public function gakkum() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_datun;
		// $data['dataDatun'] = $this->M_datun->select_all([], 'like', 'Penegakan Hukum');
		$data['dataDatun'] = $this->M_datun->select_all(['kategori' => 'gakkum']);

		$data['page'] 		= "DATUN";
		$data['judul'] 		= "Penegakan Hukum (Gakkum)";

		// $this->template->views('_under_develop', $data);
		$this->template->views('datun/_gakkum', $data);
	}

	public function timkum() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_datun;
		// Legal Opinian (LO), Legal Assistant (LA)
		// $data['dataDatun'] = $this->M_datun->select_all([], 'like', 'Pendapat Hukum');
		$data['dataDatun'] = $this->M_datun->select_all(['kategori' => 'timkum']);

		$data['page'] 		= "DATUN";
		$data['judul'] 		= "Pendapat Hukum (Timkum)";

		// $this->template->views('_under_develop', $data);
		$this->template->views('datun/_timkum', $data);
	}

	public function bankum() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_datun;
		// $data['dataDatun'] = $this->M_datun->select_all([], 'like', 'Bantuan Hukum');
		$data['dataDatun'] = $this->M_datun->select_all(['kategori' => 'bankum']);

		$data['page'] 		= "DATUN";
		$data['judul'] 		= "Bantuan Hukum (Bankum)";

		// $this->template->views('_under_develop', $data);
		$this->template->views('datun/_bankum', $data);
	}

	public function thl() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_datun;
		// Tindakan Hukum Lain, Konsiliasi, Mediasi, Fasilitasi
		// $data['dataDatun'] = $this->M_datun->select_all([], 'like', 'Tindakan Hukum Lain');
		$data['dataDatun'] = $this->M_datun->select_all(['kategori' => 'thl']);

		$data['page'] 		= "DATUN";
		$data['judul'] 		= "Tindakan Hukum Lain (THL)";

		// $this->template->views('_under_develop', $data);
		$this->template->views('datun/_thl', $data);
	}

	public function yankum() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_datun;
		// $data['dataDatun'] = $this->M_datun->select_all([], 'like', 'Pelayanan Hukum');
		$data['dataDatun'] = $this->M_datun->select_all(['kategori' => 'yankum']);

		$data['page'] 		= "DATUN";
		$data['judul'] 		= "Pelayanan Hukum (YANKUM)";

		// $this->template->views('_under_develop', $data);
		$this->template->views('datun/_yankum', $data);
	}

	public function penyelamatan_kn() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_datun;
		$data['dataDatun'] = $this->M_datun->select_all([], 'like', 'Penyelamatan');

		$data['page'] 		= "DATUN";
		$data['judul'] 		= "Penyelamatan Keuangan Negara (Penyelamatan KN)";

		// $this->template->views('_under_develop', $data);
		$this->template->views('datun/_penyelamatan_kn', $data);
	}

	public function pemulihan_kn() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_datun;
		$data['dataDatun'] = $this->M_datun->select_all([], 'like', 'Pemulihan');

		$data['page'] 		= "DATUN";
		$data['judul'] 		= "Pemulihan Keuangan Negara (Pemulihan KN)";

		// $this->template->views('_under_develop', $data);
		$this->template->views('datun/_pemulihan_kn', $data);
	}

	public function datun_detail($id) {
		$data['userdata'] 	= $this->userdata;
		$data['data'] = $this->M_datun->select_by_id($id);

		$json = array();
		if($data['data']) {
			$json = array('success' => true, 'data' => $data['data']);
		} else {
			$json = array('success' => false, 'data' => []);
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($json));
	}

	public function datun_note() {
		$data['userdata'] 	= $this->userdata;
		$json = array();
		$model = $this->M_datun;

		if($this->input->post('id')) {
			$id = $this->input->post('id');
			$model->update($id, array(
				'kajari_note' => $this->input->post('kajari_note')
			));

			$this->session->set_flashdata('success', 'Berhasil disimpan');
			$json = array('success' => true, 'message' => 'Berhasil disimpan');
		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($json));
	}

	public function datun_remove() {
		$json = array();
		$model = $this->M_datun;

		if($this->input->post('id')) {
			$id = $this->input->post('id');
			$model->delete($id);

			$this->session->set_flashdata('success', 'Berhasil terhapus');
			$json = array('success' => true, 'message' => 'Berhasil terhapus');
		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($json));
	}

	public function datun_kegiatan($kat) {
		$data['userdata'] 	= $this->userdata;
		
		$this->load->model('M_datun_menu');
		// if($kat == 'gakkum') {
		// 	$html = '<option value="gakkum_ligitasi">Ligitasi</option>
		// 	<option value="gakkum_nonligitasi">Non Ligitasi</option>';
		// } elseif ($kat == 'timkum') {
		// 	$html = '<option value="timkum_lo">Legal Opinian (LO)</option>
		// 	<option value="timkum_la">Legal Assistant (LA)</option>';
		// } elseif ($kat == 'bankum') {
		// 	$html = '<option value="bankum_ligitasi">Ligitasi</option>
		// 	<option value="bankum_nonligitasi">Non Ligitasi</option>';
		// } elseif ($kat == 'thl') {
		// 	$html = '<option value="thl_kosiliasi">Kosiliasi</option>
		// 	<option value="thl_mediasi">Mediasi</option>
		// 	<option value="thl_fasilitasi">Fasilitasi</option>';
		// } elseif ($kat == 'yankum') {
		// 	$html = '<option value="yankum">Pelayanan Hukum</option>
		// 	<option value="yankum_lisan">Pelayanan Hukum Lisan</option>';
		// }

		$menu = $this->M_datun_menu->select_all(['parent' => $kat]);
		$html = '';
		foreach($menu as $key => $val) {
			$html .= '<option value="'.$val->nama.'">'.$val->deskripsi.'</option>';
		}

		echo $html;
	}
}

/* End of file Kota.php */
/* Location: ./application/controllers/Kota.php */