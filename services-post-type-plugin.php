<?php

/**
* Plugin Name: Custom Post Type - Gravity Forms HTML Field Plugin
* Plugin URI: https://forms.keetrax.com/services-post-type-plugin
* Description: A services custom post type, built for Gravity Forms HTML field.
* Version: 1.0
* Author: Erica Bradley
**/


/*Resources that helpd with the Shortcode and Plugin
https://wordpress.org/support/article/post-types/
https://codex.wordpress.org/The_Loop
https://codex.wordpress.org/Function_Reference/register_post_type
https://developer.wordpress.org/reference/classes/wp_query/
*/
  


//Registers the Custom Post Type
add_action('init', array('Keetrax_Services', 'register_cpt_services'));  

//Registers the Custom Post Type Taxonomy - e.g. Categories, Tags.
add_action('init', array('Keetrax_ServiceTaxonomy', 'register_service_taxonomy'));

//Registers the Custom Post Type Shortcode
add_action('init', array('Keetrax_Shortcode', 'register_cpt_shortcode'));


class Keetrax_Services
{
    //Registers the Custom Post Type
    static function register_cpt_services()
    {

        //Labels used for Displaying the Custom Post Type, 
        $labels = array

        (
            'name'                      => _x( 'Services', 'Post Type General Name', 'services-plugin'), 
            'singular_name'             => _x( 'Service', 'Post Type Singular Name', 'services-plugin'),
            'add_new'                   => _x( 'Add New', 'Service', 'services-plugin'),                
            'add_new_item'              => _x( 'Add New Item', 'New Service','services-plugin'),
            'edit_item'                 => __( 'Edit Item', 'services-plugin'),
            'new_item'                  => __( 'New Item', 'services-plugin'),
            'update_item'               => __( 'Update Item', 'services-plugin'),
            'view_item'                 => __( 'View Item', 'services-plugin'),
            'view_items'                => __( 'View Items', 'services-plugin'),
            'search_items'              => __( 'Search Item', 'services-plugin'),
            'not_found'                 => __( 'Not found', 'services-plugin'),
            'not_found_in_trash'        => __( 'Not found in Trash', 'services-plugin'),
            'parent_item_colon'         => __( 'Parent Item:', 'services-plugin'),
            'all_items'                 => __( 'All Items', 'services-plugin'),
            'archives'                  => __( 'Item Archives', 'services-plugin'),
            'attributes'                => __( 'Item Attributes', 'services-plugin'),
            'insert_into_item'          => __( 'Insert into item', 'services-plugin'),
            'uploaded_to_this_item'     => __( 'Uploaded to this item', 'services-plugin'),
            'featured_image'            => __( 'Featured Image', 'services-plugin'),
            'set_featured_image'        => __( 'Set featured image', 'services-plugin'),
            'remove_featured_image'     => __( 'Remove featured image', 'services-plugin'),
            'use_featured_image'        => __( 'Use as featured image', 'services-plugin'),
            'filter_items_list'         => __( 'Filter items list', 'services-plugin'),
            'items_list'                => __( 'Items list', 'services-plugin'),
            'items_list_navigation'     => __( 'Items list navigation', 'services-plugin'),
            'menu_name'                 => _x( 'Services', 'menu name', 'services-plugin'),
            'name_admin_bar'            => _x( 'Service', 'admin bar name', 'services-plugin'),
            'item_published'            => _x('Item Published', 'item published', 'services-plugin'),
            'item_plublished_privately' => __('Item Reverted to draft', 'services-plugin'),
            'item_updated'              => __('Item Updated', 'services-plugin'),
            'item_scheduled'            => __('Item Scheduled', 'services-plugin'),
        );

        //Arguments for the Post Type - Used to Display the Custom Post type in the Admin Interface.
        $args = array
        (
            'label'                     => __( 'Service', 'services-plugin'),
            'description'               => __( 'Service Description', 'services-plugin'),
            'labels'                    => $labels,
            'supports'                  => array('title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes', 'post-formats'),
            'taxonomies'                => array( 'category', 'post_tag' ),
            'hierarchical'              => false,
            'public'                    => true,  //Visible to Appropriate Users
            'show_ui'                   => true,
            'show_in_menu'              => true,
            'menu_position'             => 10,    //This Displays the Custom Post Type Below Media on the Admin Panel
            'menu_icon'                 => 'dashicons-format-aside',
            'show_in_admin_bar'         => true,
            'show_in_nav_menus'         => true,
            'can_export'                => true,
            'has_archive'               => true,
            'exclude_from_search'       => false, //This Custom Post Type can be Searched in the Amdin Panel
            'publicly_queryable'        => true,
            'capability_type'           => 'post',
            'capability'                => array('edit_post' => 'edit_Service',
            'edit_terms'                => 'edit_Service',
            'delete_terms'              => 'delete_Service', 
            'assign_terms'              => 'assign_Service',
            'create_posts'              => 'edit_Services',
            'manage_terms'              => 'manage_Services'),
            'map_meta_cap'              => true,
            'rewrite'                   => array('slug', 'with_front', 'feeds', 'pages'),
          );

                       
        //Registers the Custom Post Type
        register_post_type('service', $args);

    }
}

