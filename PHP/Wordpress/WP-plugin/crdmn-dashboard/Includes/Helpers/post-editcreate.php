<?php

/*
 * Remove metaboxes.
 */
function remove_customposttype_metaboxes() {
	foreach ( get_post_types( array( '_builtin' => FALSE ) )  as $name_CPT ) {
		if ( strpos( $name_CPT , 'crdmn_' ) !== FALSE ) {
			$name_CPT	= 'post' ;
		//	remove_meta_box( 'postexcerpt' ,		$name_CPT , 'normal'	) ;
			remove_meta_box( 'trackbacksdiv' ,		$name_CPT , 'normal'	) ;
			remove_meta_box( 'postcustom' ,			$name_CPT , 'normal'	) ;
			remove_meta_box( 'commentstatusdiv',	$name_CPT , 'normal'	) ;
			remove_meta_box( 'commentsdiv' ,		$name_CPT , 'normal'	) ;
		//	remove_meta_box( 'revisionsdiv' ,		$name_CPT , 'normal'	) ;
		//	remove_meta_box( 'authordiv' ,			$name_CPT , 'normal'	) ;
			remove_meta_box( 'sqpt-meta-tags' ,		$name_CPT , 'normal'	) ;
			remove_meta_box( 'members-cp',			$name_CPT , 'normal'	) ;
		//	remove_meta_box( 'slugdiv',				$name_CPT , 'normal'	) ;

			remove_meta_box( 'ml_box',				$name_CPT , 'side' );
		//	remove_meta_box( 'postimagediv',		$name_CPT , 'side' );
		//	remove_meta_box( 'tagsdiv-post_tag',	$name_CPT , 'side' );
		//	remove_meta_box( 'tagsdiv-{$tax-name}',	$name_CPT , 'side' );
		//	remove_meta_box( '{$tax-name}div',		$name_CPT , 'side' );
		}
	}	
}

/*
 * Enqueue.
 */
add_action( 'cmb2_admin_init', 'cmb2_admin_assets' );
function cmb2_admin_assets() {
	wp_enqueue_style(
		'new-record' ,
		CRDMN_DASHBOARD__CSS_URL . '/new-record.css' ,
		array() ,
		NULL ,
		'screen, projection'
		);
	wp_enqueue_script(
		'new-record' ,
		CRDMN_DASHBOARD__JS_URL . 'new-record.js' ,
		array( 'jquery' ) ,
		'' ,
		FALSE
		) ;
}