<?php
/*

	---------------------------------------------------------------------------

	Disable all the default Wordpress functions I'll probably won't need at all
	
	---------------------------------------------------------------------------


*/


// ---- Remove the clutter from the header
// ---------------------------------------
		
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'start_post_rel_link');
		remove_action('wp_head', 'index_rel_link');
		remove_action('wp_head', 'adjacent_posts_rel_link');
		
		
// ---- Remove the Emoji support 
// -----------------------------		
		
		function rswebsols_disable_emojis_tinymce( $plugins ) {
   			
   			return array_diff( $plugins, array( 'wpemoji' ) );

   		}

		function disable_wp_emojicons() {
	
		  // all actions related to emojis
		  remove_action( 'admin_print_styles', 'print_emoji_styles' );
		  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		  remove_action( 'wp_print_styles', 'print_emoji_styles' );
		  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		
		  // filter to remove TinyMCE emojis
		  add_filter( 'tiny_mce_plugins', 'rswebsols_disable_emojis_tinymce' );
		
		}
		add_action( 'init', 'disable_wp_emojicons' );
		
		
// ---- Remove unused Widgets 
// --------------------------

		 function unregister_default_widgets() {
		     unregister_widget('WP_Widget_Pages');
		     unregister_widget('WP_Widget_Calendar');
		     unregister_widget('WP_Widget_Archives');
		     unregister_widget('WP_Widget_Links');
		     unregister_widget('WP_Widget_Meta');
		     unregister_widget('WP_Widget_Search');
		     unregister_widget('WP_Widget_Text');
		     unregister_widget('WP_Widget_Categories');
		     unregister_widget('WP_Widget_Recent_Posts');
		     unregister_widget('WP_Widget_Recent_Comments');
		     unregister_widget('WP_Widget_RSS');
		     unregister_widget('WP_Widget_Tag_Cloud');
		     unregister_widget('Twenty_Eleven_Ephemera_Widget');

		 }
		 add_action('widgets_init', 'unregister_default_widgets', 11);	
		 
		
// ---- Remove the default image sizes, since we resize them on the fly
// --------------------------------------------------------------------		
		
		function remove_default_image_sizes( $sizes) {
			unset( $sizes['thumbnail']);	
			unset( $sizes['medium']);
			unset( $sizes['large']);
     
			return $sizes;
		}
		add_filter('intermediate_image_sizes_advanced', 'remove_default_image_sizes');
		
		
// ---- Remove Links & Comments menu in Admin, since we don't use 'em most of the time
// -----------------------------------------------------------------------------------

		function remove_menus () {
		global $menu;
			$restricted = array(__('Links'), __('Comments'));
			end ($menu);
			while (prev($menu)){
				$value = explode(' ',$menu[key($menu)][0]);
				if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
			}
		}
		add_action('admin_menu', 'remove_menus');


// ---- Add custom logo to the dashboard
// -------------------------------------

		function custom_login_logo() {
			echo '<style type="text/css">
			.login h1 a { background-image: url(http://www.stylique.nl/handtekening/logo.jpg) !important; 
				height: 120px; width: 200px; background-size: auto; margin: 0 auto; 
				}
			</style>';
		}
		add_action('login_head', 'custom_login_logo'); 
		
		
// ---- Add basic theme support
// -------------------------------------

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'widgets' );
		

// ---- Remove jQuery Migrate
// -------------------------------------
		
		add_filter( 'wp_default_scripts', 'dequeue_jquery_migrate' );

		function dequeue_jquery_migrate( &$scripts){
			if(!is_admin()){
				$scripts->remove( 'jquery');
				$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.11.3', 1);
			}
		}