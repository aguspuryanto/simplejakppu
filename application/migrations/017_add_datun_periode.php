<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_datun extends CI_Migration { 
    public $table_name = 'epak_datun';

    public function up() { 
        $this->dbforge->add_field(array(
            'periode' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            )
        ));
    }

    public function down() { 

    }
}