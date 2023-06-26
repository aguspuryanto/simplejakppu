<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_penahanan extends CI_Migration { 
    public $table_name = 'epak_tahan';
    
    public function up() { 
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nama_tsk' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'jenis_kelamin' => array(
                'type' => 'VARCHAR',
                'constraint' => '2'
            ),
            'pasal_tsk' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'jenis_perkara' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'sp_tahap' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'lokasi_tahan' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'keadaan_tahan' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'tahap_perkara' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'jenis_module' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
            'keterangan' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'created_at' => array('type' => 'timestamp')
        ));
        $this->dbforge->add_key('id', TRUE);
        if (!$this->db->table_exists($this->table_name)) $this->dbforge->create_table($this->table_name, TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table($this->table_name);
    }
}