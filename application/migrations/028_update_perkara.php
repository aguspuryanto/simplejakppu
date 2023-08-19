<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_update_perkara extends CI_Migration { 
    public function up() {
        // update table
        $table_name = 'epak_perkara'; //$this->db->dbprefix('epak_perkara');
        if (!$this->db->field_exists('kajari_note', $table_name)) {
            $this->dbforge->add_column($table_name, array(
                'kajari_note' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'keterangan'))
            );
        }

        $table_name = 'epak_tahan';
        if (!$this->db->field_exists('kajari_note', $table_name)) {
            $this->dbforge->add_column($table_name, array(
                'kajari_note' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'keterangan'))
            );
        }

        $table_name = 'epak_inkracth';
        if (!$this->db->field_exists('kajari_note', $table_name)) {
            $this->dbforge->add_column($table_name, array(
                'kajari_note' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'jenis_module'))
            );
        }

        $table_name = 'epak_sptugas';
        if (!$this->db->field_exists('kajari_note', $table_name)) {
            $this->dbforge->add_column($table_name, array(
                'kajari_note' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'jenis_module'))
            );
        }

        $table_name = 'epak_trafikwna';
        if (!$this->db->field_exists('kajari_note', $table_name)) {
            $this->dbforge->add_column($table_name, array(
                'kajari_note' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'keterangan'))
            );
        }

        $table_name = 'epak_realisasi';
        if (!$this->db->field_exists('kajari_note', $table_name)) {
            $this->dbforge->add_column($table_name, array(
                'kajari_note' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'sisa_anggaran'))
            );
        }

        $table_name = 'epak_bmnkelola';
        if (!$this->db->field_exists('kajari_note', $table_name)) {
            $this->dbforge->add_column($table_name, array(
                'kajari_note' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'jml_kib'))
            );
        }

        $table_name = 'epak_pnbp';
        if (!$this->db->field_exists('kajari_note', $table_name)) {
            $this->dbforge->add_column($table_name, array(
                'kajari_note' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'keterangan'))
            );
        }

        $table_name = 'epak_datun_rev';
        if (!$this->db->field_exists('kajari_note', $table_name)) {
            $this->dbforge->add_column($table_name, array(
                'kajari_note' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'keterangan'))
            );
        }

        $table_name = 'epak_mafia';
        if (!$this->db->field_exists('kajari_note', $table_name)) {
            $this->dbforge->add_column($table_name, array(
                'kajari_note' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'keterangan'))
            );
        }
        if (!$this->db->field_exists('jenis_module', $table_name)) {
            $this->dbforge->add_column($table_name, array(
                'jenis_module' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'keterangan'))
            );
        }

        $table_name = 'epak_bbkelola';
        if (!$this->db->field_exists('kajari_note', $table_name)) {
            $this->dbforge->add_column($table_name, array(
                'kajari_note' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'keterangan'))
            );
        }
        if (!$this->db->field_exists('reg_bb', $table_name)) {
            $this->dbforge->add_column($table_name, array(
                'reg_bb' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'nama_terdakwa'))
            );
        }
    }
}