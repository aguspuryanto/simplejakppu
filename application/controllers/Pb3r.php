<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pb3r extends AUTH_Controller {
	// public $jenis_module = 'pidum';

    public function __construct() {
		parent::__construct();
		$this->load->model('M_inkracth');
		$this->load->model('M_bbkelola');
		$this->load->model('M_bbsita');
    }

    public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_inkracth;
		$options = array('jenis_module' => 'bbkembali');
		$data['dataInkracth'] = $this->M_inkracth->select_all($options);

		$data['page'] 		= "bbkembali";
		$data['judul'] 		= " BARANG BUKTI DI KEMBALIKAN";
		$data['deskripsi'] 	= "";

		$this->template->views('pb3r/bbkembali', $data);
    }

	public function bbkelola() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_bbkelola;
		$options = array();
		$data['dataInkracth'] = $this->M_bbkelola->select_all($options);

		$data['page'] 		= "bbkelola";
		$data['judul'] 		= " BARANG BUKTI DIKELOLA";
		$data['deskripsi'] 	= "";

		$this->template->views('pb3r/bbkelola', $data);
	}

	public function bbkelola_add() {		
		$this->load->library('form_validation');
		
		$model = $this->M_bbkelola;
        $json = array();
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
				'tahun' => $this->input->post('tahun'),
				'jmlbb' => $this->input->post('jmlbb'),
				'jmlperkara' => $this->input->post('jmlperkara'),
				'keterangan' => $this->input->post('keterangan'),
			);

			if($model->save($data)) {
				$this->session->set_flashdata('success', 'Berhasil disimpan');
				$json = array('success' => true, 'message' => 'Berhasil disimpan');
			} else {
				$this->session->set_flashdata('error', 'Gagal disimpan');
				$json = array('success' => false, 'message' => 'Gagal disimpan');
			}
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($json));
	}

	public function bbsita() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_bbsita;
		$options = array();
		$data['dataInkracth'] = $this->M_bbsita->select_all($options);

		$data['page'] 		= "bbsita";
		$data['judul'] 		= " BARANG BUKTI DI SITA";
		$data['deskripsi'] 	= "";

		$this->template->views('pb3r/bbsita', $data);
	}

}