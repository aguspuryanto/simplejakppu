<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_add_datun_menu extends CI_Migration { 
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

        $menu_datun = array(array(
            'nama' => "gakkum",
            'deskripsi' => "GAKKUM",
            'parent' => 0,
        ), array(
            'nama' => "timkum",
            'deskripsi' => "TIMKUM",
            'parent' => 0,
        ), array(
            'nama' => "bankum",
            'deskripsi' => "BANKUM",
            'parent' => 0,
        ), array(
            'nama' => "thl",
            'deskripsi' => "THL",
            'parent' => 0,
        ), array(
            'nama' => "yankum",
            'deskripsi' => "YANKUM",
            'parent' => 0,
        ));

        $submenu_gakkun = array(array(
            'nama' => "gakkum_ligitasi",
            'deskripsi' => "Ligitasi",
            'parent' => 1,
        ), array(
            'nama' => "gakkum_nonligitasi",
            'deskripsi' => "Non Ligitasi",
            'parent' => 1,
        ));

        $menu_datun = array_merge($menu_datun, $submenu_gakkun);

        $submenu_timkum = array(array(
            'nama' => "timkum_lo",
            'deskripsi' => "Legal Opinian (LO)",
            'parent' => 2,
        ), array(
            'nama' => "timkum_la",
            'deskripsi' => "Legal Assistant (LA)",
            'parent' => 2,
        ));

        $menu_datun = array_merge($menu_datun, $submenu_timkum);
        
        $this->db->insert_batch($this->table_name, $menu_datun);
    }

    public function down()
    {
        $this->dbforge->drop_table($this->table_name, TRUE);
    }

}