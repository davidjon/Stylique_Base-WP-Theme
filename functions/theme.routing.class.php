<?php
/*

	---------------------------------------------------------------------------

	Create custom routing
	
	---------------------------------------------------------------------------


*/
class Theme_Routing
{
    public function __construct()
    {
        $this->init_routing();
    }
    
    public function init_routing()
    {
        add_action( 'init',  array(&$this, 'add_rewrite_tag'));

        add_filter( 'post_type_link', array(&$this, 'filter_post_type_link'), 1, 4 );        

    }

    public function add_rewrite_tag()
    {
	    // defines the rewrite structure for 'chapters', needs to go first because the structure is longer
	    // says that if the URL matches this rule, then it should display the 'chapters' post whose post name matches the last slug set
	   // add_rewrite_rule( '^arrangement/([^/]*)/([^/]*)/([^/]*)/?','index.php?slide=$matches[3]','top' );
	    add_rewrite_rule( '^missie/([^/]*)/([^/]*)/([^/]*)/?','index.php?presentatie=$matches[3]','top' );
	    // defines the rewrite structure for 'books'
	    // says that if the URL matches this rule, then it should display the 'books' post whose post name matches the last slug set
	    add_rewrite_rule( '^missie/([^/]*)/([^/]*)/?','index.php?les=$matches[2]','top' );   
	    
    }
    public function filter_post_type_link($post_link, $post, $leavename, $sample)
    {
    	switch( $post->post_type ) {

        case 'les':

           //haal de juiste arrangementen id op
           $arrangement = get_post_meta($post->ID, 'arrangement_id', true);
           $post_slug = $post->post_name;
         
           //lees de juiste terms uit
           // $groep = get_the_terms($arrangement, 'groep');
           // $voedselgroep = get_the_terms($arrangement, 'voedselgroep');
            
           
           $arrangement_data = get_post($arrangement);
            
                if ( isset( $arrangement_data->post_name )) {
                    // create the new permalink met als structuur /arrangement/groep-voedselgroep/titel 
                    $post_link = home_url( user_trailingslashit( 'missie/' . $arrangement_data->post_name . '/' . $post_slug ) );
                }

            break;
            
         case 'presentatie':

            // I spoke with Dalton and he is using the CPT-onomies plugin to relate his custom post types so for this example, we are retrieving CPT-onomy information. this code can obviously be tweaked with whatever it takes to retrieve the desired information.
            // we need to find the author the book belongs to. using array_shift() makes sure only one author is allowed
            $arrangement = get_post_meta($post->ID, 'arrangement_id', true);
            $post_slug = $post->post_name;
            
         
            //var_dump($arrangement);
         
            $arrangement_data = get_post($arrangement);
            
                if ( isset( $arrangement_data->post_name) ) {
                    // create the new permalink
                    $post_link = home_url( user_trailingslashit( 'missie/' . $arrangement_data->post_name . '/digibord/' . $post_slug ) );
                }

            break;
            


      
       }
       return $post_link;
    }
}

$routing = new Theme_Routing();
?>