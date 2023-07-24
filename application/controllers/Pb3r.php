<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pb3r extends AUTH_Controller {
	// public $jenis_module = 'pidum';

    public function __construct() {
		parent::__construct();
		$this->load->model('M_inkracth');
    }

    public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['model'] = $this->M_inkracth;
		$options = array('jenis_module' => 'bbkembali');
		$data['dataInkracth'] = $this->M_inkracth->select_all($options);

		$data['judul'] 		= " BARANG BUKTI DI KEMBALIKAN";
		$data['deskripsi'] 	= "";
		$data['page'] 		= "INKRACTH";

		$this->template->views('pb3r/bbkembali', $data);
    }

}