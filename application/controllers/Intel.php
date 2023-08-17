<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Intel extends AUTH_Controller {
	public $jenis_module = 'intel';
	public function __construct() {
		parent::__construct();
		$this->load->model('M_perkara');
		$this->load->model('M_perkara_pidsus');
		$this->load->model('M_penahanan');
		$this->load->model('M_pnbp');
		$this->load->model('M_sptugas');
		$this->load->model('M_cegahtangkal');
		$this->load->model('M_buron');
		$this->load->model('M_trafikwna');
		$this->load->model('M_wnapidana');
		$this->load->model('M_mafia');
	}

	public function index() {
		// Statistik Intelijen
		// 1.	Sprintug
		// 2.	Ops Intelijen
		// 3.	Penyuluhan hukum dan Penerangan hukum
		// 4.	Jaksa Jaga Desa
		// 5.	Pakem
		// 6.	DPO
		// 7.	Om Jak Menjawab
		// 8.	Tim Pemberantasan Mafia Tanah
		// 9.	Tim Percepatan Investasi
		// 10.	Kegiatan supporting PPS propinsi dan Pusat serta PPS Daerah
		// 11.	Kegiatan penanggulangan Stunting
		// 12.	Kegiatan dukungan penggunaan TKDN
		// 13.	Kegiatan penanggulangan dampak inflasi daerah
		// 14.	Kegiatan penanggulangan kemisikinan ekstrim
		// 15.	Kegiatan dukungan UMKM
		// 16.	Kegiatan supporting bidang lain
		// 17.	Kegiatan suporting IKN

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

		/*
		 * Sprintug = count from M_sptugas where jenis_module = sptugas
		 * Ops Intelijen = count from M_sptugas where jenis_module = opintelijen
		 */
		$data['data_statistik_intel'] = $this->M_sptugas->getStatistik();
		// echo json_encode($data['data_statistik_intel']);
		$data['data_statistik_intel'] = array_merge($data['data_statistik_intel'], [
			array('jenis_module' => 'penyuluhan_hukum', 'tot' => 0),
			array('jenis_module' => 'jaksa_jaga_desa', 'tot' => 0),
			array('jenis_module' => 'pakem', 'tot' => 0),
			array('jenis_module' => 'dpo', 'tot' => 0),
			array('jenis_module' => 'omjak_menjawab', 'tot' => 0),
			array('jenis_module' => 'mafia', 'tot' => 0),
			array('jenis_module' => 'investasi', 'tot' => 0),
		]);
		// echo json_encode($data['data_statistik_intel']);

		$data['page'] 			= "INTEL";
		$data['judul'] 			= "Statistik Intelijen";
		$data['deskripsi'] 		= "";

		$this->template->views('intel/home', $data);
		// redirect('/papan-kontrol/pidum');
	}

	public function intel() {
		$data['userdata'] 	= $this->userdata;

		$options = array('jenis_module' => 'intelijen');
		$data['dataPidum'] = $this->M_perkara->select_all($options);
		$data['dataPenahanan'] = $this->M_penahanan->select_all($options);
		$data['dataPnbp'] = $this->M_pnbp->select_all($options);
		
		$data['page'] 		= "INTEL";

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
		$data['page'] 		= "INTEL";

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

	public function op_intelijen() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_sptugas;
		$options = array('jenis_module' => 'opintelijen');
		$data['dataSptugas'] = $this->M_sptugas->select_all($options);

		$data['judul'] 		= "Operasi Intelijen Yustisial";
		$data['deskripsi'] 	= "";
		$data['page'] 		= "INTEL";

		$this->template->views('intel/op_intelijen', $data);
	}

	public function cegah_tangkal() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_cegahtangkal;
		$data['dataSptugas'] = $this->M_cegahtangkal->select_all();

		$data['judul'] 		= "Pencegahan dan Penangkalan";
		$data['deskripsi'] 	= "";
		$data['page'] = "INTEL";

		$this->template->views('intel/cegah_tangkal', $data);
	}

	public function tangkap_buron() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_buron;
		$data['dataSptugas'] = $this->M_buron->select_all();

		$data['judul'] 		= "Tangkap Buron";
		$data['deskripsi'] 	= "";
		$data['page'] = "INTEL";

		$this->template->views('intel/tangkap_buron', $data);
	}

	/*
	 * Module : Pengawasan Lalu Lintas WNA
	 */

	public function awas_wna() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_trafikwna;
		$data['dataProvider'] = $this->M_trafikwna->select_all();

		$data['judul'] 		= "PENGAWASAN LALU LINTAS WNA";
		$data['deskripsi'] 	= "";
		$data['page'] = "INTEL";

		$this->template->views('intel/awas_wna', $data);
	}

	public function awaswna_add() {		
		$this->load->library('form_validation');

		$model = $this->M_trafikwna;

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
				'asal_wna' => $this->input->post('asal_wna'),
				'pnduduk_wna' => $this->input->post('pnduduk_wna'),
				'tnaga_kerja' => $this->input->post('tnaga_kerja'),
				'plajar' => $this->input->post('plajar'),
				'pneliti' => $this->input->post('pneliti'),
				'kluarga' => $this->input->post('kluarga'),
				'rohaniwan' => $this->input->post('rohaniwan'),
				'ilegal' => $this->input->post('ilegal'),
				'usaha' => $this->input->post('usaha'),
				'sosbud' => $this->input->post('sosbud'),
				'wisata' => $this->input->post('wisata'),
				'keterangan' => $this->input->post('keterangan'),
			);

			$model->save($data);
			$this->session->set_flashdata('success', 'Berhasil disimpan');
			$json = array('success' => true, 'message' => 'Berhasil disimpan');
			
		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($json));
	}

	// pidana_wna, proyek_strategis, berantas_mafia, cepat_investasi
	public function pidana_wna() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_wnapidana;
		$data['dataProvider'] = $this->M_wnapidana->select_all();

		$data['judul'] 		= "PENGAWASAN LALU LINTAS WNA";
		$data['deskripsi'] 	= "";
		$data['page'] = "INTEL";

		$this->template->views('intel/pidana_wna', $data);
	}

	public function pidanawna_add() {
		$this->load->library('form_validation');

		$model = $this->M_wnapidana;

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
				'identitas' => $this->input->post('identitas'),
				'asal_wna' => $this->input->post('asal_wna'),
				'kasus_posisi' => $this->input->post('kasus_posisi'),
				'tahap' => $this->input->post('tahap'),
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

	/*
	 * Module : Data Proyek Strategis
	 */
	public function proyek_strategis() {
		$data['userdata'] 	= $this->userdata;

		$this->load->model('M_proyek');
		$data['model'] = $this->M_proyek;
		$data['dataProvider'] = $this->M_proyek->select_all();

		$data['judul'] 		= "PROYEK STRATEGIS";
		$data['deskripsi'] 	= "";
		$data['page'] = "INTEL";

		$this->template->views('intel/proyek_strategis', $data);
	}

	/*
	 * Module : Tim Pemberatasan Mafia Tanah
	 */
	public function berantas_mafia() {
		$data['userdata'] 	= $this->userdata;

		$this->load->model('M_mafia');
		$data['model'] = $this->M_mafia;
		$data['dataProvider'] = $this->M_mafia->select_all();

		$data['judul'] 		= "TIM PEMBERANTASAN MAFIA TANAH";
		$data['deskripsi'] 	= "";
		$data['page'] = "INTEL";

		$this->template->views('intel/berantas_mafia', $data);
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
				'keterangan' => $this->input->post('keterangan')
			);

			$model->save($data);
			$this->session->set_flashdata('success', 'Berhasil disimpan');
			$json = array('success' => true, 'message' => 'Berhasil disimpan');
			
		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($json));
	}

	public function cepat_investasi() {
		$data['userdata'] 	= $this->userdata;

		$this->load->model('M_investasi');
		$data['model'] = $this->M_investasi;
		$data['dataProvider'] = $this->M_investasi->select_all();

		$data['judul'] 		= "PERCEPATAN INVESTASI";
		$data['deskripsi'] 	= "";		
		$data['page'] = "INTEL";

		$this->template->views('intel/cepat_investasi', $data);
	}

	public function investasi_add() {
		$this->load->library('form_validation');

		$model = $this->M_investasi;

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
				'sp' => $this->input->post('sp'),
				'nama_pemodal' => $this->input->post('nama_pemodal'),
				'bidang_usaha' => $this->input->post('bidang_usaha'),
				'nilai' => $this->input->post('nilai'),
				'wktu' => $this->input->post('wktu'),
				'lokasi' => $this->input->post('lokasi'),
				'tipe' => $this->input->post('tipe'),
				'tahapan' => $this->input->post('tahapan'),
				'potensi_aght' => $this->input->post('potensi_aght'),
				'keterangan' => $this->input->post('keterangan')
			);

			$model->save($data);
			$this->session->set_flashdata('success', 'Berhasil disimpan');
			$json = array('success' => true, 'message' => 'Berhasil disimpan');
			
		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($json));
	}

	// SPTUGAS
	public function sptugas_detail($id) {
		$data['userdata'] 	= $this->userdata;
		$data['data'] = $this->M_sptugas->select_by_id($id);

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

	public function sptugas_note() {
		$data['userdata'] 	= $this->userdata;

		$json = array();
		$model = $this->M_sptugas;

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

	public function sptugas_remove() {
		$json = array();
		$model = $this->M_sptugas;

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

/* End of file Intel.php */
/* Location: ./application/controllers/Intel.php */