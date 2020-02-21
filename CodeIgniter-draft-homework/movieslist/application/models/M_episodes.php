<?php

class M_episodes extends CI_Model {

    var $table	= 'episodes';
    var $key_ID	= 'ID';

    public function __construct() {
		parent::__construct();
    }
    
    
	public function one_by_episodeID( $episode_ID = FALSE ) {
		$this-> db-> where( 'ID' , $episode_ID );
		$query	= $this-> db-> get( $this->table );

		return $query->row_array();
    }

	public function by_record( $record_ID = FALSE ) {
		$this-> db-> where( 'record_ID' , $record_ID );
		$this-> db-> order_by( 'date_start' , 'asc' );
		$query	= $this-> db-> get( $this->table );

		return $query->result_array();
    }

	public function by_ID( $episode_ID = FALSE ) {
		$this-> db-> where( 'episode_ID' , $episode_ID );
		$this-> db-> order_by( 'date_start' , 'asc' );
		$query	= $this-> db-> get( $this->table );

		return $query->result_array();
    }

	public function by_season( $season_ID = FALSE ) {
		$this-> db-> where( 'season_ID' , $season_ID );
		$this-> db-> order_by( 'date_start' , 'asc' );
		$query	= $this-> db-> get( $this->table );

		return $query->result_array();
    }

	public function date_start( $episodes_arr = FALSE ) {
		reset( $episodes_arr );	
		return $episodes_arr[ key( $episodes_arr ) ][ 'date_start' ] ;
    }
	public function date_finish( $episodes_arr = FALSE ) {
		end( $episodes_arr );	
		return $episodes_arr[ key( $episodes_arr ) ][ 'date_start' ] ;
    }
}
