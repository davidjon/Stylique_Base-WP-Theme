<?php
/*

	---------------------------------------------------------------------------

	Data Class for Posttypes to easily display data on the frontend
	
	---------------------------------------------------------------------------


*/

class PostType_Data
{
    public function __construct()
    {
    	//...
    }
    
   public function single_posttype_data($id, $type = 'all')
   {
	   $item = get_post($id); 
	   
	   if(isset($item)) :
	   
	   
	   		$data = array(
		   				'id'			=> $item->ID,
		   				'title'			=> $item->post_title,
		   				'slug'			=> $item->post_name,
		   				'terms'			=> wp_get_post_terms($item->ID, 'terms', array("fields" => "ids")),
		   				'acf' 			=> get_field('werkbladen_pdf', $item->ID),
		   				); 
	   
	   
		   	if($type === 'all' ) :

		   		$data['custom']			= $this->get_custom_function('jwz', $item->ID);
		   		
		   	endif; 
		   		
			return $data; 
		
		endif;
	   
   }

   
   public function get_custom_function($foo, $bar) {
	   
	  return array($foo, $bar);    

   }

   public function get_posttype_taxname($postid, $taxonomy = 'taxname')
   {
	   $item = get_post($postid); 
	   
	   if(isset($item)) :
	   	
	   		$terms = wp_get_post_terms($item->ID, $taxonomy, array("fields" => "ids"));
	   		
	   		//get the first term
	   		$term = $terms[0];
	   		
	   		//get the slug for term
	   		$term = get_term( $term, $taxonomy );
	   		$slug = $term->slug;
	   		
	   		return $slug; 
	   	
	   endif;
	   
	   return false; 
	   
	   
   }
   
// ---- Get Posts from post type. 
// ------------------------------

	public function get_posts($postid = false, $limit = -1) {
					
					
		$conditions = array(
			'posts_per_page' => $limit,
			'post_type' => 'posstype',
			'post_status' => 'publish',
			'orderby' => 'title',
			'order' => 'ASC',
		);
		
		if($postid){
			$conditions['post__not_in'] = array($postid); 
		}
		
		$posts = get_posts($conditions);

		if (isset($posts)) : 
		 
		 	$output = array();
		 	
			foreach($posts as $post) :
				
				$output[] = $this->single_posttype_data($post->ID);

			endforeach;
			
			return $output;
			
		endif;
		
		return false;
		
	}

 

}
?>