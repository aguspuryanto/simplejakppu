<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_bbtidaklaku extends CI_Migration { 
    public $table_name = 'epak_bbtidaklaku';

    public function up() {  
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'tahun' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'jml' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'hasil' => array(
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

    public function down() { 
        if ($this->db->table_exists($this->table_name)) $this->dbforge->drop_table($this->table_name);
    }