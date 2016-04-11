<?php

/*

	---------------------------------------------------------------------------

	General function used a cross the website
	
	---------------------------------------------------------------------------


*/

define("THEME_ROOT", dirname(__FILE__).'/');
define("THEME_ASSETS_ROOT", dirname(__FILE__).'/assets/');

require_once( THEME_ROOT . '/functions/theme.setup.php'); 


if(!function_exists('is_ajax_rq')) {

	function is_ajax_rq() {
		
		return (!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) AND strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest" ? true : false); 
	
	}

}


// ----------- Remove default body classes, not using them and .page conflicts with mine

		add_filter( 'body_class', 'wpse15850_body_class', 10, 2 );
		
		function wpse15850_body_class( $wp_classes, $extra_classes ) {
		
		    // List of the only WP generated classes allowed
		    $whitelist = array( 'home', 'error404', 'page-template' );
		   // $whitelist = array( 'page-template' );
		
		    // Filter the body classes
		    $wp_classes = array_intersect( $wp_classes, $whitelist );
		
		    // Add the extra classes back untouched
		    return array_merge( $wp_classes, (array) $extra_classes );
		}
		
		
		
	
	function share_url($platform, $url, $title) 
	{
		
		
		if($platform === 'twitter') :
			
			$url = 'http://twitter.com/intent/tweet?status='.urlencode($title).' - '.urlencode($url); 
			
		elseif($platform === 'facebook') :
		
			$url = 'http://www.facebook.com/share.php?u='.urlencode($url).'&title='.urlencode($title); 

		endif; 
		
		echo $url; 
		
	}