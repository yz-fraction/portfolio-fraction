<?php

function CRDMN_Dashboard__login_form() { ?>
    
<?php }



function CRDMN_Dashboard__login_footer() {
	$sfsb_options	= get_option('fsb_settings');
	if ( isset( $sfsb_options[ 'image' ] ) ) {
		$image_URL		= $sfsb_options['image'];
		if( is_ssl() ) {
			$image_URL	= str_replace( 'http://', 'https://', $image_URL );
		}
	}
	?>
    <img src="<?php adaptive_images_e( esc_url( $image_URL ) , 'frontpage-header' ) ?>" id="pagebackground" />
<?php }