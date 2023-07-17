<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penahanan extends CI_Model {
    public $table_name = 'epak_tahan';

    public function rules()
    {
        return [
            ['field' => 'nama_tsk', 'label' => 'NAMA TSK/TDKW/TPDANA','rules' => 'required'],
            ['field' => 'jenis_kelamin', 'label' => 'JENIS KELAMIN','rules' => 'required'],
            ['field' => 'pasal_tsk', 'label' => 'PASAL DISANGKA/DIDAKWA/DITUNTUT/TERBUKTI','rules' => 'required'],
            ['field' => 'jenis_perkara', 'label' => 'JENIS PERKARA/PERMASALAHAN','rules' => 'required'],
            ['field' => 'sp_tahap', 'label' => 'SURAT PERINTAH PENAHANAN/JENIS PENAHANAN','rules' => 'required'],
            ['field' => 'lokasi_tahan', 'label' => 'LOKASI PENAHANAN','rules' => 'required'],
            ['field' => 'keadaan_tahan', 'label' => 'KEADAAN TAHANAN','rules' => 'required'],
            ['field' => 'tahap_perkara', 'label' => 'TAHAP PERKARA','rules' => 'required'],
            ['field' => 'keterangan', 'label' => 'KETERANGAN']
        ];
    }

    public function save($data) {
        $this->db->insert($this->table_name, $data);
    }

    public function select_all($options = "") {
        if($options) {
            $this->db->where($options);
        }
        $data = $this->db->get($this->table_name);
        return $data->result();
    }

    public function total_rows() {
        $data = $this->db->get($this->table_name);
        return $data->num_rows();
    }

    public function select_by_module($module) {
        $this->db->select('COUNT(*) as jml');
        $this->db->where('jenis_module', $module);
        $data = $this->db->get($this->table_name);
        return $data->row();
    }
}