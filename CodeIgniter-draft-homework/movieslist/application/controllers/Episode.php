<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Episode extends CI_Controller {
	
	public function __construct()  {
		parent::__construct();
	}
		
	public function all( $record_ID = FALSE ) {
		# Variables.
		$data				= array();
		
		# Load model.
		$this->load->model( 'Records' );
		$this->load->model( 'M_episodes' );
			
		# Get record data.
		$data[ 'record' ]	= $this->Records->name_by_ID( $record_ID );
		
		# Get seasons.
		$data[ 'episodes' ]	= $this->M_episodes->by_record( $record_ID );
		
		# Load view.
		$this->load->view( 'episode/all' , $data );
	}
		
	public function view( $episode_ID = FALSE ) {
		# Variables.
		$data				= array();
		
		# Load model.
		$this->load->model( 'Records' );
		$this->load->model( 'M_season' );
		$this->load->model( 'M_episodes' );
			
		# Get record data.
		$data[ 'record' ]	= $this->Records->name_by_episodeID( $episode_ID );
		
		# Get episode.
		$data[ 'episode' ]	= $this->M_episodes->one_by_episodeID( $episode_ID );
		
		# Load view.
		$this->load->view( 'episode/view' , $data );
	}
}
