<?php
/*

	---------------------------------------------------------------------------

	Customize the columns in the Wordpress Admin
	
	---------------------------------------------------------------------------


*/


class Theme_Columns
{
    public function __construct()
    {
        $this->init_columns();
    }
    
    public function init_columns()
    {
      $this->custom_posttype_columns();
    }
    
    public function custom_posttype_columns() 
    {
	    
	    //create custom slide columns
      	add_filter( 'manage_edit-slide_columns', 'edit_posttype_columns');
      	add_action( 'manage_posttype_posts_custom_column', 'manage_posttype_columns', 10, 2 );
	    
	    function edit_posttype_columns($columns) {
	    
		    $columns = array(
				'cb' => '<input type="checkbox" />',
				'title' => __( 'Titel' ),
				'col1' => __( 'Col 1' ),
				'col2' => __('Col 2')
			);
			return $columns;
	    
		}
		
		function manage_posttype_columns( $column, $post_id ) {
			global $post;
		
			switch( $column ) {
			
				
				case 'col1' :
		
					echo 'Plaats hier wat getoond moet worden';
					
					break;
							
				case 'col2' :
							
					echo 'Plaats hier wat getoond moet worden';
					break;
		
				default :
					break;
			}
		}
    
    }
    
}

$columns = new Theme_Columns(); 

?>