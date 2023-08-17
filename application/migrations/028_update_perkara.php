<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_update_perkara extends CI_Migration { 
    public function up() {
        // update table
        $table_name = 'epak_perkara'; //$this->db->dbprefix('epak_perkara');
        if (!$this->db->field_exists('kajari_note', $table_name)) {
            $this->dbforge->add_column($table_name, array(
                'kajari_note' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'keterangan'))
            );
        }

        $table_name = 'epak_tahan';
        if (!$this->db->field_exists('kajari_note', $table_name)) {
            $this->dbforge->add_column($table_name, array(
                'kajari_note' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'keterangan'))
            );
        }

        $table_name = 'epak_inkracth';
        if (!$this->db->field_exists('kajari_note', $table_name)) {
            $this->dbforge->add_column($table_name, array(
                'kajari_note' => array('type' => 'VARCHAR', 'constraint' => 100, 'after' => 'keterangan'))
            );
        }
    }
}