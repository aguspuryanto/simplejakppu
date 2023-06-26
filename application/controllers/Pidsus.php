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
		// $data['userdata'] 	= $this->userdata;

		// $data['page'] 		= "kota";
		// $data['judul'] 		= "Data Kota";
		// $data['deskripsi'] 	= "Manage Data Kota";

		// $data['modal_tambah_kota'] = show_my_modal('modals/modal_tambah_kota', 'tambah-kota', $data);

		// $this->template->views('kota/home', $data);
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