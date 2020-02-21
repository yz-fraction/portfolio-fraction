<?php

class M_season extends CI_Model {

    var $table	= 'seasons';
    var $key_ID	= 'ID';

    public function __construct()
    {
		parent::__construct();
    }
	

//    public function index( $ID = FALSE ) {
//		$query	= $this-> db-> get( $this->table );
//
//		return $query->result_array();
//	}
	

    public function get_name( $season_ID = FALSE ) {
		# Query.
		$this-> db-> select( 'season_ID AS season_name' );
		$this-> db-> where( 'ID' , $season_ID );
		$query	= $this-> db-> get( $this->table ) ;

		# Return.
		return $query->row_array();
	}

     public function get_name_by_recordID( $record_ID = FALSE ) {
		# Query.
		$this-> db-> select( ''.$this->table.'.'.$this->key_ID . ', title' );
		$this-> db-> where( 'seasons.'.$this->key_ID , $record_ID );
		$this-> db-> join( $this->table , $this->table.'.'.$this->key_ID . ' = seasons.record_ID', 'left');
		$query	= $this-> db-> get( 'seasons' ) ;

		# Return.
		return $query->row_array();
	}

    public function for_record( $record_ID = FALSE ) {
		# Variables.
		$data	= array() ;

		# Get seasons.
		$this-> db-> where( 'record_ID' , $record_ID );
		$this-> db-> select( 'ID, season_ID' );
		$query	= $this-> db-> get( $this->table ) ;

		# Build array.
		foreach ( $query->result_array() as $row ) {
			$data[ $row[ 'ID' ] ]  = $row[ 'season_ID' ];
		}

		# Return.
		return $data;
    }
    
    public function by_record( $record_ID = FALSE ) {
		# Query.
		$this->db->select( '
			`seasons`.`ID` AS season_ID, 
			`seasons`.`season_ID` AS seasons_number, 
			(
				SELECT
					MIN( episodes.date_start )
				FROM 
					episodes 
				WHERE 
					`seasons`.`ID` = `episodes`.`season_ID` AND '.$this->table.'.record_ID='.$record_ID.'
			) AS date_start ,
			(
				SELECT
					MAX( episodes.date_start )
				FROM 
					episodes 
				WHERE 
					`seasons`.`ID` = `episodes`.`season_ID` AND '.$this->table.'.record_ID='.$record_ID.'
			) AS date_finish
		' , FALSE ) ;
		$this-> db-> where( $this->table.'.record_ID' , $record_ID );
		$query = $this-> db-> get( $this->table );

		# Return.
		return $query->result_array();
    }

}
