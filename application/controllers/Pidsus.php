<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pidsus extends AUTH_Controller {
	public $jenis_module = 'pidsus';
	public function __construct() {
		parent::__construct();
		$this->load->model('M_perkara');
		$this->load->model('M_perkara_pidsus');
		$this->load->model('M_penahanan');
		$this->load->model('M_pnbp');
		$this->load->model('M_mafia');
	}

	public function index() {
		// Statistik Pidsus :
		// 1. Perkara Pidsus
		// a. Sprintug
		// b. Penyelidikan
		// c. Penyidikan
		// d. Spdp
		// b. Pratut
		// c. TUT
		// d. Eksekusi
		// d. Upaya Hukum (Banding)
		// e. Upaya Hukum (Kasasi)
		// f. Upaya Hukum Luar Biasa (PK)
		// g. Lain-lain

		// 2. Jumlah Tersangka, Terdakwa dan Terpidana (Laki dan perempuan)
		// 3. Jumlah Tahanan  (Laki, perempuan dan anak)
		// 4. Tim pemberantasan mafia pelabuhan

		// $data['jml_perkara'] 	= $this->M_perkara->total_rows();
		$data['jml_perkara'] 	= $this->M_perkara->select_by(['jenis_module'=>$this->jenis_module])->jml;
		$data['jml_penahanan'] 	= $this->M_penahanan->total_rows();
		$data['jml_pnbp'] 		= $this->M_pnbp->total_pnbp();
		$data['userdata'] 		= $this->userdata;

		// $data['data_perkara'] = isset($data_perkara) ? json_encode($data_perkara) : [];
		// $data['data_pnbp'] = isset($data_pnbp) ? json_encode($data_pnbp) : [];
		$data['data_perkara'] = $this->M_perkara->getPerkaraAll();
		$data['data_pnbp'] = $this->M_pnbp->statistik_pnbp();
		$data['data_statistik'] = $this->M_perkara->stat_perkara($this->jenis_module);
		
		$data['data_statistik_perkara'] = $this->M_perkara->getPerkaraStatistik($this->jenis_module);
		$data['data_statistik_pidana'] = $this->M_perkara->getTerpidanaStatistik($this->jenis_module);
		// echo json_encode($data_statistik_pidana);

		$data['page'] 			= "PIDSUS";
		$data['judul'] 			= "Statistik Pidana Khusus (Pidsus)";
		$data['deskripsi'] 		= "";

		$this->template->views('pidum/home', $data);
		// redirect('/papan-kontrol/pidum');
	}

	public function pidsus() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_perkara;
		$options = array('jenis_module' => $this->jenis_module);
		$data['dataPidum'] = $this->M_perkara->select_all($options);
		// $data['dataPenahanan'] = $this->M_penahanan->select_all($options);
		// $data['dataPnbp'] = $this->M_pnbp->select_all($options);
		
		$data['page'] 		= "PIDSUS";
		$data['judul'] 		= "Data Perkara";

		$this->template->views('pidsus/index', $data);
	}

	public function penahanan() {
		$data['userdata'] 	= $this->userdata;

		$options = array('jenis_module' => $this->jenis_module);
		$data['dataPidum'] = $this->M_perkara->select_all($options);
		$data['dataPenahanan'] = $this->M_penahanan->select_all($options);
		$data['dataPnbp'] = $this->M_pnbp->select_all($options);
		
		$data['page'] 		= "PIDSUS";
		$data['judul'] 		= "Penahanan";

		$this->template->views('pidsus/penahanan', $data);
	}

	public function pidsus_pnbp() {
		$data['userdata'] 	= $this->userdata;

		$options = array('jenis_module' => $this->jenis_module);
		$data['dataPidum'] = $this->M_perkara->select_all($options);
		$data['dataPenahanan'] = $this->M_penahanan->select_all($options);
		$data['dataPnbp'] = $this->M_pnbp->select_all($options);

		$data['page'] 		= "PIDSUS";
		$data['judul'] 		= "Penerimaan Negara Bukan Pajak (PNBP)";

		$this->template->views('pidsus/pnbp', $data);
	}

	public function mafia_pelabuhan() {
		$data['userdata'] 	= $this->userdata;

		// $this->load->model('M_mafia');
		$data['model'] = $this->M_mafia;
		$options = array('jenis_module' => $this->jenis_module);
		$data['dataProvider'] = $this->M_mafia->select_all($options);

		// $options = array('jenis_module' => $this->jenis_module);
		// $data['dataPidum'] = $this->M_perkara->select_all($options);
		// $data['dataPenahanan'] = $this->M_penahanan->select_all($options);
		// $data['dataPnbp'] = $this->M_pnbp->select_all($options);

		$data['page'] 		= "PIDSUS";
		$data['judul'] 		= "Mafia Pelabuhan";

		$this->template->views('pidsus/mafia_pelabuhan', $data);
	}

	public function berantasmafia_add() {
		$this->load->library('form_validation');

		$model = $this->M_mafia;
		$this->form_validation->set_rules($model->rules());
		$this->form_validation->set_message('required', 'Mohon lengkapi {field}!');

		$json = array();
		if (!$this->form_validation->run()) {
			foreach($model->rules() as $key => $val) {
				$json = array_merge($json, array(
					$val['field'] => form_error($val['field'], '<p class="mt-3 text-danger">', '</p>')
				));
			}
		} else {
			$data = array(
				'sumber_info' => $this->input->post('sumber_info'),
				'lokasi' => $this->input->post('lokasi'),
				'pemilik' => $this->input->post('pemilik'),
				'bukti' => $this->input->post('bukti'),
				'luas' => $this->input->post('luas'),
				'ksus_posisi' => $this->input->post('ksus_posisi'),
				'prmasalahan' => $this->input->post('prmasalahan'),
				'potensi_mafia' => $this->input->post('potensi_mafia'),
				'tahapan' => $this->input->post('tahapan'),
				'keterangan' => $this->input->post('keterangan'),
				'jenis_module' => $this->input->post('jenis_module')
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

	public function pidsus_add() {
		$this->load->library('form_validation');
		
		$model = $this->M_perkara;

        $json = array();
		$this->form_validation->set_rules($model->rules());
		$this->form_validation->set_message('required', 'Mohon lengkapi {field}!');

		if (!$this->form_validation->run()) {			
			foreach($model->rules() as $key => $val) {
				$json = array_merge($json, array(
					$val['field'] => form_error($val['field'], '<p class="mt-3 text-danger">', '</p>')
				));
			}
			$json['success'] = false;
			$json['message'] = validation_errors();
		} else {
			$data = array(
				'pulbaket_no' => $this->input->post('pulbaket_no'),
				'penyelidik_no' => $this->input->post('penyelidik_no'),
				'penyidikan_no' => $this->input->post('penyidikan_no'),
				'instansi_asal' => $this->input->post('instansi_asal'),
				'nama_tsk' => $this->input->post('nama_tsk'),
				'pasal_tsk' => $this->input->post('pasal_tsk'),
				'jenis_perkara' => $this->input->post('jenis_perkara'),
				'tahap_1' => $this->input->post('tahap_1'),
				'tahap_1_tipe' => $this->input->post('tahap_1_tipe'),
				'tahap_1_proses' => $this->input->post('tahap_1_proses'),
				'tahap_2' => $this->input->post('tahap_2'),
				'limpah_pn' => $this->input->post('limpah_pn'),
				'putus_pn' => $this->input->post('putus_pn'),
				'banding_pn' => $this->input->post('banding_pn'),
				'kasasi_pn' => $this->input->post('kasasi_pn'),
				'eksekusi_pn' => $this->input->post('eksekusi_pn'),
				'grasi_pn' => $this->input->post('grasi_pn'),
				'pk_pn' => $this->input->post('pk_pn'),
				'pekating_pn' => $this->input->post('pekating_pn'),
				'jenis_module' => 'pidsus',
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

	public function pidsus_detail($id) {
		$data['userdata'] 	= $this->userdata;

		// $model = $this->M_perkara;
		$data['data'] = $this->M_perkara->select_by_id($id);

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

	public function pidsus_note() {
		$data['userdata'] 	= $this->userdata;

		$json = array();
		$model = $this->M_perkara;

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

	public function pidsus_remove() {
		$json = array();
		$model = $this->M_perkara;

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

	// Penahanan
	public function tahan_detail($id) {
		$data['userdata'] 	= $this->userdata;

		// $model = $this->M_perkara;
		$data['data'] = $this->M_penahanan->select_by_id($id);

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

	public function tahan_note() {
		$data['userdata'] 	= $this->userdata;

		$json = array();
		$model = $this->M_penahanan;
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

	public function tahan_remove() {
		$json = array();
		$model = $this->M_penahanan;
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

	// Mafia
	public function mafia_detail($id) {
		$data['userdata'] 	= $this->userdata;

		// $model = $this->M_perkara;
		$data['data'] = $this->M_mafia->select_by_id($id);

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

	public function mafia_note() {
		$data['userdata'] 	= $this->userdata;

		$json = array();
		$model = $this->M_mafia;
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

	public function mafia_remove() {
		$json = array();
		$model = $this->M_mafia;

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
}

/* End of file Pidsus.php */
/* Location: ./application/controllers/Pidsus.php */