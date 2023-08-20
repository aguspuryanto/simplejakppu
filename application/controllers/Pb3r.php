<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pb3r extends AUTH_Controller {
	// public $jenis_module = 'pidum';

    public function __construct() {
		parent::__construct();
		$this->load->model('M_inkracth');
		$this->load->model('M_bbkelola');
		$this->load->model('M_bbsita');
		$this->load->model('M_bblelang');
		$this->load->model('M_bbtidaklaku');

		$this->load->model('M_uangganti');
		$this->load->model('M_uangdenda');
		$this->load->model('M_uangrampas');
    }

    public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_inkracth;
		$options = array('jenis_module' => 'bbkembali');
		$data['dataInkracth'] = $this->M_inkracth->select_all($options);

		$data['page'] 		= "PB3R";
		$data['judul'] 		= " BARANG BUKTI DI KEMBALIKAN";
		$data['deskripsi'] 	= "";

		$this->template->views('pb3r/bbkembali', $data);
    }

	public function bbkelola() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_bbkelola;
		// $options = array();
		$data['dataInkracth'] = $this->M_bbkelola->select_all();

		$data['page'] 		= "PB3R";
		$data['judul'] 		= "BARANG BUKTI & BARANG RAMPASAN";
		$data['deskripsi'] 	= "";

		// $this->template->views('pb3r/bbkelola', $data);
		$this->template->views('pb3r/_bbkelola', $data);
		// $this->template->render('sbadmin/pb3r/bbkelola', $data);
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
			// $data = array(
			// 	'tahun' => $this->input->post('tahun'),
			// 	'jmlbb' => $this->input->post('jmlbb'),
			// 	'jmlperkara' => $this->input->post('jmlperkara'),
			// 	'keterangan' => $this->input->post('keterangan'),
			// );

			$data = array(
				'nama_terdakwa' => $this->input->post('nama_terdakwa'),
				'reg_bb' => $this->input->post('reg_bb'),
				'pasal_disangka' => $this->input->post('pasal_disangka'),
				'bb' => $this->input->post('bb'),
				'pasal_terbukti' => $this->input->post('pasal_terbukti'),
				'putusan' => $this->input->post('putusan'),
				'eksekusi' => $this->input->post('eksekusi'),
				'dokumen' => $this->input->post('dokumen'),
				'petunjuk' => $this->input->post('petunjuk'),
				'tahun' => ($this->input->post('tahun')) ?? date('Y'),
			);

			// if($model->save($data) == 1) {
				$model->save($data);
				$this->session->set_flashdata('success', 'Berhasil disimpan');
				$json = array('success' => true, 'message' => 'Berhasil disimpan');
			// } else {
				// $this->session->set_flashdata('error', 'Gagal disimpan');
				// $json = array('success' => false, 'message' => 'Gagal disimpan');
			// }
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

		$data['page'] 		= "PB3R";
		$data['judul'] 		= "EKSEKUSI BARANG BUKTI SITAAN";
		$data['deskripsi'] 	= "";

		$this->template->views('pb3r/bbsita', $data);
	}

	public function bbsita_add() {		
		$this->load->library('form_validation');
		
		$model = $this->M_bbsita;
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
				'ba20' => $this->input->post('ba20'),
				'ba23' => $this->input->post('ba23'),
				'keterangan' => $this->input->post('keterangan'),
			);

			// if($model->save($data)) {
				$model->save($data);
				$this->session->set_flashdata('success', 'Berhasil disimpan');
				$json = array('success' => true, 'message' => 'Berhasil disimpan');
			// } else {
			// 	$this->session->set_flashdata('error', 'Gagal disimpan');
			// 	$json = array('success' => false, 'message' => 'Gagal disimpan');
			// }
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($json));		
	}

	public function bbkembali() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_inkracth;
		$options = array('jenis_module' => 'bbkembali');
		$data['dataInkracth'] = $this->M_inkracth->select_all($options);

		$data['judul'] 		= "BARANG BUKTI DI KEMBALIKAN";
		$data['deskripsi'] 	= "";
		$data['page'] 		= "PB3R";

		$this->template->views('pb3r/bbkembali', $data);
	}

	public function bblelang() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_bblelang;
		$options = array();
		$data['dataInkracth'] = $this->M_bblelang->select_all($options);
		
		$data['page'] 		= "PB3R";
		$data['judul'] 		= "EKSEKUSI BARANG RAMPASAN NEGARA (LELANG)";
		$data['deskripsi'] 	= "";

		$this->template->views('pb3r/bblelang', $data);
	}

	public function bblelang_add() {		
		$this->load->library('form_validation');
		
		$model = $this->M_bblelang;
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
				'jml' => $this->input->post('jml'),
				'hasil' => $this->input->post('hasil'),
				'keterangan' => $this->input->post('keterangan'),
			);

			// if($model->save($data)) {
				$model->save($data);
				$this->session->set_flashdata('success', 'Berhasil disimpan');
				$json = array('success' => true, 'message' => 'Berhasil disimpan');
			// } else {
			// 	$this->session->set_flashdata('error', 'Gagal disimpan');
			// 	$json = array('success' => false, 'message' => 'Gagal disimpan');
			// }
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($json));		
	}

	public function bbtidaklaku() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_bbtidaklaku;
		$options = array();
		$data['dataInkracth'] = $this->M_bbtidaklaku->select_all($options);
		
		$data['page'] 		= "PB3R";
		$data['judul'] 		= "BARANG RAMPASAN YANG TIDAK LAKU TERJUAL (LELANG)";
		$data['deskripsi'] 	= "";

		$this->template->views('pb3r/bbtidaklaku', $data);
	}

	public function bbtidaklaku_add() {		
		$this->load->library('form_validation');
		
		$model = $this->M_bbtidaklaku;
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
				'jml' => $this->input->post('jml'),
				'hasil' => $this->input->post('hasil'),
				'keterangan' => $this->input->post('keterangan'),
			);

			// if($model->save($data)) {
				$model->save($data);
				$this->session->set_flashdata('success', 'Berhasil disimpan');
				$json = array('success' => true, 'message' => 'Berhasil disimpan');
			// } else {
			// 	$this->session->set_flashdata('error', 'Gagal disimpan');
			// 	$json = array('success' => false, 'message' => 'Gagal disimpan');
			// }
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($json));
	}

	public function uangganti() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_uangganti;
		$options = array();
		$data['dataInkracth'] = $this->M_uangganti->select_all($options);
		
		$data['page'] 		= "PB3R";
		$data['judul'] 		= "Uang Pengganti";
		$data['deskripsi'] 	= "";

		$this->template->views('pb3r/uangganti', $data);
	}

	public function uangdenda() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_uangdenda;
		$options = array();
		$data['dataInkracth'] = $this->M_uangdenda->select_all($options);
		
		$data['page'] 		= "PB3R";
		$data['judul'] 		= "DENDA";
		$data['deskripsi'] 	= "";

		$this->template->views('pb3r/uangdenda', $data);
	}

	public function uangrampas() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_uangrampas;
		$options = array();
		$data['dataInkracth'] = $this->M_uangrampas->select_all($options);

		$data['page'] 		= "PB3R";
		$data['judul'] 		= "UANG RAMPASAN";
		$data['deskripsi'] 	= "";

		$this->template->views('pb3r/uangrampas', $data);
	}

	public function uangdenda_add() {
		$this->load->library('form_validation');
		
		// echo $this->input->post('jenis_module'); die();
		$form_data = $this->input->post();
		// echo json_encode($form_data); die();

		if($form_data['jenis_module'] == 'uangganti') $model = $this->M_uangganti;
		if($form_data['jenis_module'] == 'uangdenda') $model = $this->M_uangdenda;
		if($form_data['jenis_module'] == 'uangrampas') $model = $this->M_uangrampas;

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
				'perkara' => $this->input->post('perkara'),
				'hasil' => $this->input->post('hasil'),
				'keterangan' => $this->input->post('keterangan'),
			);

			// if($model->save($data)) {
				$insert = $model->save($data);
				if(!$insert) {
					$this->session->set_flashdata('error', 'Gagal disimpan');
					$json = array('success' => false, 'message' => 'Gagal disimpan');
				} else {
					$this->session->set_flashdata('success', 'Berhasil disimpan');
					$json = array('success' => true, 'message' => 'Berhasil disimpan');
				}
			// } else {
			// 	$this->session->set_flashdata('error', 'Gagal disimpan');
			// 	$json = array('success' => false, 'message' => 'Gagal disimpan');
			// }
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($json));		
	}

	public function bb_statistik() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_bbkelola;
		$options = array();
		$data['dataInkracth'] = $this->M_bbkelola->select_all($options);

		$data['page'] 		= "PB3R";
		$data['judul'] 		= "STATISTIK BB & RAMPASAN";
		$data['deskripsi'] 	= "";
		
		$this->template->views('pb3r/_statistik', $data);
	}

	// BB Kelola
	public function bbkelola_detail($id) {
		$data['userdata'] 	= $this->userdata;

		// $model = $this->M_perkara;
		$data['data'] = $this->M_bbkelola->select_by_id($id);
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

	public function bbkelola_note() {
		$data['userdata'] 	= $this->userdata;

		$json = array();
		$model = $this->M_bbkelola;
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

	public function bbkelola_remove() {
		$json = array();
		$model = $this->M_bbkelola;
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