<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordCRUD extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		
		$this->load->model(
			'records'
		);
	}
		
	
	# Create.
	public function create() {
		if( ! empty( $_POST ) ) {
			# Set upload file configuration.
			$config[ 'upload_path' ]	= dirname( BASEPATH ) . '/uploads/' ;
			$config[ 'allowed_types' ]	= 'gif|jpg|png';

			# Load library.
			$this->load->library( 'upload' , $config );
			
			# Load model.
			$this->load->model( 'M_recordCRUD' );
			
			# If poster uploaded.
			if ( $this-> upload-> do_upload( 'userfile' ) ) {
				# Get uploaded file data.
				$data = array( 'upload_data' => $this-> upload-> data() );
				
				# Prepare data.
				$_POST[ 'poster_filename' ]	= $data[ 'upload_data' ][ 'file_name' ] ;
			}
			unset( $_POST[ 'userfile' ] ) ;
			
			# Execute.
			$this->M_recordCRUD->create( $_POST );
			
			# Redirect to dashboard.
			redirect( site_url() . '/dashboard/' );
		}
	}
	
	# Read.
	public function read( $ID = FALSE ) {
		$data   = $this->records->one( $ID );
		$this->load->view( 'Dashboard/crud/read' , $data );
	}
	
	# Update.
	public function update( $ID = FALSE ) {
		# Update.
		if( ! empty( $_POST ) ) {
			# Set upload file configuration.
			$config[ 'upload_path' ]	= dirname( BASEPATH ) . '/uploads/' ;
			$config[ 'allowed_types' ]	= 'gif|jpg|png';

			# Load library.
			$this->load->library( 'upload' , $config );
			
			# Load model.
			$this->load->model( 'M_recordCRUD' );
			
			# If poster uploaded.
			if ( $this-> upload-> do_upload( 'userfile' ) ) {
				# Get uploaded file data.
				$data = array( 'upload_data' => $this-> upload-> data() );
				
				# Prepare data.
				$_POST[ 'poster_filename' ]	= $data[ 'upload_data' ][ 'file_name' ] ;
			}
			unset( $_POST[ 'userfile' ] ) ;

			# Execute.
			$this->M_recordCRUD->update( $ID , $_POST );

			# Redirect to result.
			redirect( site_url() . '/'.__CLASS__.'/update/' . $ID );
		} 
		
		# Display.
		else {
			if( $ID ) {
				# Get record.
				$data[ 'record' ]   = $this->records->one( $ID );

				# Get seasons.
				$this->load->model( 'm_season' );
				$data[ 'seasons' ]  = $this->m_season->for_record( $ID );

				# View.
				$this->load->view( 'Dashboard/crud/update' , $data );
			} else {
				ci_die() ;
			}
		}
	}
	
	# Delete.
	public function delete( $ID = FALSE ) {
		# Load model.
		$this->load->model( 'M_recordCRUD' );
		
		# Execute.
		$data   = $this->M_recordCRUD->delete( $ID );
		
		# Redirect to dashboard.
		redirect( site_url() . '/dashboard/' );
	}
}
