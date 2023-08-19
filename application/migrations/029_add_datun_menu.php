<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_datun_rev extends CI_Migration { 
    public $table_name = 'epak_datun_menu';

    public function up() { 
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nama' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'deskripsi' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'parent' => array(
                'type' => 'CHAR',
                'constraint' => '4'
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->table_name, TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table($this->table_name, TRUE);
    }

}