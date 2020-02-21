<?php

class M_recordCRUD extends CI_Model {

    var $table	= 'records';
    var $key_ID	= 'ID';

    public function __construct()
    {
		parent::__construct();
    }
    
    # Create.
    public function create( $data = FALSE ) {
		if( ! empty( $data['title'] ) ) {
			$this-> db-> insert( $this->table , $data );
		}
    }
	
	# Update.
    public function update( $ID = FALSE , $data = FALSE ) {
		if( $ID AND $data ) {
			$this-> db-> where( $this->key_ID , $ID );
			$this-> db-> update( $this->table , $data );
		}
    }
	
	# Delete.
    public function delete( $ID = FALSE ) {
		if( $ID ) {
			$this-> db-> where( $this->key_ID , $ID );
			$this-> db-> delete( $this->table );
		}
    }

}
