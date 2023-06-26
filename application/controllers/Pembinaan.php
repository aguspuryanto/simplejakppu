<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembinaan extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		// $this->load->model('M_perkara');
		// $this->load->model('M_perkara_pidsus');
		// $this->load->model('M_penahanan');
		// $this->load->model('M_pnbp');
		$this->load->model('M_asset');
		$this->load->model('M_realisasi');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['model'] = $this->M_realisasi;
		$data['dataDatun'] = $this->M_realisasi->select_all();
		
		$data['page'] 		= "Perdata dan Tata Usaha Negara";

		// $this->template->views('pembinaan/index', $data);
		redirect('/Pembinaan/realisasi');
	}

	public function realisasi() {
		$data['userdata'] 	= $this->userdata;
		$data['model'] = $this->M_realisasi;
		$data['dataRealisasi'] = $this->M_realisasi->select_all();

		$data['page'] 		= "Perdata dan Tata Usaha Negara";

		$this->template->views('pembinaan/realisasi', $data);
	}

	public function rumdinas() {
		$data['userdata'] 	= $this->userdata;
		$data['model'] = $this->M_asset;

		$options = array('jenis_module' => 'rumdinas');
		$data['dataAsset'] = $this->M_asset->select_all($options);

		$data['page'] 		= "Rumah Dinas";

		$this->template->views('pembinaan/rumdinas', $data);
	}

	public function gedung() {
		$data['userdata'] 	= $this->userdata;
		$data['model'] = $this->M_asset;

		$options = array('jenis_module' => 'gedung');
		$data['dataAsset'] = $this->M_asset->select_all($options);

		$data['page'] 		= "Page";

		$this->template->views('pembinaan/gedung', $data);
	}

	public function kendaraan() {
		$data['userdata'] 	= $this->userdata;
		$data['model'] = $this->M_asset;

		$options = array('jenis_module' => 'kendaraan');
		$data['dataAsset'] = $this->M_asset->select_all($options);

		$data['page'] 		= "kendaraan";

		$this->template->views('pembinaan/kendaraan', $data);
	}

	public function asset_add() {
		$this->load->library('form_validation');
		
		$model = $this->M_asset;

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
				'nama_barang' => $this->input->post('nama_barang'),
				'tipe_barang' => $this->input->post('tipe_barang'),
				'kondisi_barang' => $this->input->post('kondisi_barang'),
				'tahun_barang' => $this->input->post('tahun_barang'),
				'nilai_barang' => preg_replace("/[^0-9]/", "", $this->input->post('nilai_barang')),
				'asal_barang' => $this->input->post('asal_barang'),
				'pj_barang' => $this->input->post('pj_barang'),
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

	public function realisasi_add() {
		$this->load->library('form_validation');
		
		$model = $this->M_realisasi;

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
				'kode_nama_kegiatan' => $this->input->post('kode_nama_kegiatan'),
				'pagu' => $this->input->post('pagu'),
				'periode_lalu' => preg_replace("/[^0-9]/", "", $this->input->post('periode_lalu')),
				'periode_ini' => preg_replace("/[^0-9]/", "", $this->input->post('periode_ini')),
				'periode_total' => preg_replace("/[^0-9]/", "", $this->input->post('periode_total')),
				'periode_persen' => $this->input->post('periode_persen'),
				'sisa_anggaran' => preg_replace("/[^0-9]/", "",$this->input->post('sisa_anggaran')),
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

/* End of file Pembinaan.php */
/* Location: ./application/controllers/Pembinaan.php */