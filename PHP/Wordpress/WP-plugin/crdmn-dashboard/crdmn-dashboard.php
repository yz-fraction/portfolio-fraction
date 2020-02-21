<?php
/*
Plugin Name:	CRDMN Dashboard
Description:	Design&permissions for "$GLOBALS[ 'user_level' ] != 10"
Version:		1.0.
Author:			Veselyj.
*/

if ( ! defined( 'ABSPATH' ) ) { exit ; }

//https://codex.wordpress.org/Creating_Admin_Themes
class CRDMN_Dashboard__ {

	const CLASS_NAME				= __CLASS__ ;

	public function __construct() {

		# Define.
		define( 'CRDMN_DASHBOARD__PLUGIN_DIR' ,			plugin_dir_path( __FILE__ ) ) ;
		define( 'CRDMN_DASHBOARD__PLUGIN_URL' ,			WP_PLUGIN_URL . basename(__FILE__, '.php' ) . '/' )  ;
		include_once ( 'Includes/Core/__define.php' ) ;

		# Load files.
		include_once ( 'Includes/Core/__load_includes.php' ) ;
		include_once ( 'Includes/Core/__based_on_permissions.php' ) ;
	}
}
$GLOBALS[ 'CRDMN_Dashboard__' ] = new CRDMN_Dashboard__() ;