<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ML_Files extends CI_Model {
	
	public function upload_poster( $file_name )
	{
		$upload_path	= './cover/original/';
		
		$config['upload_path']		= ''.$upload_path.'';
		$config['file_name']		= ''.$file_name.'';
		$config['overwrite']		= TRUE;
		$config['allowed_types']	= 'jpg';
		$config['max_size']			= '1500';
		$config['max_width']		= '1500';
		$config['max_height']		= '1500';
		
		$this->load->library('upload' , $config );
		
		if ( $this->upload->do_upload() )
		{
			$data = array('upload_data' => $this->upload->data());
			
			$file_name				= $file_name.$data['upload_data']['file_ext'];
			$original_poster_path	= $upload_path.$file_name;
			
			return $this->_resize_poster( $original_poster_path , $file_name );
		}
		else
		{
			return FALSE;
		}
	}
	
	private function _resize_poster( $original_poster_path , $filename )
	{
		$file_path		= $original_poster_path;
		$file_path_64	= './cover/64/'.$filename;
		
		$config_64['image_library']		= 'gd2';
		$config_64['source_image']		= ''.$original_poster_path.'';
		$config_64['new_image']			= ''.$file_path_64.'';
		$config_64['create_thumb']		= TRUE;
		$config_64['maintain_ratio']	= TRUE;
		$config_64['master_dim']		= 'width';
		$config_64['thumb_marker']		= '_64';
		$config_64['width']				= 64;
		$config_64['height']			= 64;
		$this->load->library("image_lib");
		$this->image_lib->initialize( $config_64 );
		$this->image_lib->resize();
		$this->image_lib->clear();
		
		$file_path_64	= ltrim( $file_path_64 ,	'.' );
		
		
		$root			= $_SERVER['DOCUMENT_ROOT'];
		$file_path_64	= $root.substr( $file_path_64 ,  0 , strlen( $file_path_64 )  - 4 ).'_64.jpg';
		
		unset( $root );
		unset( $filename );
		unset( $original_poster_path );
		
		return ( file_exists ( $file_path_64 ) ) ? TRUE : FALSE;
	}
}

