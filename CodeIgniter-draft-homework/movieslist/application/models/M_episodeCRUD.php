<?php

class M_episodeCRUD extends CI_Model {

    var $table	= 'episodes';
    var $key_ID	= 'ID';

    public function __construct() {
	parent::__construct();
    }
    
    
    public function create() {
	if( ! empty( $_POST ) ) {
	    # Get number rows.
	    $this-> db-> from( $this->table );
	    $query	= $this-> db-> get();
	    $rowcount	= $query-> num_rows();
	    
	    # Create.
	    $result	= $this-> db-> insert( $this->table , $_POST );
	}
    }

}
