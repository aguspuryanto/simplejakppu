<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_datun extends CI_Model {
    public $table_name = "epak_datun";

    public function rules()
    {
        return [
            ['field' => 'skk', 'label' => 'SURAT PERMOHONAN/SKK', 'rules' => 'required'],
            ['field' => 'kegiatan', 'label' => 'KEGIATAN','rules' => 'required'],
            ['field' => 'penggugat', 'label' => 'PENGGUGAT/PEMOHON/PELAWAN','rules' => 'required'],
            ['field' => 'tergugat', 'label' => 'TERGUGAT/TERMOHON/TERLAWAN','rules' => 'required'],
            ['field' => 'seksi', 'label' => 'SEKSI','rules' => 'required'],
            ['field' => 'sk_tim', 'label' => 'SP/SK TIM JPN','rules' => 'required'],
            ['field' => 'posisi_kasus', 'label' => 'POSISI KASUS/PERMASALAHAN/OBYEK PERKARA','rules' => 'required'],
            ['field' => 'tahap', 'label' => 'TAHAP','rules' => 'required'],
            ['field' => 'periode', 'label' => 'PERIODE','rules' => 'required'],
            ['field' => 'keterangan', 'label' => 'KETERANGAN']
        ];
    }

    public function save($data) {
        $this->db->trans_begin();
        $this->db->insert($this->table_name, $data);
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
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