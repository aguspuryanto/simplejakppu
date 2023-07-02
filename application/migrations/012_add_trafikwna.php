<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_trafikwna extends CI_Migration { 
    public $table_name = 'epak_trafikwna';

    public function up() { 
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'asal_wna' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'pnduduk_wna' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'tnaga_kerja' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'plajar' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'pneliti' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'kluarga' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'rohaniwan' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'ilegal' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'usaha' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'sosbud' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'wisata' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
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
        if ($this->db->table_exists($this->table_name)) $this->dbforge->drop_table($this->table_name);
    }
}