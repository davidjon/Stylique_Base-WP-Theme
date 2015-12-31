<?php

/*

	---------------------------------------------------------------------------

	Create custom Taxonomies
	
	---------------------------------------------------------------------------


*/



class Theme_Taxonomies
{
    public function __construct()
    {
        $this->init_taxonomies();
    }
    
    public function init_taxonomies()
    {
        add_action( 'init', array( &$this, 'create_taxonomy_taxname' ) );

    }

    public function create_taxonomy_taxname()
    {
    	$args = array(
			'hierarchical' => true,
			'label' =>  __('Tax name', 'base'),
			'query_var' => true,
			'rewrite' => array( 'slug' => 'taxname', 'with_front' => false  ),	
		);
        
        register_taxonomy( 'taxname', 'postype', $args); 
    }
}

$taxonomies = new Theme_Taxonomies();
?>