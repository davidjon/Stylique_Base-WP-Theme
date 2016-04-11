<?php

/*

	---------------------------------------------------------------------------

	Create all the custom post types needed for this theme
	
	---------------------------------------------------------------------------
	
	POSTTYPE
	POSTTYPE_SINGULAR


*/


class Theme_Posttypes
{
    public function __construct()
    {
        $this->init_posttypes();
    }
    
    public function init_posttypes()
    {
        add_action( 'init', array( &$this, 'create_post_type_POSTTYPE' ) );
    }

    public function create_post_type_POSTTYPE()
    {
        $labels = array(
    		'name'               => __('POSTTYPE'),
    		'singular_name'      => __('POSTTYPE_SINGULAR'),
    		'add_new'            => __('New POSTTYPE_SINGULAR'),
    		'add_new_item'       => __('New POSTTYPE_SINGULAR'),
    		'edit_item'          => __('Edit POSTTYPE_SINGULAR'),
    		'new_item'           => __('New occasion'),
    		'all_items'          => __('Show all POSTTYPE'),
    		'view_item'          => __('View POSTTYPE_SINGULAR'),
    		'search_items'       => __('Search POSTTYPE'),
    		'not_found'          => __('Nothing found'),
    		'not_found_in_trash' => __('Nothing found'),
    		'menu_name'          => __('POSTTYPE'),
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
        register_post_type('POSTTYPE_SINGULAR', $args);
    }
}

$posttypes = new Theme_Posttypes();
?>