<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SeasonCRUD extends CI_Controller {
    
    public function __construct() {
	parent::__construct();
    }


    public function create() {
	if( ! empty( $_POST ) ) {
	    # Load model.
	    $this->load->model( 'M_seasonCRUD' );
	    
	    # Execute.
	    $this->M_seasonCRUD->create();
	    
	    # Redirect to dashboard.
	    redirect( site_url() . '/dashboard/' );
	}
    }
}
