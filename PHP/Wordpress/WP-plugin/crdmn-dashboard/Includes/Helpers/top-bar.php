<?php

function top_bar__hide() {
	add_filter( 'show_admin_bar', '__return_false' );
}

function top_bar__remove() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
	$wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
	$wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
	$wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
	$wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
	$wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
	$wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
	$wp_admin_bar->remove_menu('view-site');        // Remove the view site link
	$wp_admin_bar->remove_menu('updates');          // Remove the updates link
	$wp_admin_bar->remove_menu('comments');         // Remove the comments link
	$wp_admin_bar->remove_menu('new-content');      // Remove the content link
	$wp_admin_bar->remove_menu('view');			    // Remove the view link
	$wp_admin_bar->remove_menu('archive');			// Remove the archive link
	$wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
//	$wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
	$wp_admin_bar->remove_menu('languages');        // Remove the languages link
	$wp_admin_bar->remove_menu('updraft_admin_node');        // Remove the languages link
	$wp_admin_bar->remove_menu('preview');        // Remove the languages link
}

function top_bar__left( $wp_admin_bar ) {
	$args_dashboard = array(
		'id'	=> 'crdmn-dashboard',
		'title'	=> '<span><i class="fa fa-tachometer" aria-hidden="true"></i>'.__('Dashboard').'</span>',
		'href'	=> admin_url(),
		);
	$wp_admin_bar->add_node($args_dashboard);


	$args_website = array(
		'id'	=> 'crdmn-website',
		'title'	=> '<span><i class="fa fa-home" aria-hidden="true"></i>'.__('Home').'</span>',
		'href'	=> site_url(),
		);
	$wp_admin_bar->add_node($args_website);
}

function top_bar__right( $wp_admin_bar )
{
	# Profile link.
	$current_user	= wp_get_current_user();
	$howdy			= sprintf( __('%1$s'), $current_user->display_name );
	$wp_admin_bar->add_node( array(
        'id'	=> 'my-account' ,
        'title'	=> '<i class="fa fa-user-o" aria-hidden="true"></i>'.$howdy ,
    ) ) ;
	
	
	# Logout button.
	if ( is_user_logged_in() ) {
       $wp_admin_bar->add_node(
            array(
                'id'     => 'crdmn-logout',
                'parent' => 'top-secondary',
                'title'  => __( 'Log out' ) . '<i class="fa fa-sign-out" aria-hidden="true"></i>' ,
                'href'   => wp_logout_url(),
            )
        );
    }
}