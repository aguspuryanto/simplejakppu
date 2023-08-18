<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembinaan extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_asset');
		$this->load->model('M_realisasi');
		$this->load->model('M_pnbp');
		$this->load->model('M_bmnkelola');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['model'] = $this->M_realisasi;
		$data['dataDatun'] = $this->M_realisasi->select_all();
		
		$data['page'] 		= "PEMBINAAN";

		// $this->template->views('pembinaan/index', $data);
		redirect('/Pembinaan/realisasi');
	}

	public function realisasi() {
		$data['userdata'] 	= $this->userdata;
		$data['model'] = $this->M_realisasi;
		$data['dataRealisasi'] = $this->M_realisasi->select_all();

		$data['page'] 		= "PEMBINAAN";

		$this->template->views('pembinaan/realisasi', $data);
	}

	public function rumdinas() {
		$data['userdata'] 	= $this->userdata;
		$data['model'] = $this->M_asset;

		$options = array('jenis_module' => 'rumdinas');
		$data['dataAsset'] = $this->M_asset->select_all($options);

		$data['page'] 		= "PEMBINAAN";

		$this->template->views('pembinaan/rumdinas', $data);
	}

	public function gedung() {
		$data['userdata'] 	= $this->userdata;
		$data['model'] = $this->M_asset;

		$options = array('jenis_module' => 'gedung');
		$data['dataAsset'] = $this->M_asset->select_all($options);

		$data['page'] 		= "PEMBINAAN";

		$this->template->views('pembinaan/gedung', $data);
	}

	public function kendaraan() {
		$data['userdata'] 	= $this->userdata;
		$data['model'] = $this->M_asset;

		$options = array('jenis_module' => 'kendaraan');
		$data['dataAsset'] = $this->M_asset->select_all($options);

		$data['page'] 		= "PEMBINAAN";

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
				'pagu' => preg_replace("/[^0-9]/", "", $this->input->post('pagu')),
				'periode_lalu' => preg_replace("/[^0-9]/", "", $this->input->post('periode_lalu')),
				'periode_ini' => preg_replace("/[^0-9]/", "", $this->input->post('periode_ini')),
				'periode_total' => preg_replace("/[^0-9]/", "", $this->input->post('periode_total')),
				'periode_persen' => $this->input->post('periode_persen'),
				'sisa_anggaran' => preg_replace("/[^0-9]/", "",$this->input->post('sisa_anggaran')),
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

	public function penyerapan() {
		$data['userdata'] 	= $this->userdata;
		$data['model'] = $this->M_realisasi;
		$data['dataRealisasi'] = $this->M_realisasi->select_all(['tgl' => date('Y-m-d')]);

		$data['page'] 		= "PEMBINAAN";

		// $this->template->views('_under_develop', $data);
		$this->template->views('pembinaan/penyerapan', $data);
		
	}

	public function bmn() {
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "PEMBINAAN";
		$data['judul'] 		= "Barang Milik Negara (BMN)";
		$data['title'] 		= "Data BMN";

		$data['model'] = $this->M_bmnkelola;
		$data['dataPnbp'] = $this->M_bmnkelola->select_all();

		$this->template->views('pembinaan/bmn', $data);
	}

	public function add_bmn() {
		$this->load->library('form_validation');
		
		$model = $this->M_bmnkelola;

		$json = array();
		$this->form_validation->set_rules($model->rules());
		$this->form_validation->set_message('required', 'Mohon lengkapi {field}!');

		if (!$this->form_validation->run()) {
			foreach($model->rules() as $key => $val) {
				$json = array_merge($json, array(
					$val['field'] => form_error($val['field'], '<p class="mt-3 text-danger">', '</p>')
				));
			}
			$json = array_merge($json, array('success' => false, 'message' => 'Gagal tersimpan!'));
		}
		else {
			$data = array(
				'kelompok' => $this->input->post('kelompok'),
				'kode_barang' => $this->input->post('kode_barang'),
				'nama_barang' => $this->input->post('nama_barang'),
				'nup' => $this->input->post('nup'),
				'kondisi' => $this->input->post('kondisi'),
				'merk_tipe' => $this->input->post('merk_tipe'),
				'tgl_perolehan' => $this->input->post('tgl_perolehan'),
				'nilai_perolehan' => $this->input->post('nilai_perolehan'),
				'kuantiti' => preg_replace("/[^0-9]/", "", $this->input->post('kuantiti')),
				'status_kelola' => $this->input->post('status_kelola'),
				'no_psp' => $this->input->post('no_psp'),
				'tgl_psp' => $this->input->post('tgl_psp'),
				'nobpkb' => $this->input->post('nobpkb'),
				'nopol' => $this->input->post('nopol'),
				'pemakai' => $this->input->post('pemakai'),
				'jml_kib' => $this->input->post('jml_kib'),
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

	public function pnbp() {
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "PEMBINAAN";
		$data['judul'] 		= "Penerimaan Negara Bukan Pajak (PNBP)";

		$data['model'] = $this->M_pnbp;
		$data['dataPnbp'] = $this->M_pnbp->select_all();

		$this->template->views('pembinaan/pnbp', $data);

	}

	public function realisasi_detail($id) {
		$data['userdata'] 	= $this->userdata;
		$data['data'] = $this->M_realisasi->select_by_id($id);

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

	public function realisasi_note() {
		$data['userdata'] 	= $this->userdata;

		$json = array();
		$model = $this->M_realisasi;
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

	public function realisasi_remove() {
		$json = array();
		$model = $this->M_realisasi;
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

	// BMN
	public function bmn_detail($id) {
		$data['userdata'] 	= $this->userdata;
		$data['data'] = $this->M_bmnkelola->select_by_id($id);

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

	public function bmn_note() {
		$data['userdata'] 	= $this->userdata;

		$json = array();
		$model = $this->M_bmnkelola;
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

	public function bmn_remove() {
		$json = array();
		$model = $this->M_bmnkelola;
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

	// PNBP
	public function pnbp_detail($id) {
		$data['userdata'] 	= $this->userdata;
		$data['data'] = $this->M_pnbp->select_by_id($id);

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

	public function pnbp_note() {
		$data['userdata'] 	= $this->userdata;

		$json = array();
		$model = $this->M_pnbp;
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
}

/* End of file Pembinaan.php */
/* Location: ./application/controllers/Pembinaan.php */