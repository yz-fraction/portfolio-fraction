<?php

class CRDMN_Dashboard__enqueue {

	function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'assets_dashboard' ) );
		add_action( 'login_enqueue_scripts', array( $this, 'assets_login' ) );
	}

	public function assets_login() {
		#
		# Stylesheets.
		#
		wp_enqueue_style(
			'crdmn-login' ,
			CRDMN_DASHBOARD__PLUGIN_URL . 'Assets/Stylesheet/login.css' ,
			array() ,
			NULL ,
			'screen, projection'
			) ;
	}

	public function assets_dashboard() {
		if( ! current_user_can( 'administrator' ) ) {
			#
			# Stylesheets.
			#
			wp_register_style( 'font-awesome-css' , 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', false, '4.7.0', null);
			wp_enqueue_style( 'font-awesome-css' );

			$file_list__stylesheet	= glob( CRDMN_DASHBOARD__PLUGIN_DIR . 'Assets/Stylesheet/Everywhere/*.css' ) ;
			if( $file_list__stylesheet )
			{
				foreach( $file_list__stylesheet as $value )
				{
					if( $value != 'login.css' ) {
						$file_info		= pathinfo( $value ) ;
						$file_name		= $file_info[ 'filename' ] ;
						wp_enqueue_style(
							$file_name ,
							WP_SITEURL . ltrim( str_delete( $_SERVER['DOCUMENT_ROOT'] , $value ) , '/' ) ,
							array() ,
							NULL ,
							'screen, projection'
							) ;
					}
				}
			} 


			#
			# Scripts.
			#
			$arr_enqueue_script	= array(
				//'file_name'			=> 'Dir_name' ,
			) ;
			foreach ( $arr_enqueue_script as $key => $value ) {
				$file_path	= CRDMN_DASHBOARD__PLUGIN_DIR . 'Assets/Script/' . $value.DS.$key.'.js' ;
				if( is_file( $file_path ) AND file_exists( $file_path ) AND is_readable( $file_path ) )
				{
					wp_enqueue_script(
						$key ,
						WP_SITEURL . ltrim( str_delete( $_SERVER['DOCUMENT_ROOT'] , $file_path ) , '/' ) ,
						array() ,
						'' ,
						TRUE
						);
				}
			}
		}
	}
}