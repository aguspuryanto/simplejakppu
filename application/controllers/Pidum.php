<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pidum extends AUTH_Controller {
	public $jenis_module = 'pidum';
	public function __construct() {
		parent::__construct();
		$this->load->model('M_perkara');
		$this->load->model('M_perkara_pidsus');
		$this->load->model('M_penahanan');
		$this->load->model('M_pnbp');
		$this->load->model('M_inkracth');
	}

	public function index() {
		// Statistik Pidum :
		// 1. Perkara Pidum
		// a. Spdp
		// b. Pratut
		// c. TUT
		// d. Eksekusi
		// d. Upaya Hukum (Banding)
		// e. Upaya Hukum (Kasasi)
		// f. Upaya Hukum Luar Biasa (PK)
		// g. Lain-lain

		// 2. Jenis perkara : 
		// a. Tindak Pidana Narkotika dan Zat Adiktif Lainnya ; 
		// b. TP Terhadap Orang dan Harta Benda ; 
		// c. TP Terhadap Keamanan Negara, Ketertiban Umum dan TP Umum Lainnya; 
		// d. TP Terorisme dan Lintas Negara;

		// 3. Jumlah Tersangka, Terdakwa dan Terpidana (Laki, perempuan dan anak)
		// 4. Jumlah Tahanan (Laki, perempuan dan anak)

		// $data['jml_perkara'] 	= $this->M_perkara->total_rows();
		$data['jml_perkara'] 	= $this->M_perkara->select_by(['jenis_module'=>$this->jenis_module])->jml;
		$data['jml_penahanan'] 	= $this->M_penahanan->total_rows();
		$data['jml_pnbp'] 		= $this->M_pnbp->total_pnbp();
		$data['userdata'] 		= $this->userdata;

		// $data['data_perkara'] = isset($data_perkara) ? json_encode($data_perkara) : [];
		// $data['data_pnbp'] = isset($data_pnbp) ? json_encode($data_pnbp) : [];
		$data['data_perkara'] = $this->M_perkara->getPerkaraAll();
		$data['data_pnbp'] = $this->M_pnbp->statistik_pnbp();
		$data['data_statistik'] = $this->M_perkara->stat_perkara();
		
		$data['data_statistik_perkara'] = $this->M_perkara->getPerkaraStatistik();
		$data['data_statistik_pidana'] = $this->M_perkara->getTerpidanaStatistik();
		// echo json_encode($data_statistik_pidana);

		$data['page'] 			= "home";
		$data['judul'] 			= "Statistik Pidana Umum (Pidum)";
		$data['deskripsi'] 		= "";

		// echo json_encode($data['data_statistik_perkara']);
		$this->template->views('pidum/home', $data);
		// redirect('/Pidum/pidum');
	}

	public function pidum() {
		$data['userdata'] 	= $this->userdata;
		$data['dataPidum'] = $this->M_perkara->select_all();
		$data['dataPenahanan'] = $this->M_penahanan->select_all();
		$data['dataPnbp'] = $this->M_pnbp->select_all();
		
		$data['page'] 		= "Pidana Umum";
		$data['judul'] 		= "Data Perkara Pidana Umum (Pidum)";

		$this->template->views('pidum/index', $data);
	}

	public function pidum_penahanan() {
		$data['userdata'] 	= $this->userdata;
		$data['dataPidum'] = $this->M_perkara->select_all();
		$data['dataPenahanan'] = $this->M_penahanan->select_all();
		$data['dataPnbp'] = $this->M_pnbp->select_all();
		
		$data['page'] 		= "Pidana Umum";

		$this->template->views('pidum/penahanan', $data);
	}

	public function pidum_pnbp() {
		$data['userdata'] 	= $this->userdata;
		$data['dataPidum'] = $this->M_perkara->select_all();
		$data['dataPenahanan'] = $this->M_penahanan->select_all();
		$data['dataPnbp'] = $this->M_pnbp->select_all();
		
		$data['page'] 		= "PNBP";

		$this->template->views('pidum/pnbp', $data);
	}
	
	public function pidum_add() {
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
				'jenis_module' => $this->jenis_module,
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

	public function pidum_tahan_add() {
		$this->load->library('form_validation');
		
		$model = $this->M_penahanan;

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
				'nama_tsk' => $this->input->post('nama_tsk'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'pasal_tsk' => $this->input->post('pasal_tsk'),
				'jenis_perkara' => $this->input->post('jenis_perkara'),
				'sp_tahap' => $this->input->post('sp_tahap'),
				'lokasi_tahan' => $this->input->post('lokasi_tahan'),
				'keadaan_tahan' => $this->input->post('keadaan_tahan'),
				'tahap_perkara' => $this->input->post('tahap_perkara'),
				'jenis_module' => ($this->input->post('jenis_module')) ? $this->input->post('jenis_module') : $this->jenis_module,
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

	public function pidum_pnbp_add() {
		$this->load->library('form_validation');
		$_POST = $this->input->post();
		// echo json_encode($_POST);
		$model = $this->M_pnbp;

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
				'nama_tsk' => $this->input->post('nama_tsk'),
				'jenis_perkara' => $this->input->post('jenis_perkara'),
				'putusan_perkara' => $this->input->post('putusan_perkara'),
				'pasal_terbukti' => $this->input->post('pasal_terbukti'),
				'jenis_pnpb' => $this->input->post('jenis_pnpb'),
				'jumlah_pnpb' => $this->input->post('jumlah_pnpb'),
				'bukti_pnpb' => $this->input->post('bukti_pnpb'),
				'jenis_module' => ($this->input->post('jenis_module')) ? $this->input->post('jenis_module') : $this->jenis_module,
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

	public function pidum_inkracth() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_inkracth;
		$options = array('jenis_module' => 'inkracth');
		$data['dataInkracth'] = $this->M_inkracth->select_all();
		
		$data['page'] 		= "INKRACTH";

		$this->template->views('pidum/inkracth', $data);
	}

	public function pidum_inkracth_add() {
		$this->load->library('form_validation');
		// $_POST = $this->input->post();
		// echo json_encode($_POST);
		$model = $this->M_inkracth;

		$json = array();
		$this->form_validation->set_rules($model->rules());

		// bbmusnah s/d keterangan
		// inkracth = bbkembali
		if($this->input->post('jenis_module') == 'inkracth' || $this->input->post('jenis_module') == 'bbkembali') {
			// $this->form_validation->set_rules('ba20_pengembalin', 'BA20/PENGEMBALIAN', 'required');
			// $this->form_validation->set_rules('alamat_bb', 'BA20/PENGEMBALIAN', 'required');
			// $this->form_validation->set_rules('no_telp', 'NO TELP', 'required');
		}

		// bbrampas
		if($this->input->post('jenis_module') == 'bbrampas') {

		}

		$this->form_validation->set_message('required', 'Mohon lengkapi {field}!');

		if (!$this->form_validation->run()) {			
			foreach($model->rules() as $key => $val) {
				$json = array_merge($json, array(
					$val['field'] => form_error($val['field'], '<p class="mt-3 text-danger">', '</p>')
				));
			}
		} else {
			$data = array(
				'nama_terdakwa' => $this->input->post('nama_terdakwa'),
				'p48_no_tgl' => $this->input->post('p48_no_tgl'),
				'putusan_no_tgl' => $this->input->post('putusan_no_tgl'),
				'pasal_terbukti' => $this->input->post('pasal_terbukti'),
				'putusan_amar' => $this->input->post('putusan_amar'),
				'pasal_terbukti' => $this->input->post('pasal_terbukti'),
				'barang_bukti' => $this->input->post('barang_bukti'),
				'keterangan' => $this->input->post('keterangan'),
			);

			// bbmusnah s/d keterangan
			// inkracth = bbkembali
			if($this->input->post('jenis_module') == 'inkracth' || $this->input->post('jenis_module') == 'bbkembali') {
				// merge data
				$data_extra = array(
					'ba20_pengembalin' => $this->input->post('ba20_pengembalin'),
					'alamat_bb' => $this->input->post('alamat_bb'),
					'no_telp' => $this->input->post('no_telp'),
				);

				$data = array_merge($data, $data_extra);
			}

			// bbrampas
			if($this->input->post('jenis_module') == 'bbrampas') {
				// merge data
				$data_extra = array(
					'setor_negara' => $this->input->post('setor_negara'),
					'ntb' => $this->input->post('ntb'),
					'ntpn' => $this->input->post('ntpn'),
					'b18' => $this->input->post('b18'),
					'bast_barang' => $this->input->post('bast_barang'),
					'ba21' => $this->input->post('ba21'),
					'pendapat_hkm' => $this->input->post('pendapat_hkm'),
					'p48' => $this->input->post('p48'),
					'putusan' => $this->input->post('putusan'),
					'pnetapan' => $this->input->post('pnetapan'),
					'ba_sita' => $this->input->post('ba_sita'),
					'sp_sita' => $this->input->post('sp_sita'),
				);

				$data = array_merge($data, $data_extra);
			}

			$data = array_merge($data, array('jenis_module' => ($this->input->post('jenis_module')) ? $this->input->post('jenis_module') : 'inkracth'));

			// echo json_encode($data);
			$model->save($data);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
			$json = array('success' => true, 'message' => 'Berhasil disimpan');
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($json));

	}

	public function pidum_bbmusnah() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_inkracth;
		$options = array('jenis_module' => 'bbmusnah');
		// $data['dataProvider'] = $this->M_inkracth->select_all($options);
		$data['dataInkracth'] = $this->M_inkracth->select_all($options);
		
		$data['page'] 		= "INKRACTH";

		$this->template->views('pidum/inkracth', $data);
	}

	public function pidum_bbkembali() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_inkracth;
		$options = array('jenis_module' => 'bbkembali');
		$data['dataInkracth'] = $this->M_inkracth->select_all($options);

		$data['judul'] 		= " BARANG BUKTI DI KEMBALIKAN";
		$data['deskripsi'] 	= "";
		$data['page'] 		= "INKRACTH";

		$this->template->views('pidum/bbkembali', $data);
	}

	public function pidum_bbrampas() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_inkracth;
		$options = array('jenis_module' => 'bbrampas');
		$data['dataInkracth'] = $this->M_inkracth->select_all($options);

		$data['page'] 		= "INKRACTH";

		$this->template->views('pidum/bbrampas', $data);
	}

	public function pidum_bblelang() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_inkracth;
		$options = array('jenis_module' => 'bblelang');
		$data['dataInkracth'] = $this->M_inkracth->select_all($options);

		$data['page'] 		= "INKRACTH";

		$this->template->views('pidum/bblelang', $data);
	}
}

/* End of file Pidum.php */
/* Location: ./application/controllers/Pidum.php */