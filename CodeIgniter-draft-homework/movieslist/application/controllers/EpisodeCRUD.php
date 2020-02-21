<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EpisodeCRUD extends CI_Controller {
    
    public function __construct() {
	parent::__construct();
    }


    public function create() {
	if( ! empty( $_POST ) ) {
	    # Load model.
	    $this->load->model( 'M_episodeCRUD' );
	    
	    # Execute.
	    $this->M_episodeCRUD->create();
	    
	    # Redirect to dashboard.
	    redirect( site_url() . '/dashboard/' );
	}
    }
}
