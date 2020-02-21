<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function __construct() 
	{
	    parent::__construct();

	    $this-> load-> helper(
			'url' ,
			'form'
			);
	    $this->load->model(
			'records'
			);
    }
        
	public function index() {
	    $data['records']   = $this->records->all();
	    //echo '<pre>' ; print_r( $data ) ; echo '</pre>' ;
	    $this->load->view( 'welcome_message' , $data );
	}
}
