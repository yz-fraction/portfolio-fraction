<?php

class CRDMN_Dashboard__disabling {

	function __construct() {
			add_action( 'admin_menu',					array( $this, 'dashboard_widgets' ) );
			
			add_action( 'admin_menu',					array( $this, 'left_bar_links' ) );
	}

	public function dashboard_widgets() {
		if( isset( $GLOBALS[ 'user_level' ] ) AND $GLOBALS[ 'user_level' ] != 10 ) {
			remove_meta_box( 'dashboard_right_now' ,		'dashboard', 'core' );
			remove_meta_box( 'dashboard_activity' ,			'dashboard', 'core' );
			remove_meta_box( 'dashboard_recent_comments' ,	'dashboard', 'core' );
			remove_meta_box( 'dashboard_incoming_links' ,	'dashboard', 'core' );
			remove_meta_box( 'dashboard_plugins' ,			'dashboard', 'core' );

//			remove_meta_box( 'dashboard_quick_press' ,		'dashboard', 'core' );
			remove_meta_box( 'dashboard_recent_drafts' ,	'dashboard', 'core' );
			remove_meta_box( 'dashboard_primary' ,			'dashboard', 'core' );
			remove_meta_box( 'dashboard_secondary' ,		'dashboard', 'core' );
		}
	}

	public function left_bar_links() {
		if( isset( $GLOBALS[ 'user_level' ] ) AND $GLOBALS[ 'user_level' ] != 10 ) {
			remove_menu_page( 'index.php' );                  //Dashboard
			remove_menu_page( 'jetpack' );                    //Jetpack* 
			//remove_menu_page( 'edit.php' );                   //Posts
			//remove_menu_page( 'upload.php' );                 //Media
			//remove_menu_page( 'edit.php?post_type=page' );    //Pages
			remove_menu_page( 'edit-comments.php' );          //Comments
			remove_menu_page( 'themes.php' );                 //Appearance
			remove_menu_page( 'plugins.php' );                //Plugins
			remove_menu_page( 'users.php' );                  //Users
			remove_menu_page( 'profile.php' );                //Users
			remove_menu_page( 'tools.php' );                  //Tools
			remove_menu_page( 'options-general.php' );        //Settings
		}
	}
}


