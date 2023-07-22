<?php

class Migrate extends CI_Controller
{
    public function __construct() {
		parent::__construct ();
		
		// $this->input->is_cli_request () or exit ( "Execute via command line: php index.php migrate" );
		
		$this->load->library ( 'migration' );
	}
    public function index()
    {
        // if (! $this->migration->current ()) {
		// 	show_error ( $this->migration->error_string () );
		// } else {
		// 	echo "version: ";
		// 	echo $this->migration->current() . "<br>";
        //     echo "Table Migrated Successfully.";
        // }

		if ($this->migration->current() === FALSE)
        {
            echo $this->migration->error_string();
        }else{
            echo "version: " . $this->migration->version(17) . ". Table Migrated Successfully.";
        }
    }

}