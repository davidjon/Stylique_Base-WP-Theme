<?php

/*

	---------------------------------------------------------------------------

	Create all the custom post types needed for this theme
	
	---------------------------------------------------------------------------


*/


class Theme_Posttypes
{
    public function __construct()
    {
        $this->init_posttypes();
    }
    
    public function init_posttypes()
    {
        add_action( 'init', array( &$this, 'create_post_type_occasions' ) );
    }

    public function create_post_type_occasions()
    {
        $labels = array(
    		'name'               => __('Occasions'),
    		'singular_name'      => __('Occasion'),
    		'add_new'            => __('New occasion'),
    		'add_new_item'       => __('New occasion'),
    		'edit_item'          => __('Edit occasion'),
    		'new_item'           => __('New occasion'),
    		'all_items'          => __('Show all occasions'),
    		'view_item'          => __('View occasion'),
    		'search_items'       => __('Search occasions'),
    		'not_found'          => __('Nothing found'),
    		'not_found_in_trash' => __('Nothing found'),
    		'menu_name'          => __('Occasions'),
    		'parent_item_colon'  => '',
    	);
    	$args = array(
    		'labels'				=> $labels,
    		'public'				=> true,
    		'publicly_queryable'	=> true,
    		'show_ui'				=> true,
    		'show_in_menu'			=> true,
    		'query_var'				=> true,
    		'capability_type'		=> 'page',
    		'has_archive'			=> false,
    		'hierarchical'			=> false,
    		'menu_position'			=> 5,
    		'menu_icon'				=> '',
    		'supports'				=> array( 'title', 'thumbnail' ),
    	);
        register_post_type('occasion', $args);
    }
}

$posttypes = new Theme_Posttypes();
?>