<?php

/*
 * class Manipulation_book
 */

class Manipulation_book  {
	
	public function __get( $var )
	{
		return get_instance()->$var;
	}
	
	
	public function form( $book_info = FALSE )
	{
		if( ! isset ( $book_info['title'] ) )
		{
			$book_info = FALSE;
		}
		
		# Form attributes
		$data['form']['form']	= array(
								'id'		=> 'book' ,
								'name'		=> 'book' ,
								
								'method'	=> 'post' ,
								
								'class'		=> 'form-horizontal' ,
		);
		
		# Input: book title
		$f_name = 'title';
		$data['form']['title']	= array(
								'id'			=> $f_name ,
								'name'			=> $f_name ,
								
								'class'			=> 'input-xlarge' ,
								
								'size'			=> '' ,
								'maxlength'		=> '' ,
								
								'required'		=> '' ,
								
								'value'			=> set_value( $f_name , ( $book_info != FALSE ) ? $book_info[$f_name] : NULL ) ,
								'placeholder'	=> lang('placeholder_'.$f_name.''),
		);
		
		# Input: author
		$f_name = 'author';
		$data['form'][$f_name]	= array(
								'id'			=> $f_name ,
								'name'			=> $f_name ,
								
								'class'			=> 'input-xlarge' ,
								
								'size'			=> '' ,
								'maxlength'		=> '' ,
								
								'required'		=> '' ,
								
								'value'			=> set_value( $f_name , ( $book_info != FALSE ) ? $book_info[$f_name] : NULL ) ,
								'placeholder'	=> lang('placeholder_'.$f_name.''),
		);
		
		# Select userfile button
		$f_name = 'userfile';	# field name
		$data['form'][$f_name]		= array(
								'id'			=> $f_name ,
								'name'			=> $f_name ,
								
								'class'			=> $f_name ,
		);
		
		# Rubrics
		$data['form']['rubrics']	= $this->M_rubric->checked_rubrics( $book_info['ID'] );
		
		# Submit button
		$data['form']['submit']	= array(
								'id'			=> 'submit_book' ,
								'name'			=> 'submit' ,
								'class'			=> 'btn' ,
								'value'			=> lang('form_submit') ,
		);
		
		# Cover
		if ( ! $book_info )
		{
			$data['form']['ID']	= 0;
			$data['form']['cover']		= books_list( $data['form'] );
		}
		
		
		
		return $data['form'];
	}
	
	
	// --------------------------------------------------------------------
	
	
	public function index( $data , $ID , $action )
	{
		# Update book
		$book['author']	= $data['author'];
		$book['title']	= $data['title'];
		
		# Update rubrics
		$rubrics		= $data['rubrics'];
		
		switch( $action )
		{
			case 'insert': 	# Insert data
							$book				= $this->_insert_book( $book );
							$rubrics			= $this->_insert_rubrics( $rubrics );
							break;
						
			case 'update': 	# Update data
							$book				= $this->_update_book( $book , $ID );
							$rubrics			= $this->_update_rubrics( $rubrics , $ID );
							break;
		}
		
		return ( $book AND $rubrics ) ? TRUE : FALSE ;
	}
	
	
	// --------------------------------------------------------------------
	
	
	public function book_delete( $book_ID )
	{
		# Delete cover
		$cover 		= cover_by_ID( $book_ID );
		$filename	= $_SERVER['DOCUMENT_ROOT'].cover_by_ID( $book_ID );
		if ( file_exists( $filename ) )
		{
			unlink( $_SERVER['DOCUMENT_ROOT'].$cover );
		}
		
		# Delete rubrics
		$this->db->delete( 'rubriclink' , array( 'book_ID' => $book_ID ) );
		
		# Delete
		return $this->db->delete( 'book' , array( 'ID' => $book_ID ) );
	}
	
	
	// --------------------------------------------------------------------
	
	
	private function _insert_book( $data )
	{
		if( is_array( $data ) )
		{
			return $this->db->insert( 'book' , $data );
		}
	}
	
	private function _insert_rubrics( $data )
	{
		if( is_array( $data ) )
		{
			$book_ID	= $this->M_book->last_ID();
			
			foreach( $data as $key => $value )
			{
				# Step by step: insert country
				$array = array(
								'book_ID'	=> $book_ID ,
								'rubric_ID'	=> $value['ID']
				);
				
				$result = $this->db->insert( 'rubriclink' , $array );
				
				unset( $array );
			}
		}
		
		return ( $result ) ? TRUE : FALSE ;
	}
	
	
	
	// --------------------------------------------------------------------
	
	
	private function _update_book( $data , $ID )
	{
		
		return $this->db->update(
									'book' ,
									$data ,
									array( 'ID' => $ID )
									);
	}
	
	private function _update_rubrics( $data , $book_ID )
	{
		# Delete old rubrics
		$this->db->delete( 'rubriclink' , array( 'book_ID' => $book_ID ) );
		
		# Insert new rubrics
		if( is_array( $data ) )
		{
			foreach( $data as $key => $value )
			{
				# Step by step: insert new rubric
				$array = array(
								'book_ID'	=> $book_ID ,
								'rubric_ID'	=> $value['ID']
								);
				
				$result = $this->db->insert( 'rubriclink' , $array );
				
				unset( $array );
			}
		}
		
		return ( $data ) ? TRUE : FALSE ;
	}
}