class Keetrax_ServiceTaxonomy
{

    // Registers Taxonomy For Custom Post Type
    static function register_service_taxonomy()
    {
          //Labels used for Grouping the Custom Post Type
           $lables = array
		   (
		      'name'				    => _x('Services','services-plugin'),//Adds Context to the name of the Custom Post Type
              'singular_name'           => _x('Service', 'Type', 'services-plugin'),
              'all_items'               => __('All Service', 'services-plugin'),
              'search_items'            => __('Search Service', 'services-plugin'),
              'parent_item'             => __('Parent Service', 'services-plugin'),
              'parent_item_colon'       => __('Parent Service:', 'services-plugin'),
			  'edit item'               => __('Edit Service', 'services-plugin'),
			  'update_item'             => __('Update Service', 'services-plugin'),
			  'add_new_item'            => __('Add New Service', 'services-plugin'),
			  'new_item_name'           => __('New Service', 'services-plugin'),
			  'menu_name'               => __('Service', 'services-plugin'),
			  'popular_items'           => __('Services', 'services-plugin'),
			  'back_to_items'           => __('Back to Services', 'services-plugin'),
			  'add_or_remove_items'     => __('Add or remove Services', 'service-plugin'),
            );

            //Arguments used with the Labels to Group the Custom Post Type
            $args = array
			(
               'public'                 => true,
               'hierarchical'           => false,
			   'labels'                 => $labels,
			   'show_ui'                => true,
			   'show_admin_column'      => true,                        
			   'update_count_callback'  => '_update_post_term_count',
			   'query_var'              => true,
			   'show_in_menu'           => true,
			   'show_in_nav_menus'      => true,
			   'show_tagcloud'          => true,
			   'rewrite'                => array('slug', 'with_font', 'hierarchical'),
			   'capabilities'           => array('manage_terms', 'edit_terms', 'delete_terms', 'assign_terms'),
			   'sort'                   => true,
                );

            //Adds the Taxonomy, passes in the array's arguments.
            register_taxonomy('service', $args); 
               
    }

}

     
//Class for Service Shortcode retreival
class Keetrax_ShortcodeServices
{
                     
    static function get_cpt_content( $atts )
    {
            //Attributes used to Display Shortcode for Custom Post Type
            $atts = shortcode_atts( array
            ( 
                 'post_type' => 'service', 
                 'title' => 'null',        //Title of the Custom Post Type
                 'p' => 'null',            //Used to ID the Different Custom Posts
                 'post_status' => 'publish',
                 'posts_per_page' => 1,       
            ), $atts );
             
           //Each time the Shortcode is called , the Post Type Attributes are Queried.
           $getPostContent = new WP_Query($atts);

           //If there is a Post for the Shortcode called, then this will be Displayed
           if ( $getPostContent->have_posts() ) :
               
               while ( $getPostContent->have_posts() ) : $getPostContent->the_post();
         
                    //Displays the Custom Post Type Content    
                    $content = apply_filters('the_content',get_the_content( ));
            
               ob_start();
            ?>
			
				<!--Displays the Custom Post Type Content-->
				<div class="content">
                 
					<?php 
						echo $content; 
					?>    
				</div>

            <?php 
        
				endwhile;   
            endif;     
               
            wp_reset_postdata();//Needs to reset, as this loops each time the shortcode is called.
    
            return ob_get_clean();//Helps to reset the Queried Post Type.

    }
     
}
     
class Keetrax_Shortcode
{   
    //Function to Register the Shortcode
    static function register_cpt_shortcode(){
         
        //Gets the Function and class for the Shortcode and Registers them.
        add_shortcode('service', array('Keetrax_ShortcodeServices','get_cpt_content'));          
    }         
}

?>