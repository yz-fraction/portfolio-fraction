<?php if ( ! defined( 'ABSPATH' ) ) { exit ; } ?>
<?php
include_once 'Functions/error_reporting.php' ;

# System.
include_once 'Functions/security.php' ;
include_once 'Functions/permalinks.php' ;
include_once 'Functions/themecleaner.php' ;
include_once 'Functions/constants.php' ;
include_once 'Functions/Helpers/string.php' ;
include_once 'Functions/Helpers/URL_helper.php' ;
include_once 'Functions/Helpers/array_helper.php' ;
foreach( glob( dirname(__FILE__) . '/Functions/Helpers/*.php' ) as $value ) { is_file($value) AND file_exists($value) AND include $value; }
include_once 'Functions/core.php' ;
include_once 'Functions/polylang.php' ;
include_once 'Functions/conditions.php' ;

# BE-FE.
include_once 'Functions/path.php' ;
include_once 'Settings/UAC.php' ;

# BE.
include_once 'Functions/permissions.php' ;
include_once 'Functions/medialibrary.php' ;
include_once 'Functions/Plugins/cmb2.php' ;
include_once 'Plugin-BE/socialmedia.php' ;
include_once 'Plugin-BE/metrics.php' ;
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

# FE.
include_once 'Functions/style.php' ;
include_once 'Functions/theme.php' ;
include_once 'Functions/profile.php' ;
include_once 'Functions/email.php' ;
include_once 'Functions/post.php' ;

# Enqueue.
include_once 'Functions/enqueue.php' ;

# Sitemap.
add_filter( 'template_include', 'beans_child_template_redirect' );
function beans_child_template_redirect( $template ) {
    global $wp;
    if ( $wp->request === 'sitemap.xml' ) {
		return TEMPLATEPATH . '/Plugin-BE/sitemap.php' ;
	} else {
		return $template;
	}
}