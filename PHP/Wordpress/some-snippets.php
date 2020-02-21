<?php
defined( 'ABSPATH' ) OR exit;
/**
 * Silence is golden.
 */
?>

 
<?php if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar('crdmn-sidebar-footer-everywhere') ) : else : endif; ?>


<?php
$form_posts	= new WP_Query( array(
	'post_type'	=> 'wpcf7_contact_form' ,
	'name'		=> 'contact' ,
) ) ;
$wpcf7_form_ID	= $form_posts->posts[0]->ID ?? 0 ;
?>
<?php echo isset( $wpcf7_form_ID ) ? do_shortcode( '[contact-form-7 id="'.$wpcf7_form_ID.'" html_id="contact-wrapper" html_class="contact-wrapper"]' ) : '' ; ?>

<?php echo do_shortcode( '[contact-form-7 id="1234" title="Form title" html_id="formID" html_class="formClass"]' ) ; ?>



<?php
wp_enqueue_script(
	'TinyMCE' ,
	'TinyMCE/tinymce.min.js' ,
	array() ,
	'' ,
	TRUE );
?>
<script type="text/javascript">
	tinymce.init({
		selector: "#announcement",
		plugins: "textcolor autolink link",
		toolbar: "undo redo | bold italic | forecolor | bullist numlist | link unlink",
		menubar : false

	});
	
	tinymce.init({
		selector: "#description",
		plugins: [
			"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
			"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			"save table contextmenu directionality emoticons template paste textcolor"
			],
		toolbar: "insertfile undo redo | bold italic | forecolor | bullist numlist   | link unlink directionality | alignleft aligncenter alignright alignjustify  | outdent indent | image  media | code searchreplace | table | fullscreen",
		menubar : false,
		relative_urls: false,

		external_filemanager_path:"/wp-content/plugins/crdmn-events/Plugins/tinymce/plugins/responsivefilemanager/",
		filemanager_title:"Responsive Filemanager" ,
		external_plugins: { "filemanager" : "/wp-content/plugins/crdmn-events/Plugins/tinymce/plugins/responsivefilemanager/plugin.min.js"}
	});
</script>


<?php
global $wpdb;
global $table_name;

$plugin_version	= '1.0';
$DB_prefix	= ( is_multisite() ) ? $wpdb->base_prefix : $wpdb->prefix ;
$table_name	= $DB_prefix . CRDMN_Currency_Manager::DB_TABLE ;

