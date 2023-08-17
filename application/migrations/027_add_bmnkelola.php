<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_bmnkelola extends CI_Migration { 
    public $table_name = 'epak_bmnkelola';

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'kelompok' => array(
                'type' => 'VARCHAR', 'constraint' => '100'
            ),
            'kode_barang' => array(
                'type' => 'VARCHAR', 'constraint' => '100'
            ),
            'nama_barang' => array(
                'type' => 'VARCHAR', 'constraint' => '100'
            ),
            'nup' => array(
                'type' => 'VARCHAR', 'constraint' => '100'
            ),
            'kondisi' => array(
                'type' => 'VARCHAR', 'constraint' => '100'
            ),
            'merk_tipe' => array(
                'type' => 'VARCHAR', 'constraint' => '100'
            ),
            'tgl_perolehan' => array(
                'type' => 'timestamp', 'default' => 'CURRENT_TIMESTAMP'
            ),
            'nilai_perolehan' => array(
                'type' => 'VARCHAR', 'constraint' => '100'
            ),
            'kuantiti' => array(
                'type' => 'VARCHAR', 'constraint' => '100'
            ),
            'status_kelola' => array(
                'type' => 'VARCHAR', 'constraint' => '100'
            ),
            'no_psp' => array(
                'type' => 'VARCHAR', 'constraint' => '100'
            ),
            'tgl_psp' => array(
                'type' => 'timestamp', 'default' => 'CURRENT_TIMESTAMP'
            ),
            'nobpkb' => array(
                'type' => 'VARCHAR', 'constraint' => '100'
            ),
            'nopol' => array(
                'type' => 'VARCHAR', 'constraint' => '100'
            ),
            'pemakai' => array(
                'type' => 'VARCHAR', 'constraint' => '100'
            ),
            'jml_kib' => array(
                'type' => 'VARCHAR', 'constraint' => '100'
            ),
            'created_at' => array('type' => 'timestamp')
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->table_name, TRUE);
    }

    public function down() { 
        $this->dbforge->drop_table($this->table_name, TRUE);
    }
}