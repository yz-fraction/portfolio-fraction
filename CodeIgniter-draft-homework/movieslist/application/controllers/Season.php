<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Season extends CI_Controller {
	
	public function __construct()  {
		parent::__construct();
	}
		
	public function all( $record_ID = FALSE ) {
		## Variables.
		$data				= array();
		
		## Get seasons.
		# Load model.
		$this->load->model( 'M_season' );
			
		# Get seasons.
		$data[ 'seasons' ]	= $this->M_season->by_record( $record_ID );
		
		# Load view.
		$this->load->view( 'season/all' , $data );
	}
		
	public function view( $season_ID = FALSE ) {
		# Variables.
		$data				= array();
		
		# Load model.
		$this->load->model( 'Records' );
		$this->load->model( 'M_season' );
		$this->load->model( 'M_episodes' );
		
		# Get record data.
		$data[ 'record' ]	= $this->Records->name_by_seasonID( $season_ID );
		
		# Get episodes.
		$data[ 'episodes' ]	= $this->M_episodes->by_season( $season_ID  );
		
		# Prepare seasons.
		$data[ 'season' ]	= $this->M_season->get_name( $season_ID );
		$data[ 'season' ][ 'season_start' ]		= $this->M_episodes->date_start( $data[ 'episodes' ] );
		$data[ 'season' ][ 'season_finish' ]	= $this->M_episodes->date_finish( $data[ 'episodes' ] );
		
		# Load view.
		$this->load->view( 'season/view' , $data );
	}
}
