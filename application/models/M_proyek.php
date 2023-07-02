<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_proyek extends CI_Model {
    public $table_name = "epak_proyek";

    public function rules()
    {
        return [
            ['field' => 'nama_pkerjaan', 'label' => 'NAMA PEKERJAAN', 'rules' => 'required'],
            ['field' => 'instansi', 'label' => 'INSTANSI PEMILIK PEKERJAAN','rules' => 'required'],
            ['field' => 'kontraktor', 'label' => 'KONTRAKTOR PELAKSANA','rules' => 'required'],
            ['field' => 'nilai', 'label' => 'NILAI KONTRAK','rules' => 'required'],
            ['field' => 'sumber', 'label' => 'SUMBER PEMBIAYAAN','rules' => 'required'],
            ['field' => 'wktu', 'label' => 'JANGKA WAKTU PELAKSANAAN','rules' => 'required'],
            ['field' => 'lokasi', 'label' => 'LOKASI PEKERJAAN','rules' => 'required'],
            ['field' => 'kdudukan', 'label' => 'KEDUDUKAN PEKERJAAN','rules' => 'required'],
            ['field' => 'potensi_aght', 'label' => 'POTENSI AGHT','rules' => 'required'],
            ['field' => 'tahapan', 'label' => 'TAHAPAN','rules' => 'required'],
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