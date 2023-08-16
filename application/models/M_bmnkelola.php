<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bmnkelola extends CI_Model {
    public $table_name = "epak_bmnkelola";

    public function rules()
    {
        return [
            ['field' => 'kelompok', 'label' => 'KELOMPOK', 'rules' => 'required'],
            ['field' => 'kode_barang', 'label' => 'KODE BARANG', 'rules' => 'required'],
            ['field' => 'nama_barang', 'label' => 'NAMA BARANG', 'rules' => 'required'],
            ['field' => 'nup', 'label' => 'NUP'],
            ['field' => 'kondisi', 'label' => 'KONDISI'],
            ['field' => 'merk_tipe', 'label' => 'MERK/TIPE'],
            ['field' => 'tgl_perolehan', 'label' => 'TGL PEROLEHAN'],
            ['field' => 'nilai_perolehan', 'label' => 'NILAI PEROLEHAN'],
            ['field' => 'kuantiti', 'label' => 'KUANTITAS'],
            ['field' => 'status_kelola', 'label' => 'STATUS PENGELOLAAN'],
            ['field' => 'no_psp', 'label' => 'NO PSP'],
            ['field' => 'tgl_psp', 'label' => 'TGL PSP'],
            ['field' => 'nobpkb', 'label' => 'NO BPKB'],
            ['field' => 'nopol', 'label' => 'NOPOL'],
            ['field' => 'pemakai', 'label' => 'PEMAKAI'],
            ['field' => 'jml_kib', 'label' => 'JML KIB'],
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