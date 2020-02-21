<?php

class M_seasonCRUD extends CI_Model {

    var $table	= 'seasons';
    var $key_ID	= 'ID';

    public function __construct() {
	parent::__construct();
    }
    
    
    public function create() {
		if( ! empty( $_POST ) ) {
			# Variables.
			$record_ID	= $_POST[ 'record_ID' ] ;

			# Get number rows.
			$this-> db-> select( 'record_ID' );
			$this-> db-> where( 'record_ID' , $record_ID );
			$numrows	= $this-> db-> count_all_results( $this->table );
			$season_num	= $numrows ? ++$numrows : 1 ;
//			echo '<pre>' ; print_r( $season_num ) ; echo '</pre>' ;exit;
			# Build array.
			$_POST[ 'season_ID' ]   = $season_num ;

			# Create.
			$this-> db-> insert( $this->table , $_POST );
		}
    }
    public function update( $ID = FALSE , $data = FALSE ) {
	if( $ID AND $data ) {
	    $this-> db-> where( $this->key_ID , $ID );
	    $this-> db-> update( $this->table , $data );
	    
	}
    }
    public function delete( $ID = FALSE ) {
	if( $ID ) {
	    $this-> db-> where( $this->key_ID , $ID );
	    $this-> db-> delete( $this->table );
	}
    }

}
