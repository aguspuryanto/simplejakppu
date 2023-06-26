<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datun extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_perkara');
		$this->load->model('M_perkara_pidsus');
		$this->load->model('M_penahanan');
		$this->load->model('M_pnbp');
		$this->load->model('M_datun');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;

		// $data['page'] 		= "kota";
		// $data['judul'] 		= "Data Kota";
		// $data['deskripsi'] 	= "Manage Data Kota";

		// $data['modal_tambah_kota'] = show_my_modal('modals/modal_tambah_kota', 'tambah-kota', $data);

		// $this->template->views('kota/home', $data);
		redirect('/Datun/datun');
		// echo "Hallo Datun";
	}

	public function datun() {
		$data['userdata'] 	= $this->userdata;

		// $options = array('jenis_module' => 'datun');
		$data['model'] = $this->M_datun;
		$data['dataDatun'] = $this->M_datun->select_all();
		
		$data['page'] 		= "Perdata dan Tata Usaha Negara";

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
			$data = array(
				'skk' => $this->input->post('skk'),
				'kegiatan' => $this->input->post('kegiatan'),
				'penggugat' => $this->input->post('penggugat'),
				'tergugat' => $this->input->post('tergugat'),
				'seksi' => $this->input->post('seksi'),
				'sk_tim' => $this->input->post('sk_tim'),
				'posisi_kasus' => $this->input->post('posisi_kasus'),
				'tahap' => $this->input->post('tahap'),
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

/* End of file Kota.php */
/* Location: ./application/controllers/Kota.php */