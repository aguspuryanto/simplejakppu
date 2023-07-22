<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pidsus extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_perkara');
		$this->load->model('M_perkara_pidsus');
		$this->load->model('M_penahanan');
		$this->load->model('M_pnbp');
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
		$data['jml_perkara'] 	= $this->M_perkara->select_by(['jenis_module'=>'pidsus'])->jml;
		$data['jml_penahanan'] 	= $this->M_penahanan->total_rows();
		$data['jml_pnbp'] 		= $this->M_pnbp->total_pnbp();
		$data['userdata'] 		= $this->userdata;

		// $data['data_perkara'] = isset($data_perkara) ? json_encode($data_perkara) : [];
		// $data['data_pnbp'] = isset($data_pnbp) ? json_encode($data_pnbp) : [];
		$data['data_perkara'] = $this->M_perkara->getPerkaraAll();
		$data['data_pnbp'] = $this->M_pnbp->statistik_pnbp();
		$data['data_statistik'] = $this->M_perkara->stat_pidum();
		
		$data['data_statistik_perkara'] = $this->M_perkara->getPerkaraStatistik('pidsus');
		$data['data_statistik_pidana'] = $this->M_perkara->getTerpidanaStatistik('pidsus');
		// echo json_encode($data_statistik_pidana);

		$data['page'] 			= "home";
		$data['judul'] 			= "Statistik Pidana Khusus (Pidsus)";
		$data['deskripsi'] 		= "";

		$this->template->views('pidum/home', $data);
		// redirect('/papan-kontrol/pidum');
	}

	public function pidsus() {
		$data['userdata'] 	= $this->userdata;

		$options = array('jenis_module' => 'pidsus');
		$data['dataPidum'] = $this->M_perkara->select_all($options);
		$data['dataPenahanan'] = $this->M_penahanan->select_all($options);
		$data['dataPnbp'] = $this->M_pnbp->select_all($options);
		
		$data['page'] 		= "Pidana Khusus";

		$this->template->views('pidsus/index', $data);
	}

	public function pidsus_penahanan() {
		$data['userdata'] 	= $this->userdata;

		$options = array('jenis_module' => 'pidsus');
		$data['dataPidum'] = $this->M_perkara->select_all($options);
		$data['dataPenahanan'] = $this->M_penahanan->select_all($options);
		$data['dataPnbp'] = $this->M_pnbp->select_all($options);
		
		$data['page'] 		= "Pidana Khusus";

		$this->template->views('pidsus/penahanan', $data);
	}

	public function pidsus_pnbp() {
		$data['userdata'] 	= $this->userdata;

		$options = array('jenis_module' => 'pidsus');
		$data['dataPidum'] = $this->M_perkara->select_all($options);
		$data['dataPenahanan'] = $this->M_penahanan->select_all($options);
		$data['dataPnbp'] = $this->M_pnbp->select_all($options);

		$data['page'] 		= "Pidana Khusus";

		$this->template->views('pidsus/pnbp', $data);
	}

	public function pidsus_add() {
		$this->load->library('form_validation');
		
		$model = $this->M_perkara_pidsus;

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
}

/* End of file Pidsus.php */
/* Location: ./application/controllers/Pidsus.php */