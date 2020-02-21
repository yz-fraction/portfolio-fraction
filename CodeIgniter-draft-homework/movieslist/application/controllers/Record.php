<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Record extends CI_Controller {
	
		public function __construct() {
			parent::__construct();

			$this-> load-> model(
				'records'
				);
		}
		
	public function index( $ID = FALSE ) {
		# Get data.
		$data['records']	= $this->records->get();
		
		# Load view.
		$this->load->view( 'welcome_message' , $data );
	}
		
	public function view( $record_ID = FALSE ) {
		## Variables.
		$data				= array();
		
		
		## Get episodes.
		# Load model.
		$this->load->model( 'M_episodes' );
			
		# Get episodes.
		$data[ 'episodes' ]	= $this->M_episodes->by_record( $record_ID  );
		
		
		## Get seasons.
		# Load model.
		$this->load->model( 'M_season' );
			
		# Get seasons.
		$data[ 'seasons' ]	= $this->M_season->by_record( $record_ID );
		
		
		## Get record.
		$data[ 'record' ]	= $this->records->one( $record_ID );
		$data[ 'record' ][ 'season_start' ]		= $this->M_episodes->date_start( $data[ 'episodes' ] );
		$data[ 'record' ][ 'season_finish' ]	= $this->M_episodes->date_finish( $data[ 'episodes' ] );
		

		## Load view.
		$this->load->view( 'record/view' , $data );
	}
}
