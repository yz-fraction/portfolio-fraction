<?php

//	error_reporting( E_ALL );
//	ini_set( 'display_errors' , TRUE );
//	ini_set( 'html_errors' , TRUE );

###
# Classes.
###
$file_list_classes	= glob( CRDMN_DASHBOARD__CLASSES_DIR . '*.php' ) ;
if( $file_list_classes )
{
	foreach( $file_list_classes as $key => $value )
	{
		$fileinfo		= pathinfo( $value ) ;
		$class_name		= $fileinfo[ 'filename' ] ;
		$class_name_new	= CRDMN_Dashboard__::CLASS_NAME . $class_name;

		if( is_file( $value ) AND file_exists( $value ) AND is_readable( $value ) )
		{
			require_once $value ;

			if( class_exists( $class_name_new ) )
			{
				# Init classes.
				$this->$class_name	= new $class_name_new() ;
			}
		}
	}
}


###
# Helpers.
###
$file_list__helpers	= glob( CRDMN_DASHBOARD__HELPERS_DIR . '*.php' ) ;
if( $file_list__helpers )
{
	foreach( $file_list__helpers as $key => $value )
	{
		is_file( $value ) AND file_exists( $value ) AND require_once $value ;
	}
}