if( $wpdb->get_var( "SHOW TABLES LIKE '".$table_name."'" ) != $table_name )
{
	$SQL	= '
		CREATE TABLE '.$table_name.' (
				`id` INT NOT NULL AUTO_INCREMENT ,
				`fromto` VARCHAR( 11 ) NOT NULL ,
				`rate` FLOAT( 10 ) NOT NULL ,
				`code` INT( 3 ) NOT NULL ,
				`size` INT( 3 ) NOT NULL ,
				`rate_per_one` FLOAT( 10 ) NOT NULL ,
				`change` FLOAT( 10 ) NOT NULL ,
				`timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				PRIMARY KEY ( `id` )
				) ENGINE = MYISAM ' ;

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' ) ;

	dbDelta( $SQL ) ;
}


<?php
if( ! empty( $atts['delete_transient'] ) ) { delete_transient( $weather_transient_name ); }
if( get_transient( $weather_transient_name ) )
{
	$weather_data = get_transient( $weather_transient_name );
}


if( is_active_widget( FALSE , FALSE , $this->id_base ) )
{
	
}


add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );


add_action( 'init' , 'cng_author_base' ) ;
function cng_author_base() 
{
    global $wp_rewrite;
	
    $author_slug				= 'profile' ;
	
    $wp_rewrite->author_base	= $author_slug ;
}


$term_data	= get_term_by( 'id' , absint( $term_ID ) , 'taxonomy_name' );
$term_name	= $term_data->name ;


function remove_gallery($content) {
    return remove_shortcode('gallery', $content);
}
add_filter( 'the_content', 'remove_gallery', 6);


$post_type = get_queried_object();
$post_type->rewrite['slug'];


if( !is_admin() && $q->is_main_query() && (
	$q->is_post_type_archive() AND !is_news_archive()
	) ) {
	$q->set( 'post_type', get_queried_object()->name );
}


add_filter( 'post_row_actions', 'remove_row_actions', 10, 1 );
function remove_row_actions( $actions )
{
    if( get_post_type() === 'wprss_feed_item' )
        unset( $actions['edit'] );
        unset( $actions['view'] );
        unset( $actions['trash'] );
        unset( $actions['inline hide-if-no-js'] );
    return $actions;
}


$post_language		= pll_get_post_language( $post_ID ) ;


if( is_page_template( array( 'about.php' , 'sitemap.php' ) ) )
{
	
}


function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


function se_remove_script() {
    if ( is_page_template( 'blankPage.php' ) ) {
        wp_dequeue_script( 'some-js' );
    }
}
add_action( 'wp_print_scripts', 'se_remove_script', 99 );


get_option('date_format');	# d.m.Y
get_option('time_format');	# H:m
get_option('gmt_offset');	# 1 or -1


if( ! defined( 'DS' ) ) { define( 'DS' ,	'/' ); }

define( 'COOKIE_DOMAIN', strtolower( stripslashes( $_SERVER['HTTP_HOST'] ) ) );


add_action( 'wp_loaded' , function() use ( $parametr1 , $parametr2 ) {
	
	} ) ;
	
	
# Programmatically set a page template.
update_post_meta( $page_ID , '_wp_page_template' , 'template_name.php' ) ;
	
	
//======================================================================
// WooCommerce
//======================================================================
add_filter('gettext', 'change_checkout_btn');
add_filter('ngettext', 'change_checkout_btn');
function change_checkout_btn( $checkout_btn )
{
	$checkout_btn	= str_ireplace( 'Checkout', 'Your New Text', $checkout_btn ) ;
	return $checkout_btn;
}


global $woocommerce;
$cart_URL = $woocommerce->cart->get_cart_url();


$woocommerce->cart->empty_cart();


global $wp ;
$order_ID	= $wp->query_vars[ 'view-order' ] ;
$order_data	= new WC_Order( $order_ID ) ;



// ------------------------------------------------------------------------



function tags_to_pagehead() 
{
	# <html class="no-js" lang="">
    echo '
	<link href="data:image/x-icon;base64,AAABAAEAEBAQAAAAAAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAsC8qAP+EAACzh1cAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACAAAAAAAAACAAAAAAAAACAAAAAAAAEiAAAAADAAAiAAAAAAMzAiAAAAAAAAMzAAAAAAAAAiMzMAAAAAAAADAzAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD//wAA//8AAP//AAD//wAA//8AAP//AAD//wAA//8AAP//AAD//wAA//8AAP//AAD//wAA//8AAP//AAD//wAA" rel="icon" type="image/x-icon" />
	
	<script>
		document.documentElement.className = document.documentElement.className.replace("no-js","js");
	</script>
	';
}
add_action( 'wp_head' , 'tags_to_pagehead' );



// ------------------------------------------------------------------------



/**
 * Clean excerpt.
 * 
 * © http://wordpress.org/support/topic/remove-ltpgt-tag-from-excerpt
 */
function clean_excerpt( $string ) 
{
	$tags		= array( '<p>' , '</p>' );
	$myExcerpt	= str_replace( $tags , '' , $string );
	
	return $myExcerpt;
}


// ------------------------------------------------------------------------


function phone_wrapper_skypephone( $phone_href , $phone_show = FALSE ) 
{
	$phone_show	= $phone_show === FALSE ? $phone_href : $phone_show ;

	# Prepare.
	$string_new	= '<a href="callto:+'.preg_replace( "/[^0-9]/" , '' , $phone_href ).'" title="Call with Skype">' . $phone_show . '</a>' ;

	# Return.
	$return		= $string_new ;

	return $return ;
}


// ------------------------------------------------------------------------


function wpcf7_submit( $data )
{
	
}
add_action('wpcf7_submit', 'wpcf7_submit');


// ------------------------------------------------------------------------


function disable_meta_and_term_cache(  $query ) {
	$query->set( 'update_post_meta_cache' , FALSE );
	$query->set( 'update_post_term_cache' , FALSE );
}
function disable_meta_cache(  $query ) {
	$query->set( 'update_post_meta_cache' , FALSE );
}
function disable_term_cache(  $query ) {
	$query->set( 'update_post_term_cache' , FALSE );
}

