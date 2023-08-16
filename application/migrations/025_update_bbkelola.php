<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_Update_bbkelola extends CI_Migration { 
    public $table_name = 'epak_bbkelola';

    public function up() {
        // update table
        if (!$this->db->field_exists('nama_terdakwa', $this->table_name)) {
            $this->dbforge->add_column($this->table_name, array(
                'nama_terdakwa' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'id'))
            );
        }

        if (!$this->db->field_exists('pasal_disangka', $this->table_name)) {
            $this->dbforge->add_column($this->table_name, array(
                'pasal_disangka' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'nama_terdakwa'))
            );
        }

        if (!$this->db->field_exists('bb', $this->table_name)) {
            $this->dbforge->add_column($this->table_name, array(
                'bb' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'pasal_disangka'))
            );
        }

        if (!$this->db->field_exists('pasal_terbukti', $this->table_name)) {
            $this->dbforge->add_column($this->table_name, array(
                'pasal_terbukti' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'bb'))
            );
        }

        if (!$this->db->field_exists('putusan', $this->table_name)) {
            $this->dbforge->add_column($this->table_name, array(
                'putusan' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'pasal_terbukti'))
            );
        }

        if (!$this->db->field_exists('eksekusi', $this->table_name)) {
            $this->dbforge->add_column($this->table_name, array(
                'eksekusi' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'putusan'))
            );
        }

        if (!$this->db->field_exists('dokumen', $this->table_name)) {
            $this->dbforge->add_column($this->table_name, array(
                'dokumen' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'eksekusi'))
            );
        }

        if (!$this->db->field_exists('petunjuk', $this->table_name)) {
            $this->dbforge->add_column($this->table_name, array(
                'petunjuk' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'dokumen'))
            );
        }
    }

    public function down()
    {
        // drop column
        // $this->dbforge->drop_column($this->table_name, 'tahun');
        // $this->dbforge->drop_column($this->table_name, 'jmlbb');
        // $this->dbforge->drop_column($this->table_name, 'jmlperkara');
        // $this->dbforge->drop_column($this->table_name, 'keterangan');

        // drop table
        // $this->dbforge->drop_table($this->table_name);
    }
}