<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_Add_datun_periode extends CI_Migration { 
    public $table_name = 'epak_datun';

    public function up() {
        if (!$this->db->field_exists('periode', $this->table_name)) {            
            $fields = array(
                'periode' => array('type' => 'VARCHAR', 'constraint' => '100')
            );
            $this->dbforge->add_column($this->table_name, $fields);
        }
    }

    public function down() { 

    }
}