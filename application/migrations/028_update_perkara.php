<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_update_perkara extends CI_Migration { 
    public function up() {
        // update table
        $table_name = 'epak_perkara'; //$this->db->dbprefix('epak_perkara');
        $field_arra = ['kajari_note', 'tindak_lanjut', 'dokumen'];
        foreach($field_arra as $key => $value) {
            if (!$this->db->field_exists($value, $table_name)) {
                $this->dbforge->add_column($table_name, array(
                    $value => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'keterangan'))
                );
            }
        }

        $table_name = 'epak_tahan';
        $field_arra = ['kajari_note', 'tindak_lanjut', 'dokumen'];
        foreach($field_arra as $key => $value) {
            if (!$this->db->field_exists($value, $table_name)) {
                $this->dbforge->add_column($table_name, array(
                    $value => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'keterangan'))
                );
            }
        }

        $table_name = 'epak_inkracth';
        $field_arra = ['kajari_note', 'tindak_lanjut', 'dokumen'];
        foreach($field_arra as $key => $value) {
            if (!$this->db->field_exists($value, $table_name)) {
                $this->dbforge->add_column($table_name, array(
                    $value => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'jenis_module'))
                );
            }
        }

        $table_name = 'epak_sptugas';
        $field_arra = ['kajari_note', 'tindak_lanjut', 'dokumen'];
        foreach($field_arra as $key => $value) {
            if (!$this->db->field_exists($value, $table_name)) {
                $this->dbforge->add_column($table_name, array(
                    $value => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'jenis_module'))
                );
            }
        }

        $table_name = 'epak_trafikwna';
        $field_arra = ['kajari_note', 'tindak_lanjut', 'dokumen'];
        foreach($field_arra as $key => $value) {
            if (!$this->db->field_exists($value, $table_name)) {
                $this->dbforge->add_column($table_name, array(
                    $value => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'keterangan'))
                );
            }
        }

        $table_name = 'epak_realisasi';
        $field_arra = ['kajari_note', 'tindak_lanjut', 'dokumen'];
        foreach($field_arra as $key => $value) {
            if (!$this->db->field_exists($value, $table_name)) {
                $this->dbforge->add_column($table_name, array(
                    $value => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'sisa_anggaran'))
                );
            }
        }

        $table_name = 'epak_bmnkelola';
        $field_arra = ['kajari_note', 'tindak_lanjut', 'dokumen'];
        foreach($field_arra as $key => $value) {
            if (!$this->db->field_exists($value, $table_name)) {
                $this->dbforge->add_column($table_name, array(
                    $value => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'jml_kib'))
                );
            }
        }

        $table_name = 'epak_pnbp';
        $field_arra = ['kajari_note', 'tindak_lanjut', 'dokumen'];
        foreach($field_arra as $key => $value) {
            if (!$this->db->field_exists($value, $table_name)) {
                $this->dbforge->add_column($table_name, array(
                    $value => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'keterangan'))
                );
            }
        }

        $table_name = 'epak_datun_rev';
        $field_arra = ['kajari_note', 'tindak_lanjut', 'dokumen'];
        foreach($field_arra as $key => $value) {
            if (!$this->db->field_exists($value, $table_name)) {
                $this->dbforge->add_column($table_name, array(
                    $value => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'keterangan'))
                );
            }
        }
        
        if (!$this->db->field_exists('kategori', $table_name)) {
            $this->dbforge->add_column($table_name, array(
                'kategori' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'id'))
            );
        }

        $table_name = 'epak_mafia';
        $field_arra = ['kajari_note', 'jenis_module', 'tindak_lanjut', 'dokumen'];
        foreach($field_arra as $key => $value) {
            if (!$this->db->field_exists($value, $table_name)) {
                $this->dbforge->add_column($table_name, array(
                    $value => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'keterangan'))
                );
            }
        }

        $table_name = 'epak_bbkelola';
        $field_arra = ['kajari_note', 'tindak_lanjut', 'dokumen'];
        foreach($field_arra as $key => $value) {
            if (!$this->db->field_exists($value, $table_name)) {
                $this->dbforge->add_column($table_name, array(
                    $value => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'keterangan'))
                );
            }
        }
        
        if (!$this->db->field_exists('reg_bb', $table_name)) {
            $this->dbforge->add_column($table_name, array(
                'reg_bb' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'nama_terdakwa'))
            );
        }
    }
}