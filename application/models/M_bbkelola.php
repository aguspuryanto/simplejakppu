<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bbkelola extends CI_Model {
    public $table_name = "epak_bbkelola";

    public function rules()
    {
        return [
            ['field' => 'tahun', 'label' => 'TAHUN', 'rules' => 'required'],
            ['field' => 'jmlbb', 'label' => 'JUMLAH BB','rules' => 'required'],
            ['field' => 'jmlperkara', 'label' => 'JUMLAH PERKARA','rules' => 'required'],
            ['field' => 'keterangan', 'label' => 'KETERANGAN']
        ];
    }

    public function save($data) {
        // $this->db->trans_begin();
        // $this->db->insert($this->table_name, $data);
        // $this->db->trans_complete();
        
        // if ($this->db->trans_status() === FALSE){
        //     $this->db->trans_rollback();
        //     return 0;
        // } else {
        //     $this->db->trans_commit();
        //     $insert_id = $this->db->insert_id();
        //     return  $insert_id;
        // }

        $result = $this->db->insert($this->table_name, $data);
        try {
            if ($result) {
                return $this->db->insert_id();    
            } else {
                throw new Exception("database error");
            }
        } catch (Exception $e) {
            log_message('error',$e->getMessage());
            return;
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