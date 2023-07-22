<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pnbp extends CI_Model {
    public $table_name = 'epak_pnbp';

    public function rules()
    {
        return [
            ['field' => 'nama_tsk', 'label' => 'NAMA TERPIDANA','rules' => 'required'],
            ['field' => 'jenis_perkara', 'label' => 'JENIS PERKARA','rules' => 'required'],
            ['field' => 'putusan_perkara', 'label' => 'PUTUSAN INKRACHT','rules' => 'required'],
            ['field' => 'pasal_terbukti', 'label' => 'PASAL TERBUKTI','rules' => 'required'],
            ['field' => 'jenis_pnpb', 'label' => 'JENIS PNBP','rules' => 'required'],
            ['field' => 'jumlah_pnpb', 'label' => 'JUMLAH','rules' => 'required'],
            ['field' => 'bukti_pnpb', 'label' => 'BUKTI SETOR','rules' => 'required'],
            ['field' => 'keterangan', 'label' => 'KETERANGAN']
        ];
    }

    public function save($data) {
        $this->db->insert($this->table_name, $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }

    public function select_all($options = "") {
        if($options) {
            $this->db->where($options);
        }
        $this->db->group_by('jenis_pnpb');
        $data = $this->db->get($this->table_name);
        return $data->result();
    }

    public function total_rows() {
        $data = $this->db->get($this->table_name);
        return $data->num_rows();
    }

    public function total_pnbp() {
        $data = $this->db->select_sum('jumlah_pnpb')->from($this->table_name)->get();
        return ($data) ? number_format($data->row('jumlah_pnpb')) : 0;
    }

    public function select_by_perkara($jenis_pnpb) {
        $this->db->select_sum('jumlah_pnpb');
        $this->db->where('jenis_pnpb', $jenis_pnpb);
        $data = $this->db->get($this->table_name);
        return $data->row();
    }

    public function statistik_pnbp() {
		$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

		// $pnbp = $this->select_all();
		$index = 0;
		foreach ($this->select_all() as $value) {
		    $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];

			// $pegawai_by_kota = $this->M_pegawai->select_by_kota($value->id);
			$pnbp_by_jenis = $this->select_by_perkara($value->jenis_pnpb);

			$data_pnbp[$index]['value'] = $pnbp_by_jenis->jumlah_pnpb;
			$data_pnbp[$index]['color'] = $color;
			$data_pnbp[$index]['highlight'] = $color;
			$data_pnbp[$index]['label'] = $value->jenis_pnpb;
			
			$index++;
		}

        return $data_pnbp;
    }
}