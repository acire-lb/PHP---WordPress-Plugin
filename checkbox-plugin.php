<?php

/**
* Plugin Name: Checkbox plugin - Gravity Forms checkbox Field Plugin
* Plugin URI: https://forms.keetrax.com/services-post-type-plugin
* Description: scripts for the checkbox and entry information, built for Gravity Forms field.
* Version: 1.0
* Author: Erica Bradley
**/



//Gets the Entry Details from a submitted entry
add_action('init', 'get_entry_details');


   		
    function set_readonly_settings()
	{
         	//Updates the Fields in the 9th Form as read only
		add_filter( 'gform_field_content_9', 'set_readonly_field', 10, 2);

 		function set_readonly_field( $field_content, $field ) 
		{
   			return str_replace( 'type=', "readonly='readonly' type=", $field_content );
		}
    	}


         //Sets the Fields with the class 'gf_readonly' as read only
        add_filter( 'gform_pre_render_9', 'set_field_readonly' );
    	
	function set_field_readonly( $form ) 
     	{
    		?>
			<script type="text/javascript">
			jQuery(document).ready(function()
			{
				jQuery("li.gf_readonly input").attr("readonly","readonly");
			});
			</script>
		<?php
		return $form;//Returns the Form Details to render
      	}
     	

     //Gets the Entry ID information
     function get_entry_details()
     
     {
          //checks if the entry_id is set.   
         if(isset($_GET['entry_id']))
	 {
                  $id = $_GET['entry_id'];
                  $entry = GFAPI::get_entry( $id);
          }   
           
          return $entry;//returns the Entry from the Entry ID
     }
     


     //Updates the Service options parameter from the Previous entry
     add_filter( 'gform_field_value_client_email', 'set_email_field_value', 10, 3 );
         
        function set_email_field_value($entry)
        {
            $entries = get_entry_details($entry);
            return $entries[4];  //Returns the Entry for the Client email Information
         }



     //Updates the client name parameter from the Previous entry
     add_filter( 'gform_field_value_client_name', 'set_name_field_value', 10, 4 );
         
	function set_name_field_value($entry)
        {
            $entries = get_entry_details($entry);
            return $entries[2];//Returns the Client Name Information from the Entry
	}
		


     //Updates the Service options parameter from the Previous entry
     add_filter( 'gform_field_value_service_options', 'set_service_field_value', 10, 3 );
         
        function set_service_field_value($entry)
        {
	    $entries = get_entry_details($entry);
            return $entries;
	}
    
     
 
?>
