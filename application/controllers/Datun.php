<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datun extends AUTH_Controller {
	public $jenis_module = 'datun';
	public function __construct() {
		parent::__construct();
		$this->load->model('M_perkara');
		$this->load->model('M_perkara_pidsus');
		$this->load->model('M_penahanan');
		$this->load->model('M_pnbp');
		$this->load->model('M_datun');
	}

	public function index() {
		// Statistik DATUN
		// 1.	Bantuan Hukum (Litigasi dan non Litigasi)
		// 2.	Pertimbangan Hukum (pendampingan hukum, pendapat hukum dan audit hukum)
		// 3.	Tindakan Hukum Lain
		// 4.	Penegakan Hukum
		// 5.	Pelayanan Hukum (tertulis dan lisan)
		// 6.	Kegiatan penanggulangan Stunting
		// 7.	Kegiatan dukungan penggunaan TKDN
		// 8.	Kegiatan penanggulangan dampak inflasi daerah
		// 9.	Kegiatan penanggulangan kemisikinan ekstrim
		// 10.	Kegiatan dukungan UMKM
		// 11.	Kegiatan suporting IKN

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

		$data['page'] 			= "home";
		$data['judul'] 			= "Statistik Datun";
		$data['deskripsi'] 		= "";

		$this->template->views('datun/home', $data);
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