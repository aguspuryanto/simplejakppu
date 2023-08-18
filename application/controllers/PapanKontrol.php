<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PapanKontrol extends AUTH_Controller {
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

	public function pidum() {
		$data['userdata'] 	= $this->userdata;
		$data['dataPidum'] = $this->M_perkara->select_all();
		$data['dataPenahanan'] = $this->M_penahanan->select_all();
		$data['dataPnbp'] = $this->M_pnbp->select_all();
		
		$data['page'] 		= "Pidana Umum";

		$this->template->views('pidum/index', $data);
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
				'jenis_module' => 'pidum',
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

	public function pidum_tahan() {
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
				'jenis_module' => ($this->input->post('jenis_module')) ? $this->input->post('jenis_module') : 'pidum',
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

	public function pidum_pnbp() {
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
				'jenis_module' => ($this->input->post('jenis_module')) ? $this->input->post('jenis_module') : 'pidum',
				'keterangan' => $this->input->post('keterangan'),
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

	public function pidsus() {
		$data['userdata'] 	= $this->userdata;

		$options = array('jenis_module' => 'pidsus');
		$data['dataPidum'] = $this->M_perkara->select_all($options);
		$data['dataPenahanan'] = $this->M_penahanan->select_all($options);
		$data['dataPnbp'] = $this->M_pnbp->select_all($options);
		
		$data['page'] 		= "Pidana Khusus";

		$this->template->views('pidsus/index', $data);
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
				'keterangan' => $this->input->post('keterangan'),
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

	public function intel() {
		$data['userdata'] 	= $this->userdata;

		$options = array('jenis_module' => 'intelijen');
		$data['dataPidum'] = $this->M_perkara->select_all($options);
		$data['dataPenahanan'] = $this->M_penahanan->select_all($options);
		$data['dataPnbp'] = $this->M_pnbp->select_all($options);
		
		$data['page'] 		= "Intelijen";

		$this->template->views('pidsus/index', $data);
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

	public function datun() {
		$data['userdata'] 	= $this->userdata;

		$options = array('jenis_module' => 'datun');
		$data['dataPidum'] = $this->M_perkara->select_all($options);
		$data['dataPenahanan'] = $this->M_penahanan->select_all($options);
		$data['dataPnbp'] = $this->M_pnbp->select_all($options);
		
		$data['page'] 		= "Perdata dan Tata Usaha Negara";

		$this->template->views('pidsus/index', $data);
	}

	public function datun_add() {
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
				'jenis_module' => 'datun',
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

	// 
	public function tampil() {
		// $data['dataKota'] = $this->M_kota->select_all();
		// $this->load->view('kota/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');

		// $data 	= $this->input->post();
		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_kota->insert($data);

		// 	if ($result > 0) {
		// 		$out['status'] = '';
		// 		$out['msg'] = show_succ_msg('Data Kota Berhasil ditambahkan', '20px');
		// 	} else {
		// 		$out['status'] = '';
		// 		$out['msg'] = show_err_msg('Data Kota Gagal ditambahkan', '20px');
		// 	}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }

		// echo json_encode($out);
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;

		// $id 				= trim($_POST['id']);
		// $data['dataKota'] 	= $this->M_kota->select_by_id($id);

		// echo show_my_modal('modals/modal_update_kota', 'update-kota', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');

		// $data 	= $this->input->post();
		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_kota->update($data);

		// 	if ($result > 0) {
		// 		$out['status'] = '';
		// 		$out['msg'] = show_succ_msg('Data Kota Berhasil diupdate', '20px');
		// 	} else {
		// 		$out['status'] = '';
		// 		$out['msg'] = show_succ_msg('Data Kota Gagal diupdate', '20px');
		// 	}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }

		// echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		// $result = $this->M_kota->delete($id);
		
		// if ($result > 0) {
		// 	echo show_succ_msg('Data Kota Berhasil dihapus', '20px');
		// } else {
		// 	echo show_err_msg('Data Kota Gagal dihapus', '20px');
		// }
	}

	public function detail() {
		$data['userdata'] 	= $this->userdata;

		// $id 				= trim($_POST['id']);
		// $data['kota'] = $this->M_kota->select_by_id($id);
		// $data['jumlahKota'] = $this->M_kota->total_rows();
		// $data['dataKota'] = $this->M_kota->select_by_pegawai($id);

		// echo show_my_modal('modals/modal_detail_kota', 'detail-kota', $data, 'lg');
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_perkara->select_all();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', "ID"); 
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', "Nama Kota");

		$rowCount = 2;
		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->nama); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data_Perkara.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data_Perkara.xlsx', NULL);
	}

	public function import() {
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {
			$this->session->set_flashdata('msg', 'File harus diisi');
		} else {
			$config['upload_path'] = './assets/excel/';
			$config['allowed_types'] = 'xls|xlsx';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('excel')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$data = $this->upload->data();
				
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Jakarta');

				include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';

				$inputFileName = './assets/excel/' .$data['file_name'];
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

				$index = 0;
				foreach ($sheetData as $key => $value) {
					if ($key != 1) {
						// $check = $this->M_kota->check_nama($value['B']);

						if ($check != 1) {
							$resultData[$index]['nama'] = ucwords($value['B']);
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_kota->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Kota Berhasil diimport ke database'));
						redirect('Kota');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Kota Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('Kota');
				}

			}
		}
	}
}

/* End of file Kota.php */
/* Location: ./application/controllers/Kota.php */