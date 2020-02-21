<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
	public function __construct()  
	{
		parent::__construct();

		$this->load->helper(
			'html'
			);
		$this->load->model(
			'records'
			);
	}

        
	public function index( $ID = FALSE ) {
	    $data['records']   = $this->records->all();
	    $this->load->view( 'Dashboard/dashboard' , $data );
	}
        
	public function update( $ID = FALSE ) {
		# Get record.
		$data	= $this->records->one( $ID );

		# View.
		$this->load->view( 'Dashboard/update' , $data );
	}
}
