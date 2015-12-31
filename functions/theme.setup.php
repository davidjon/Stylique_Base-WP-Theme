<?php

/*

	---------------------------------------------------------------------------

	General starting point for a custom theme
	
	---------------------------------------------------------------------------


*/

class Theme_Setup
{
	public function __construct() 
	{

		//setup theme
		$this->setup_theme(); 

		// setup menu's, sidebar navigation & assets
		add_action( 'init', array( &$this, 'setup_menus' ) );	
		add_action( 'init', array( &$this, 'setup_sidebars' ) );
		add_action('wp_enqueue_scripts', array( &$this, 'setup_assets' ));	

			
	}
	public function setup_theme()
	{
		
		//load the reset function
		require_once( THEME_ROOT . 'functions/theme.reset.php' );
		
		//load the custom image resize script to resize on the fly
		require_once( THEME_ROOT . 'functions/plugin.image.resize.php' );

		//load custom classes for post types, taxonomies etc. 
		require_once( THEME_ROOT . 'functions/theme.post-types.class.php' );
		require_once( THEME_ROOT . 'functions/theme.taxonomies.class.php' );
		require_once( THEME_ROOT . 'functions/theme.columns.class.php' );
		require_once( THEME_ROOT . 'functions/theme.routing.class.php' );
		
		
		//get data modals ready to be used on pages
		require_once( THEME_ROOT . 'functions/data.post-type.class.php' );
		
	}
	public function setup_menus()
	{
		register_nav_menu('main_nav', __('Main Navigation'));
	}
	public function setup_sidebars()
	{
		register_sidebar(array(
			'name' => __('Sidebar'),
			'id'   => 'sidebar',
			'description'   => __('Put your widgets here'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		));
	}
	public function setup_assets()
	{
		wp_enqueue_style( 'main',  THEME_ASSETS_ROOT . '/css/main.css');
		//wp_register_style( 'main',  THEME_ASSETS_ROOT . '/css/main.css');
		
		wp_dequeue_script('jquery-migrate'); 
		wp_enqueue_script( 'main', THEME_ASSETS_ROOT . '/js/main.min.js', array('jquery'), NULL , true );
		//wp_register_script( 'sticky-js', THEME_ASSETS_ROOT . '/bower_components/bla.js', array('jquery'), NULL, true );
	}
}

$setup = new Theme_Setup();

?>