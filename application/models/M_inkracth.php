<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_inkracth extends CI_Model {
    public $table_name = "epak_inkracth";
    public $jenis_module = "inkracth";

    public function rules()
    {
        return [
            ['field' => 'nama_terdakwa', 'label' => 'NAMA TERDAKWA', 'rules' => 'required'],
            ['field' => 'p48_no_tgl', 'label' => 'P48 & TGL','rules' => 'required'],
            ['field' => 'putusan_no_tgl', 'label' => 'NO PUTUSAN & TGL','rules' => 'required'],
            ['field' => 'putusan_amar', 'label' => 'AMAR PUTUSAN','rules' => 'required'],
            ['field' => 'pasal_terbukti', 'label' => 'PASAL YG TERBUKTI','rules' => 'required'],
            ['field' => 'barang_bukti', 'label' => 'BARANG BUKTI','rules' => 'required'],
            ['field' => 'keterangan', 'label' => 'KETERANGAN','rules' => 'required'],
            ['field' => 'ba20_pengembalin', 'label' => 'BA20/PENGEMBALIAN'],
            ['field' => 'alamat_bb', 'label' => 'ALAMAT BARANG BUKTI'],
            ['field' => 'no_telp', 'label' => 'NO TELP'],
            ['field' => 'setor_negara', 'label' => 'SETOR NEGARA'],
            ['field' => 'ntb', 'label' => 'NTB'],
            ['field' => 'ntpn', 'label' => 'NTPN'],
            ['field' => 'b18', 'label' => 'B18'],
            ['field' => 'bast_barang', 'label' => 'BAST BARANG RAMPASAN'],
            ['field' => 'ba21', 'label' => 'B21'],
            ['field' => 'pendapat_hkm', 'label' => 'PENDAPAT HUKUM'],
            ['field' => 'p48', 'label' => 'P48'],
            ['field' => 'putusan', 'label' => 'PUTUSAN'],
            ['field' => 'pnetapan', 'label' => 'PENETAPAN'],
            ['field' => 'ba_sita', 'label' => 'BA SITA'],
            ['field' => 'sp_sita', 'label' => 'SP SITA'],
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