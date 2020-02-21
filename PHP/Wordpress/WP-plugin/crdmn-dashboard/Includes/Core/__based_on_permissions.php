<?php

#
# Dashboard.
#
add_action( 'plugins_loaded' , 'CRDMN_Dashboard__based_on_permissions__1' );
function CRDMN_Dashboard__based_on_permissions__1 () {
	if( isset( $GLOBALS[ 'user_level' ] ) AND $GLOBALS[ 'user_level' ] != 10 ) {
		# Post CRUD.
		add_filter( 'manage_posts_columns',	'CRDMN_Dashboard__post_list__columns',	20, 2 );
		add_action( 'do_meta_boxes' ,		'remove_customposttype_metaboxes' ,		20 );
		
		# Styling dashboard.
		add_action( 'wp_before_admin_bar_render',	'top_bar__remove');
		add_action( 'admin_bar_menu' ,				'top_bar__left' );
		add_action( 'admin_bar_menu',				'top_bar__right' , 25 ) ;
	}
}
add_action( 'setup_theme',	'top_bar__hide' );
function CRDMN_Dashboard__based_on_permissions__2 () {
	if ( ! current_user_can( 'administrator' ) ) {
		# Styling dashboard.
		top_bar__hide();
	}
}


#
# Login.
#
add_action( 'login_form' ,		'CRDMN_Dashboard__login_form' );
add_action( 'login_footer' ,	'CRDMN_Dashboard__login_footer' );