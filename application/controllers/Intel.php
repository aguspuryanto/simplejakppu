<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Intel extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_perkara');
		$this->load->model('M_perkara_pidsus');
		$this->load->model('M_penahanan');
		$this->load->model('M_pnbp');
		$this->load->model('M_sptugas');
		$this->load->model('M_cegahtangkal');
		$this->load->model('M_buron');
		$this->load->model('M_traffikwna');
		$this->load->model('M_wnapidana');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;

		// $data['page'] 		= "kota";
		// $data['judul'] 		= "Data Kota";
		// $data['deskripsi'] 	= "Manage Data Kota";

		// $data['modal_tambah_kota'] = show_my_modal('modals/modal_tambah_kota', 'tambah-kota', $data);

		// $this->template->views('kota/home', $data);
		// redirect('/papan-kontrol/pidum');
		echo "Hallo Intelijen";
	}

	public function intel() {
		$data['userdata'] 	= $this->userdata;

		$options = array('jenis_module' => 'intelijen');
		$data['dataPidum'] = $this->M_perkara->select_all($options);
		$data['dataPenahanan'] = $this->M_penahanan->select_all($options);
		$data['dataPnbp'] = $this->M_pnbp->select_all($options);
		
		$data['page'] 		= "Intelijen";

		$this->template->views('intel/index', $data);
	}

	public function intel_add() {		
		$this->load->library('form_validation');
		
		$model = $this->M_perkara;

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
				'jenis_module' => 'intelijen',
				'keterangan' => $this->input->post('description'),
			);

			$model->save($data);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
			$json = array('success' => true, 'message' => 'Berhasil disimpan');
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($json));
	}

	public function sp_tugas() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_sptugas;
		$options = array('jenis_module' => 'sptugas');
		$data['dataSptugas'] = $this->M_sptugas->select_all($options);

		$data['judul'] 		= "Surat Perintah Tugas";
		$data['deskripsi'] 	= "";
		$data['page'] 		= "Intelijen";

		$this->template->views('intel/sp_tugas', $data);
	}

	public function sp_tugas_add() {		
		$this->load->library('form_validation');

		$model = $this->M_sptugas;

		$this->form_validation->set_rules($model->rules());

		$this->form_validation->set_message('required', 'Mohon lengkapi {field}!');

		if (!$this->form_validation->run()) {
			foreach($model->rules() as $key => $val) {
				$json = array_merge($json, array(
					$val['field'] => form_error($val['field'], '<p class="mt-3 text-danger">', '</p>')
				));
			}
		} else {
			$data = array(
				'sumber_info' => $this->input->post('sumber_info'),
				'sp_tugas' => $this->input->post('sp_tugas'),
				'objek_tugas' => $this->input->post('objek_tugas'),
				'kasus_posisi' => $this->input->post('kasus_posisi'),
				'permasalahan' => $this->input->post('permasalahan'),
				'potensi_aght' => $this->input->post('potensi_aght'),
				'tahapan' => $this->input->post('tahapan'),
				'keterangan' => $this->input->post('keterangan'),
				'jenis_module' => $this->input->post('jenis_module'),
			);

			$model->save($data);
			$this->session->set_flashdata('success', 'Berhasil disimpan');
			$json = array('success' => true, 'message' => 'Berhasil disimpan');
			
		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($json));
	}

	public function op_intelijen() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_sptugas;
		$options = array('jenis_module' => 'opintelijen');
		$data['dataSptugas'] = $this->M_sptugas->select_all($options);

		$data['judul'] 		= "Operasi Intelijen Yustisial";
		$data['deskripsi'] 	= "";
		$data['page'] 		= "Intelijen";

		$this->template->views('intel/op_intelijen', $data);
	}

	public function cegah_tangkal() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_cegahtangkal;
		$data['dataSptugas'] = $this->M_cegahtangkal->select_all();

		$data['judul'] 		= "Pencegahan dan Penangkalan";
		$data['deskripsi'] 	= "";
		$data['page'] = "Intelijen";

		$this->template->views('intel/cegah_tangkal', $data);
	}

	public function tangkap_buron() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_buron;
		$data['dataSptugas'] = $this->M_buron->select_all();

		$data['judul'] 		= "Tangkap Buron";
		$data['deskripsi'] 	= "";
		$data['page'] = "Intelijen";

		$this->template->views('intel/tangkap_buron', $data);
	}

	public function awas_wna() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_traffikwna;
		$data['dataSptugas'] = $this->M_traffikwna->select_all();

		$data['judul'] 		= "PENGAWASAN LALU LINTAS WNA";
		$data['deskripsi'] 	= "";
		$data['page'] = "Intelijen";

		$this->template->views('intel/awas_wna', $data);
	}

	// pidana_wna, proyek_strategis, berantas_mafia, cepat_investasi
	public function pidana_wna() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_wnapidana;
		$data['dataSptugas'] = $this->M_wnapidana->select_all();

		$data['judul'] 		= "PENGAWASAN LALU LINTAS WNA";
		$data['deskripsi'] 	= "";
		$data['page'] = "Intelijen";

		$this->template->views('intel/pidana_wna', $data);
	}

	public function proyek_strategis() {
		$data['userdata'] 	= $this->userdata;

		$this->load->model('M_proyek');
		$data['model'] = $this->M_proyek;
		$data['dataSptugas'] = $this->M_proyek->select_all();

		$data['judul'] 		= "PROYEK STRATEGIS";
		$data['deskripsi'] 	= "";
		$data['page'] = "Intelijen";

		$this->template->views('intel/proyek_strategis', $data);
	}

	public function berantas_mafia() {
		$data['userdata'] 	= $this->userdata;

		$this->load->model('M_mafia');
		$data['model'] = $this->M_mafia;
		$data['dataSptugas'] = $this->M_mafia->select_all();

		$data['judul'] 		= "TIM PEMBERANTASAN MAFIA TANAH";
		$data['deskripsi'] 	= "";
		$data['page'] = "Intelijen";

		$this->template->views('intel/berantas_mafia', $data);
	}

	public function cepat_investasi() {
		$data['userdata'] 	= $this->userdata;

		$options = array('jenis_module' => 'intelijen');
		$data['page'] = "Intelijen";

		$this->template->views('intel/cepat_investasi', $data);
	}
}

/* End of file Intel.php */
/* Location: ./application/controllers/Intel.php */