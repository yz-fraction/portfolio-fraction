<?php

class Records extends CI_Model {

    var $table	= 'records';
    var $key_ID	= 'ID';

    public function __construct()
    {
		parent::__construct();
    }
	

	public function name_by_ID( $ID = FALSE ) {
		# Query.
		$this-> db-> select( ''.$this->key_ID.', title' );
		$this-> db-> where( $this->table.'.'.$this->key_ID , $ID );
		$query	= $this-> db-> get( $this->table ) ;

		# Return.
		return $query->row_array();
	}

	public function name_by_seasonID( $season_ID = FALSE ) {
		# Query.
		$this-> db-> select( ''.$this->table.'.'.$this->key_ID . ', title' );
		$this-> db-> where( 'seasons.'.$this->key_ID , $season_ID );
		$this-> db-> join( $this->table , $this->table.'.'.$this->key_ID . ' = seasons.record_ID', 'left');
		$query	= $this-> db-> get( 'seasons' ) ;

		# Return.
		return $query->row_array();
	}

	public function name_by_episodeID( $episode_ID = FALSE ) {
		# Query.
		$this-> db-> select( ''.$this->table.'.'.$this->key_ID . ', '.$this->table.'.title' );
		$this-> db-> where( 'episodes.'.$this->key_ID , $episode_ID );
		$this-> db-> join( $this->table , $this->table.'.'.$this->key_ID . ' = episodes.record_ID', 'left');
		$query	= $this-> db-> get( 'episodes' ) ;

		# Return.
		return $query->row_array();
	}

	public function one( $ID = FALSE ) {
		# Query.
		$this-> db-> select(
			'
			'.$this->table.'.ID ,
			'.$this->table.'.title ,
			'.$this->table.'.body ,
			'.$this->table.'.poster_filename ,
			MIN(episodes.date_start) AS date_start ,
			MAX(episodes.date_start) AS date_finish ,
			(
				SELECT COUNT(*)
				FROM 
					episodes 
				WHERE 
					`record_ID` = '.$ID.'
			) AS episodes_count ,
			(
				SELECT COUNT(*)
				FROM 
					seasons 
				WHERE 
					`record_ID` = '.$ID.'
			) AS seasons_count ,
			'
			);
		$this-> db-> from( $this->table );
		$this-> db-> join( 'episodes' , $this->table.'.'.$this->key_ID . ' = episodes.record_ID', 'left');
		$this-> db-> where( $this->table.'.'.$this->key_ID , $ID );
		$query  = $this->db->get();

		# Return.
		return $query->row_array();
    }

    public function all()  {
		# Query.
		$query  = $this->db->get( $this->table ) ;
		
		# Return.
		return $query->result();
    }

}
