<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_sptugas extends CI_Migration { 
    public $table_name = 'epak_sptugas';

    public function up() { 
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'sumber_info' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'sp_tugas' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'objek_tugas' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'kasus_posisi' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'permasalahan' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'potensi_aght' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'tahapan' => array(
                'type' => 'VARCHAR',
                'constraint' => '150'
            ),
            'keterangan' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'jenis_module' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
            'created_at' => array('type' => 'timestamp')
        ));
        $this->dbforge->add_key('id', TRUE);
        if (!$this->db->table_exists($this->table_name)) $this->dbforge->create_table($this->table_name, TRUE);
    }

    public function down()
    {
        if ($this->db->table_exists($this->table_name)) $this->dbforge->drop_table($this->table_name);
    }
}