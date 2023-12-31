<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_buron extends CI_Model {
    public $table_name = "epak_buron";

    public function rules()
    {
        return [
            ['field' => 'identitas', 'label' => 'IDENTITAS', 'rules' => 'required'],
            ['field' => 'srt_mohon', 'label' => 'SURAT PERMOHONAN','rules' => 'required'],
            ['field' => 'kasus_posisi', 'label' => 'KASUS POSISI','rules' => 'required'],
            ['field' => 'kepja_no', 'label' => 'KEPJA RI NO','rules' => 'required'],
            ['field' => 'tgl_mulai', 'label' => 'TANGGAL MULAI','rules' => 'required'],
            ['field' => 'tgl_akhir', 'label' => 'TANGGAL AKHIR','rules' => 'required'],
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